<?php
require_once'php/core/init.php';
$user = new User();
$override = new OverideData();
?>
<!DOCTYPE html>
<html data-style-switcher-options="{'changeLogo': false, 'borderRadius': 0, 'colorPrimary': '#F45C57', 'colorSecondary': '#cd3530', 'colorTertiary': '#2082C1', 'colorQuaternary': '#343434'}">

<head>

    <!-- Basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Info-Elimu | Catholic Diocese of Moshi</title>

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
    <link rel="stylesheet" href="css/skins/skin-corporate-hosting.css">		<script src="master/style-switcher/style.switcher.localstorage.js"></script>

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
                <img src="img/slides/catholic%20slide.jpg"
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
                     data-transform_in="y:[-300%];opacity:0;s:500;">WELCOME TO</div>

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
                     data-mask_in="x:0px;y:0px;">CATHOLIC DIOCESE OF MOSHI </div>


                <div class="tp-caption bottom-label"
                     data-x="center" data-hoffset="0"
                     data-y="center" data-voffset="50"
                     data-start="2000"
                     style="z-index: 5"
                     data-transform_in="y:[100%];opacity:0;s:500;"><h2><p style="color: #FFFFFF"><strong>SCHOOLS AND COLLEGES</strong></p></h2></div>

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
                            <li><a data-hash data-hash-offset="165" href="#schools">Schools & Colleges</a></li>
                            <li><a data-hash data-hash-offset="165" href="#about">About</a></li>
                            <li><a data-hash data-hash-offset="165" href="#admnistration">Administration</a></li>
                            <li><a data-hash data-hash-offset="165" href="#contactLocation">Contacts & Location</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </aside>

        <section class="section section-no-background section-no-border mt-none" id="news">
            <div class="row">
                <div class="col-md-12 center">
                    <h2 class="heading-dark mb-none"><strong>News and Announcements</strong></h2>
                    <p class="mb-xl"></p>
                </div>
            </div>
            <div class="container">

                <div class="row mt-md">
                    <?php $xy=0;if($override->get('school_notification','org_news',1)){
                    foreach($override->getNewsOrderBy('school_notification','org_news',1,'general_news',1) as $orgNews){?>
                    <div class="col-md-4">
                        <div class="feature-box feature-box-tertiary feature-box-style-3 appear-animation" data-appear-animation="fadeInUp" data-appear-animation-delay="0">
                            <div class="feature-box-icon">
                                <i class="fa fa-envelope"></i>
                            </div>
                            <div class="feature-box-info">
                                 <?php if($orgNews['attachment'] == ''){?>
                                     <h4 class="mb-sm"><a class="" href="#teacherNewz<?=$xy?>" data-toggle="modal" ><?=$orgNews['title']?></a></h4>
                                 <?php }else{?>
                                     <h4 class="mb-sm"><a href="readDocument.php?path=<?=$orgNews['attachment']?>" target="_blank"><?=$orgNews['title']?></a></h4>
                                 <?php } ?>

                                <p class="mb-lg"><i>Posted on : </i><?=$orgNews['postTime']?></p>
                            </div>
                        </div>
                    </div>
                        <?php if($orgNews['attachment'] == ''){?>
                            <div class="modal fade" id = "teacherNewz<?=$xy?>" role="dialog" >
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4><?=$orgNews['title']?></h4>
                                        </div>
                                        <div class="modal-body">
                                            <?=$orgNews['message']?>
                                            <div class="modal-footer">
                                                <a class="btn btn-default " data-dismiss="modal">Ok</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php }$xy++;}}else{ ?>
                        <div class="col-md-offset-3"><h1><p>No News and Announcement at the Moment </p></h1></div>
                    <?php } ?>
                </div>

            </div>
        </section>
        <div class="row center mt-xl">
            <div class="owl-carousel owl-theme" data-plugin-options='{"items": 6, "autoplay": true, "autoplayTimeout": 3000}'>
                <div>
                    <img class="img-responsive" src="img/logos/advert.png" alt="">
                </div>
                <div>
                    <img class="img-responsive" src="img/logos/tangazo%203.jpg" alt="">
                </div>
                <div>
                    <img class="img-responsive" src="img/logos/tangazo4.jpg" alt="">
                </div>
                <div>
                    <img class="img-responsive" src="img/logos/tangazo5.jpg" alt="">
                </div>
                <div>
                    <img class="img-responsive" src="img/logos/tangazo6.jpg" alt="">
                </div>
                <div>
                    <img class="img-responsive" src="img/logos/tangazo7.jpg" alt="">
                </div>
                <div>
                    <img class="img-responsive" src="img/logos/tangazo111.jpg" alt="">
                </div>

            </div>
        </div>

        <section class="section section-no-background section-no-border mt-none" id="schools">
            <div class="row">
                <div class="col-md-12 center">
                    <h2 class="heading-dark mb-none"> <strong>Schools and Colleges</strong></h2>
                    <p class="mb-xl"></p>
                </div>
            </div>
            <div class="container">
                <div class="row mt-md">
                    <div class="col-md-6">
                        <div class="feature-box feature-box-tertiary feature-box-style-5">
                            <div class="feature-box-icon">
                                <i class="fa fa-child"></i>
                            </div>
                            <div class="feature-box-info">
                                <h4 class="mb-sm"><a href="adv_schools.php?cat=1&org=1">Primary Schools</a></h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="feature-box feature-box-tertiary feature-box-style-5">
                            <div class="feature-box-icon">
                                <i class="fa fa-book"></i>
                            </div>
                            <div class="feature-box-info">
                                <h4 class="mb-sm"><a href="adv_schools.php?cat=2&org=1">Secondary Schools</a></h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="feature-box feature-box-tertiary feature-box-style-5">
                            <div class="feature-box-icon">
                                <i class="fa fa-graduation-cap"></i>
                            </div>
                            <div class="feature-box-info">
                                <h4 class="mb-sm"><a href="adv_schools.php?cat=4&org=1">Universities and Colleges</a></h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="feature-box feature-box-tertiary feature-box-style-5">
                            <div class="feature-box-icon">
                                <i class="fa fa-wrench"></i>
                            </div>
                            <div class="feature-box-info">
                                <h4 class="mb-sm"><a href="adv_schools.php?cat=3&org=1">Vocation Training Center</a></h4>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
        <section class="section section-no-border mt-none" id="about">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 center">
                        <h2 class="heading-dark mt-xl mb-none"> <strong>About Catholic Diocese of Moshi</strong></h2>
                        <p class="mb-xl"></p>
                    </div>
                </div>
                <div class="row">
                    <div class="pricing-table mt-xl">
                       <!-- <img class="pull-left" src="img/device.png" width="200" height="140" data-appear-animation="bounceIn" alt="">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur pellentesque neque eget diam posuere porta. Quisque ut nulla at nunc <a href="#">vehicula</a> lacinia. Proin adipiscing porta tellus, ut feugiat nibh adipiscing sit amet. In eu justo a felis faucibus ornare vel id metus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; In eu libero ligula. Fusce eget metus lorem, ac viverra leo. Nullam convallis, arcu vel pellentesque sodales, nisi est varius diam, ac ultrices sem ante quis sem. Proin ultricies volutpat sapien, nec scelerisque ligula mollis lobortis.</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur pellentesque neque eget diam posuere porta. Quisque ut nulla at nunc <a href="#">vehicula</a> lacinia. Proin adipiscing porta tellus, ut feugiat nibh adipiscing sit amet. In eu justo a felis faucibus ornare vel id metus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; In eu libero ligula. Fusce eget metus lorem, ac viverra leo. Nullam convallis, arcu vel pellentesque sodales, nisi est varius diam, ac ultrices sem ante quis sem. Proin ultricies volutpat sapien, nec scelerisque ligula mollis lobortis. Nullam convallis, arcu vel pellentesque sodales, nisi est varius diam, ac ultrices sem ante quis sem. Proin ultricies volutpat sapien, nec scelerisque ligula mollis lobortis.</p>
                        <hr> -->
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
                        <div class="col-md-offset-4 col-md-2 col-xs-6 center mb-lg">
                            <img src="img/org/amani.jpg" class="img-responsive" alt="">
                            <h5 class="mt-sm mb-none"><strong>RT.Rev.</strong> I.Amani</h5>
                            <p class="mb-none">Chairperson</p>
                        </div>
                        <div class="col-md-2 col-xs-6 center mb-lg">
                            <img src="img/org/Ruwaichi.jpg" class="img-responsive" alt="">
                            <h5 class="mt-sm mb-none"><strong>Rev.Fr. W.J.</strong> Ruwaichi </h5>
                            <p class="mb-none">Education Director</p>
                        </div>

                    </div>

                    <div class="container">
                        <div class="row mt-md">
                            <div class="col-md-6">
                                <div class="feature-box feature-box-tertiary feature-box-style-5">
                                    <div class="feature-box-icon">
                                        <i class="fa fa-users"></i>
                                    </div>
                                    <div class="feature-box-info">
                                        <h4 class="mb-sm"><a href="readDocument.php?path=attachment/edu_org/DIOCESAN EDUCATION BOARD.pdf" target="_blank">Diocese Education Board</a></h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="feature-box feature-box-tertiary feature-box-style-5">
                                    <div class="feature-box-icon">
                                        <i class="fa fa-sitemap"></i>
                                    </div>
                                    <div class="feature-box-info">
                                        <h4 class="mb-sm"><a href="readDocument.php?path=attachment/edu_org/THE DIOCESE EDUCATION STRUCTURE.pdf">Diocese Education Structure</a></h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="feature-box feature-box-tertiary feature-box-style-5">
                                    <div class="feature-box-icon">
                                        <i class="fa fa-user"></i>
                                    </div>
                                    <div class="feature-box-info">
                                        <h4 class="mb-sm"><a href="readDocument.php?path=attachment/SCHOOL BOARD CHAIRPERSONS.pdf" target="_blank">School Board Chairpersons Secondary</a></h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="feature-box feature-box-tertiary feature-box-style-5">
                                    <div class="feature-box-icon">
                                        <i class="fa fa-briefcase"></i>
                                    </div>
                                    <div class="feature-box-info">
                                        <h4 class="mb-sm"><a href="readDocument.php?path=attachment/edu_org/DIRECTORS AND PRINCIPAL OF VTC.pdf" target="_blank">Directors and Principle VTC</a></h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="feature-box feature-box-tertiary feature-box-style-5">
                                    <div class="feature-box-icon">
                                        <i class="fa fa-user"></i>
                                    </div>
                                    <div class="feature-box-info">
                                        <h4 class="mb-sm"><a href="readDocument.php?path=attachment/edu_org/DEPUTY HEADMASTERS.pdf" target="_blank">Deputy Headmaster / Headmistress of Secondary School</a></h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="feature-box feature-box-tertiary feature-box-style-5">
                                    <div class="feature-box-icon">
                                        <i class="fa fa-university"></i>
                                    </div>
                                    <div class="feature-box-info">
                                        <h4 class="mb-sm"><a href="readDocument.php?path=attachment/edu_org/CATHOLIC DIOCECE OF MOSHI.pdf" target="_blank">A-Level Schools with Combinations</a></h4>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>


            </div>
        </section>
        <div class="row center mt-xl">
            <div class="owl-carousel owl-theme" data-plugin-options='{"items": 6, "autoplay": true, "autoplayTimeout": 3000}'>
                <div>
                    <img class="img-responsive" src="img/logos/advert.png" alt="">
                </div>
                <div>
                    <img class="img-responsive" src="img/logos/tangazo%203.jpg" alt="">
                </div>
                <div>
                    <img class="img-responsive" src="img/logos/tangazo4.jpg" alt="">
                </div>
                <div>
                    <img class="img-responsive" src="img/logos/tangazo5.jpg" alt="">
                </div>
                <div>
                    <img class="img-responsive" src="img/logos/tangazo6.jpg" alt="">
                </div>
                <div>
                    <img class="img-responsive" src="img/logos/tangazo7.jpg" alt="">
                </div>
                <div>
                    <img class="img-responsive" src="img/logos/tangazo111.jpg" alt="">
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
                            <li><i class="fa fa-map-marker"></i> <strong>Address:</strong> </li>
                            <li><i class="fa fa-phone"></i> <strong>Phone:+255-27-2752157</strong></li>
                            <li><i class="fa fa-fax"></i> <strong>Fax: +255-27-2751982</strong></li>
                            <li><i class="fa fa-envelope"></i> <strong>Postal Address:</strong>P.O.BOX 3041 </li>
                            <li><i class="fa fa-envelope"></i> <strong>Email:</strong> <a href="cathdiomoshiedu@yahoo.com">cathdiomoshiedu@yahoo.com</a></li>
                        </ul>
                        <hr>
                        <h4 class="heading-primary">Working <strong>Hours</strong></h4>
                        <ul class="list list-icons list-dark mt-xlg">
                            <li><i class="fa fa-clock-o"></i> Monday - Friday 9am to 5pm</li>
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
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCPzuQmc8jqYD_P02SBUE4IpT_d-QsbKe8&callback=initMap"></script>
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
