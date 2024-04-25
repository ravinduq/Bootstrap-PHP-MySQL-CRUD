<?php
# create database connection
$connect = mysqli_connect("localhost","root","","phplogin");

if(!empty($_POST["uname"])) {
  $query = "SELECT * FROM user WHERE uname='" . $_POST["uname"] . "'";
  $result = mysqli_query($connect,$query);
  $count = mysqli_num_rows($result);
  if($count>0) {
    echo "<span style='color:red; font-size:14px;'> Unavailable</span>";
    echo "<script>$('#submit').prop('disabled',true);</script>";
  }else{
    echo "<span style='color:green; font-size:14px;'> Available </span>";
    echo "<script>$('#submit').prop('disabled',false);</script>";
  }
}
?>