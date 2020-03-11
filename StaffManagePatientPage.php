<?php
	session_start();
	
	//variable initialize
	$name = "";
	$rfidTagId = "";
	$dateJoin = "";
	$mentalIllness = "";
	$edit_state = false;
	
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
	$query = "SELECT * FROM patient";
	
	$result = mysqli_query($con, $query);
	
	echo '<br>';
	if(!$result)
		echo 'Records are not read.';
	else
		echo 'Records have been read.';
		
	//pass updated value into variable
	if(isset($_POST['update']))
	{
		$id = mysql_real_escape_string($_POST['id']);
		$name = mysql_real_escape_string($_POST['txtPatientName']);
		$rfidTagId = mysql_real_escape_string($_POST['txtRFIDTagId']);
		$dateJoin = mysql_real_escape_string($_POST['txtDateJoin']);
		$mentalIllness = mysql_real_escape_string($_POST['txtMentalIllness']);
		
		mysqli_query($con, "UPDATE patient 
							SET patientname = '$name', rfidtagid = '$rfidTagId', datejoin = '$dateJoin', mentalillness = '$mentalIllness'
							WHERE patientid = '$id'");
		$_SESSION['msg'] = "update";
		header("Location: StaffManagePatientPage.php");
	}
	
	// when user click Edit hyperlink
	if(isset($_GET['edit']))
	{
		$edit_state = true;
		$id = $_GET['edit'];
		$query = "SELECT * FROM patient WHERE patientid = '$id'";
		$result2 = mysqli_query($con, $query);
		$row = mysqli_fetch_array($result2);
		
		$name = $row['patientname'];
		$rfidTagId = $row['rfidtagid'];
		$dateJoin = $row['datejoin'];
		$mentalIllness = $row['mentalillness'];
	}
	
	// when user click Delete
	if(isset($_GET['delete']))
	{
		$id = $_GET['delete'];
		$query = "DELETE FROM patient WHERE patientid = '$id'";
		$result3 = mysqli_query($con, $query);
		
		$_SESSION['msg'] = "delete";
		header("Location: StaffManagePatientPage.php");
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php 
if(isset($_SESSION['msg'])) 
{
	if($_SESSION['msg'] == "update")
	{
		echo "<script type='text/javascript'>alert('Record updated !')</script>";
		unset($_SESSION['msg']);
	}
	else if($_SESSION['msg'] == "delete")
	{
		echo "<script type='text/javascript'>alert('Record deleted !')</script>";
		unset($_SESSION['msg']);
	}
}
?>
<table width="905" border="" align="center">
  <tr>
    <td width="216" rowspan="2" align="center"><img src="../img/logo fit.png" width="150" height="100" /></td>
    <td width="673" height="60"><p align="left" style="font-family: 'Trebuchet MS', Arial, Helvetica, sans-serif; font-size: 18px; font-weight: bold;"> <strong style="font-size: 20px">M E N T A L P A T I E N T L O C A T I O N  M O N I T O R I N G  S Y S T E M </strong></p></td>
  </tr>
  <tr>
    <td height="60"><p align="left"><i style="font-family: 'Comic Sans MS', cursive; color: #999;"> You can edit and delete any record you like.</i></p></td>
  </tr>
  <tr>
    <td align="right">Patient Registration</td>
    <td>
      <label for="txtYear"></label>
    Summary
    </form></td>
  </tr>
  <tr>
  	<td height="138" colspan="2">
    	<br />
        <br />
    	<table align="center" border="1">
        	<thead>
            	<tr>
   					<th width="242">Name</th>
                    <th width="107">RFID Tag ID</th>
                    <th width="136">Date Join</th>
                    <th width="186">Mentall Illness</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
            <tbody>
            	<?php while($row = mysqli_fetch_array($result)) { ?>
            		<tr>
                        <td><?php echo $row['patientname']; ?></th>
                        <td><?php echo $row['rfidtagid']; ?></th>
                        <td><?php echo $row['datejoin']; ?></th>
                        <td><?php echo $row['mentalillness']; ?></th>
                        <td width="91" align="center"><a href="StaffManagePatientPage.php?edit=<?php echo $row['patientid']; ?>">Edit</a></td>
                        <td width="81" align="center"><a href="StaffManagePatientPage.php?delete=<?php echo $row['patientid']; ?>">Delete</a></td>
                	</tr>
                <?php } ?>
            </tbody>
       	</table>
        <br />
        <br />
        <?php if($edit_state == true) { ?>
            <form method="POST" action="StaffManagePatientPage.php">
            <input type="hidden" name="id" value="<?php echo $id; ?>" />
            <table width="300" border="1" align="center">
             <tr>
               <td colspan="2" align="center">Edit Record</td>
             </tr>
             <tr>
                <td>Name : </td>
               <td><input name="txtPatientName" type="text" size="23" value="<?php echo $name; ?>" /></td>
             </tr>
             <tr>
                <td>RFID Tag ID : </td>
               <td><input name="txtRFIDTagId" type="text" size="23" value="<?php echo $rfidTagId; ?>" /></td>
             </tr>
             <tr>
                <td>Date Join : </td>
               <td><input name="txtDateJoin" type="text" size="23" value="<?php echo $dateJoin; ?>" /></td>
             </tr>
             <tr>
                <td>Mental Illness : </td>
               <td><input name="txtMentalIllness" type="text" size="23" value="<?php echo $mentalIllness; ?>" /></td>
             </tr>
             <tr>
                <td colspan="2" align="center"><button type="submit" name="update">Update</button></td>
             </tr>
          </table>
          <br />
          </form>
          <?php } ?>
    	<p>&nbsp;</p>
    </td>
  </tr>
</table>
<table width="903" border="1" align="center">
  <tr>
    <td width="893" align="center"><a href="StaffHomePage.php"><img src="../img/Back.PNG" width="300" height="110" /></a>&nbsp;&nbsp;&nbsp;<a href="StaffRegisterPatientPage.php"><img src="../img/Add_Short.PNG" width="300" height="110" /></a></td>
  </tr>
</table>
</body>
</html>
