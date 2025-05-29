<?php 
include_once("../includes/config.php");

                if(isset($_POST['add'])){
                    $doc_id = trim($_POST['doc_id']);
                    $doc_id = mysqli_real_escape_string($conn, $doc_id);
                    
                    $doc_title = trim($_POST['doc_title']);
                    $doc_title = mysqli_real_escape_string($conn, $doc_title);
            
                    $doc_author = trim($_POST['doc_author']);
                    $doc_author = mysqli_real_escape_string($conn, $dock_author);
                    
                    $doc_descr = trim($_POST['doc_descr']);
                    $doc_descr = mysqli_real_escape_string($conn, $doc_descr);
                    
                    
                     // add image
                    if(isset($_FILES['doc_image']) && $_FILES['doc_image']['name'] != ""){
                        $doc_image = $_FILES['doc_image']['name'];
                        $directory_self = str_replace(basename($_SERVER['PHP_SELF']), '', $_SERVER['PHP_SELF']);
                        $uploadDirectory = $_SERVER['DOCUMENT_ROOT'] . $directory_self . "doc_images/";
                        $uploadDirectory .= $doc_image;
                        move_uploaded_file($_FILES['doc_image']['tmp_name'], $uploadDirectory);
                    }
            
                 
                    $doc_trainer=$_POST['doc_trainer'];
                    $doc_trainer = mysqli_real_escape_string($conn, $doc_trainer);
            
            
                  
                    $allowedExts = array("pdf");
                    $temp = explode(".", $_FILES["doc_file"]["name"]);
                    $extension = end($temp);
                    $doc_file=$_FILES["doc_file"]["name"];
                    move_uploaded_file($_FILES["doc_file"]["tmp_name"],"training_documents/" . $_FILES["doc_file"]["name"]);

                    $query="INSERT INTO `training_documents` (`doc_id`, `doc_title`, `doc_author`, `doc_trainer`, `doc_image`, `doc_descr`, `doc_file`) 
                    VALUES ('$doc_id', '$doc_title', '$dock_author', '$doc_trainer', '$doc_image', '$doc_descr', '$doc_file');";
    
                    $result = mysqli_query($conn, $query);
                    if(!$result){
                        echo "Can't add new data " . mysqli_error($conn);
                        exit;
                    } else {
                        header("Location: ../training_doc.php");
                    }
                }
   ?>