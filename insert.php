<!DOCTYPE html>
<html lang="en">
    <head>
        <title>x</title>
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
                                      <div class="col-sm-2" style="width: auto;top: 19px;right: 55px"><button class="button"> All books <span class="glyphicon glyphicon-book" style="vertical-align:center; align:right;"><!-- glyphicon @todo --></span></button></div>
                                      <div class="col-sm-2" style="width: auto;top: 19px;right: 55px"><a href="login.php"><button class="button"> Login <span class="glyphicon glyphicon-book" style="vertical-align:center; align:right;"><!-- glyphicon @todo --></span></button></a></div>
                                  </div>
                                </div>
                        </div>
                        
                    <!-- content -->
                        <div class="row" style="padding-top: 70px">
                                <div class="col-sm-5" style="width: 1047px;"> 
                                        <form role="form" action="" method="post" style="padding-left: 66px;">
                                            <!-- top left content -->
                                            <div class="content-left" style="width: 350px;">
                                                <input class="input-form" type="text" name="xxxx" placeholder="Book Title"></input>
                                                <input class="input-form" type="text" name="xxxx" placeholder="Author" style="margin-top: 10px;"></input>
                                            </div>
                                            <!-- top right content -->
                                            <div class="content-right" style="width: 350px;">
                                                <input class="input-form" type="text" name="xxxx" placeholder="Book Title"></input>
                                                <input class="input-form" type="text" name="xxxx" placeholder="Author" style="margin-top: 10px;"></input>
                                            </div>
											<!-- bottom left content -->
                                            <div class="content-left" style="width: 350px;padding-top: 45px;">
                                                <input class="input-form" type="text" name="xxxx" placeholder="Page Count"></input>
                                                <input class="input-form" type="text" name="xxxx" placeholder="ISBN" style="margin-top: 10px;"></input>
                                            </div>
											<!-- bottom right content -->
                                            <div class="content-right" style="width: 350px;padding-top: 45px;">
                                                <textarea class="input-form" style="resize:none; width:350px; height:78px;" placeholder="Resume" name="xxxx"></textarea>
                                            </div>
											<!-- upload form -->
                                            <div class="content-left" style="width: 350px;padding-top: 45px;">
												<input class="upload-form" type="file" name="fileToUpload" id="fileToUpload">
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