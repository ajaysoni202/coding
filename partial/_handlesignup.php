<?php 
$showerror="false";
if($_SERVER['REQUEST_METHOD'] == "POST"){
	include '_dbconnect.php';
	$username=$_POST['user_name'];
	$useremail=$_POST['user_email'];
	$pass=$_POST['password'];
	$cpass=$_POST['cpassword'];

	$existsql="select * from users where user_name='$username'";
	$result=mysqli_query($conn,$existsql);
	$numRows=mysqli_num_rows($result);
	if($numRows>0){
		$showerror="Email Already in used";
	}else{
		if($pass == $cpass){
			$hash=password_hash($pass, PASSWORD_DEFAULT);
			$existsql="insert into users (user_name,user_email,password) values('$username','$useremail','$hash')";
			$result=mysqli_query($conn,$existsql);
			if($result) {
				$showalert= true;
				header('location:../index.php?signupsuccess=true');
				exit();
			}

		}else{
			$showerror = "Password did not match";
			
		}
	}
	header("location:../index.php?signupsuccess=false&error=$showerror");
}
?>