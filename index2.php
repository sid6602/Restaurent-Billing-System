<?php  include('include/php_code2.php'); 
include("include/connection.php");
include("bg_menu_admin.html");
?>
<?php 
	if (isset($_GET['edit'])) {
		$dish_id = $_GET['edit'];
		$update = true;
		$record = mysqli_query($con, "SELECT * FROM menu WHERE dish_id=$dish_id");

		if (count((array)$record)) {
			$n = mysqli_fetch_array($record);
			$dish_name = $n['dish_name'];
			$raw_price= $n['raw_price'];
			$total_price= $n['total_price'];
			$profit= $n['profit'];
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
<?php $results = mysqli_query($con, "SELECT * FROM menu"); ?>

<table>
	<thead>
		<tr>
			
			<th>dish_name</th>
			<th>raw_price</th>
			<th>total_price</th>
			<th>profit</th>
			<th colspan="2">Action</th>
		</tr>
	</thead>
	
	<?php while ($row = mysqli_fetch_array($results)) { ?>
		<tr>
			<td><?php echo $row['dish_name']; ?></td>
			<td><?php echo $row['raw_price']; ?></td>
			<td><?php echo $row['total_price']; ?></td>
			<td><?php echo $row['profit']; ?></td>
			<td>
				<a href="index2.php?edit=<?php echo $row['dish_id']; ?>" class="edit_btn" >Edit</a>
			</td>
		
		</tr>
	<?php } ?>
</table>
	<form method="post" action="include/php_code2.php" >
		<div class="input-group">
			<input type="hidden" name="dish_id" value="<?php echo $dish_id; ?>">

			<label>dish_name</label>
			<input type="text" name="dish_name" placeholder="dish name" required pattern="[a-zA-Z\s]+" title="Only letters and white space allowed!" value="<?php echo $dish_name; ?>">
		</div>
		<div class="input-group">
			<label>raw_price</label>
<input type="number" name="raw_price" placeholder="raw material price" value="<?php echo $raw_price; ?>">
		</div>
		<div class="input-group">
			<label>total_price</label>
<input type="number" name="total_price" placeholder="total_price of dish including cost of raw material" value="<?php echo $total_price; ?>">
		</div>
		<!--<div class="input-group">
			<label>profit</label>
<input type="number" name="profit" value="<?/*php echo $profit ; */?>">
		</div>-->
		<div class="input-group">
			<?php if ($update == true): ?>
	<button class="btn" type="submit" name="update" style="background: #556B2F;" >update</button>
<?php else: ?>
	<button class="btn" type="submit" name="save" >Save</button>
<?php endif ?>
<br>
<div>

<button class="btn" type="submit"><a href="include/fetch2.json.php">Also save data to JSON file?click me!</a></button>

	
</div>
</div>	
</form>

<div style="padding-bottom: 15%;">	

<div >	
		<center><div style="float: left; display: inline-block;  margin-left: 35%;">
			<h4>Click here to delete Dish:</h4>
			<a href="include/menu_del.php"><button class="button"><b>delete Dish</b></button></a>
		</div></center>
	</div>
</div>

</body>
</html>
