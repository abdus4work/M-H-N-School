<?php require './inc/nav.php' ?>
<?php
require './config/db_con.php';
require __DIR__.'/config/google_auth_config.php';
require __DIR__.'/handler/userReg.php';
$nameErr=false;
$passErr=false;
$emailExistErr=false;
//Checking server request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Data validating
    $name = test_input($_POST['name']);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];
    $conpass=$_POST['con-pass'];
    if (empty($name)) {
        $nameErr=true;
    }
    elseif($password!=$conpass){
        $passErr=true;
    }else{
        $sql="SELECT * FROM user WHERE email=?";
        $stmt=$conn->prepare($sql);
        $stmt->bind_param("s",$email);
        $stmt->execute();
        $result=$stmt->get_result();
        if($result->num_rows==0){
        addUser($name,$email,$password);
        }
        else{
            $emailExistErr=true;
        }
    }
}

if(isset($_SESSION['name'])){
    $_SESSION['isLogged']=true;
   header('Location: ./dashboard');
}



//Validate input
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
    <main>
        <div class="container"><?php if($nameErr){
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> Name can\'t be empty.. try again....
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }elseif($passErr){
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!!!</strong> Password and confirm password doesn\'t match try again....
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }
        elseif($emailExistErr){
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!!!</strong> This email already exist try login or enter another email try again....
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }?>
        </div>

    <div id="bg" class="col-lg-3 container container-sm mt">
        <div id="form">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="was-validated">
                <div class="form-group text-center">
                    <h3>Sign Up</h3>

                </div>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control form-control-sm" required>
                    <small id="namehelp" class="form-text text-danger" hidden>Name can't be empty</small>
                </div>
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" name="email" class="form-control form-control-sm" id="email" aria-describedby="emailHelp" placeholder="Enter email" required>
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <!-- <div id="eye"> -->
                    <input type="password" name="password" class="form-control form-control-sm bg-n" id="password" placeholder="Password">
                    <!-- <i id="tgl-pass" class="fa-regular fa-eye-slash"></i> -->
                    <!-- </div> -->
                </div>
                <div class="form-group">
                    <label for="con-pass">Confirm Password</label>
                    <input type="password" name="con-pass" class="bg-n form-control form-control-sm " id="con-pass" placeholder="Confirm Password">
                    <small id="pass-match" class="form-text"></small>
                </div>
                <button id="s-btn" style="font-size: 1.5rem; font-weight:bold;" type="submit" name="submit" class="col btn btn-primary mb-3 mt-3" disabled>Sign Up</button>
            </form>
            <div id="lgicon">
                <div class="icon" id="fb"><a href="#"><img src="./image/facebook.svg" alt=""></a></div>
                <div class="icon" id="gg"><a href="<?=$client->createAuthUrl();?>"><img src="./image/google.svg" alt=""></a></div>
                <div class="icon" id="tweet"><a href="#"><img src="./image/twitter.svg" alt=""></a></div>
            </div>
            <p class="mt-3">Already have account? <a href="./login">login here</a></p>
        </div>
    </div>
    </main>
<?php require __DIR__.'/inc/footer.php'; ?>