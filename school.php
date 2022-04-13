<?php
require_once'php/core/init.php';
$user = new User();
$override = new OverideData();$school = null;$headmaster=null;$secMaster=null;$academic=null;$displine=null;$dir=null;
if($_GET['id']){ $school = $override->get('schools','id',$_GET['id']);
  $region = $override->get('region','id',$school[0]['region_id']);
    $district = $override->get('district','id',$school[0]['district_id']);
    $teachers = $override->get('teachers','school_id',$_GET['id']);
    foreach($teachers as $teacher){
        switch($teacher['position']){
            case 'Headmaster':
                $headmaster=$teacher['attachment'];
                break;
            case 'SecondMaster':
                $secMaster=$teacher['attachment'];
                break;
            case 'Academic':
                $academic=$teacher['attachment'];
                break;
            case 'Discipline':
                $displine=$teacher['attachment'];
                break;
            case 'Director':
                $dir=$teacher['attachment'];
                break;
        }
    }
}else{Redirect::to('index');}
?>
<!DOCTYPE html>
<html data-style-switcher-options="{'changeLogo': false, 'borderRadius': 0, 'colorPrimary': '#F45C57', 'colorSecondary': '#cd3530', 'colorTertiary': '#2082C1', 'colorQuaternary': '#343434'}">
<head>
    <!-- Basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Info-Elimu | <?=$school[0]['name'].' '.$school[0]['category']?> </title>

    <meta name="keywords" content="Infoelimu" />
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
    <link rel="stylesheet" href="css/skins/skin-corporate-hosting.css">
    <script src="master/style-switcher/style.switcher.localstorage.js"></script>

    <!-- Theme Custom CSS -->
    <link rel="stylesheet" href="css/custom.css">

    <!-- Head Libs -->
    <script src="vendor/modernizr/modernizr.min.js"></script>

</head>
<body data-spy="scroll" data-target="#navSecondary" data-offset="170">

<div class="body">
<?php include 'header.php'?>
<div role="main" class="main">
<div class="slider-container rev_slider_wrapper" style="height: 550px;">
    <div id="revolutionSlider" class="slider rev_slider" data-plugin-revolution-slider data-plugin-options='{"delay": 9000, "gridwidth": 1170, "gridheight": 550}'>
        <ul>
            <li data-transition="fade">
                <img src="<?=$school[0]['attachment']?>"
                     alt=""
                     data-bgposition="center center"
                     data-bgfit="cover"
                     data-bgrepeat="no-repeat"
                     data-kenburns="on"
                     data-duration="25000"
                     data-ease="Linear.easeNone"
                     data-scalestart="100"
                     data-scaleend="100"
                     data-rotatestart="0"
                     data-rotateend="0"
                     data-offsetstart="0 -350"
                     data-offsetend="0 350"
                     data-bgparallax="0"
                     class="rev-slidebg">

                <div class="tp-caption"
                     data-x="center" data-hoffset="-150"
                     data-y="center" data-voffset="-55"
                     data-start="1000"
                     style="z-index: 5"
                     data-transform_in="x:[-300%];opacity:0;s:500;"><img src="img/slides/slide-title-border.png" alt=""></div>

                <div class="tp-caption top-label"
                     data-x="center" data-hoffset="0"
                     data-y="center" data-voffset="-55"
                     data-start="500"
                     style="z-index: 5"
                     data-transform_in="y:[-300%];opacity:0;s:500;">WELCOME TO </div>

                <div class="tp-caption"
                     data-x="center" data-hoffset="150"
                     data-y="center" data-voffset="-55"
                     data-start="1000"
                     style="z-index: 5"
                     data-transform_in="x:[300%];opacity:0;s:500;"><img src="img/slides/slide-title-border.png" alt=""></div>

                <div class="tp-caption main-label"
                     data-x="center" data-hoffset="0"
                     data-y="center" data-voffset="-5"
                     data-start="1500"
                     data-whitespace="nowrap"
                     data-transform_in="y:[100%];s:500;"
                     data-transform_out="opacity:0;s:500;"
                     style="z-index: 5"
                     data-mask_in="x:0px;y:0px;"><?=$school[0]['name']?></div>

                <div class="tp-caption main-label"
                     data-x="center" data-hoffset="0"
                     data-y="center" data-voffset="50"
                     data-start="2000"
                     style="z-index: 5"
                     data-transform_in="y:[100%];opacity:0;s:500;"><?=$school[0]['category']?></div>
            </li>
        </ul>
    </div>
