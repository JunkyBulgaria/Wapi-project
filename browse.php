<?php 
session_start(); 
include("libs/mysql.php"); 
include("inc/config.php");

if(!isset($_SESSION['login_user']))
	header("location: login.php");

$db = new SQL;
$db->connect($host, $username, $password);
$db->query("use `wapi`;");

if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 
if($maxbooks > 8) $maxbooks = 8; // hardcode ako sluchaino nadvishi 8

$start_from = ($page-1) * $maxbooks; 
$allbooks = "select * from books limit $start_from, $maxbooks;";
$booksquery = $db->query($allbooks);
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
        <div class="container" style="height: auto; padding: -200px;">
            <!-- header -->
            <div class="form-content">
                <div class="row">
                    <div class="col-lg-11 col-centered">
                        <!-- left navbar -->
                        <div class="head-left">
                            <div class="col-sm-2" style="width: auto;"><img class="logo" src="img/Logo_wapi_favicon.png"></div>
                            <div class="col-sm-2" style="width: auto;">
                                <h3 style="left: -20px;position: relative;">Wapi Bulgaria<br>Library</h3>
                            </div>
                        </div>
                        <!-- right navbar -->
                        <div class="head-right">
                            <div class="col-sm-2" style="width: auto;top: 19px;right: 55px">
                                <a href="insert.php">
                                    <button class="button">
                                        New Book 
                                        <span class="glyphicon glyphicon-book" style="vertical-align:center; align:right;">
                                            <!-- glyphicon @todo -->
                                        </span>
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- content -->
                <div class="row" style="padding-top: 70px">
                    <div class="row" style="padding-left: 120px;">
                        <?php while($row = $db->fetch_assoc($booksquery)){ ?>
                        <div class="col-lg-3 col-md-4 col-xs-6" style="text-align: center;">
                            <a class="thumbnail" > <img class="img-responsive" src="<?php echo $row['cover']; ?>" alt=""> </a>
                            <?php echo $row['title']; ?><br>
                            <?php echo $row['author']; ?><br>
                            Pages: <?php echo $row['pages']; ?><br>
                            Format: <?php echo $row['format']; ?><br>
                            ISBN: <?php echo $row['isbn']; ?><br>
                            Publish Date: <?php echo $row['publishdate']; ?>
                        </div>
                        <?php } ?>
                    </div>
                    <div class="content-left" style="width: 350px;padding-top: 45px; padding-left:213px;"><a href="browse.php?page=<?php if($page <= 1) echo "1"; else echo $page-1; ?>"><button type="submit" class="button" style="margin-left: -125px;">Previous <span class="glyphicon glyphicon-book" style="vertical-align:center; align:left;"></span></button></a></div>
                    <div class="content-right" style="width: 350px;padding-top: 45px; padding-left:213px;"><a href="browse.php?page=<?php echo $page+1; ?>"> <button type="submit" class="button" style="margin-left: -84px;">Next <span class="glyphicon glyphicon-book" style="vertical-align:center; align:right;"></span></button></a></div>
                </div>
            </div>
        </div>
    </body>
</html>