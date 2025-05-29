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
	0=> 'org_id',
	1 => 'org_name',
	2 => 'org_region',
	3 => 'org_sub_city',
	4 => 'org_woreda',
	5 => 'org_city',
	6 => 'org_phone',
	7 => 'org_phone_2', 
	8 => 'org_email',
	9 => 'org_type',
	
	

);

// getting total number records without any search
$sql = "SELECT org_id, org_name, org_region, org_sub_city, org_woreda, org_city, org_phone, org_phone_2, org_email, org_type";
$sql.=" FROM organization";
$query=mysqli_query($conn, $sql) or die("ajax-data.php: get Org");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


if( !empty($requestData['search']['value']) ) {
	// if there is a search parameter
	$sql = "SELECT org_id, org_name, org_region, org_sub_city, org_woreda, org_city, org_phone, org_phone_2, org_email, org_type";
	$sql.=" FROM organization";
	$sql.=" WHERE org_id LIKE '".$requestData['search']['value']."%' ";    // $requestData['search']['value'] contains search parameter
	$sql.=" OR org_name LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR org_email LIKE '".$requestData['search']['value']."%' ";
    $sql.=" OR org_type LIKE '".$requestData['search']['value']."%' ";
    
	$query=mysqli_query($conn, $sql) or die("ajax-data.php: get Org");
	$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result without limit in the query 

	$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   "; // $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc , $requestData['start'] contains start row number ,$requestData['length'] contains limit length.
	$query=mysqli_query($conn, $sql) or die("ajax-data.php: get Org"); // again run query with limit
	
} else {	

	$sql = "SELECT org_id, org_name, org_region, org_sub_city, org_woreda, org_city, org_phone, org_phone_2, org_email, org_type";
	$sql.=" FROM organization";
	$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
	$query=mysqli_query($conn, $sql) or die("ajax-data.php: get Org");   
	
}

$data = array();
while( $row=mysqli_fetch_array($query) ) {  // preparing an array
	$nestedData=array(); 
	
	
	$ev_org=$row["org_id"];
	$query_eve =mysqli_query($conn,"SELECT * FROM `event` WHERE `fk_organization` =$ev_org order by ev_start_date desc");

    $nestedData[] = $row["org_name"];
	$nestedData[] = $row["org_region"];
    $nestedData[] = $row["org_city"];
	$nestedData[] = $row["org_phone"];
	$nestedData[] = $row["org_phone_2"];
	$nestedData[] = $row["org_email"];
	if($query_eve->num_rows > 0){
		while ($row2=mysqli_fetch_array($query_eve)){
			$nestedData[] = $row2["ev_start_date"];
			}
		}else {
			$nestedData[] = "-";
		}
	

    /* $nestedData[] = '<td><center>
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
