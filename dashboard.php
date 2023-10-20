<?php
require './inc/nav.php';
require './config/db_con.php';
if (!isset($_SESSION['isLogged'])) {
    header("Location: ./login");
} ?>
<div class="container-fluid">
    <div class="row flex-nowrap">
        <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-light">
            <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white ">
                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                    <li class="nav-item" >
                        <a href="./dashboard" class="nav-link align-middle px-0">
                            <i class="text-success fs-4 bi-house-door-fill"></i> <span  class="ms-1 d-none d-sm-inline">Home</span>
                        </a>
                        
                    </li>
                    <li>
                    <hr>
                        <a  href="#submenu1"  class="nav-link px-0 align-middle">
                            <i class="text-success fs-4 bi-person-fill-add"></i> <span  class="ms-1 d-none d-sm-inline">Add Teacher</span> </a>

                    </li>
                    <li>
                        <a href="#" class="nav-link px-0 align-middle">
                            <i class="text-success fs-4 bi-pencil-square"></i> <span class="ms-1 d-none d-sm-inline">Edit Teacher</span></a>
                            <hr>
                    </li>
                    <li>
                        <a href="?student=add" class="nav-link px-0 align-middle ">
                            <i class="fs-4 bi-person-fill-add"></i> <span class="ms-1 d-none d-sm-inline">Add Student</span></a>
                    </li>
                    <li>
                        <a href="?student=edit" class="nav-link px-0 align-middle">
                            <i class="fs-4 bi-pencil-square"></i> <span class="ms-1 d-none d-sm-inline">Edit Student</span> </a>
                            <hr>
                    </li>
                <div class="dropdown pb-4 text-dark">
                    <a href="#" class="d-flex align-items-center text-dark text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fs-4 bi-person-fill-gear"></i>
                        <span class="text-capitalize d-none d-sm-inline mx-1"><?=$_SESSION['name']; ?></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                        <li><a class="dropdown-item" href="#">New project...</a></li>
                        <li><a class="dropdown-item" href="#">Settings</a></li>
                        <li><a class="dropdown-item" href="#">Profile</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">Sign out</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col py-3">
            <div style="font-size:1.5rem !important;" class="d-flex flex-column  alert alert-success mt-3 greet" role="alert">
                <strong> Hello <?= ucfirst($_SESSION['name']); ?> </strong>
                <p> and warm welcome to our website!<br>
                    We are thrilled to have you here.
            
                    Whether you are a first time visitor or a returning friend, we are excited to share our world with
                    you.</p><br>
                <span><a href="./logout">Logout Here</a></span>
            </div>
<?php

if (isset($_GET['student']) && $_GET['student'] == 'add')
{ require __DIR__ . '/handler/addStudent.php';}
else if (isset($_GET['student']) && $_GET['student']=='edit'){
    require __DIR__.'/handler/editStudent.php';
}
?>
        </div>
    </div>
</div>




<?php

 require './inc/footer.php'; ?>