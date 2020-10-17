<?php
session_start();
if(isset($_POST['resbut']))
{
$s1=$_POST['s1'];
$s2=$_POST['s2'];
$s3=$_POST['s3'];
$s4=$_POST['s4'];
$s5=$_POST['s5'];
if($_SESSION['type']=='Student')
{
    include_once('config.php');
$sid=$_SESSION['id'];
$query="insert into lab_res (sid, step_1, step_2, step_3,step_4,step_5) values($sid,'$s1', '$s2', '$s3', '$s4','$s5')";
//echo $query;
$result = mysqli_query($link,$query);

if($result)
  { 
    
  }
 else 
  { 
     $_SESSION['wentwrong']="";
  }

header('location:welcome.php');
}
else
{
    header('location:welcome.php');
}
}
else
header('location:index:php');
?>