</div>

<aside class="nav-secondary" id="navSecondary" data-plugin-sticky data-plugin-options='{"minWidth": 991, "padding": {"top": 84}}'>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-pills nav-pills-tertiary">
                    <li><a data-hash data-hash-offset="165" href="#news">News & Announcements</a></li>
                    <li><a data-hash data-hash-offset="165" href="#history">Short History</a></li>
                    <li><a data-hash data-hash-offset="165" href="#admnistration">Administration</a></li>
                    <li><a data-hash data-hash-offset="165" href="#contactLocation">Contacts & Location</a></li>
                </ul>
            </div>
        </div>
    </div>
</aside>

<section class="section section-no-background section-no-border mt-none" id="news">
    <div class="container">
        <div class="col-md-offset-4 col-md-8 ">
        <h1>News and Announcement</h1>
        </div>
        <div class="row mt-xl">
            <?php if($override->getNews('school_notification','school_id',$_GET['id'],'general_news',1)){
                foreach($override->getNewsOrderBy('school_notification','school_id',$_GET['id'],'general_news',1) as $schoolNews){?>
                <div class="col-md-4">
                    <div class="feature-box feature-box-tertiary feature-box-style-3">
                        <div class="feature-box-icon">
                            <i class="fa fa-envelope"></i>
                        </div>
                        <div class="feature-box-info">
                            <h4 class="mb-sm"><a href="<?=$schoolNews['attachment']?>" target="_blank"><?=$schoolNews['title']?></a></h4>
                            <p class="mb-lg"><i>Posted on : </i><?=$schoolNews['postTime']?></p>
                        </div>
                    </div>
                </div>

            <?php }}else{ ?>
                <div class="col-md-offset-0"><h4><p ALIGN="CENTER">No News and Announcement at the Moment. </p></h4></div>
            <?php } ?>
        </div>
    </div>
</section>
<!------------------------------------------------------------------------------------------------------------------------------------------------------->

<div class="row center mt-xl">
    <div class="owl-carousel owl-theme" data-plugin-options='{"items": 6, "autoplay": true, "autoplayTimeout": 6000}'>
        <div>
            <img class="img-responsive" src="img/logos/tangazo4.jpg" alt="">
        </div>
        <div>
            <img class="img-responsive" src="img/logos/tangazo5.jpg" alt="">
        </div>
        <div>
            <img class="img-responsive" src="img/logos/tangazo6.jpg" alt="">
        </div>
    </div>
</div>
<section class="section section-no-border mt-none" id="history">
    <div class="container">
        <div class="row">
            <div class="col-md-12 center">
                <h2 class="heading-dark mt-xl mb-none"> <strong>About School</strong></h2>
                <p class="mb-xl"><?=$school[0]['about']?></p>
            </div>
        </div>
        <div class="row">
            <div class="pricing-table mt-xl">
               <!-- <img class="pull-left" src="img/team/blank.jpg" width="200" height="140" data-appear-animation="bounceIn" alt="">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur pellentesque neque eget diam posuere porta. Quisque ut nulla at nunc <a href="#">vehicula</a> lacinia. Proin adipiscing porta tellus, ut feugiat nibh adipiscing sit amet. In eu justo a felis faucibus ornare vel id metus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; In eu libero ligula. Fusce eget metus lorem, ac viverra leo. Nullam convallis, arcu vel pellentesque sodales, nisi est varius diam, ac ultrices sem ante quis sem. Proin ultricies volutpat sapien, nec scelerisque ligula mollis lobortis.</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur pellentesque neque eget diam posuere porta. Quisque ut nulla at nunc <a href="#">vehicula</a> lacinia. Proin adipiscing porta tellus, ut feugiat nibh adipiscing sit amet. In eu justo a felis faucibus ornare vel id metus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; In eu libero ligula. Fusce eget metus lorem, ac viverra leo. Nullam convallis, arcu vel pellentesque sodales, nisi est varius diam, ac ultrices sem ante quis sem. Proin ultricies volutpat sapien, nec scelerisque ligula mollis lobortis. Nullam convallis, arcu vel pellentesque sodales, nisi est varius diam, ac ultrices sem ante quis sem. Proin ultricies volutpat sapien, nec scelerisque ligula mollis lobortis.</p>
                <hr>-->
            </div>

        </div>
    </div>
