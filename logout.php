<?php

session_start();

$_SESSION['login'] = 0;
unset($_SESSION['email']);
unset($_SESSION['user_type']);
unset($_SESSION['userid']);

echo "<script>alert('Logout Successfully!!');window.location.href='login.php'</script>";

?>


