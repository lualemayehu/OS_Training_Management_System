<?php
// connect to the database
// Downloads files
if (isset($_GET['file_id'])) {
    $id = $_GET['file_id'];

    // fetch file to download from database
    $sql = "SELECT * FROM training_documents WHERE doc_id=$id";
    $result = mysqli_query($conn, $sql);

    $file = mysqli_fetch_assoc($result);
    $filepath = 'training_doc/training_documents/' . $file['doc_file'];

    if (file_exists($filepath)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/pdf');
        header('Content-Disposition: inline; filename=' . basename($filepath));
		header('Content-Transfer-Encoding: binary');
        header('Content-Length: ' . filesize('training_doc/training_documents/' . $file['doc_file']));
		header('Accept-Ranges: bytes');
	
        readfile('training_doc/training_documents/' . $file['doc_file']);

        // Now update downloads count
        $newCount = $file['downloads'] + 1;
        $updateQuery = "UPDATE files SET downloads=$newCount WHERE doc_id=$id";
        mysqli_query($conn, $updateQuery);
        exit;
    }

}
