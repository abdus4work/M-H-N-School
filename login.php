<?php 
require './inc/nav.php' ;
require __DIR__.'/handler/userReg.php';
require './config/google_auth_config.php';
require './config/db_con.php';
$Error=false;
if($_SERVER['REQUEST_METHOD']=='POST'){
  $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
  $password = $_POST['password'];
  checkUser($email,$password);
}

// if(isset($_GET['code'])){
//   $token=$client->fetchAccessTokenWithAuthCode($_GET['code']);
// if(!isset($token['error'])){
//   $client->setAccessToken($token['access_token']);
//   $_SESSION['access_token']=$token['access_token'];
//   $clientService= new Google\Service\Oauth2($client);
//   $data=$clientService->userinfo->get();
//   if(!empty($data['given_name'])){
//     $_SESSION['name']=$data['given_name'];
//     $_SESSION['isLogged']=true;
//     header("Location: ./dashboard");
//   }
//   if(!empty($data['email'])){
//     $_SESSION['email']=$data['email'];
//   }
// }
// }

// // if(!isset($_SESSION['access_token'])){
// //   echo "not set";
// // }

?>
<?php if($Error){
            echo '<div class="container mt-2"><div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> Invalid credential try again....
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div></div>';
        }?>
  <div id="bg" class="col-lg-3 container container-sm mt">
    <div id="form">
      <form action="<?= $_SERVER['PHP_SELF'];?>" method="POST" class="was-validated">
        <div class="form-group text-center">
          <h3>Login</h3>
        </div>
        <div class="form-group">
          <label for="email">Email address</label>
          <input type="email" name="email" class="form-control form-control-sm" id="email" aria-describedby="emailHelp" placeholder="Enter email" />
          <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <!-- <div id="eye"> -->
          <input type="password" name="password" class="form-control form-control-sm bg-n" id="password" placeholder="Password" />
          <!-- <i id="tgl-pass" class="fa-regular fa-eye-slash"></i> -->
          <!-- </div> -->
        </div>
        <button id="btn-3" style="font-size: 1.5rem; font-weight: bold" type="submit" name="submit" class="col btn btn-primary mt-3 mb-4">
          <span>Login</span>
        </button>
      </form>
      <div id="lgicon">
        <div class="icon" id="fb">
          <a href="#"><img src="./image/facebook.svg" alt="" /></a>
        </div>
        <div class="icon" id="gg">
          <a href="<?=$client->createAuthUrl();?>"><img src="./image/google.svg" alt="" /></a>
        </div>
        <div class="icon" id="tweet">
          <a href="#"><img src="./image/twitter.svg" alt="" /></a>
        </div>
      </div>
      <p class="mt-3">
        Don't have account? <a href="./signup">SignUp here</a>
      </p>
    </div>
  </div>
  <!-- Optional JavaScript -->
  <!-- <script>
    const s_btn = document.querySelectorAll("button");
    s_btn.forEach((btn) => {
      btn.addEventListener("click", (e) => {
        e.preventDefault();
      });
    });
  </script> -->
  <!-- <script src="./script.js"></script> -->
  <!-- Font Awesome Js-->
  <script src="https://kit.fontawesome.com/0929ec8fe1.js" crossorigin="anonymous"></script>
  <!-- Bootstrap js -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>