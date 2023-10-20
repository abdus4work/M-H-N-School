<?php
// require './config/google_auth_config.php';
require __DIR__.'/userReg.php';
require __DIR__ . '/../config/google_auth_config.php';
session_start();
if(isset($_GET['code'])){
    $token=$client->fetchAccessTokenWithAuthCode($_GET['code']);
  if(!isset($token['error'])){
    $client->setAccessToken($token['access_token']);
    $_SESSION['access_token']=$token['access_token'];
    $clientService= new Google\Service\Oauth2($client);
    $data=$clientService->userinfo->get();
    if(!empty($data['given_name']) && !empty($data['email'])){
      // $exist=checkGoogleUser($data['email'],$data['id']);
      $fname=$data['given_name']." ".$data['family_name'];
      if(!checkGoogleUser($data['email'],$data['id'])){
        addGoogleUser($fname,$data['email'],$data['id']);
      }
      $_SESSION['name']=$fname;
      $_SESSION['email']=$data['email'];
      $_SESSION['isLogged']=true;
      $_SESSION['oauthId']=$data['id'];
      header("Location:../dashboard");
    }
  }
  }
  
  if(!isset($_SESSION['access_token'])){
    header('Location: ../login');
  }
?>