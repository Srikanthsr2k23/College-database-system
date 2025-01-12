<?php
// Include your database connection code using mysqli
require("conection/connect.php");

$id = "";
$opr = "";
$msg = "";

if (isset($_GET['opr'])) {
    $opr = $_GET['opr'];
}

if (isset($_GET['rs_id'])) {
    $id = $_GET['rs_id'];
}

// Add data
if (isset($_POST['btn_sub'])) {
    $stu_id = isset($_POST['stuidtxt']) ? $_POST['stuidtxt'] : '';
    $f_name = isset($_POST['fnametxt']) ? $_POST['fnametxt'] : '';
    $l_name = isset($_POST['lnametxt']) ? $_POST['lnametxt'] : '';
    $gender = isset($_POST['gender']) ? $_POST['gender'] : '';
    $dob = isset($_POST['yy']) && isset($_POST['mm']) && isset($_POST['dd']) ? $_POST['yy'] . "/" . $_POST['mm'] . "/" . $_POST['dd'] : '';
    $pob = isset($_POST['pobtxt']) ? $_POST['pobtxt'] : '';
    $addr = isset($_POST['addrtxt']) ? $_POST['addrtxt'] : '';
    $phone = isset($_POST['phonetxt']) ? $_POST['phonetxt'] : '';
    $mail = isset($_POST['emailtxt']) ? $_POST['emailtxt'] : '';
    $note = isset($_POST['notetxt']) ? $_POST['notetxt'] : '';

    $sql_ins = mysqli_query($con, "INSERT INTO stu_tbl 
        VALUES (
            '$stu_id',
            '$f_name',
            '$l_name',
            '$gender',
            '$dob',
            '$pob',
            '$addr',
            '$phone',
            '$mail',
            '$note'
        )");

    if ($sql_ins) {
        $msg = "1 Row Inserted";
    } else {
        $msg = "Insert Error: " . mysqli_error($con);
    }
}

// Update data
if (isset($_POST['btn_upd'])) {
    $f_name = isset($_POST['fnametxt']) ? $_POST['fnametxt'] : '';
    $l_name = isset($_POST['lnametxt']) ? $_POST['lnametxt'] : '';
    $gender = isset($_POST['gender']) ? $_POST['gender'] : '';
    $dob = isset($_POST['yy']) && isset($_POST['mm']) && isset($_POST['dd']) ? $_POST['yy'] . "/" . $_POST['mm'] . "/" . $_POST['dd'] : '';
    $pob = isset($_POST['pobtxt']) ? $_POST['pobtxt'] : '';
    $addr = isset($_POST['addrtxt']) ? $_POST['addrtxt'] : '';
    $phone = isset($_POST['phonetxt']) ? $_POST['phonetxt'] : '';
    $mail = isset($_POST['emailtxt']) ? $_POST['emailtxt'] : '';
    $note = isset($_POST['notetxt']) ? $_POST['notetxt'] : '';

    $sql_update = mysqli_query($con, "UPDATE stu_tbl SET 
        f_name='$f_name',
        l_name='$l_name',
        gender='$gender',
        dob='$dob',
        pob='$pob',
        address='$addr',
        phone='$phone',
        email='$mail',
        note='$note'
        WHERE stu_id=$id");

    if ($sql_update) {
        $msg = "<div style='background-color: white;padding: 20px;border: 1px solid black;margin-bottom: 25px;'>"
            . "<span class='p_font'>"
            . "Record Updated Successfully... !"
            . "</span>"
            . "</div>";
    } else {
        $msg = "Update Failed...!";
    }
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
    $sql_upd=mysqli_query($con, "SELECT * FROM stu_tbl WHERE stu_id=$id");
    $rs_upd=mysqli_fetch_array($sql_upd);
    list($y,$m,$d)=explode('-',$rs_upd['dob']);
?>

<!-- for form Upadte-->

<div class="panel panel-default">
    <div class="panel-heading"><h1><span class="glyphicon glyphicon-user"></span> Student Entry Form</h1></div>
    <div class="panel-body">
        <div class="container">
            <p style="text-align:center;">Here, you'll update new student's detail to record into database.</p>
        </div>

        <div class="container_form">
            <form method="post">
                <div class="teacher_name_pos">
                    <input type="text" name="fnametxt" class="form-control" value="<?php echo $rs_upd['f_name'];?>" />
                    <input type="text" name="lnametxt" class="form-control" value="<?php echo $rs_upd['l_name'];?>" />
                </div><br>

                <div class="teacher_radio_pos">
                    <input type="radio" name="gender" value="Male" <?php if($rs_upd['gender']=="Male") echo "checked";?> /> <span class="p_font">&nbsp;Male</span>
                    <input type="radio" name="gender" value="Female" <?php if($rs_upd['gender']=="Female") echo "checked";?> /> <span class="p_font">&nbsp;Female</span>
                </div><br>

                <div class="teacher_bday_box">
                    <span class="p_font">Birthday: </span>&nbsp;&nbsp;&nbsp;
                    <div class="select_style">
                        <select name="yy">
                            <option>Year</option>
                            <?php
                            $sel="";
                            for($i=1985;$i<=2015;$i++){    
                                if($i==$y){
                                    $sel="selected='selected'";}
                                else
                                $sel="";
                            echo"<option value='$i' $sel>$i </option>";
                            }
                            
                        ?>
                        </select>
                    </div>

                    <div class="select_style">
                        <select name="mm">
                            <option>Month</option>
                            <?php
                            $sel="";
                            $mm=array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","NOv","Dec");
                            $i=0;
                            foreach($mm as $mon){
                                $i++;
                                    if($i==$m){
                                        $sel=$sel="selected='selected'";}
                                    else
                                        $sel="";
                                echo"<option value='$i' $sel> $mon</option>";        
                            }
                        ?>
                        </select>
                    </div>

                    <div class="select_style">
                        <select name="dd">
                            <option>date</option>
                            <?php
                        $sel="";
                        for($i=1;$i<=31;$i++){
                            if($i==$d){
                                $sel=$sel="selected='selected'";}
                            else
                                $sel="";
                        ?>
                        <option value="<?php echo $i ;?>"<?php echo $sel?> >
                        <?php
                        if($i<10)
                            echo"0"."$i" ;
                        else
                            echo"$i";    
                              
                        ?>
                        </option>   
                        <?php 
                        }?>
                        </select>
                    </div>

                </div><br><br>

                <div class="teacher_bdayPlace_pos">
                    <input type="text" name="pobtxt" class="form-control" value="<?php echo $rs_upd['pob'];?> " />
                </div><br>

                <div class="teacher_address_pos">
                    <input type="text" name="addrtxt" class="form-control" value='<?php echo $rs_upd['address'];?>' />
                </div><br>

                <div class="teacher_mobile_pos">
                    <input type="text" name="phonetxt" class="form-control" value="<?php echo $rs_upd['phone'];?>" />
                </div><br>

                <div class="teacher_mail_pos">
                    <input type="text" name="emailtxt" class="form-control" value="<?php echo $rs_upd['email'];?> " />
                </div><br>

                <div class="teacher_note_pos">
                    <input type="text" name="notetxt" class="form-control" value='<?php echo $rs_upd['note'];?>' />
                </div><br>

                <div class="teacher_btn_pos">
                    <input type="submit" name="btn_upd" href="#" class="btn btn-primary btn-large" value="Update" />&nbsp;&nbsp;&nbsp;
                    <input type="reset"  href="#" class="btn btn-primary btn-large" value="Cancel" />
                </div>
            </form>
        </div>
    </div>
</div><!-- end of style_informatios -->

<?php    
}
else
{
?>
<!-- for form Register-->
    
<div class="panel panel-default">
    <div class="panel-heading"><h1><span class="glyphicon glyphicon-user"></span> Student Entry Form</h1></div>
    <div class="panel-body">
        <div class="container">
            <p style="text-align:center;">Here, you'll add new student's detail to record into database.</p>
        </div>

        <div class="container_form">
            <form method="post">
                <div class="teacher_name_pos">
                    <input type="text" name="fnametxt" class="form-control" placeholder="First name" />
                    <input type="text" name="lnametxt" class="form-control" placeholder="Last name" />
                </div><br>

                <div class="teacher_radio_pos">
                    <input type="radio" name="gender" value="Male" /> <span class="p_font">&nbsp;Male</span>
                    <input type="radio" name="gender" value="Female" /> <span class="p_font">&nbsp;Female</span>
                </div><br>

                <div class="teacher_bday_box">
                    <span class="p_font">Birthday: </span>&nbsp;&nbsp;&nbsp;
                    <div class="select_style">
                        <select name="yy">
                            <option>Year</option>
                            <?php
                            for($i=1985;$i<=2015;$i++){    
                            echo"<option value='$i'>$i</option>";
                            }
                        ?>
                        </select>
                    </div>

                    <div class="select_style">
                        <select name="mm">
                            <option>Month</option>
                            <?php
                            $mm=array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","NOv","Dec");
                            $i=0;
                            foreach($mm as $mon){
                                $i++;
                                echo"<option value='$i'> $mon</option>";        
                            }
                        ?>
                        </select>
                    </div>

                    <div class="select_style">
                        <select name="dd">
                            <option>date</option>
                            <?php
                        for($i=1;$i<=31;$i++){
                        ?>
                        <option value="<?php echo $i; ?>">
                        <?php
                        if($i<10)
                            echo"0".$i;
                        else
                            echo"$i";      
                        ?>
                        </option>   
                        <?php 
                        }?>
                        </select>
                    </div>

                </div><br><br>

                <div class="teacher_bdayPlace_pos">
                    <input type="text" name="pobtxt" class="form-control" placeholder="Place of birth" />
                </div><br>

                <div class="teacher_address_pos">
                    <input type="text" name="addrtxt" class="form-control" placeholder="Address" />
                </div><br>

                <div class="teacher_mobile_pos">
                    <input type="text" name="phonetxt" class="form-control" placeholder="Mobile no." />
                </div><br>

                <div class="teacher_mail_pos">
                    <input type="text" name="emailtxt" class="form-control" placeholder="Email address" />
                </div><br>

                <div class="teacher_note_pos">
                    <input type="text" name="notetxt" class="form-control" placeholder="Note" />
                </div><br>

                <div class="teacher_btn_pos">
                    <input type="submit" name="btn_sub" href="#" class="btn btn-primary btn-large" value="Register" />&nbsp;&nbsp;&nbsp;
                    <input type="reset"  href="#" class="btn btn-primary btn-large" value="Cancel" />
                </div>
            </form>
        </div>
    </div>
</div>
<?php
}
?>
</body>
</html>
