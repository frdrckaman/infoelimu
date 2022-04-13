<?php
require_once'php/core/init.php';
$user = new User();
$override = new OverideData();$content=null;$news=null;
$chair=null;$vice=null;$treasure=null;$secretary=null;$administrator=null;
if($_GET['content']){
    if($_GET['type']) {
        if($_GET['type']=='zone'){
            $content = $override->get('tamongsco_zone', 'id', $_GET['content']);
            if($override->get('tamongsco_zone','id',$_GET['content'])){
                $news = $override->getNewsOrderBy('notification', 'accessLevel', 'generalPublic', 'zone_name', $override->get('tamongsco_zone','id',$_GET['content'])[0]['zone_id']);
            }else{
                $news = $override->getNewsOrderBy('notification', 'accessLevel', 'generalPublic', 'zone_name', $_GET['content']);
            }
            $administrator = $override->leaders('tamongsco', 'zone_name', $_GET['content'], 'position', 'Chairperson', 'position', 'Vice Chairperson', 'position', 'Secretary', 'position', 'Treasurer');
        }elseif($_GET['type']=='region'){
            $content = $override->get('tamongsco_regions', 'id', $_GET['content']);
            if($override->get('tamongsco_regions','id',$_GET['content'])){
                $news = $override->getNewsOrderBy('notification', 'accessLevel', 'generalPublic', 'region', $override->get('tamongsco_regions','id',$_GET['content'])[0]['region_id']);
            }else{
                $news = $override->getNewsOrderBy('notification', 'accessLevel', 'generalPublic', 'region', $_GET['content']);
            }
            $administrator = $override->leaders('tamongsco', 'region', $_GET['content'], 'position', 'Chairperson', 'position', 'Vice Chairperson', 'position', 'Secretary', 'position', 'Treasurer');
        }
        if ($administrator) {
            foreach ($administrator as $admin) {
                switch ($admin['position']) {
                    case 'Chairperson':
                        $chair = $admin['attachment'];
                        break;
                    case 'Vice Chairperson':
                        $vice = $admin['attachment'];
                        break;
                    case 'Secretary':
                        $secretary = $admin['attachment'];
                        break;
                    case 'Treasurer':
                        $treasure = $admin['attachment'];
                        break;
                }
            }
        }
    }else{Redirect::to('index.php');}
}else{Redirect::to('index.php');}
?>
<!DOCTYPE html>
<html data-style-switcher-options="{'changeLogo': false, 'borderRadius': 0, 'colorPrimary': '#F45C57', 'colorSecondary': '#cd3530', 'colorTertiary': '#2082C1', 'colorQuaternary': '#343434'}">

