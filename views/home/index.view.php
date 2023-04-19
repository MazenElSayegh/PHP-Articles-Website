<?php 
session_start();
if(isset($_SESSION['user_name'])){
require('../main/head.php'); 
 require('../main/sidebar.php');
 require_once('../../controllers/home.php');
 ?>
    <div class="content-wrapper m-5">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div>
                </div>
            </div>
        </div>

    <section class="content">
        <div class="container-fluid">
            <h1>Home Page</h1>
        </div>
    </section>


</div>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script>
window.onload = function() {
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	theme: "light2",
	title:{
		text: "Users in Groups"
	},
	axisY: {
		title: "Number of Users"
	},
    axisX: {
		title: "Groups Names"
	},
	data: [{
		type: "column",
		yValueFormatString: "# users",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}
</script>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

<?php require('../main/footer.php'); 
}else{
    header("Location: ../../");
    exit();
} ?>        