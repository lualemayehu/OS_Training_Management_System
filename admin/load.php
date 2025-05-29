
<?php

//load.php

$connect = new PDO('mysql:host=localhost;dbname=aflex_tms', 'root', '');

$data = array();

$query = "SELECT * FROM `event` ORDER BY `event`.`ev_id` ASC";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

foreach($result as $row)
{
 $data[] = array(
  'id'   => $row["ev_id"],
  'title'   => $row["ev_tittle_subject"],
  'start'   => $row["ev_start_date"],
  'end'   => $row["ev_end_date"]
 );
}

echo json_encode($data);

?>
