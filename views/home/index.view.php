<?php 
session_start();
if(isset($_SESSION['user_name'])){
require('../main/head.php'); 
 require('../main/sidebar.php'); ?>


    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                        </ol>
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

<?php require('../main/footer.php'); 
}else{
    header("Location: ../../");
    exit();
} ?>