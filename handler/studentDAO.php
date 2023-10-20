<?php
$server="localhost";
$user='secure';
$db_pass='Sadik@1432';
$db_name='users';

$sconn=new mysqli($server,$user,$db_pass,$db_name);
if($sconn->connect_error){
    die("Failed to connec". $sconn->connect_error);
}


function addStudent($roll,$fname,$mname,$lname,$addr,$gname,$gmob,$class,$sec,$pin){
    global $sconn;
    $sql="INSERT INTO student (roll,fname,mname,lname,addr,gname,gmob,class,sec,pin) VALUES (?,?,?,?,?,?,?,?,?,?)";
    $stmt=$sconn->prepare($sql);
    $stmt->bind_param("isssssissi",$roll,$fname,$mname,$lname,$addr,$gname,$gmob,$class,$sec,$pin);
    $stmt->execute();
    return $sconn->affected_rows;
}

function getStudent($roll,$class,$sec){
    global $sconn;
    $sql="SELECT * FROM student WHERE roll=? and class=? and sec=?";
    $stmt=$sconn->prepare($sql);
    $stmt->bind_param("iss",$roll,$class,$sec);
    $stmt->execute();
    $result=$stmt->get_result();
    return $result;
}

function updateStudent($id,$roll,$fname,$mname,$lname,$addr,$gname,$gmob,$class,$sec,$pin){
    global $sconn;
    $sql="UPDATE student SET
    roll=?,fname=?,mname=?,lname=?,addr=?,gname=?,gmob=?,class=?,sec=?,pin=? 
    WHERE id=?";
    $stmt=$sconn->prepare($sql);
    $stmt->bind_param("isssssissii",$roll,$fname,$mname,$lname,$addr,$gname,$gmob,$class,$sec,$pin,$id);
    $stmt->execute();
    return $sconn->affected_rows;
}