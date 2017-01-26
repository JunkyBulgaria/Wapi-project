<?php
session_start(); 
include("libs/mysql.php"); 
include("inc/config.php");

if(isset($_SESSION['login_user']))
	header("location: browse.php");

if(isset($_POST["username"]) && isset($_POST["password"]))
{
$db = new SQL;
$db->connect($host, $username, $password);
$db->db($database);

$user = $_POST["username"];
$pass = $_POST["password"];
$hashed_pass = openssl_digest($pass, 'sha512');

// overwrite and escape string
if(isset($user)) $user = $db->quote_smart($user);
if(isset($pass)) $pass = $db->quote_smart($pass);

$query = $db->query("select * from users where name = '$user' and password = '$hashed_pass';");

if($db->num_rows($query) == 1)
{
	$_SESSION['login_user'] = $username;
	header("location: browse.php");
}
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php echo $title; ?></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="css/style.css">
    </head>

    <body>
        <div class="container" style="height: auto;"> 
                    <!-- header -->
                    <div class="form-content">
                        <div class="row">
                                <div class="col-lg-11 col-centered"> 
                                  <!-- left navbar -->
                                  <div class="head-left">
                                      <div class="col-sm-2" style="width: auto;"><img class="logo" src="img/Logo_wapi_favicon.png"></div>
                                      <div class="col-sm-2" style="width: auto;"><h3 style="left: -20px;position: relative;">Wapi Bulgaria<br>Library</h3></div>
                                  </div>
                                  <!-- right navbar -->
                                  <div class="head-right">
                                      <div class="col-sm-2" style="width: auto;top: 19px;right: 55px"><a href="insert.php"><button class="button"> New book <span class="glyphicon glyphicon-book" style="vertical-align:center; align:right;"><!-- glyphicon @todo --></span></button></a></div>
                                  </div>
                                </div>
                        </div>
                        
                    <!-- content -->
                        <div class="row" style="padding-top: 70px">
                                <div class="col-sm-5 col-centered"> 
                                  <!-- left navbar -->
                                   <div class="form-bottom">
                                        <form role="form" action="login.php" method="post" class="login-form">
                                            <div class="form-group">
                                                <input class="input-form" type="text" name="username" placeholder="Username">
                                            </div>
                                            <div class="form-group">
                                                <input class="input-form" type="password" name="password" placeholder="Password" class="form-password form-control" id="form-password">
                                            </div>
                                            <button type="submit" class="button" style="position: relative; left:150px; margin-top: 20px;">Login <span class="glyphicon glyphicon-book" style="vertical-align:center; align:right;"><!-- glyphicon @todo --></span></button>
                                        </form>
                                    </div>
                                </div>
                        </div>
                    </div>    
                    
        </div>
    </body>

</html>