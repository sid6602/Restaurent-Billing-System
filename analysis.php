<?php 
// start_session(); 
include("include/connection.php");
include("bg_analysis.html");
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">




<style type="text/css">
.button{
	border-radius: 50px;
	padding: 40px;
	padding-left: 40px;
	padding-right: 40px;
	background-color: black;
	background: rgba(0,0,0,0.7);
	color: white;
	font-size: 30px;
	
}
h4{
	color: white;
}

</style>
</head>







<?php 
//calculating profit and price and updating it into cust_order table
// 
//$sql_price="SELECT 
// 			c.ID,
// 			M.dish_id as c_dish_id,
// 			M.total_price,
// 			m.profit,
// 			cu.cust_id AS c_cust_id,
// 			C.cust_id ,
// 			C.DISH_ID ,
// 			C.QUANTITY,
// 			 M.profit*C.QUANTITY AS user_profit,
// 			 M.total_price*C.QUANTITY AS quan_price,
// 			 M.raw_price*C.QUANTITY AS quan_raw
// 			FROM MENU M ,cust_order C, customer cu
// 			WHERE M.dish_id = C.DISH_ID AND cu.cust_id=C.cust_id
// 			ORDER BY c.ID ASC ;";

//  $result_price = mysqli_query($con, $sql_price) or die("Query Uncessfull");

// if (mysqli_num_rows($result_price) > 0) {
// while ($row_price=mysqli_fetch_array($result_price)) {

// $order_id=$row_price['ID'];
// echo $c_cust_id=$row_price['c_cust_id'];
// echo $c_dish_id=$row_price['c_dish_id'];
// $price =$row_price['quan_price'];
// $profit =$row_price['user_profit'];
// $raw_price=$row_price['quan_raw'];
// $insert_table="UPDATE cust_order SET CUST_ID='{$c_cust_id}', DISH_ID='{$c_dish_id}',price='{$price}',profit='{$profit}',total_raw='{$raw_price}' WHERE  ID='{$order_id}'" ;
// $result=mysqli_query($con, $insert_table) or die("Query Uncessfull");
// }

// } 


$sql_price="SELECT 
      c.ID,
      M.dish_id,
      M.total_price,
      m.profit,
      C.DISH_ID,
      C.QUANTITY,
       M.profit*C.QUANTITY AS user_profit,
       M.total_price*C.QUANTITY AS quan_price,
       M.raw_price*C.QUANTITY AS quan_raw
      FROM MENU M ,cust_order C
      WHERE M.dish_id = C.DISH_ID
      ORDER BY c.ID ASC ;";

 $result_price = mysqli_query($con, $sql_price) or die("Query Uncessfull");

if (mysqli_num_rows($result_price) > 0) {
while ($row_price=mysqli_fetch_array($result_price)) {

$order_id=$row_price['ID'];
$price =$row_price['quan_price'];
$profit =$row_price['user_profit'];
$raw_price=$row_price['quan_raw'];
$insert_table="UPDATE cust_order SET price='{$price}',profit='{$profit}',total_raw='{$raw_price}' WHERE  ID='{$order_id}'" ;
$result=mysqli_query($con, $insert_table) or die("Query Uncessfull");
}

}






// Selecting data from table menu and storing it in variables
$sql_menu="SELECT * FROM menu";
$result_menu=mysqli_query($con, $sql_menu) or die("Query Uncessfull");
if (mysqli_num_rows($result_menu) > 0) {
while ($row_menu=mysqli_fetch_array($result_menu)) {
$dish_id = $row_menu['dish_id'];
$dish_name = $row_menu['dish_name'];
$raw_price = $row_menu['raw_price'];
$total_price = $row_menu['total_price'];
$profit_of_single = $row_menu['profit'];

}
}



