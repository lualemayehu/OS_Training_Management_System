<?php
include_once("../includes/config.php");

if(isset($_GET['doc_id'])){
	$id=$_GET['doc_id'];
		
	$sql = "DELETE FROM `training_documents` WHERE doc_id='$id'";

	mysqli_query($conn, $sql);
	
}
header("Location: ../training_doc.php");
 	
?>