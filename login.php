<?php
require_once'php/core/init.php';
$user = new User(); $pageError = null; $errorMessage = null;$count=0;
$override = new OverideData();
if($user->isLoggedIn()){ Redirect::to('index.php');}else {
    if (!$_GET['page'] == null) {
        if ($_GET['page'] == 'tamongsco') {
            $redirect = 'tamongsco_member.php';
            $pageName = 'Tamongsco Members';
        } elseif ($_GET['page'] == 'teachers') {
            $redirect = 'teacher.php?s=';
            $pageName = 'Teachers';
        } elseif ($_GET['page'] == 'parents') {
            $redirect = 'parent.php';
            $pageName = 'Parents';
        } elseif($_GET['page'] == 'org_member'){
            $redirect = 'adv_admin.php';
            $pageName = 'Organisation';
        }
        $table = $_GET['page'];$count = Input::get('count');
        if($count == 5){$userInfo = $override->get($_GET['page'],'phone_number',Input::get('username'));
        $username = $userInfo[0]['firstname'].' '.$userInfo[0]['middlename'].' '.$userInfo[0]['lastname'];
            if($userInfo[0]['email_address']){$override->emailNotification($userInfo[0]['email_address'],$username);}
        }
        if (Input::exists()) {
            if (Token::check(Input::get('token'))) {
                $validate = new validate();
                $validate = $validate->check($_POST, array(
                    'username' => array('required' => true),
                    'password' => array('required' => true)
                ));
                if ($validate->passed()) {
                    $login = $user->loginUser(Input::get('username'), Input::get('password'), $table);
                   // print_r($login);
                    if ($login) {
                        Redirect::to($redirect);
                    } else {
                        $errorMessage = 'Wrong username or password';
                         $count++;
                    }
                } else {
                    $pageError = $validate->errors();
                }
            }
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <!-- Basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Info-Elimu | Login</title>

    <meta name="keywords" content="infoelimu" />
    <meta name="description" content="infoelimu website">
    <meta name="author" content="infoelimu.ac.tz">

    <!-- Favicon -->
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
    <link rel="apple-touch-icon" href="img/apple-touch-icon.png">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <!-- Web Fonts  -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800%7CShadows+Into+Light" rel="stylesheet" type="text/css">

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendor/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="vendor/simple-line-icons/css/simple-line-icons.min.css">
    <link rel="stylesheet" href="vendor/owl.carousel/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="vendor/owl.carousel/assets/owl.theme.default.min.css">
    <link rel="stylesheet" href="vendor/magnific-popup/magnific-popup.min.css">

    <!-- Theme CSS -->
    <link rel="stylesheet" href="css/theme.css">
    <link rel="stylesheet" href="css/theme-elements.css">
    <link rel="stylesheet" href="css/theme-blog.css">
    <link rel="stylesheet" href="css/theme-shop.css">
    <link rel="stylesheet" href="css/theme-animate.css">

    <!-- Current Page CSS -->
    <link rel="stylesheet" href="vendor/rs-plugin/css/settings.css">
    <link rel="stylesheet" href="vendor/rs-plugin/css/layers.css">
    <link rel="stylesheet" href="vendor/rs-plugin/css/navigation.css">

    <!-- Skin CSS -->
    <link rel="stylesheet" href="css/skins/default.css">		<script src="master/style-switcher/style.switcher.localstorage.js"></script>

    <!-- Theme Custom CSS -->
    <link rel="stylesheet" href="css/custom.css">

    <!-- Head Libs -->
    <script src="vendor/modernizr/modernizr.min.js"></script>

</head>
<body>

<div class="body">
<header id="header" data-plugin-options='{"stickyEnabled": true, "stickyEnableOnBoxed": true, "stickyEnableOnMobile": true, "stickyStartAt": 57, "stickySetTop": "-57px", "stickyChangeLogo": true}'>
    <div class="header-body">
        <div class="header-container container">
            <div class="header-row">
                <div class="header-column">
                    <div class="header-logo">
                        <a href="index.php">
                            <img alt="InfoElimu" width="121" height="64" data-sticky-width="102" data-sticky-height="60" data-sticky-top="33" src="img/infoelimuLogo.png">
                        </a>
                    </div>
                </div>
                <div class="header-column">
                    <div class="header-row">
                        <div class="header-search hidden-xs">
                            <form id="searchForm" action="search.php" method="get">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="srch" id="n" placeholder="Search..." required>
                                    <span class="input-group-btn">
                                        <input type="hidden" name="num" value="1">
                                        <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
                                    </span>
                                </div>
                            </form>
                        </div>

                    </div>
                    <div class="header-row">
                        <div class="header-nav">
                            <button class="btn header-btn-collapse-nav" data-toggle="collapse" data-target=".header-nav-main">
                                <i class="fa fa-bars"></i>
                            </button>
                            <ul class="header-social-icons social-icons hidden-xs">
                                <li class="social-icons-facebook"><a href="#" target="_blank" title="Facebook"><i class="fa fa-facebook"></i></a></li>
                                <li class="social-icons-twitter"><a href="#" target="_blank" title="Twitter"><i class="fa fa-twitter"></i></a></li>
                                <li class="social-icons-linkedin"><a href="#" target="_blank" title="Linkedin"><i class="fa fa-linkedin"></i></a></li>
                            </ul>
                            <div class="header-nav-main header-nav-main-effect-1 header-nav-main-sub-effect-1 collapse">
                                <nav>
                                    <ul class="nav nav-pills" id="mainNav">
                                        <li class="dropdown">
                                            <a href="index.php">Home</a></li>
                                        <li class="dropdown dropdown-mega">
                                            <a class="dropdown-toggle" href="#">Schools & Colleges</a>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <div class="dropdown-mega-content">
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <!------ 1st column ---------------->
                                                                <ul class="dropdown-mega-sub-nav">
                                                                    <li><a href="regions.php?id=3&page=1&tab=pr&dis=1">Arusha</a></li>
                                                                    <li><a href="regions.php?id=1&page=1&tab=pr&dis=1">Dar es salaam</a></li>
                                                                    <li><a href="regions.php?id=6&page=1&tab=pr&dis=1">Dodoma</a></li>
                                                                    <li><a href="regions.php?id=7&page=1&tab=pr&dis=1">Geita</a></li>
                                                                    <li><a href="regions.php?id=8&page=1&tab=pr&dis=1">Iringa</a></li>
                                                                    <li><a href="regions.php?id=9&page=1&tab=pr&dis=1">Kagera</a></li>
                                                                    <li><a href="regions.php?id=29&page=1&tab=pr&dis=1">Kaskazini Pemba</a></li>
                                                                    <li><a href="regions.php?id=30&page=1&tab=pr&dis=1">Kaskazini Unguja</a></li>
                                                                </ul>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <!------ 2nd column ---------------->
                                                                <ul class="dropdown-mega-sub-nav">
                                                                    <li><a href="regions.php?id=10&page=1&tab=pr&dis=1">Katavi</a></li>
                                                                    <li><a href="regions.php?id=11&page=1&tab=pr&dis=1">Kigoma</a></li>
                                                                    <li><a href="regions.php?id=2&page=1&tab=pr&dis=1">Kilimanjaro</a></li>
                                                                    <li><a href="regions.php?id=27&page=1&tab=pr&dis=1">Kusini Pemba</a></li>
                                                                    <li><a href="regions.php?id=28&page=1&tab=pr&dis=1">Kusini Unguja</a></li>
                                                                    <li><a href="regions.php?id=12&page=1&tab=pr&dis=1">Lindi</a></li>
                                                                    <li><a href="regions.php?id=4&page=1&tab=pr&dis=1">Manyara</a></li>
                                                                    <li><a href="regions.php?id=13&page=1&tab=pr&dis=1">Mara</a></li>
                                                                </ul>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <!------ 3rd column ---------------->
                                                                <ul class="dropdown-mega-sub-nav">
                                                                    <li><a href="regions.php?id=14&page=1&tab=pr&dis=1">Mbeya</a></li>
                                                                    <li><a href="regions.php?id=26&page=1&tab=pr&dis=1">Mjini Magharibi</a></li>
                                                                    <li><a href="regions.php?id=15&page=1&tab=pr&dis=1">Morogoro</a></li>
                                                                    <li><a href="regions.php?id=16&page=1&tab=pr&dis=1">Mtwara</a></li>
                                                                    <li><a href="regions.php?id=17&page=1&tab=pr&dis=1">Mwanza</a></li>
                                                                    <li><a href="regions.php?id=18&page=1&tab=pr&dis=1">Njombe</a></li>
                                                                    <li><a href="regions.php?id=19&page=1&tab=pr&dis=1">Pwani</a></li>
                                                                    <li><a href="regions.php?id=20&page=1&tab=pr&dis=1">Rukwa</a></li>
                                                                </ul>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <!------ 4th column ---------------->
                                                                <ul class="dropdown-mega-sub-nav">
                                                                    <li><a href="regions.php?id=21&page=1&tab=pr&dis=1">Ruvuma</a></li>
                                                                    <li><a href="regions.php?id=22&page=1&tab=pr&dis=1">Shinyanga</a></li>
                                                                    <li><a href="regions.php?id=23&page=1&tab=pr&dis=1">Simiyu</a></li>
                                                                    <li><a href="regions.php?id=24&page=1&tab=pr&dis=1">Singida</a></li>
                                                                    <li><a href="regions.php?id=25&page=1&tab=pr&dis=1">Tabora</a></li>
                                                                    <li><a href="regions.php?id=5&page=1&tab=pr&dis=1">Tanga</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="dropdown">
                                            <a class="dropdown-toggle" href="#">
                                                Organisations
                                            </a>

                                        </li>
                                        <li><a  href="about.php">About Us</a></li>
                                        <li><a  href="contact.php">Contact Us</a></li>
                                        <?php if($user->isLoggedIn()){
                                            switch($user->getSessionTable()){
                                                case 'teachers':
                                                    $myAccount ='teacher.php';
                                                    break;
                                                case 'parents':
                                                    $myAccount = 'parent.php';
                                                    break;
                                                case 'tamongsco':
                                                    $myAccount = 'tamongsco_member.php';
                                                    break;
                                                case 'org_member':
                                                    $myAccount = 'adv_admin.php';
                                                    break;
                                            }
                                            ?>
                                            <li class="dropdown mega-menu-item mega-menu-signin signin logged" id="headerAccount">
                                                <a class="dropdown-toggle" href="">
                                                    <i class="fa fa-user"> <?=$user->data()->firstname.' '.$user->data()->lastname?></i>
                                                </a>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <div class="">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <ul class="list list-icons list-icons-style-2">
                                                                        <li><i class="fa fa-user"></i>
                                                                            <a href="<?=$myAccount?>">My Account</a>
                                                                        </li>
                                                                        <li><i class="fa fa-user-times"></i>
                                                                            <a href="logout.php">Log Out</a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </li>
                                        <?php } else { ?>
                                            <li class="dropdown">
                                                <a class="dropdown-toggle" href="#">LOGIN</a>
                                                <ul class="dropdown-menu">
                                                    <li><a href="login.php?page=tamongsco&no=1&note=">TAMONGSCO</a></li>
                                                    <li><a href="login.php?page=teachers">TEACHERS</a></li>
                                                    <li><a href="login.php?page=parents">PARENTS</a></li>
                                                    <li><a href="login.php?page=org_member">ORG</a></li>
                                                </ul>
                                            </li>
                                        <?php }?>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
    <div role="main" class="main">
        <div class="container">

            <div class="row">
                <div class="col-md-12">

                    <div class="featured-boxes">
                        <div class="row">
                            <h2><strong><?=$pageName?> Login</strong></h2>
                            <div class="col-sm-6">
                                <div class="featured-box featured-box-primary align-left mt-xlg">
                                    <div class="box-content">
                                        <h4 class="heading-primary text-uppercase mb-md"></h4>
                                        <form action="" data-toggle="validator"  method="post">
                                            <div class="row">
                                                    <div class="col-md-12">
                                                <?php echo '<label style="color: #ff0000"><strong>'.$errorMessage.'</strong></label>';
                                                if(!$pageError == null){foreach($pageError as $error){
                                                    echo '<label style="color: #ff0000"><strong>'.$error.'</strong></label>'.' , ';
                                                } echo '<br>';}?>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <label>Username or E-mail Address</label>
                                                        <input type="text" name="username" class="form-control input-lg"  required>
                                                        <div class="help-block with-errors"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <a class="pull-right" href="#">(Lost Password?)</a>
                                                        <label>Password</label>
                                                        <input type="password" name="password" class="form-control input-lg"  required>
                                                        <div class="help-block with-errors"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
															<span class="remember-box checkbox">
																<label for="rememberme">
                                                                    <input type="checkbox" id="rememberme" name="rememberme">Remember Me
                                                                </label>
															</span>
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="hidden" name="count" value="<?=$count?>">
                                                    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                                                    <input type="submit" value="Login" class="btn btn-primary pull-right mb-xl" data-loading-text="Loading...">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>

    <?php include 'footer.php'?>
</div>

<!-- Vendor -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/jquery.appear/jquery.appear.min.js"></script>
<script src="vendor/jquery.easing/jquery.easing.min.js"></script>
<script src="vendor/jquery-cookie/jquery-cookie.min.js"></script>
<script src="master/style-switcher/style.switcher.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="vendor/common/common.min.js"></script>
<script src="vendor/jquery/validator.min.js"></script>
<script src="vendor/jquery.validation/jquery.validation.min.js"></script>
<script src="vendor/jquery.stellar/jquery.stellar.min.js"></script>
<script src="vendor/jquery.easy-pie-chart/jquery.easy-pie-chart.min.js"></script>
<script src="vendor/jquery.gmap/jquery.gmap.min.js"></script>
<script src="vendor/jquery.lazyload/jquery.lazyload.min.js"></script>
<script src="vendor/isotope/jquery.isotope.min.js"></script>
<script src="vendor/owl.carousel/owl.carousel.min.js"></script>
<script src="vendor/magnific-popup/jquery.magnific-popup.min.js"></script>
<script src="vendor/vide/vide.min.js"></script>

<!-- Theme Base, Components and Settings -->
<script src="js/theme.js"></script>

<!-- Current Page Vendor and Views -->
<script src="vendor/rs-plugin/js/jquery.themepunch.tools.min.js"></script>		<script src="vendor/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>

<!-- Theme Custom -->
<script src="js/custom.js"></script>

<!-- Theme Initialization Files -->
<script src="js/theme.init.js"></script>

<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','../../../www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-42715764-5', 'auto');
    ga('send', 'pageview');
</script>
<script src="master/analytics/analytics.js"></script>

</body>
</html>
