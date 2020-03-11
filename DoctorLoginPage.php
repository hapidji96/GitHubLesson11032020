<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<table width="745" height="528" border="0" align="center">
  <tr align="center">
    <td height="177" colspan="2"><img src="../img/logo short tail.png" width="490" height="306" longdesc="MPLMS Logo" /></td>
  </tr>
  <tr>
    <td height="28" colspan="2"> <p align="center" style="font-family: 'Trebuchet MS', Arial, Helvetica, sans-serif; font-size: 18px; font-weight: bold;"> <strong style="font-size: 20px">M E N T A L P A T I E N T L O C A T I O N  M O N I T O R I N G  S Y S T E M </strong></p></td>
  </tr>
  <tr>
    <td height="52" colspan="2"> <p align="center"><i style="font-family: 'Comic Sans MS', cursive; color: #999;"> Enter your username and password</i></p></td>
  </tr>
  <form action="DoctorLoginPage.php" method="POST">
  <tr align="center">
    <td width="327" height="34" align="right">Username :</td>
    <td width="408" align="left">
      <input type="text" name="txtUsername" id="txtUsername" />
    </td>
  </tr>
  <tr align="center">
    <td height="34" align="right">Password :</td>
    <td align="left"><input type="text" name="txtPassword" id="txtPassword" /></td>
  </tr>
  <tr>
    <td height="58" colspan="2" align="center"><input type="submit" name="login" value="Login" /></td>
  </tr>
  </form>
</table>
</body>
</html>

<?php
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	// connect to server
	$con = mysqli_connect('127.0.0.1','root','');
	
	echo '<br>';
	if(!$con)
		echo 'Not Connected To Server';
	else
		echo 'Connected To Server';
		
	// connect to database 'mplms'
	echo '<br>';
	if(!mysqli_select_db($con, 'mplms'))
		echo 'Database Not Selected';
	else
		echo 'Database is Selected';
		
	$username = $_POST['txtUsername'];
	$password = $_POST['txtPassword'];
	
	$query = "SELECT * FROM user WHERE username = '$username' AND password = '$password' AND role = 'Doctor'";
	$result = mysqli_query($con, $query) or die("Failed to query database ".mysql_error());
	$row = mysqli_fetch_array($result);
	
	echo '<br>';
	if(!$row)
		echo 'Record is not exist';
	else
	{
		echo 'Record is exist.';
		header("Location: DoctorHomePage.php");
	}
}
?>