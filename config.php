
<?php
error_reporting(0);
session_start();
if(!isset($_SESSION['login']))
 $_SESSION['login'] = 0;
if(!mysql_connect("localhost","root",""))
{
     die('oops connection problem ! --> '.mysql_error());
}
if(!mysql_select_db("naukridhanda1"))
{
     die('oops database selection problem ! --> '.mysql_error());
}

 
?>
