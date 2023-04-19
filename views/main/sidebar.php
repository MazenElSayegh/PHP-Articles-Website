<nav class="navbar navbar-dark  bg-dark fixed-top ">
  <div class="container-fluid ">
  <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>  
  <a class="navbar-brand" href="../home/index.view.php">Articles Dashboard</a>
   
    <div class="offcanvas offcanvas-start text-bg-dark  "  tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
      <div class="offcanvas-header bg-dark">
        <h5 class="offcanvas-title text-white" id="offcanvasDarkNavbarLabel">Articles</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body bg-dark">
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3 ">
          <li class="nav-item">
            <a class="nav-link active fs-1 " aria-current="page" href="../home/index.view.php">Home</a>
          </li>
         
         
          
          <li class="nav-item"><a class="nav-link" href="../login/profile.php">My Profile</a></li>
          <?php if($_SESSION['group']=='Admins'){ ?>
                <li class="nav-item"><a class="nav-link" href="../users/users.php">Users</a></li>
                <?php } ?>
                <li class="nav-item"><a class="nav-link" href="../groups/groups.php">Groups</a></li>
                <?php if($_SESSION['group']=='Admins'||$_SESSION['group']=='Editors'){ ?>
                  <li class="nav-item"><a class="nav-link" href="../articles/articles.php">Articles</a></li>
                <?php } ?>
              <li class="nav-item"><a class="nav-link" href="../../controllers/logout.php">Logout</a></li>
           
         
        </ul>
       
      </div>
    </div>
  </div>
</nav>