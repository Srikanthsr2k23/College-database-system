<?php
    session_start();

    require("conection/connect.php");

    $msg = "";

    if (isset($_POST['btn_log'])) {
        $uname = $_POST['unametxt'];
        $pwd = $_POST['pwdtxt'];

        // Using mysqli and prepared statements to prevent SQL injection
        $stmt = mysqli_prepare($con, "SELECT * FROM users_tbl WHERE username=? AND password=?");
        mysqli_stmt_bind_param($stmt, "ss", $uname, $pwd);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        $count = mysqli_num_rows($result);

        if ($count > 0) {
            $row = mysqli_fetch_array($result);

            if ($row['type'] == 'admin') {
                $msg = "Login successful!...";
            } else {
                header("location: everyone.php");
            }
        } else {
            $msg = "Invalid login authentication, try again!";
        }

        mysqli_close($conn);
    }
?>

<!-- Your HTML code remains unchanged -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css"/>
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css.map"/>
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css"/>
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-theme.css"/>
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-theme.css.map"/>
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-theme.min.css"/>
<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/login1.css" />
<link rel="stylesheet" href="dropdown.css">
<title>Login</title>
<style>
#i
{
  background-image: url(https://th.bing.com/th/id/OIP.p03c3PklHBJTdYX6XHxDrgHaFk?w=236&h=180&c=7&r=0&o=5&dpr=1.3&pid=1.7);
}
body
{
   background-image: url();
}
</style>
</head>

<body>
<div  id="i" style="background-color: rgb(216, 216, 216);">
  <img src="https://media-exp1.licdn.com/dms/image/C510BAQGsvdtQ7CXc2A/company-logo_200_200/0/1578915255325?e=2159024400&v=beta&t=bRGiH-1mJvi_Fjob189WvSBP0YRfcGK0-HsCWWjoIoc" style="margin-left:50px; margin-top: 50px">
  <h1 style=" color: rgb(255, 255, 255); margin-left: 400px; margin-top:-50px; font-size: 50px;">
   <b> JYOTHY INSTITUTE OF TECHNOLOGY</b>
  </h1>
  <a href="#" target=blank style="font-size:20px; margin-left:500px; text-decoration:none">.</a>
</div>

    	<div class="container" style="margin-top:100px; margin-right: 50%">
    		<div class="h1_pos">
    			<h1  style="text-align: center; font-weight: 900">Only staff members. </h1>
    		</div><br><br><br>
    		<form method="post">
                    <input type="text" class="form-control" name="unametxt" placeholder="Username" title="Enter username here" /><br>
                    <input type="password" class="form-control" name="pwdtxt" placeholder="Password" title="Enter username here" /><br>
    		<input type="submit" href="#" class="btn btn-default" name="btn_log" value="Sign in" style="float: right;"/>
    		
    		</form>
        </div>
	
        <h2 style="color: #3a28a5; text-align: center;">
            <?php echo $msg; ?>
        </h2>  
        </body>
</html>