if (isset($_POST['year1'])) {
	$year = $_POST['year'];

//specific year nusar all month total of raw and sale (for graph to display raw amd sale)
$sql_raw_graph="SELECT year(order_date) as selected_date, date_format(order_date,'%M') as month_name, sum(total_raw) as monthly_invest
     from cust_order
     WHERE year(order_date)='{$year}' 
     group by year(order_date), month(order_date)
     order by year(order_date), month(order_date);";

	$result_raw_graph=mysqli_query($con, $sql_raw_graph) or die("Query Uncessfull");
	if (mysqli_num_rows($result_raw_graph) > 0) {
	while ($row_raw_graph=mysqli_fetch_array($result_raw_graph)) {
		$month= $row_raw_graph['month_name'];
		$invest= $row_raw_graph['monthly_invest'];
		$result_array[] = ['label'=>$month, 'y'=>$invest];
		 $dataPoints1 =($result_array);
}}


$sql_price_graph="SELECT year(order_date) as selected_date, date_format(order_date,'%M') as month_name1, sum(price) as monthly_invest1
     from cust_order
     WHERE year(order_date)='{$year}' 
     group by year(order_date), month(order_date)
     order by year(order_date), month(order_date);";

	$result_price_graph=mysqli_query($con, $sql_price_graph) or die("Query Uncessfull");
	if (mysqli_num_rows($result_price_graph) > 0) {
	while ($row_price_graph=mysqli_fetch_array($result_price_graph)) {
		$month1= $row_price_graph['month_name1'];
		$invest1= $row_price_graph['monthly_invest1'];
		$result_array1[] = ['label'=>$month1, 'y'=>$invest1];
		 $dataPoints2 =($result_array1);
}}}


?>

<!-- For bar graph -->
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

    <script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	backgroundColor: "transparent",
	theme: "light2",
	title:{
		text: "Investment and Sale Monthly Analysis",
		fontColor: "white",
	},

	subtitles: [{
    text: "Raw material investment on the left, Overall sale of month on the right",
    fontColor: "white",
    fontSize: 20,
  }], 

	axisX: {
    title: "Month",
    titleFontColor: "white",
    labelFontColor: "white"
  },
	axisY:{
		includeZero: true,
	title: "Indian Rs",
    titleFontColor: "white",
    lineColor: "#4F81BC",
    labelFontColor: "grey",
    tickColor: "#4F81BC",
    includeZero: true
	},
	legend:{
		cursor: "pointer",
		verticalAlign: "center",
		horizontalAlign: "right",
		itemclick: toggleDataSeries
	},
	data: [{
		type: "column",
		name: "Investment",
		indexLabel: "{y}",
		yValueFormatString: "#0.##",
		showInLegend: true,
		dataPoints: <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>
	},{
		type: "column",
		name: "Sale",
		indexLabel: "{y}",
		yValueFormatString: "#0.##",
		showInLegend: true,
		dataPoints: <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
function toggleDataSeries(e){
	if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
	}
	else{
		e.dataSeries.visible = true;
	}
	chart.render();
}
 
}
</script>





<!-- code for pie chart -->


<body style="overflow: hidden;"> 

<div style="overflow: scroll; height: 100%; margin-top: 5%; ">
<div>
	<center><form  method="post">
		<div style="display: inline-block;">
		<label style="color: white;" >Enter year : </label>
            <input type="number" name="year" />
       		</div>
			<div style="padding-bottom: 2%;  display: inline-block;">
				<button type="submit" name="year1" >Show</button></button></div>
	</form>
	</center>
</div>
	
	<div style="width: 94%; background-color: rgba(0,0,0,0.5);height: 500px; margin-left: 3%; margin-right: 3%; padding: 3%; padding-left: 3%;">
		<div id="chartContainer"  style="width: 100%;">
		</div>
	</div><br><br>
	
	<div style="margin-bottom: 50%;margin-top: 10%;">	
		<div style="float: left; display: inline-block;  margin-left: 15%;">
			<h4>Click here to see analysis:</h4>
			<a href="include/php_ana_forms.php"><button class="button"><b>Overall Analysis</b></button></a>
		</div>
		 <div style="float: right; display: inline-block; margin-right: 15%;">
		 	<h4>Click here to see dish wise analysis:</h4>
			<a href="include/php_ana_forms1.php"><button class="button"><b>Dish wise Analysis</b></button></a>
		</div> 
	</div>
</div>
</body>
</html>