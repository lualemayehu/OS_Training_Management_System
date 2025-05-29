<?php
/* Database connection start */
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "aflex_tms";

$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());

/* Database connection end */


// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;


$columns = array( 
// datatable column index  => database column name

	0=> 'ev_id',
	1 => 'ev_tittle_subject',
	2 => 'ev_request_date',
	3 => 'ev_start_date',
	4 => 'ev_end_date',
	5 => 'org_name',
	6 => 'cust_first_name',
	7 => 'cust_phone',
	8 => 'cust_type',
	9 => 'ev_round',
	
	
);

// getting total number records without any search

	$sql = "SELECT `ev_id`,`ev_round`, `ev_tittle_subject`, `ev_request_date`, `ev_start_date`, `ev_end_date`,`org_name`";
	$sql.="FROM `event` LEFT JOIN `organization` on `event`.`fk_organization`=`organization`.`org_id`";
	

$query=mysqli_query($conn, $sql) or die("ajax-data.php: get Org");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


if( !empty($requestData['search']['value']) ) {
	// if there is a search parameter
	$sql = "SELECT `ev_id`,`ev_round`, `ev_tittle_subject`, `ev_request_date`, `ev_start_date`, `ev_end_date`,`org_name`";
	$sql.="FROM `event` LEFT JOIN `organization` on `event`.`fk_organization`=`organization`.`org_id` ";
	
	$sql.=" WHERE ev_id LIKE '".$requestData['search']['value']."%' ";    // $requestData['search']['value'] contains search parameter
	$sql.=" OR ev_tittle_subject LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR ev_level LIKE '".$requestData['search']['value']."%' ";
    $sql.=" OR ev_mode_of_delivery LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR ev_language LIKE '".$requestData['search']['value']."%' ";
    $sql.=" OR ev_key_note LIKE '".$requestData['search']['value']."%' ";
    $sql.=" OR org_name LIKE '".$requestData['search']['value']."%' ";
    
	$query=mysqli_query($conn, $sql) or die("ajax-data.php: get eve");
	$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result without limit in the query 

	$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   "; // $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc , $requestData['start'] contains start row number ,$requestData['length'] contains limit length.
	$query=mysqli_query($conn, $sql) or die("ajax-data.php: get Org"); // again run query with limit
	
} else {	
	$sql = "SELECT `ev_id`, `ev_round`,`ev_tittle_subject`, `ev_request_date`, `ev_start_date`, `ev_end_date`,`org_name`";
	$sql.="FROM `event` LEFT JOIN `organization` on `event`.`fk_organization`=`organization`.`org_id`";
	
$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
	$query=mysqli_query($conn, $sql) or die("ajax-data.php: get Org");   
	
}

$data = array();
while( $row=mysqli_fetch_array($query) ) {  // preparing an array
	$nestedData=array(); 
	$trevent=$row["ev_id"];
	$query_tr =mysqli_query($conn,"SELECT `cust_first_name`,`cust_phone` FROM `customer` WHERE `fk_event`= $trevent AND `cust_type`='Coordinator' AND `deleted`='0'");

	$nestedData[] = $row["ev_round"];
	$nestedData[] = $row["org_name"];
    $nestedData[] = $row["ev_tittle_subject"];
	$nestedData[] = $row["ev_request_date"];
	$nestedData[] = $row["ev_start_date"];
    $nestedData[] = $row["ev_end_date"];
	if($query_tr->num_rows > 0){
	while ($row2=mysqli_fetch_array($query_tr)){
		$nestedData[] = $row2["cust_first_name"];
		$nestedData[] = $row2["cust_phone"];
		}
	}else {
		$nestedData[] = "-";
		$nestedData[] = "-";
	}
    /*$nestedData[] = '<td><center>
                     <a href="edit-siswa.php?kd='.$row['kode_siswa'].'"  data-toggle="tooltip" title="Edit" class="btn btn-sm btn-primary"> <i class="glyphicon glyphicon-edit"></i> </a>
				     <a href="hapus-siswa.php?kd='.$row['kode_siswa'].'"  data-toggle="tooltip" title="Delete" onclick="return confirm(\'Anda yakin akan menghapus data '.$row['nama_siswa'].'?\')" class="btn btn-sm btn-danger"> <i class="glyphicon glyphicon-trash"> </i> </a>
	                 </center></td>';		*/
	
	$data[] = $nestedData;
    
}



$json_data = array(
			"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
			"recordsTotal"    => intval( $totalData ),  // total number of records
			"recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
			"data"            => $data   // total data array
			);

echo json_encode($json_data);  // send data as json format

?>
