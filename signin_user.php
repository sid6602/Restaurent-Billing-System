<?php  

session_start();

include("include/connection.php");


if(isset($_POST['sign_in']))
{
// To recieve data from form
	$email = htmlentities(mysqli_real_escape_string($con, $_POST['email']));
	$pass = htmlentities(mysqli_real_escape_string($con, $_POST['password']));
	 


//To validate password
	// if (strlen($pass)<8 ) {
	// 	echo"<script>alert('Password should be minimum 8 characters!')</script>";
	// 	exit();
	// }

//To validate email
	// if (!filter_var($email, FILTER_VALIDATE_EMAIL) {
	// 	echo"<script>alert('Invalid format and please re-enter valid email')</script>";
	// 	exit();
	// }
	


	 $select_user= "SELECT * from customer WHERE email='$email' AND password='$pass'";

	 $query=mysqli_query($con,$select_user);
	 $Check_user= mysqli_num_rows($query);

	 if ($Check_user==1) {
	 	$_SESSION['email']=$email;

	 	$update_msg= mysqli_query($con, "UPDATE customer SET log_in='online' WHERE email='$email'");

	 	$user= $_SESSION['email'];
	 	$get_user="SELECT * from customer where email='$user'";

	 	$run_user= mysqli_query($con,$get_user);
	 	$row= mysqli_fetch_array($run_user);

	 	$user_name= $row['cust_name'];

//ithe homepage.php chi link dyayachi aahe
	 	echo "<script>window.open('home.php?cust_name=$user_name', '_self')</script>";
	 }else{

	 	echo"
	 	<div class='alert alert-danger'>
	 	<strong>Check your email and password!</strong>
	 	</div>

	 	";
	 }
}
?>