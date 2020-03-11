<?php
	session_start();
	
	//variable initialize
	$rfidreaderid = "";
	$locationname = "";
	$dateassign = "";
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
	$query = "SELECT * FROM location";
	
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
		$locationname = mysql_real_escape_string($_POST['txtLocationName']);
		$rfidreaderid = mysql_real_escape_string($_POST['txtRFIDReaderId']);
		$dateassign = mysql_real_escape_string($_POST['txtDateAssign']);
		
		mysqli_query($con, "UPDATE location 
							SET locationname = '$locationname', rfidreaderid = '$rfidreaderid', dateassigned = '$dateassign'
							WHERE locationid = '$id'");
		$_SESSION['msg'] = "update";
		header("Location: StaffManageLocationPage.php");
	}
	
	// when user click Edit hyperlink
	if(isset($_GET['edit']))
	{
		$edit_state = true;
		$id = $_GET['edit'];
		$query = "SELECT * FROM location WHERE locationid = '$id'";
		$result2 = mysqli_query($con, $query);
		$row = mysqli_fetch_array($result2);
		
		$locationname = $row['locationname'];
		$rfidreaderid = $row['rfidreaderid'];
		$dateassign = $row['dateassigned'];
	}
	
	// when user click Delete
	if(isset($_GET['delete']))
	{
		$id = $_GET['delete'];
		$query = "DELETE FROM location WHERE locationid = '$id'";
		$result3 = mysqli_query($con, $query);
		
		$_SESSION['msg'] = "delete";
		header("Location: StaffManageLocationPage.php");
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
<table width="1000" border="" align="center">
  <tr>
    <td width="163" rowspan="2" align="center"><img src="../img/logo fit.png" width="150" height="100" /></td>
    <td width="583" height="60"><p align="left" style="font-family: 'Trebuchet MS', Arial, Helvetica, sans-serif; font-size: 18px; font-weight: bold;"> <strong style="font-size: 20px">M E N T A L P A T I E N T L O C A T I O N  M O N I T O R I N G  S Y S T E M </strong></p></td>
  </tr>
  <tr>
    <td height="60"><p align="left"><i style="font-family: 'Comic Sans MS', cursive; color: #999;"> You can edit and delete any record you like.</i></p></td>
  </tr>
  <tr>
    <td align="right">Forbidden Location</td>
    <td>
      <label for="txtYear"></label>
    Assignation
    </td>
  </tr>
  <tr>
  	<td colspan="2">
    <br />
    	<table align="center" border="1">
        	<thead>
            	<tr>
   					<th width="221">Location Name</th>
                    <th width="170">RFID Reader ID</th>
                    <th width="140">Date Assign</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
            <tbody>
            	<?php while($row = mysqli_fetch_array($result)) { ?>
            		<tr>
                        <td><?php echo $row['locationname']; ?></th>
                        <td><?php echo $row['rfidreaderid']; ?></th>
                        <td><?php echo $row['dateassigned']; ?></th>
                        <td width="108" align="center"><a href="StaffManageLocationPage.php?edit=<?php echo $row['locationid']; ?>">Edit</a></td>
                        <td width="99" align="center"><a href="StaffManageLocationPage.php?delete=<?php echo $row['locationid']; ?>">Delete</a></td>
                	</tr>
                <?php } ?>
            </tbody>
       	</table>
        <br />
        <br />
        <?php if($edit_state == true) { ?>
            <form method="POST" action="StaffManageLocationPage.php">
            <input type="hidden" name="id" value="<?php echo $id; ?>" />
            <table width="350" border="1" align="center">
             <tr>
               <td colspan="2" align="center">Edit Record</td>
             </tr>
             <tr>
                <td>Location Name : </td>
               <td><input name="txtLocationName" type="text" size="23" value="<?php echo $locationname; ?>" /></td>
             </tr>
             <tr>
                <td>RFID Reader ID : </td>
               <td><input name="txtRFIDReaderId" type="text" size="23" value="<?php echo $rfidreaderid; ?>" /></td>
             </tr>
             <tr>
                <td>Date Assign : </td>
               <td><input name="txtDateAssign" type="text" size="23" value="<?php echo $dateassign; ?>" /></td>
             </tr>
             <tr>
                <td colspan="2" align="center"><button type="submit" name="update">Update</button></td>
             </tr>
          </table>
          <br />
          </form>
    <?php } ?>
    </td>
  </tr>
</table>
<table width="1000" border="1" align="center">
  <tr>
    <td align="center"><a href="StaffHomePage.php"><img src="../img/Back.PNG" width="300" height="110" /></a>&nbsp;&nbsp;&nbsp;<a href="StaffRegisterLocationPage.php"><img src="../img/Add_Short.PNG" width="300" height="110" /></a></td>
  </tr>
</table>
</body>
</html>