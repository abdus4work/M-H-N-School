<?php
$severname='localhost';
$username='secure';
$db_pass='Sadik@1432';
$db_name='m_h_n_school';
$conn= new mysqli($severname,$username,$db_pass,$db_name);
// $conn=mysqli_connect($severname,$username,$db_pass,$db_name);

if($conn->connect_error){ 
    die("Error".$conn->connect_error);
}

?>