<?php
session_start();
try {
    if(isset($_SESSION['user_name'])) {

        require_once('../main/head.php');
        require_once('../main/sidebar.php');
?>

<div class="container m-5">
    <div class="w-50 position-absolute top-50 start-50 translate-middle" >
        <div class="card border border-dark">
            <div class="card-header mb-2 bg-secondary text-white">
                <h3>Hello, <?php echo $_SESSION['name']; ?></h3>
            </div>
            <ul class="list-group list-group-flush my-3">
                <li class="list-group-item">Username: <?php echo $_SESSION['user_name']; ?></li>
                <li class="list-group-item">Email: <?php echo $_SESSION['email']; ?></li>
                <li class="list-group-item">Mobile: <?php echo $_SESSION['mobile']; ?></li>
                <li class="list-group-item">Group: <?php echo $_SESSION['group']; ?></li>
                <li class="list-group-item">Subscription date: <?php echo date('d-M-Y',strtotime($_SESSION['subscription_date'])) ;?></li>
                <li class="list-group-item">Last login: <?php echo date('h:i l d-M-Y',strtotime($_SESSION['last_login'])) ; ?></li>
            </ul>
        </div>
        <a href="../../controllers/logout.php" class="btn btn-warning mt-3 border border-dark rounded-pill">Logout</a>
    </div>
</div>


<?php
        require_once('../main/footer.php');
    } else {
        header("Location: ../../");
        throw new Exception('unauthorized access for profile page');
    }
} catch(Exception $e){
    $exc=$e->getMessage();
    $date = date('d.m.Y h:i:s');
    $log = $exc."   |  Date:  ".$date."\n";
    error_log("$log",3, "../../assets/log-files/log.php");
  }
?>