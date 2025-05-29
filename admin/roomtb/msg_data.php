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
	0=> 'msg_id',
	1 => 'msg_er_name',
	2 => 'msg_detail',
	3 => 'created_at',
	4 => 'resolve_status',
	5 => 'resolve_date',
	
	

);

// getting total number records without any search
$sql = "SELECT `msg_id`, `msg_er_name`, `msg_detail`, `created_at`, `resolve_status`, `resolve_date`";
$sql.=" FROM `message`";
$query=mysqli_query($conn, $sql) or die("ajax-data.php: get Org");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


if( !empty($requestData['search']['value']) ) {
	// if there is a search parameter
	$sql = "SELECT `msg_id`, `msg_er_name`, `msg_detail`, `created_at`, `resolve_status`, `resolve_date`";
    $sql.=" FROM `message`";
    $sql.=" WHERE msg_id LIKE '".$requestData['search']['value']."%' ";    // $requestData['search']['value'] contains search parameter
	$sql.=" OR msg_er_name LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR created_at LIKE '".$requestData['search']['value']."%' ";
    $sql.=" OR resolve_status LIKE '".$requestData['search']['value']."%' ";
    $sql.=" OR resolve_date LIKE '".$requestData['search']['value']."%' ";
    
	$query=mysqli_query($conn, $sql) or die("ajax-data.php: get Org");
	$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result without limit in the query 

	$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   "; // $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc , $requestData['start'] contains start row number ,$requestData['length'] contains limit length.
	$query=mysqli_query($conn, $sql) or die("ajax-data.php: get Org"); // again run query with limit
	
} else {	

	$sql = "SELECT `msg_id`, `msg_er_name`, `msg_detail`, `created_at`, `resolve_status`, `resolve_date`";
    $sql.=" FROM `message`";
    $sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
	$query=mysqli_query($conn, $sql) or die("ajax-data.php: get Org");   
	
}

$data = array();
while( $row=mysqli_fetch_array($query) ) {  // preparing an array
	$nestedData=array(); 
	
	 $id = $row["msg_id"];
	 $nestedData[] = $row["msg_er_name"];
	$nestedData[] = $row["msg_detail"];
    $nestedData[] = $row["created_at"];
	$status = $row["resolve_status"];
    if($status== 1){
        $nestedData[] = "Resolved";
    }else{
        $nestedData[] = "Active";
    }
	$nestedData[] = $row["resolve_date"];

    if($status== 0){
        $nestedData[] = '<td><center>
        <form action="roomtb/msg_querry.php" method="POST"    >
        <input type="hidden" name="msg_id" value="'.$id.'"/>
        <button name="msg_resolved" class="btn btn-outline-light btn-rounded btn-sm"  >Delivered</button>
    </form></center></td>';
    }else{
        $nestedData[] = '<td><center></center></td>';
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
