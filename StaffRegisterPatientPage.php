<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<table width="745" height="618" border="0" align="center">
  <tr align="center">
    <td height="177" colspan="2"><img src="../img/logo short tail.png" width="490" height="306" longdesc="MPLMS Logo" /></td>
  </tr>
  <tr>
    <td height="28" colspan="2"> <p align="center" style="font-family: 'Trebuchet MS', Arial, Helvetica, sans-serif; font-size: 18px; font-weight: bold;"> <strong style="font-size: 20px">M E N T A L P A T I E N T L O C A T I O N  M O N I T O R I N G  S Y S T E M </strong></p></td>
  </tr>
  <tr>
    <td height="52" colspan="2"> <p align="center"><i style="font-family: 'Comic Sans MS', cursive; color: #999;">Enter patient information</i></p></td>
  </tr>
  <form action="StaffRegisterPatientPage.php" method="POST">
  <tr align="center">
    <td width="361" height="34" align="left">First Name : <input type="text" name="txtPatientFirstName" id="txtPatientFirstName" size="30%" /></td>
    <td width="369" align="left">Last Name : <input type="text" name="txtPatientLastName" id="txtPatientLastName" size="30%" /></td>
  </tr>
  <tr align="center">
    <td height="34" align="left">IC Number : <input type="text" name="txtICNumber" id="txtICNumber" size="30%" /></td>
    <td align="left">Date Of Birth : <input type="text" name="txtBirthDate" id="txtBirthDate" size="30%" /></td>
  </tr>
  <tr align="center">
    <td height="34" align="left">Age : <input type="text" name="txtAge" id="txtAge" size="30%%" /></td>
    <td align="left">Sex : <input type="text" name="txtSex" id="txtSex" size="30%" /></td>
  </tr>
  <tr align="center">
    <td height="34" align="left">Marital Status : <input type="text" name="txtMaritalStatus" id="txtMaritalStatus" size="30%" /></td>
    <td align="left">Religion : <input type="text" name="txtReligion" id="txtReligion" size="30%" /></td>
  </tr>
  <tr>
  	<td height="34" align="left">Mobile No : <input type="text" name="txtMobileNo" id="txtMobileNo" size="30%" /></td>
    <td align="left">Home No : <input type="text" name="txtHomeNo" id="txtHomeNo" size="30%" /></td>
  </tr>
  <tr>
  	<td height="34" align="left" colspan="2">Email Address : <input type="text" name="txtEmail" id="txtEmail" size="80%" /></td>
    <td align="left"></td>
  </tr>
  <tr>
  	<td height="34" colspan="2" align="center"><i><b><u>Address</u></b></i></td>
    <td width="1"></td>
  </tr>
  <tr>
  	<td height="34" align="left">Address : <input type="text" name="txtAddress" id="txtAddress" size="30%" /></td>
    <td align="left">City : <input type="text" name="txtCity" id="txtCity" size="30%" /></td>
  </tr>
  <tr>
  	<td height="34" align="left">Postcode : <input type="text" name="txtPostcode" id="txtPostcode" size="30%" /></td>
    <td align="left">State : <input type="text" name="txtState" id="txtState" size="30%" /></td>
  </tr>
  <tr>
  	<td height="34" colspan="2" align="center"><i><b><u>Next of Kin / First Contact</u></b></i></td>
    <td width="1"></td>
  </tr>
  <tr>
  	<td height="34" align="left">Name : <input type="text" name="txtKinName" id="txtKinName" size="30%" /></td>
    <td align="left">Relationship : <input type="text" name="txtRelationship" id="txtRelationship" size="30%" /></td>
  </tr>
  <tr>
  	<td height="34" align="left" colspan="2">Address : 
  	  <input type="text" name="txtKinAddress" id="txtKinAddress" size="85%" /></td>
    <td></td>
  </tr>
  <tr>
  	<td height="34" align="left">Mobile No : <input type="text" name="txtKinMobileNo" id="txtKinMobileNo" size="30%" /></td>
    <td align="left">Home/Work No : <input type="text" name="txtKinHomeNo" id="txtKinHomeNo" size="30%" /></td>
  </tr>
  <tr>
  	<td height="34" align="center" colspan="2"><i><b><u>Admission</u></b></i></td>
    <td></td>
  </tr>
  <tr>
  	<td height="34" align="left">Date Join : <input type="text" name="txtDateJoin" id="txtDateJoin" size="30%" /></td>
    <td align="left">RFID Tag : <input type="text" name="txtRFIDTag" id="txtRFIDTag" size="30%" /></td>
  </tr>
  <tr>
  	<td height="34" align="left" colspan="2">Mental Illness : <input type="text" name="txtMentalIllness" id="txtMentalIllness" size="75%" /></td>
    <td align="left"></td>
  </tr>
  <tr>
    <td height="76" colspan="2" align="center"><input type="submit" name="submit" value="Submit" /></a></td>
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
		
	// connect to database 'patient'
	echo '<br>';
	if(!mysqli_select_db($con, 'mplms'))
		echo 'Database Not Selected';
	else
		echo 'Database is Selected';
		
	// count rows in 'patient'
	$query_countRows = "SELECT COUNT(patientid) AS num FROM patient";
	$countRows_Result = mysqli_query($con, $query_countRows);
	$row = mysqli_fetch_assoc($countRows_Result);
	$size = $row['num'];
	
	echo '<br>';
	if(!$countRows_Result)
		echo 'Patient records not counted';
	else
		printf("%d patient records have been found.", $size);
		
	$sizeInt = (int)$size + 1;
	$stringSize = (string)$sizeInt;
	$patientIdBuilder = "patient".$stringSize;
	
	$patientid = $patientIdBuilder;
	$firstname = $_POST['txtPatientFirstName'];
	$lastname = $_POST['txtPatientLastName'];
	$icnumber = $_POST['txtICNumber'];
	$birthdate = $_POST['txtBirthDate'];
	$age = $_POST['txtAge'];
	$sex = $_POST['txtSex'];
	$maritalStatus = $_POST['txtMaritalStatus'];
	$religion = $_POST['txtReligion'];
	$email = $_POST['txtEmail'];
	$mobileNo = $_POST['txtMobileNo'];
	$homeNo = $_POST['txtHomeNo'];
	
	$address = $_POST['txtAddress'];
	$city = $_POST['txtCity'];
	$postcode = $_POST['txtPostcode'];
	$state = $_POST['txtState'];
	
	$kinName = $_POST['txtKinName'];
	$kinRelationship = $_POST['txtRelationship'];
	$kinAddress = $_POST['txtKinAddress'];
	$kinMobileNo = $_POST['txtKinMobileNo'];
	$kinHomeNo = $_POST['txtKinHomeNo'];
	
	$rfidIdTag = $_POST['txtRFIDTag'];
	$datejoin = $_POST['txtDateJoin'];
	$mentalIllness = $_POST['txtMentalIllness'];
	
	// PATIENT 
	
	$queryPatient = "INSERT INTO patient 
				(patientid, firsttname, lastname, icnumber,
				birthdate, age, sex, maritalstatus, religion, email,
				rfidtagid, datejoin, mentalillness) 
				VALUES 
				('$patientid', '$firstname', '$lastname', '$icnumber',
				'$birthdate', '$age', '$sex', '$maritalStatus', '$religion', '$email',
				'$rfidIdTag', '$datejoin', '$mentalIllness')";
				
	echo '<br>';
	if(!mysqli_query($con, $queryPatient))
		echo 'Patient record not inserted.';
	else
		echo 'Patient record has been inserted';
		
	
	// PATIENT ADDRESS
	// count rows in 'patientaddress'
	$query_countRows = "SELECT COUNT(addressid) AS num FROM patientaddress";
	$countRows_Result = mysqli_query($con, $query_countRows);
	$row = mysqli_fetch_assoc($countRows_Result);
	$size = $row['num'];
	
	echo '<br>';
	if(!$countRows_Result)
		echo 'Address records not counted';
	else
		printf("%d address records have been found.", $size);
		
	$sizeInt = (int)$size + 1;
	$stringSize = (string)$sizeInt;
	$addressIdBuilder = "address".$stringSize;
	
	$queryPatientAddress = "INSERT INTO patientaddress
			(addressid, patientid, address, city, state, postcode) 
			VALUES 
			('$addressIdBuilder', '$patientid', '$address', '$city', '$state', '$postcode')";
	
	echo '<br>';
	if(!mysqli_query($con, $queryPatientAddress))
		echo 'Address record not inserted.';
	else
		echo 'Address record has been inserted';


	// PATIENT CONTACT
	// count rows in 'patientcontact'
	$query_countRows = "SELECT COUNT(contactid) AS num FROM patientcontact";
	$countRows_Result = mysqli_query($con, $query_countRows);
	$row = mysqli_fetch_assoc($countRows_Result);
	$size = $row['num'];
	
	echo '<br>';
	if(!$countRows_Result)
		echo 'Contact records not counted';
	else
		printf("%d contact records have been found.", $size);
		
	$sizeInt = (int)$size + 1;
	$sizeIntPlus1 = (int)$size + 1;
	$stringSize = (string)$sizeInt;
	$stringSizePlus1 = (string)$sizeIntPlus1;
	$contactIdBuilder1 = "contact".$stringSize;
	$contactIdBuilder2 = "contact".($stringSizePlus1);
	
	$queryPatientContactMobile = "INSERT INTO patientcontact
			(contactid, patientid, category, number) 
			VALUES 
			('$contactIdBuilder1', '$patientid', 'Mobile', $mobileNo";
	
	$queryPatientContactHome = "INSERT INTO patientcontact
			(contactid, patientid, category, number) 
			VALUES 
			('$contactIdBuilder2', '$patientid', 'Home', $homeNo)";
	
	echo '<br>';
	if(!mysqli_query($con, $queryPatientContactMobile))
		echo 'Contact mobile record not inserted.';
	else
		echo 'Contact mobile record has been inserted';
		
	echo '<br>';
	if(!mysqli_query($con, $queryPatientContactHome))
		echo 'Contact home record not inserted.';
	else
		echo 'Contact home record has been inserted';
		
	// KIN
	// count rows in 'kin'
	$query_countRows = "SELECT COUNT(kinid) AS num FROM patientkin";
	$countRows_Result = mysqli_query($con, $query_countRows);
	$row = mysqli_fetch_assoc($countRows_Result);
	$size = $row['num'];
	
	echo '<br>';
	if(!$countRows_Result)
		echo 'Kin records not counted';
	else
		printf("%d kin records have been found.", $size);
		
	$sizeInt = (int)$size + 1;
	$stringSize = (string)$sizeInt;
	$kinIdBuilder = "kin".$stringSize;
	
	$queryPatientKin = "INSERT INTO patientkin
			(kinid, patientid, kinname, address, mobilenumber, homenumber) 
			VALUES 
			('$kinIdBuilder', '$patientid', '$address', $kinMobileNo, $kinHomeNo)";
	
	echo '<br>';
	if(!mysqli_query($con, $queryPatientKin))
		echo 'Kin record not inserted.';
	else
		echo 'Kin record has been inserted';
}
?>