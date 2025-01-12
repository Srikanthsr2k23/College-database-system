<?php
$msg = "";
$opr = "";
if (isset($_GET['opr']))
    $opr = $_GET['opr'];

if (isset($_GET['rs_id']))
    $id = $_GET['rs_id'];

// Create a MySQLi connection
$servername = "localhost";
$username = "root";
$password = ""; // Your MySQL password
$dbname = "assignment";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($opr == "del") {
    // Use prepared statements to prevent SQL injection
    $del_stmt = $conn->prepare("DELETE FROM stu_score_tbl WHERE ss_id = ?");
    $del_stmt->bind_param("i", $id);
    if ($del_stmt->execute()) {
        $msg = "<div style='background-color: white;padding: 20px;border: 1px solid black;margin-bottom: 25px;''>"
            . "<span class='p_font'>"
            . "1 Record Deleted... !"
            . "</span>"
            . "</div>";
    } else {
        $msg = "Could not Delete :" . $conn->error;
    }
    $del_stmt->close();
}

echo $msg;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/style_view.css" />
<title>Untitled Document</title>
</head>

<body>
<div class="btn_pos">
        <form method="post">
            <input type="text" name="searchtxt" class="input_box_pos form-control" placeholder="Search name.." />
            <div class="btn_pos_search">
            <input type="submit" class="btn btn-primary btn-large" value="Search"/>&nbsp;&nbsp;
            <a href="?tag=score_entry"><input type="button" class="btn btn-large btn-primary" value="Register new" name="butAdd"/></a>
            </div>
        </form>
    </div><br><br>
    
<br />
<div class="table_margin">
<table class="table table-bordered">
        <thead>
            <tr>
            <th style="text-align: center;">Sl.No</th>
            <th style="text-align: center;">Students ID </th>
            <th style="text-align: center;">Teacher's SSN</th>
            <th style="text-align: center;">Subject ID </th>
            <th style="text-align: center;">Mid term</th>
            <th style="text-align: center;">Final</th>
            <th style="text-align: center;">Note</th>
            <th style="text-align: center;" colspan="2">Operation</th>
        </tr>
        </thead>
        <?php
        
        $key="";
    if(isset($_POST['searchtxt']))
        $key=$_POST['searchtxt'];
    
        if ($key != "") {
            $sql_sel = $conn->query("SELECT * FROM stu_score_tbl WHERE stu_id LIKE '%$key%'");

        } else {
            $sql_sel = $conn->query("SELECT * FROM stu_score_tbl");
        }
        
        $i = 0;
        while ($row = $sql_sel->fetch_assoc()) {
            $i++;
            // Your table row generation code goes here
            ?>
      <tr>
            <td><?php echo $i;?></td>
            <td><?php echo $row['stu_id'];?></td>
            <td><?php echo $row['faculties_id'];?></td>
            <td><?php echo $row['sub_id'];?></td>
            <td><?php echo $row['miderm'];?></td>
            <td><?php echo $row['final'];?></td>
            <td><?php echo $row['note'];?></td>
            <td align="center"><a href="?tag=score_entry&opr=upd&rs_id=<?php echo $row['ss_id'];?>"><img style="-webkit-box-shadow: 0px 0px 0px 0px rgba(50, 50, 50, 0.75);-moz-box-shadow:    0px 0px 0px 0px rgba(50, 50, 50, 0.75);box-shadow:         0px 0px 0px 0px rgba(50, 50, 50, 0.75);" src="picture/update.png" height="20" alt="Update" /></a></td>
            <td align="center"><a href="?tag=view_scores&opr=del&rs_id=<?php echo $row['ss_id'];?>"><img style="-webkit-box-shadow: 0px 0px 0px 0px rgba(50, 50, 50, 0.75);-moz-box-shadow:    0px 0px 0px 0px rgba(50, 50, 50, 0.75);box-shadow:         0px 0px 0px 0px rgba(50, 50, 50, 0.75);" src="picture/delete.jpg" height="20" alt="Delete" /></a></td>
        </tr>
        
    <?php
        }
        
    
    ?>
    </table>
</div>
</body>
</html>
