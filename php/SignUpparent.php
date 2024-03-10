<?php
include('../connect.php');
$Name=$_POST['Name'];
$Email=$_POST['Email'];
$Password=$_POST['Password'];
$hPassword = password_hash($Password, PASSWORD_DEFAULT);
$sql="insert into parent(Name,Email,Password) values('$Name','$Email','$hPassword')";
$Result=$conn->QUERY($sql);

header('location:http://localhost/persnol-work/project/homePage.php');

?>