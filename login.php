 <?php
session_start();
include('assets/includes/config.php');

if(isset($_POST['login_button']))
{
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $query = "SELECT * FROM users where email='$email' and password='$password' LIMIT 1";
    $query_run = mysqli_query($conn, $query);

    if(mysqli_num_rows($query_run) > 0)
    {
        foreach($query_run as $data){
			$user_id=$data['id'];
			$user_name= $data['fname'].' '.$data['lname'];
			$user_email=$data['email'];
			$role_as=$data['role_as'];
		}

        // Authenticating Logged In User
        $_SESSION['authentication'] = true;
		$_SESSION['auth_role'] = "$role_as";
        // Storing Authenticated User data in Session
        $_SESSION['auth_user'] = [
            'user_id'=>$user_id,
            'user_fullname'=>$user_name,
            'user_email'=>$user_email,
        ];

		if($_SESSION['auth_role']==1){
			 $_SESSION['message'] = "Wellcome Admin"; //message to show
        header("Location: admin/index.php");
        exit(0);
		}
		elseif($_SESSION['auth_role']==0){
			 $_SESSION['message'] = "Welcome user"; //message to show
        header("Location: reception/index.php");
        exit(0);
		}
		elseif($_SESSION['auth_role']==2){
			 $_SESSION['message'] = "Welcome user"; //message to show
        header("Location: encoder/index.php");
        exit(0);
		}
    }
    else
    {
        $_SESSION['message'] = "Invalid Email or Password"; //message to show
        header("Location: index.php");
        exit(0);
    }
}
else{
	$_SESSION['message'] = "Page Not allowed"; //message to show
        header("Location: index.php");
        exit(0);
}
?>