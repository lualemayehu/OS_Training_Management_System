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

	0=> 'cust_id',
	1 => 'cust_first_name',
	2 => 'cust_middle_name',
	3 => 'cust_last_name',
	4 => 'cust_title',
	5 => 'cust_edu',
	6 => 'cust_inistitute',
	7 => 'cust_region', 
	8 => 'cust_phone',
	9 => 'cust_email',
    10=> 'org_name',
	
	

);

// getting total number records without any search
$sql = "SELECT `cust_id`, `cust_edu`, `cust_inistitute`, `cust_region`,`cust_phone`, `cust_email`,`org_name`,CONCAT_WS(' ', `cust_title`,`cust_first_name`, `cust_middle_name`, `cust_last_name`) AS `whole_name`";
$sql.="FROM `customer` LEFT JOIN `organization`ON `customer`.`fk_organization`=`organization`.`org_id` ORDER BY cust_id DESC";

$query=mysqli_query($conn, $sql) or die("ajax-data.php: get Org");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


if( !empty($requestData['search']['value']) ) {
	// if there is a search parameter
    $sql = "SELECT `cust_id`, `cust_edu`, `cust_inistitute`, `cust_region`,`cust_phone`, `cust_email`,`org_name`,CONCAT_WS(' ', `cust_title`,`cust_first_name`, `cust_middle_name`, `cust_last_name`) AS `whole_name`";
$sql.="FROM `customer` LEFT JOIN `organization`ON `customer`.`fk_organization`=`organization`.`org_id` ";
	$sql.=" WHERE cust_first_name LIKE '".$requestData['search']['value']."%' ";    // $requestData['search']['value'] contains search parameter
	$sql.=" OR cust_middle_name LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR cust_last_name LIKE '".$requestData['search']['value']."%' ";
    $sql.=" OR cust_inistitute LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR org_name LIKE '".$requestData['search']['value']."%' ";
    
	$query=mysqli_query($conn, $sql) or die("ajax-data.php: get Org");
	$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result without limit in the query 

	$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   "; // $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc , $requestData['start'] contains start row number ,$requestData['length'] contains limit length.
	$query=mysqli_query($conn, $sql) or die("ajax-data.php: get Org"); // again run query with limit
	
} else {	

	$sql = "SELECT `cust_id`, `cust_edu`, `cust_inistitute`, `cust_region`,`cust_phone`, `cust_email`,`org_name`,CONCAT_WS(' ', `cust_title`,`cust_first_name`, `cust_middle_name`, `cust_last_name`) AS `whole_name`";
$sql.="FROM `customer` LEFT JOIN `organization`ON `customer`.`fk_organization`=`organization`.`org_id`";
	$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
	$query=mysqli_query($conn, $sql) or die("ajax-data.php: get Org");   
	
}

$data = array();
while( $row=mysqli_fetch_array($query) ) {  // preparing an array
	$nestedData=array(); 
	
	$cust_full__name=
	
	$nestedData[] = '<td>
                     <a href="trainee_detail.php?id='.$row["cust_id"].'" > '.$row["whole_name"].' &nbsp </a>
				    </td>';
	$nestedData[] = $row["cust_edu"];
	$nestedData[] = $row["org_name"];
	$nestedData[] = $row["cust_inistitute"];
	$cust_phone = $row["cust_phone"];
	$cust_email = $row["cust_email"];
	if($cust_phone ==''){
		$nestedData[] = '-';
	}else {
		$nestedData[]=$cust_phone;;
	}
	if($cust_email ==''){
		$nestedData[] = '-';
	}else {
		$nestedData[]=$cust_email;;
	}
	
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
