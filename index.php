<?php  include('include/php_code.php'); 
include("include/connection.php");
include("bg_user_admin.html");
?>

<?php 
	if (isset($_GET['edit'])) {
		$cust_id = $_GET['edit'];
		$update = true;
		$record = mysqli_query($con, "SELECT * FROM customer WHERE cust_id=$cust_id");

		if (count((array)$record)) {
			$n = mysqli_fetch_array($record);
			$cust_name = $n['cust_name'];
			$email= $n['email'];
			$password= $n['password'];
			$user_role= $n['user_role'];
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>CRUD: CReate, Update, Delete PHP MySQL</title>
	<link rel="stylesheet" type="text/css" href="CSS/style.css">
	<STYLE>
	 a{text-decoration: none;
	   color: white;       }
     
     .b{
       max-width:900px;
       background-color: white;
       align-content: center;
        margin: auto;
        background-image:url(form.png);
      background-size: cover;
        
      }


.button{
	border-radius: 50px;
	padding: 20px;
	padding-left: 40px;
	padding-right: 40px;
	background-color: black;
	background: rgba(0,0,0,0.7);
	color: white;
	font-size: 30px;
	
}
	  </STYLE>
</head>
<body style="background-image: url('img4.jpg');">
	<button style="background-color: black; float: right; margin-right: 50px;"><a href="home.php">Back</a></button>

	<div class="b">
	<?php if (isset($_SESSION['message'])): ?>
	<div class="msg">
		<?php 
			echo $_SESSION['message']; 
			unset($_SESSION['message']);
		?>
	</div>
<?php endif ?>
<?php $results = mysqli_query($con, "SELECT * FROM customer"); ?>
	

<table>
	<thead>
		<tr>
			
			<th>cust_name</th>
			<th>email</th>
			<th>password</th>
			<th>user_role</th>
			<th colspan="2">Action</th>
		</tr>
	</thead>
	
	<?php while ($row = mysqli_fetch_array($results)) { ?>
		<tr>
			<td><?php echo $row['cust_name']; ?></td>
			<td><?php echo $row['email']; ?></td>
			<td><?php echo $row['password']; ?></td>
			<td><?php echo $row['user_role']; ?></td>
			
			<td>
				<a href="index.php?edit=<?php echo $row['cust_id']; ?>" class="edit_btn" >Edit</a>
			</td>
			
		</tr>
	<?php } ?>
</table>



<div >
	<form method="post" action="include/php_code.php" style="padding: 15px; border: black solid; "

>
		<div class="input-group">
			<input type="hidden" name="cust_id" value="<?php echo $cust_id; ?>">

			<label>cust_name</label>
			<input type="text" name="cust_name" placeholder="Name" required pattern="[a-zA-Z\s]+" title="Only letters and white space allowed!" value="<?php echo $cust_name; ?>" >
		</div>
		<div class="input-group">
			<label>email</label>
			<input type="text" name="email" placeholder="Email" required  pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="eg., someone@gmail.com" value="<?php echo $email; ?>">
		</div>
		<div class="input-group">
						<label>password</label>
			<input type="text" name="password" placeholder="Password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" value="<?php echo $password; ?>">
		</div>
		<div class="input-group">
						<label>user_role</label>
			<input type="text" name="user_role" value="<?php echo $user_role; ?>">
		</div>
		<div class="input-group">
						<?php if ($update == true): ?>
				<button class="btn" type="submit" name="update" style="background: #556B2F;" >update</button>
			<?php else: ?>
				<button class="btn" type="submit" name="save" >Save</button>
			<?php endif ?>

		</div>
			<div>
				<br>
			<button class="btn" type="submit"><a href="include/fetch.json.php">Also save data to JSON file?click me!</a></button>
			</div>
		</div>
		
</form>

		
	
	<div style="padding-bottom: 15%;">	

<div >	
		<div style="float: left; display: inline-block;  margin-left: 35%;">
			<h4>Click here to delete User:</h4>
			<a href="include/user_del.php"><button class="button"><b>delete user</b></button></a>
		</div>
	</div>
</div>







</body>
</html>