<head>

    <!-- Basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Info-Elimu | TAMONGSCO ZONE</title>

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
                        <img src="<?=$content[0]['attachment']?>"
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
                             data-mask_in="x:0px;y:0px;">TAMONGSCO <?=$content[0]['name']?></div>

                        <div class="tp-caption bottom-label"
                             data-x="center" data-hoffset="0"
                             data-y="center" data-voffset="50"
                             data-start="2000"
                             style="z-index: 5"
                             data-transform_in="y:[100%];opacity:0;s:500;"></div>

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
                            <li><a data-hash data-hash-offset="165" href="members.php?content=<?=$_GET['content']?>&type=<?=$_GET['type']?>">Our Members</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </aside>

        <section class="section section-no-background section-no-border mt-none" id="news">
            <div class="row">
                <div class="col-md-12 center">
                    <h2 class="heading-dark mb-none"> <strong>News and Announcements</strong></h2>
                    <p class="mb-xl"></p>
                </div>
            </div>
            <div class="container">
                <div class="row mt-xl">
                    <?php if($news){$x = 0;foreach($news as $new){?>
                        <div class="col-md-4">
                            <div class="feature-box feature-box-tertiary feature-box-style-3">
                                <div class="feature-box-icon">
                                    <i class="fa fa-envelope"></i>
                                </div>
                                <div class="feature-box-info">
                                    <?php if($new['attachment'] == ''){?>
                                        <h4 class="mb-sm"><a class="" href="#teacherNewz<?=$x?>" data-toggle="modal" ><?=$new['title']?></a></h4>
                                    <?php }else{?>
                                        <h4 class="mb-sm"><a href="readDocument.php?path=<?=$new['attachment']?>" target="_blank"><?=$new['title']?></a></h4>
                                    <?php }?>
                                    <p class="mb-lg"><?=$new['postTime']?></p>
                                </div>
                            </div>
                        </div>
                        <?php if($new['attachment'] == ''){?>
                            <div class="modal fade" id = "teacherNewz<?=$x?>" role="dialog" >
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4><?=$new['title']?></h4>
                                        </div>
                                        <div class="modal-body">
                                            <?=$new['message']?>
                                            <div class="modal-footer">
                                                <a class="btn btn-default " data-dismiss="modal">Ok</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php }$x++;}}else{?>
                        <div class="col-md-offset-0"><h4><p align="center">No News and Announcement at the Moment </p></h4></div>
                    <?php } ?>
                </div>
        </section>
        <div class="row center mt-xl">
            <div class="owl-carousel owl-theme" data-plugin-options='{"items": 6, "autoplay": true, "autoplayTimeout": 6000}'>
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
        <section class="section section-no-border mt-none" id="history">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 center">
                        <h2 class="heading-dark mt-xl mb-none"> <strong>About Us</strong></h2>
                        <p class="mb-xl"><?=$content[0]['about']?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="pricing-table mt-xl">

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
                            <?php if($chair){?>
                                <img src="<?=$chair?>" class="img-responsive" alt="Chairperson picture">
                            <?php }else{?>
                                <img src="img/team/blank.jpg" class="img-responsive" alt="Chairperson picture">
                            <?php }?>
                            <h5 class="mt-sm mb-none"></h5>
                            <p class="mb-none">Chairperson</p>
                        </div>
                        <div class="col-md-2 col-xs-6 center mb-lg">
                            <?php if($vice){?>
                            <img src="<?=$vice?>" class="img-responsive" alt="Vice Chairperson picture">
                            <?php }else{?>
                            <img src="img/team/blank.jpg" class="img-responsive" alt="Vice Chairperson picture">
                            <?php }?>
                            <h5 class="mt-sm mb-none"></h5>
                            <p class="mb-none">Vice Chairperson</p>
                        </div>
                        <div class="col-md-2 col-xs-6 center mb-lg">
                            <?php if($treasure){?>
                            <img src="<?=$treasure?>" class="img-responsive" alt="Treasurer picture">
                            <?php }else{?>
                            <img src="img/team/blank.jpg" class="img-responsive" alt="Treasurer picture">
                            <?php }?>
                            <h5 class="mt-sm mb-none"></h5>
                            <p class="mb-none">Treasurer</p>
                        </div>
                        <div class="col-md-2 col-xs-6 center mb-lg">
                            <?php if($secretary){?>
                            <img src="<?=$treasure?>" class="img-responsive" alt="General Secretary picture">
                            <?php }else{?>
                            <img src="img/team/blank.jpg" class="img-responsive" alt="General Secretary picture">
                            <?php }?>
                            <h5 class="mt-sm mb-none"></h5>
                            <p class="mb-none">General Secretary</p>
                        </div>

                    </div>
                </div>
            </div>
        </section>
        <div class="row center mt-xl">
            <div class="owl-carousel owl-theme" data-plugin-options='{"items": 6, "autoplay": true, "autoplayTimeout": 6000}'>
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
                            <li><i class="fa fa-map-marker"></i> <strong>Address:</strong> <?=$content[0]['location']?></li>
                            <li><i class="fa fa-phone"></i> <strong>Phone:</strong> <?=$content[0]['phone_number']?></li>
                            <li><i class="fa fa-envelope"></i> <strong>Postal Address:</strong><?=$content[0]['postal_address']?></li>
                            <li><i class="fa fa-fax"></i> <strong>Fax:</strong><?=$content[0]['fax_number']?></li>
                            <li><i class="fa fa-envelope"></i> <strong>Email:</strong> <a href="<?=$content[0]['email_address']?>"><?=$content[0]['email_address']?></a></li>
                        </ul>
                        <hr>
                        <h4 class="heading-primary">Working <strong>Hours</strong></h4>
                        <ul class="list list-icons list-dark mt-xlg">
                            <li><i class="fa fa-clock-o"></i> Monday - Friday 8am to 4pm</li>
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
