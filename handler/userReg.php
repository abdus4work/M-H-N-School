<?php
require __DIR__.'/../config/db_con.php';


function checkUser($userId,$password){
    global $conn;
    $sql="SELECT * FROM user WHERE userId=?";
    $stmt=$conn->prepare($sql);
    $stmt->bind_param("s",$userId);
    $stmt->execute();
    $result=$stmt->get_result();
    if($result->num_rows>0){
    $data=$result->fetch_array();
    if(password_verify($password,$data['pass'])){
        $_SESSION['name']=$data['name'];
        $_SESSION['isLogged']=true;
        header("Location: ./dashboard");
    }
    }
  else{
    global $Error;
    $Error=true;
  }
}
?>