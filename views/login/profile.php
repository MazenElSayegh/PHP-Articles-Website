<?php
session_start();
if(isset($_SESSION)){

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Profile</title>
</head>
<body class="container m-5">
<div class="w-50 position-absolute top-50 start-50 translate-middle" >
    <div class="card border border-dark">
        <div class="card-header mb-2 bg-secondary text-white">
            <h3>Hello, <?php echo $_SESSION['name']; ?><h3>
        </div>
        <ul class="list-group list-group-flush my-3">
            <li class="list-group-item">Username: <?php echo $_SESSION['user_name']; ?></li>
            <li class="list-group-item">Email: <?php echo $_SESSION['email']; ?></li>
            <li class="list-group-item">Mobile: <?php echo $_SESSION['mobile']; ?></li>
            <li class="list-group-item">Group: <?php echo $_SESSION['group']; ?></li>
            <li class="list-group-item">Subscription date: <?php echo $_SESSION['subscription_date']; ?></li>
        </ul>
    </div>
    <a href="../../controllers/logout.php" class="btn btn-warning mt-3 border border-dark rounded-pill">Logout</a>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
<?php }else{
    header("Location: ../");
    exit();
} ?>