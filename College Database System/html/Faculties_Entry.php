<?php
$servername = "localhost";
$username = "root";
$password = ""; // Your MySQL password
$dbname = "assignment";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


	
$opr = ""; // Initialize the variable

$id = "";

if(isset($_GET['opr']))
    $opr = $_GET['opr'];

if(isset($_GET['rs_id']))
    $id = $_GET['rs_id'];

// Your existing code continues from here...

if(isset($_POST['btn_sub'])){
	$facuties_name=$_POST['fnametxt'];
	$note=$_POST['notetxt'];	
	

$sql_ins=mysqli_query($conn,"INSERT INTO facuties_tbl 
						VALUES(
							NULL,
							'$facuties_name',
							'$note'
							)
					");
if($sql_ins==true)
	$msg="1 Row Inserted";
else
	$msg="Insert Error:".mysqli_error();
	
}

//------------------uodate data----------
if(isset($_POST['btn_upd'])){
	$fac_name=$_POST['fnametxt'];
	$note=$_POST['notetxt'];	
	
	$sql_update=mysqli_query($conn,"UPDATE facuties_tbl SET 
								faculties_name='$fac_name'
								note='$note'
							WHERE
								faculties_id=$id
							");
	if($sql_update==true)
		echo "<div style='background-color: white;padding: 20px;border: 1px solid black;margin-bottom: 25px;''>"
                . "<span class='p_font'>"
                . "Record Updated Successfully... !"
                . "</span>"
                . "</div>";
	else
		$msg="Update Failed...!";
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/style_entry.css" />
</head>

<body>

<?php

if($opr=="upd")
{
	$sql_upd=mysqli_query($conn,"SELECT * FROM facuties_tbl WHERE faculties_id=$id");
	$rs_upd=mysqli_fetch_array($sql_upd);
	
?>

<div class="panel panel-default">
  		<div class="panel-heading"><h1><span class="glyphicon glyphicon-hdd"></span> Departments Update Form</h1></div>
  			<div class="panel-body">
			<div class="container">
				<p style="text-align:center;">Here, you'll update the department detail to record into database.</p>
			</div>
			<div class="container_form">
    <form method="post">
        <div class='faculty_pos'>
		<input type="text" style="width: 250px;" class="form-control" name="fnametxt" placeholder='Department name' value="<?php echo $rs_upd['faculties_name'];?>"/><br>
            
			<div class="teacher_bday_box" style="margin-left: 0px;">
					<div class="select_style">
                                            <select name="techtxt" style="width: 200px">
                                            <option>HOD name</option>
                            <?php
                                $te_name=mysqli_query($conn,"SELECT * FROM teacher_tbl");
								while($row=mysqli_fetch_array($te_name)){
									if($row['teacher_id']==$rs_upd['teacher_id'])
								   		$iselect="selected";
									else
										$iselect="";
								?>
                                <option value="<?php echo $row['teacher_id'];?>" <?php echo $iselect?> > <?php echo $row['f_name'] ; echo " "; echo $row['l_name'];?> </option>
                                	
								<?php	
									}
                            ?>
                                        </select>
                                        </div>
            </div><br><br>
			
			<textarea name="notetxt" class="form-control" cols="18" value='<?php  echo $rs_upd['note'];?>' rows="4"></textarea><br><Br>
        
            <input type="submit" name="btn_sub" href="#" class="btn btn-primary btn-large" value="Register" />&nbsp;&nbsp;&nbsp;
	    <input type="reset"  href="#" class="btn btn-primary btn-large" value="Cancel" />
        </div>
    </form>
</div>

<?php	
}
else
{
?>
<div class="panel panel-default">
  		<div class="panel-heading"><h1><span class="glyphicon glyphicon-hdd"></span> Department Entry Form</h1></div>
  			<div class="panel-body">
			<div class="container">
				<p style="text-align:center;">Here, you'll add new Department's detail to record into database.</p>
			</div>


<div class="container_form">
    <form method="post">
        <div class='faculty_pos'>
        
            <input type="text" style="width: 250px;" class="form-control" name="fnametxt" placeholder='Department name'/><br>
			<div class="teacher_bday_box" style="margin-left: 0px;">
					<div class="select_style">
                                            <select name="techtxt" style="width: 200px">
                                            <option>HOD name</option>
                            <?php
                                $te_name=mysqli_query($conn,"SELECT * FROM teacher_tbl");
								while($row=mysqli_fetch_array($te_name)){
									if($row['teacher_id']==$rs_upd['teacher_id'])
								   		$iselect="selected";
									else
										$iselect="";
								?>
                                <option value="<?php echo $row['teacher_id'];?>" <?php echo $iselect?> > <?php echo $row['f_name'] ; echo " "; echo $row['l_name'];?> </option>
                                	
								<?php	
									}
                            ?>
                                        </select>
                                        </div>
            </div><br><br>
			
            <textarea name="notetxt" class="form-control" cols="18" placeholder='Notes' rows="4"></textarea><br><Br>
        
            <input type="submit" name="btn_sub" href="#" class="btn btn-primary btn-large" value="Register" />&nbsp;&nbsp;&nbsp;
	    <input type="reset"  href="#" class="btn btn-primary btn-large" value="Cancel" />
        </div>
    </form>
</div><!-- end of style_informatios -->

<?php
}
?>
</body>
</html>