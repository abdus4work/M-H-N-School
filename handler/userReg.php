<?php
require __DIR__.'/../config/db_con.php';

function addGoogleUser($name,$email,$oauthid){
    $sql="INSERT INTO user (name,email,oauthid) VALUES (?,?,?)";
    // $sql="INSERT INTO user (name,email,oauthid) VALUES ('$name','$email','$oauthid')";
    global $conn;
    $stmt=$conn->prepare($sql);
    $stmt->bind_param("sss",$name,$email,$oauthid);
    $stmt->execute();
    if(!$conn->affected_rows){
        echo "Error: ".$sql."<br>". $conn->connect_error;
    }
    $stmt->close();
}

function addUser($name,$email,$password){
    $password=password_hash($password,PASSWORD_DEFAULT);
    // $sql="INSERT INTO user (name,email,pass) VALUES ('$name','$email','$password')";
    $sql="INSERT INTO user (name,email,pass) VALUES (?,?,?)";
    global $conn;
    $stmt=$conn->prepare($sql);
    $stmt->bind_param("sss",$name,$email,$password);
    $stmt->execute();
    if($conn->affected_rows){
        $_SESSION['name']=$name;
        $_SESSION['email']=$email;
    }
    else{
        echo "Error: ".$sql."<br>". $conn->connect_error;
    }
    $stmt->close();
}

function checkGoogleUser($email,$oauthid){
    global $conn;
    $sql="SELECT * FROM user WHERE email=? AND oauthid=?";
    $stmt=$conn->prepare($sql);
    $stmt->bind_param("ss",$email,$oauthid);
    $stmt->execute();
    $result=$stmt->get_result();
    return $result->num_rows>0;
}

function checkUser($email,$password){
    global $conn;
    $sql="SELECT * FROM user WHERE email=?";
    $stmt=$conn->prepare($sql);
    $stmt->bind_param("s",$email);
    $stmt->execute();
    $result=$stmt->get_result();
    if($result->num_rows>0){
    $data=$result->fetch_array();
    if(password_verify($password,$data['pass'])){
        $_SESSION['name']=$data['name'];
        $_SESSION['isLogged']=true;
        $_SESSION['email']=$email;
        header("Location: ./dashboard");
    }
  }
  else{
    global $Error;
    $Error=true;
  }
}
?>