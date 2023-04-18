<?php
require_once ('views/main/head.php');
// require_once ('views/main/sidebar.php');
?>
<div class="container d-flex flex-column justify-content-end w-50">
    <div class="card p-5 bg-light m-5">
    <div class="card-header my-3 bg-secondary text-white"><h2>Welcome</h2></div>
    <?php if(isset($_GET['error'])){ ?>
        <div class="bg-danger w-50 p-2 my-3 text-center">
            <?php echo $_GET['error']; ?>
        </div> 
    <?php } ?>
    <form action="controllers/login.php" method="post">
        <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" class="form-control" name="uname" placeholder="username">
        </div>
        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" class="form-control" name="password" placeholder="password">
        </div>
        <button type="submit" class="btn btn-primary">LOGIN</button>
    </form>
    </div>
</div>
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> -->
<?php 
require_once ('views/main/footer.php'); ?>