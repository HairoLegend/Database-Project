<?

session_start();
session_destroy();
header("Location: login.php"); //redirect to new page

?>