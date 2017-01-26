<?php 
session_start(); 
include("libs/mysql.php"); 
include("inc/config.php");

if(!isset($_SESSION['login_user']))
	header("location: login.php");

$db = new SQL;
$db->connect($host, $username, $password);
$db->db($database); // select db


if(isset($_FILES["fileToUpload"]))
{
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$eligible = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	
	/* ---------------------------- */
	/* get variables from post form */
	/* ---------------------------- */
	$book_title = $_POST["title"];
	$book_author = $_POST["author"];
	$book_publishdate = $_POST["publishdate"];
	$book_format = $_POST["format"];
	$page_count = $_POST["pagecount"];
	$isbn = $_POST["isbn"];
	$resume = $_POST["resume"];
	/* ---------------------------- */
	
	/* -------------------------------------------------------------- */
	/* mysql escape characters to prevent xss and overwrite variables */
	/* -------------------------------------------------------------- */
	if(isset($book_title)) $book_title = $db->quote_smart($book_title); else { $eligible = 0;  $err = "1"; }
	if(isset($book_author)) $book_author = $db->quote_smart($book_author); else  { $eligible = 0;  $err = "2"; }
	if(isset($book_publishdate)) $book_publishdate = $db->quote_smart($book_publishdate); else  { $eligible = 0;  $err = "3"; }
	if(isset($book_format)) $book_format = $db->quote_smart($book_format); else  { $eligible = 0;  $err = "4"; }
	if(isset($page_count) && is_numeric($page_count)) $page_count = $db->quote_smart($page_count); else  { $eligible = 0; $err = "5"; }
	if(isset($isbn) && is_numeric($isbn)) $isbn = $db->quote_smart($isbn); else  { $eligible = 0;  $err = "6"; }
	if(isset($resume)) $resume = $db->quote_smart($resume); else  { $eligible = 0;  $err = "7"; }
	/* -------------------------------------------------------------- */
	
	$book_publishdate = date('Y-m-d', strtotime(str_replace('-', '/', $book_publishdate)));	// convert publishdate to fit mysql
	
	$bookcover = $target_file;
	$hashed_cover = md5($bookcover.$book_title); // directory/filename.extension + post title
	$image = $target_dir.$hashed_cover.".".$imageFileType; // used to generate the new image location

	if(isset($_POST["submit"])) {
		$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		if($check !== false) {
			$eligible = 1;
		} else {
			$notification = '<div class="alert alert-danger"><center>File is not an image.</center></div>';
			$eligible = 0;
		}
	}

	if (file_exists($image)) {
		$notification = '<div class="alert alert-danger"><center>This bookcover is already used, please try with different name.</center></div>';
		$eligible = 0;
	}

	if ($_FILES["fileToUpload"]["size"] > $filesize) {
		$notification = '<div class="alert alert-danger"><center>Sorry, your file is too large.</center></div>';
		$eligible = 0;
	}

	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
		$notification = '<div class="alert alert-danger"><center>Sorry, only JPG, JPEG, PNG & GIF files are allowed for the book cover.</center></div>';
		$eligible = 0;
	}

	if ($eligible == 0) {
		$notification = '<div class="alert alert-danger"><center>Sorry, your book was not uploaded, there was an error with your data, please try again.</center></div>'; // '. $err .'

	} else {
		if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
			rename($target_file, $target_dir.$hashed_cover.".".$imageFileType);

			$db->query("INSERT INTO `books` (`title`, `author`, `pages`, `format`, `isbn`, `publishdate`, `cover`) VALUES ('$book_title', '$book_author', '$page_count', '$book_format', '$isbn', '$book_publishdate', '$image');");
			$notification='<div class="alert alert-success"><center>Thank You! Your book has been uploaded!</center></div>';
			
		} else {
			$notification = '<div class="alert alert-danger"><center>Sorry, there was an error uploading your book.</center></div>';
		}
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
		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
		<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <link rel="stylesheet" href="css/style.css">
		<script>
			$( function() {
				$( "#datepicker" ).datepicker();
			} );
		</script>
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
                                      <div class="col-sm-2" style="width: auto;top: 19px;right: 55px"><a href="browse.php"> <button class="button">All books <span class="glyphicon glyphicon-book" style="vertical-align:center; align:right;"><!-- glyphicon @todo --></span></button></a></div>
                                  </div>
                                </div>
                        </div>
                        
                    <!-- content -->
                        <div class="row" style="padding-top: 70px">
                                <div class="col-sm-5" style="width: 1047px;"> 
								<?php if(isset($notification)) echo $notification; ?>
                                        <form role="form" action="insert.php" method="post" enctype="multipart/form-data" style="padding-left: 66px;">
                                            <!-- top left content -->
                                            <div class="content-left" style="width: 350px;">
                                                <input class="input-form" type="text" name="title" placeholder="Book Title"></input>
                                                <input class="input-form" type="text" name="author" placeholder="Author" style="margin-top: 10px;"></input>
                                            </div>
                                            <!-- top right content -->
                                            <div class="content-right" style="width: 350px;">
                                                <input class="input-form" type="text" name="publishdate" placeholder="Publish Date" id="datepicker"></input>
                                                <input class="input-form" type="text" name="format" placeholder="Format" style="margin-top: 10px;"></input>
                                            </div>
											<!-- bottom left content -->
                                            <div class="content-left" style="width: 350px;padding-top: 45px;">
                                                <input class="input-form" type="text" name="pagecount" placeholder="Page Count"></input>
                                                <input class="input-form" type="text" name="isbn" placeholder="ISBN" style="margin-top: 10px;"></input>
                                            </div>
											<!-- bottom right content -->
                                            <div class="content-right" style="width: 350px;padding-top: 45px;">
                                                <textarea class="input-form" style="resize:none; width:350px; height:78px;" placeholder="Resume" name="resume"></textarea>
                                            </div>
											<!-- upload form -->
                                            <div class="content-left" style="width: 350px;padding-top: 45px;">
												<input class="upload-form" type="file" name="fileToUpload" id="fileToUpload"><?php echo $filesize / 1000000 ?> mb max, JPG, JPEG, PNG & GIF only!
                                            </div>
											<!-- submit button -->
											<div class="content-right" style="width: 350px;padding-top: 45px; padding-left:213px;">
												<button type="submit" class="button">Submit <span class="glyphicon glyphicon-book" style="vertical-align:center; align:right;"></span></button>
											</div>
                                        </form>

                                </div>
                        </div>
                    </div>    
                    
        </div>
    </body>

</html>