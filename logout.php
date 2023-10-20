<?php 
require './config/google_auth_config.php';
session_start();
// 
if(isset($_SESSION['isLogged'])){
    $client->revokeToken();
    session_unset();
    session_destroy();
    header("Location: ./login");
}
else{
    header("Location: ./login");
}

?>