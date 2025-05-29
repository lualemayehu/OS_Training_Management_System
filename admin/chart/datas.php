<?php
header('Content-Type: application/json');
$conn = mysqli_connect("localhost","root","","aflex_tms");
$sqlQuery = "SELECT `ev_start_date` AS year, COUNT(*) as total FROM `customer` LEFT JOIN `event` ON `fk_event`= `ev_id` WHERE `customer`.`cust_type`='Trainee' AND `customer`.`deleted`='0' GROUP BY year";
$result = mysqli_query($conn,$sqlQuery);
$data = array();
foreach ($result as $row) {
	$data[] = $row;
}
mysqli_close($conn);
echo json_encode($data);
?>