<?php
	session_start();
	
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
		
	//read from table 'patient'
	$query = "SELECT * FROM patientlocation
			  INNER JOIN patient
			  ON patientlocation.patientid = patient.patientid
			  INNER JOIN location
			  ON patientlocation.locationid = location.locationid";
	
	$result = mysqli_query($con, $query);
	
	echo '<br>';
	if(!$result)
		echo 'Records are not read.';
	else
		echo 'Records have been read.';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<table width="1000" border="" align="center">
  <tr>
    <td width="163" rowspan="2" align="center"><img src="../img/logo fit.png" width="150" height="100" /></td>
    <td width="583" height="60"><p align="left" style="font-family: 'Trebuchet MS', Arial, Helvetica, sans-serif; font-size: 18px; font-weight: bold;"> <strong style="font-size: 20px">M E N T A L P A T I E N T L O C A T I O N  M O N I T O R I N G  S Y S T E M </strong></p></td>
  </tr>
  <tr>
    <td height="60"><p align="left"><i style="font-family: 'Comic Sans MS', cursive; color: #999;"> Let's find out where are your patients currently at.</i></p></td>
  </tr>
  <tr>
    <td colspan="2">
    	<br />
        <table width="767" border="1" align="center">
          <thead>
          	<tr>
                <th width="161">Patient Name</td>
                <th width="142">RFID Tag ID</td>
                <th width="176">Location</td>
                <th width="136">Date</td>
                <th width="118">Time</td>
            </tr>
          </thead>
          <tbody>
          	<?php while($row = mysqli_fetch_array($result)) { ?>
              <tr>
                <td><?php echo $row['patientname']; ?></td>
                <td><?php echo $row['rfidtagid']; ?></td>
                <td><?php echo $row['locationname']; ?></td>
                <td><?php echo $row['dateupdate']; ?></td>
                <td><?php echo $row['timeupdate']; ?></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
        <br />
    </td>
  </tr>
</table>
<table width="1000" border="1" align="center">
  <tr>
    <td align="left"><a href="StaffHomePage.php"><img src="../img/Back.PNG" width="300" height="110" /></a></td>
    <td align="right"><a href="StaffViewSpecificPatientLocationPage.php"><img src="../img/SpecificSearch.PNG" width="630" height="110" /></a></td>
  </tr>
</table>
</body>
</html>