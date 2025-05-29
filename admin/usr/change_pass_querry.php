<?php 
session_start(); 
include('../includes/config.php');
if(strlen($_SESSION['authentication'])==false)
  { 
header('location:../index.php');
}
else{
    
    if(isset($_POST['changeSubmit']))
	{
        
            $password=$_POST['current_password'];
            $newpassword=$_POST['password'];
            $useremail=$_SESSION['auth_user']['user_email'];

            $result = mysqli_query($conn, "SELECT * FROM `users`WHERE `email`='$useremail'"); // using mysqli_query instead
            while($res = mysqli_fetch_array($result)){
                $c_pass=$res['password'];
                  
            if(!empty($_POST['current_password']) && !empty($_POST['password'])&& !empty($_POST['confirm_password'])){
                //password and confirm password comparison
                if($_POST['password'] !== $_POST['confirm_password']){
                
                        echo '<script type="text/javascript">
                            window.onload = function () { 
                                alert("New Password dont match");
                                window.location.href="../change_pass.php";
                            } 
                        </script>'; 

                }elseif($c_pass!=$password){
                    echo '<script type="text/javascript">
                            window.onload = function () { 
                                alert("Your Current Password don\'t match");
                                window.location.href="../change_pass.php";
                            } 
                        </script>';
                }
                else{
                    $queryr=mysqli_query($conn, " UPDATE `users` SET `password` = '$newpassword' WHERE `users`.`email` = '$useremail'") ;
                    if($queryr){
                        echo '<script type="text/javascript">
                        window.onload = function () { 
                            alert("Succesfuly changed");
                            window.location.href="../../logout.php";
                        } 
                    </script>';
                    }
                 }
            }else{
                echo '<script type="text/javascript">
                            window.onload = function () { 
                                alert("Fill the form corectlly");
                                window.location.href="../change_pass.php";
                            } 
                        </script>';
            }
        }
    }
}
?>
