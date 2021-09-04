<?php  
include("include/connection.php");
session_start();


if(!isset($_SESSION['email'])){
		header("location: login.php");
	}
	else{




?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	
	
<?php include("bg.html");?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>

<style type="text/css">
body{
	margin: 0px;
}

.left_div{
	float: left; align-content: center; width: 50%;  display: inline-block;
}

.form_div{
	margin-left: 80px; margin-right: 80px; margin-top: 30px;
}

.form{
	padding: 15px; border: black solid; background-color: rgba(0, 0, 0, 0.5);
	margin-top: 20%;
}
.button4 {
	border-radius: 12px;
	background-color: #4CAF50;
	padding: 7px;
	padding-right: 30px;
	padding-left: 30px;
	/*margin-left: 47%;*/
	/*margin-right: 50%;*/
	align-content: center;
}

.menu{
color: white;
text-shadow: 5px 5px 5px black;
font-size: 50px;
}

</style>




<body>
<div>
	<div class="left_div">
			<div class="form_div">
					<form class="form" method="post" action="include/bill.php">
					<center><h2 style="color: white;">Place Your Order</h2><br></center>


					<?php 
			             $sql_name30="SELECT * FROM cust_order";
			              $result_name30=mysqli_query($con,$sql_name30) or die("query unsuccessful");
			                        while ($row5030=mysqli_fetch_assoc($result_name30)) {
			                      ?>
			                      <input type="hidden" name="id1"  value="<?php echo $row5030['ID'] ?>" />
			                 <?php } ?>


					<div class="form-group">
					 	
					 	<center> <label for="cars" style="color: white;">Select your id: </label>
					 	<select name="cust_id" id="cars" required>
			                      <option value="" disabled="disabled" selected></option>
			                      <?php 
			                        $sql_name10="SELECT * FROM customer";
			                        $result_name10=mysqli_query($con,$sql_name10) or die("query unsuccessful");
			                        while ($row5010=mysqli_fetch_assoc($result_name10)) {
			                      ?>
			                      <option  value="<?php echo $row5010['cust_id']; ?>" >Id <?php echo $row5010['cust_id']; ?> is for <?php echo $row5010['cust_name']; ?> </option>
			                     <?php } ?>
			                    </select><br>
			                   
			                   
					 </div>




					 <div class="form-group">
					 	
					 	<center> <label for="cars" style="color: white;">Select Your Name: </label>
					 	<select name="cust_name" id="cars" required>
			                      <option value="" disabled="disabled" selected></option>
			                      <?php 
			                        $sql_name1="SELECT * FROM customer";
			                        $result_name1=mysqli_query($con,$sql_name1) or die("query unsuccessful");
			                        while ($row501=mysqli_fetch_assoc($result_name1)) {
			                      ?>
			                      <option  ><?php echo $row501['cust_name']; ?></option>
			                     <?php } ?>
			                    </select><br>
					 </div>



					 <div class="form-group">
					 	
					 	<center> <label for="cars" style="color: white;">Select your id: </label>
					 	<select name="dish_id" id="cars" required>
			                      <option value="" disabled="disabled" selected></option>
			                      <?php 
			                        $sql_name20="SELECT * FROM menu";
			                        $result_name20=mysqli_query($con,$sql_name20) or die("query unsuccessful");
			                        while ($row5020=mysqli_fetch_assoc($result_name20)) {
			                      ?>
			                      <option  value="<?php echo $row5020['dish_id']; ?>">Id <?php echo $row5020['dish_id']; ?> is for <?php echo $row5020['dish_name']; ?> </option>
			                     <?php } ?>
			                    </select><br>
					 </div>


					<div class="form-group">

			             
					    <center><label for="cars" style="color: white;">Select Dish: </label>
			                    <select name="cust_dish" id="cars" required>
			                      <option value="" disabled="disabled" selected></option>
			                      <?php 
			                        $sql_dish1="SELECT * FROM menu";
			                        $result_dish1=mysqli_query($con,$sql_dish1) or die("query unsuccessful");
			                        while ($row1=mysqli_fetch_assoc($result_dish1)) {
			                      ?>
			                      <option  ><?php echo $row1['dish_name']; ?></option>
			                     <?php } ?>
			                    </select><br>

					  </div>

					  <div class="form-group">
					  	<center>
					    <label style="color: white;">enter no of dishes:</label>
	            		<input type="number" name="cust_num" required/>
	            		</center>
					  </div>
					   <div class="form-group">
					  	<center>
					    <label style="color: white;">Enter Date</label>
	            		<input type="date" name="cust_date" required />
	            		</center>
					  </div>
					  <center><a href="bill.php"><button type="submit" name="submit" class="button4">Submit</button></a></center>
					</form>
			</div>
			







			
			
<?php 
$user1 = $_SESSION['email'];
						$get_user1 = "SELECT * from customer where email='$user1'";
						$run_user1 = mysqli_query($con, $get_user1);
						$row1 = mysqli_fetch_array($run_user1);

						$user_id1 = $row1['cust_id'];
					 $user_name1 = $row1['cust_name'];



					if(isset($_GET['cust_name'])){
					    	global $con;
					    	$get_username= $_GET['cust_name'];

					    	$get_user = "SELECT * from customer where cust_name='$get_username' ";

					    	$run_user = mysqli_query($con, $get_user);

					    	$row_user = mysqli_fetch_array($run_user);

					    	$username = $row_user['cust_name'];
					    	
			   			}
?>


	</div>
	<div style="float: right ;align-content: center; width: 50%; display: inline-block; ">
		<div style="margin-right: 5%; margin-left: 5%; margin-top: 30px;">
			

			<?php   

			$sql_menu="SELECT * FROM menu";

			$result_menu=mysqli_query($con,$sql_menu) or die("Query Uncessfull");

			if(mysqli_num_rows($result_menu) > 0){
			
			
			 ?> 
			
				<div>
					<center><div><h1 class="menu">Menu </h1></div></center>
					
					
				</div>

				


			<table class="table" >
			  <thead class="thead-dark" >
			    <tr>
			      <th scope="col"><center><h3>Dish Name</h3></center></th>
			      <th scope="col"><center><h3>Price</h3></center></th>
			      
			    </tr>
			  </thead>
			  <tbody>

			  	<?php 
			  		while ($row_menu=mysqli_fetch_assoc($result_menu)) {
			  	 ?>
			    <tr style="background-color: rgba(0, 0, 0, 0.5); color: white;">
			     <th scope="row"> <center><?php echo $row_menu['dish_name']; ?></center></th>
			      <td><center><?php echo $row_menu['total_price']; ?></center></td>
			      
			    </tr>
			   
			    </tr>
			<?php  }?>
			  </tbody>
			</table>
<?php }else{
  echo"No record found";
}  ?>

		</div>
	</div>	
</div>

</body>
</html>

<?php } ?>