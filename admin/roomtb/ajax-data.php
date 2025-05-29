<?php
/* Database connection start */
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "aflex_event";

$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());

/* Database connection end */


// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;


$columns = array( 
// datatable column index  => database column name
	
    0 => 'room_no', 
	1 => 'room_type',
	2 => 'room_booked',
	3=> 'check_in_date',
	4=> 'check_out_date',
);

// getting total number records without any search
$sql = "SELECT  room_no, room_type, room_booked,check_in_date,check_out_date";
$sql.=" FROM room";
$query=mysqli_query($conn, $sql) or die("ajax-data.php: get Room number");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


if( !empty($requestData['search']['value']) ) {
	// if there is a search parameter
	$sql = "SELECT  room_no, room_type, room_booked,check_in_date,check_out_date";
	$sql.=" FROM room";
	$sql.=" WHERE room_no LIKE '".$requestData['search']['value']."%' ";    // $requestData['search']['value'] contains search parameter
	$sql.=" OR room_type LIKE '".$requestData['search']['value']."%' ";
    $sql.=" OR room_booked LIKE '".$requestData['search']['value']."%' ";
    
	$query=mysqli_query($conn, $sql) or die("ajax-data.php: get Siswa");
	$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result without limit in the query 

	$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   "; // $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc , $requestData['start'] contains start row number ,$requestData['length'] contains limit length.
	$query=mysqli_query($conn, $sql) or die("ajax-data.php: get Nilai"); // again run query with limit
	
} else {	

	$sql = "SELECT  room_no, room_type, room_booked, check_in_date,check_out_date";
	$sql.=" FROM room";
	$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
	$query=mysqli_query($conn, $sql) or die("ajax-data.php: get Nilai");   
	
}

$data = array();
while( $row=mysqli_fetch_array($query) ) {  // preparing an array
	$nestedData=array(); 

    $nestedData[] = $row["room_no"];
	$nestedData[] = $row["room_type"];
	$nestedData[] = $row["room_booked"];
	$nestedData[] = $row["check_in_date"];
	$nestedData[] = $row["check_out_date"];
		
	
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

