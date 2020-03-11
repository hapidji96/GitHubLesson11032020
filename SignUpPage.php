<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<table width="745" height="696" border="0" align="center">
  <tr align="center">
    <td height="177" colspan="2"><img src="../img/logo short tail.png" width="490" height="306" longdesc="MPLMS Logo" /></td>
  </tr>
  <tr>
    <td height="28" colspan="2"> <p align="center" style="font-family: 'Trebuchet MS', Arial, Helvetica, sans-serif; font-size: 18px; font-weight: bold;"> <strong style="font-size: 20px">M E N T A L P A T I E N T L O C A T I O N  M O N I T O R I N G  S Y S T E M </strong></p></td>
  </tr>
  <tr>
    <td height="52" colspan="2"> <p align="center"><i style="font-family: 'Comic Sans MS', cursive; color: #999;"><u> Enter your personal information </u></i></p></td>
  </tr>
  <form action="SignUpPage.php" method="POST">
      <tr align="center">
        <td width="327" height="34" align="right">Name :</td>
        <td width="408" align="left">
          <input type="text" name="txtName" id="txtName" />
        </td>
      </tr>
      <tr align="center">
        <td height="34" align="right">Role :</td>
        <td align="left"> <p>
            <label for="radBtnRole"></label>
            <label>
              <input type="radio" name="radGroupRole" value="Staff" id="radGroupRole_0" />
              Staff</label>
            <br />
            <label>
              <input type="radio" name="radGroupRole" value="Doctor" id="radGroupRole_1" />
              Doctor</label>
            <br />
          </p>
        </td>
      </tr>
      <tr>
        <td height="52" colspan="2"> <p align="center"><i style="font-family: 'Comic Sans MS', cursive; color: #999;"><u> Enter your login  information </u></i></p></td>
      </tr>
      <tr align="center">
        <td width="327" height="34" align="right">Username :</td>
        <td width="408" align="left">
          <label for="txtUsername"></label>
          <input type="text" name="txtUsername" id="txtUsername" />
        </td>
      </tr>
      <tr align="center">
        <td height="34" align="right">Password :</td>
        <td align="left">
          <label for="txtPassword"></label>
          <input name="txtPassword" type="password" id="txtPassword"  />
        </td>
      </tr>
      <tr>
        <td height="88" colspan="2" align="center"><input type="submit" name="submit" value="Submit" /></td>
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
		
	// connect to database 'user'
	echo '<br>';
	if(!mysqli_select_db($con, 'mplms'))
		echo 'Database Not Selected';
	else
		echo 'Database is Selected';
	
	// count rows in 'user'
	$query_countRows = "SELECT COUNT(userid) AS num FROM user";
	$countRows_Result = mysqli_query($con, $query_countRows);
	$row = mysqli_fetch_assoc($countRows_Result);
	$size = $row['num'];
	
	echo '<br>';
	if(!$countRows_Result)
		echo 'Records not counted';
	else
		printf("%d records have been found.", $size);
		
	$sizeInt = (int)$size + 1;
	$stringSize = (string)$sizeInt;
	$userIdBuilder = "user".$stringSize;
	
	$userid = $userIdBuilder;
	$name = $_POST['txtName'];
	$role = $_POST['radGroupRole'];
	$username = $_POST['txtUsername'];
	$password = $_POST['txtPassword'];
	
	$query = "INSERT INTO user (userid, name, role, username, password) VALUES ('$userid', '$name', '$role', '$username', '$password')";
	
	echo '<br>';
	if(!mysqli_query($con, $query))
		echo 'Record not inserted.';
	else
		echo 'Record has been inserted';
		
	if($role == 'Staff')
		header("Location: StaffHomePage.php");
	else if($role == 'Doctor')
		header("Location: DoctorHomePage.php");
	else
		printf("Page not redirect. Please check.");
}
?>