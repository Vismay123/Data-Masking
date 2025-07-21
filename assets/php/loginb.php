<?php

include('connection.php');

    session_start();

	$username = mysqli_real_escape_string($conn, $_POST['username']);
	
	$password = mysqli_real_escape_string($conn, $_POST['password']);

	$Country = mysqli_real_escape_string($conn, $_POST['Country']);
	
	$result = mysqli_query($conn, "select * from login1 where username='$username' and password='$password' and Country='$Country'");

	if(!$result){
		echo $qry;
	}
	
	else{
		if(mysqli_num_rows($result)>0){
			$row = mysqli_fetch_assoc($result);
			$_SESSION['username'] = $username;
			$_SESSION['password'] = $password;
			$_SESSION['Country'] = $Country;
			$_SESSION['id'] = $row['id'];
			echo "<script>alert('Welcome $username');
				window.location.href = '../../modules/searchindex2.php';
				</script>";
			
		}
		else{

			echo "<script>alert('Wrong Credentials');
					window.location.href = '../../modules/login.php';
					</script>";
		}	
	
	}
	
?>