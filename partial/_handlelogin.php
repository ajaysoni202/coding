<?php
$showerror ="false";
if($_SERVER['REQUEST_METHOD'] == "POST"){
	include '_dbconnect.php';
	$email =$_POST['email'];
	$pass = $_POST['password'];

	$sql = "select * from users where user_email='$email' ";
	$result = mysqli_query($conn,$sql);

	$numRows =mysqli_num_rows($result);
	if($numRows == 1){
		$row = mysqli_fetch_assoc($result);

			if(password_verify($pass, $row['password'])){
				session_start();
				$_SESSION['loggin']=true;
				$_SESSION['sno'] = $row['sno'];
				$_SESSION['user_name'] = $row['user_name'];	
				$_SESSION['email'] = $email; 

				}
			header('location:../index.php');
		}
	}


	?>