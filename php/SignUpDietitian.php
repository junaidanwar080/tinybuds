<?php
include('../connect.php');
$Name=$_POST['Name'];
$Email=$_POST['Email'];
$Password=$_POST['Password'];
$hPassword = password_hash($Password, PASSWORD_DEFAULT);
$Certificate=$_POST['Certificate'];
$sql="insert into admin(Name,Email,Password,Certificate) values('$Name','$Email','$hPassword','$Certificate')";
$Result=$conn->QUERY($sql);

header('location:http://localhost/persnol-work/project/homePage.php');

?>