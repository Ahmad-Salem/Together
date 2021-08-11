<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
    <head>

        <!-- tab icon -->
        <link rel="apple-touch-icon" sizes="57x57" href="images/logo/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="images/logo/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="images/logo/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="images/logo/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="images/logo/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="images/logo/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="images/logo/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="images/logo/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="images/logo/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192"  href="images/logo/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="images/logo/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="images/logo/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="images/logo/favicon-16x16.png">
        <link rel="manifest" href="images/logo/manifest.json">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff">




        
        <meta charset="utf-8">
        <!--IE compatibility Meta -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- first mobile meta --> 
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Main Intro</title>

        <!-- Bootstrap -->
        <link href="css/bootstrap.css" rel="stylesheet"/>
        <!-- fontawsome  -->
        <link rel="stylesheet" href="css/font-awesome.min.css" />
        <!-- My Css style -->
        <link rel="stylesheet" href="css/style.css" />
        <link rel="stylesheet" href="css/media.css" />
        <!-- My color scheme -->
        <link rel="stylesheet" href="css/default_theme.css" />
        
        <!-- [if it ie 9] -->
            <script src="javascript/html5shiv.min.js"></script>
            <script src="javascript/respond.min.js"></script>
        <!-- [end if] -->
        
    </head>
    <body>
        <!--the start nav bar section -->
        <!-- Start The Nav bar -->
        <nav class="navbar navbar-inverse navbar-fixed-top">
          <!-- the start of the containner -->
            <div class="container">
            
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand pop" href="#">TOGETHER <span>INC</span></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              
                <ul class="nav navbar-nav navbar-right">
                    <li class="active"><a href="index.php">Home<span class="sr-only">(current)</span></a></li>
                    <li><a href="main_related_pages/search.php">Missed Children</a></li>
                    <li><a href="main_related_pages/about_us.php">About us</a></li>
                    <li><a href="main_related_pages/FQA.php">FAQ</a></li>
                </ul>
                
            </div><!-- /.navbar-collapse -->
          </div><!-- /end of the container -->
        </nav>
        <!-- End The Nav bar -->
        <!--the end  nav bar section -->
        
        <!-- the start of the Container section section-->
        <section class="ContainerSection">
            
                <div class="Main-Intro">
                    <div class="Main-Intro-Content">
                    
                        <div class="container">
                            <div class="Intro-TxT">
                                <h2><img src="images/logo/Capture.PNG" title="Together"/></h2>
                                <div class="col-md-3 col-sm-1 hidden-xs"></div>
                                <div class="login col-md-6 col-sm-10 col-xs-12">
                                    <!-- error message -->
                                    <?php echo @$_SESSION['Message_login'];?>
                                    <form action="login/login.php" method="POST" id="login_submit">
                                        <!-- Email-->
                                        <div class="input-group margin-bottom-sm Email">
                                            <span class="input-group-addon"><i class="fa fa-envelope-o fa-fw" aria-hidden="true"></i></span>
                                              <input class="form-control" type="text" placeholder="Email address" id="Email_login" name="login_email">
                                        </div>
                                        <!-- error message -->
                                        <div class="Error_login" id="Error_Email"><span>Error testing </span></div>
                                        <!-- password-->
                                        <div class="input-group margin-bottom-sm Password">
                                            <span class="input-group-addon"><i class="fa fa-key fa-fw" aria-hidden="true"></i></span>
                                              <input class="form-control" type="password" placeholder="Password" id="Pass_login" name="login_password">
                                        </div>
                                        <!-- error message -->
                                        <div class="Error_login" id="Error_Pass"><span>Error testing </span></div>

                                        <!-- check acount type -->
                                        <label class="pe">Person</label>
                                        <input type="radio" name="account_type" class="radio_p" value="person" checked/>
                                        <label>Foundation</label>    
                                        <input type="radio" name="account_type" class="radio_f" value="foundation"/>  
                                       
                                        <input type="submit" name="login_submit" value="Submit" 
                                               class="btn-block Submit-Btn"/>
                                        
                                        
                                    </form>
                                    <a href="" class="forget">Forget my password...</a><span>|</span>
                                    <a href="register.php" class="forget">Sign in</a>
                                </div>
                                <div class="col-md-3 col-sm-1 hidden-xs"></div>    
                            </div>
                        </div>
                    </div>        
                </div>                
            
        
        </section>
        <!-- the end of ContainerSection -->
        
        <!-- the start of footer section -->
        <section class="FooterSection">
            <div class="container">
                
                
            </div>
            
            <div class="copy_right text-center">
                Copyright &copy; 2017 TOGETHER <span>INC</span>
            </div>
        

        </section>
        <!-- the end of footer section -->
        <!-- start section loading -->
        <div class="loading-overlay">

                  <div class="sk-cube-grid">
                      <div class="sk-cube sk-cube1"></div>
                      <div class="sk-cube sk-cube2"></div>
                      <div class="sk-cube sk-cube3"></div>
                      <div class="sk-cube sk-cube4"></div>
                      <div class="sk-cube sk-cube5"></div>
                      <div class="sk-cube sk-cube6"></div>
                      <div class="sk-cube sk-cube7"></div>
                      <div class="sk-cube sk-cube8"></div>
                      <div class="sk-cube sk-cube9"></div>
                  </div>

        </div>
        <!-- end section loading -->

        <!-- start scroll Top -->
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="javascript/jquery-2.1.1.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="javascript/bootstrap.min.js"></script>
        <!-- My plugin js  -->
        <script src="javascript/index.js"></script>
        <script src="javascript/index_alignment.js"></script>
        <script src="javascript/index_intro.js"></script>
        <script src="javascript/validation_login.js"></script>
        <!-- nice scroll library -->
        <script src="javascript/jquery.nicescroll.min.js"></script>
    </body>




</html>
<?php 
$_SESSION=null;
$_COOKIE=null;

?>