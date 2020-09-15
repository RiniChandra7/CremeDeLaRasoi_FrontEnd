
<?php
	include 'database.php';
	session_start();
	if($_POST['type']==1){
		$name=$_POST['name'];
		$email=$_POST['email'];
		$password=$_POST['password'];
		$pic=$_POST['pic'];
		
		$duplicate=mysqli_query($conn,"select * from user where email='$email'");
		if (mysqli_num_rows($duplicate)>0)
		{
			echo json_encode(array("statusCode"=>201));
		}
		else{
			$sql = "INSERT INTO 'user'( 'UserName', 'Email', 'Password', 'Upvotes', 'isDailyTips', 'ProfilePic') 
			VALUES ('$name','$email','$password', '0', '0', '1', '$pic')";
			if (mysqli_query($conn, $sql)) {
                $_SESSION['UserName'] = $name;
				echo json_encode(array("statusCode"=>200));
			} 
			else {
				echo json_encode(array("statusCode"=>201));
			}
		}
		mysqli_close($conn);
	}
	if($_POST['type']==2){
		$email=$_POST['email'];
		$password=$_POST['password'];
		$check=mysqli_query($conn,"select * from user where email='$email' and password='$password'");
		if (mysqli_num_rows($check)>0)
		{
			$_SESSION['email']=$email;
            $_SESSION['UserName']=$check[0]['UserName'];
			echo json_encode(array("statusCode"=>200));
		}
		else{
			echo json_encode(array("statusCode"=>201));
		}
		mysqli_close($conn);
	}
?>
  