</section>
<section class="section section-no-background section-no-border mt-none mb-none" id="admnistration">
    <div class="container">
        <div class="row">
            <div class="col-md-12 center">
                <h2 class="heading-dark mb-none"> <strong>Administration</strong></h2>
                <p class="mb-xl"></p>
            </div>
        </div>
        <div class="container">
            <div class="row mt-lg">
                <div class="col-md-offset-2 col-md-2 col-xs-6 center mb-lg">
                    <?php if($dir){?>
                        <img src="<?=$dir?>" class="img-responsive" alt="">
                    <?php }else{ ?>
                        <img src="img/team/blank.jpg" class="img-responsive" alt="">
                    <?php }?>
                    <h5 class="mt-sm mb-none"></h5>
                    <p class="mb-none">Director</p>
                </div>
                <div class="col-md-2 col-xs-6 center mb-lg">
                    <?php if($headmaster){?>
                        <img src="<?=$headmaster?>" class="img-responsive" alt="">
                    <?php }else{ ?>
                        <img src="img/team/blank.jpg" class="img-responsive" alt="">
                    <?php }?>
                    <h5 class="mt-sm mb-none"></h5>
                    <p class="mb-none">Head Teacher</p>
                </div>
                <div class="col-md-2 col-xs-6 center mb-lg">
                    <?php if($secMaster){?>
                        <img src="<?=$secMaster?>" class="img-responsive" alt="">
                    <?php }else{ ?>
                        <img src="img/team/blank.jpg" class="img-responsive" alt="">
                    <?php }?>
                    <h5 class="mt-sm mb-none"></h5>
                    <p class="mb-none">Assistant Head Teacher</p>
                </div>
                <div class="col-md-2 col-xs-6 center mb-lg col-md-offset-0">
                    <?php if($academic){?>
                        <img src="<?=$academic?>" class="img-responsive" alt="">
                    <?php }else{ ?>
                        <img src="img/team/blank.jpg" class="img-responsive" alt="">
                    <?php }?>
                    <h5 class="mt-sm mb-none"></h5>
                    <p class="mb-none">Academic</p>
                </div>
            </div>
        </div>

    </div>
</section>
<div class="row center mt-xl">
    <div class="owl-carousel owl-theme" data-plugin-options='{"items": 6, "autoplay": true, "autoplayTimeout": 6000}'>
        <div>
            <img class="img-responsive" src="img/logos/tangazo%203.jpg" alt="">
        </div>
        <div>
            <img class="img-responsive" src="img/logos/tangazo111.jpg" alt="">
        </div>
        <div>
            <img class="img-responsive" src="img/logos/tangazo7.jpg" alt="">
        </div>
    </div>
</div>
<section class="section section-no-background section-no-border mt-md section-footer" id="contactLocation">
    <div class="container">
        <div class="row">
            <div class="col-md-12 center">
                <h2 class="heading-dark mb-none"> <strong>Contact and Location</strong></h2>
                <p class="mb-xl"></p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="google-map-borders">
                    <div id="googlemapsBorders" class="google-map mt-none mb-none" style="height: 270px;"></div>
                </div>
            </div>
            <div class="col-md-6">
                <h4 class="heading-primary">The <strong>Office</strong></h4>
                <ul class="list list-icons list-icons-style-3 mt-xlg">
                    <li><i class="fa fa-map-marker"></i> <strong>Address:</strong><?=$school[0]['location'].' '.$district[0]['name'].' , '.$region[0]['name']?></li>
                    <li><i class="fa fa-phone"></i> <strong>Phone:</strong><?=$school[0]['phone_number']?></li>
                    <li><i class="fa fa-envelope"></i> <strong>Postal Address:</strong><?=$school[0]['postal_address']?></li>
                    <li><i class="fa fa-envelope"></i> <strong>Email:</strong> <a href="<?=$school[0]['email_address']?>"><?=$school[0]['email_address']?></a></li>
                </ul>
                <hr>
                <h4 class="heading-primary">Working <strong>Hours</strong></h4>
                <ul class="list list-icons list-dark mt-xlg">
                    <li><i class="fa fa-clock-o"></i> Monday - Friday 8am to 5pm</li>
                    <li><i class="fa fa-clock-o"></i> Saturday - 9am to 2pm</li>
                    <li><i class="fa fa-clock-o"></i> Sunday - Closed</li>
                </ul>

            </div>
        </div>
    </div>
</section>
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

<!-- Demo -->
<script src="js/demos/demo-corporate-hosting.js"></script>

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
