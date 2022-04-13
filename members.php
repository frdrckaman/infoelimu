<?php
require_once'php/core/init.php';
$user = new User();
$override = new OverideData();$content=null;$members=null;$tamongscoZone=null;$tamongscoRegion=null;
$chair=null;$vice=null;$treasure=null;$secretary=null;$administrator=null;$tamongscoZone=null;$name=null;
if($_GET['content'] && $_GET['type']){
    if($_GET['type'] == 'zone') {
        $tamongscoZone = $override->get('tamongsco_zone', 'id', $_GET['content']);$name = $tamongscoZone[0]['name'];//print_r($tamongscoZone);
        $members = $override->get('tamongsco', 'zone_name', $tamongscoZone[0]['zone_id']);
    }elseif($_GET['type'] == 'region'){
        $tamongscoRegion = $override->get('tamongsco_regions','id',$_GET['content']);$name = $tamongscoRegion[0]['name'];//print_r($tamongscoRegion);
        $members = $override->get('tamongsco','region',$tamongscoRegion[0]['region_id']);
    }
}else Redirect::to('index.php');
?>
<!DOCTYPE html>
<html data-style-switcher-options="{'changeLogo': false, 'borderRadius': 0, 'colorPrimary': '#F45C57', 'colorSecondary': '#cd3530', 'colorTertiary': '#2082C1', 'colorQuaternary': '#343434'}">

<head>

    <!-- Basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Info-Elimu | TAMONGSCO MEMBERS</title>

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

<section class="section section-no-background section-no-border mt-none" id="news">
    <div class="row">
        <div class="col-md-12 center">
            <h2 class="heading-dark mb-none"> <strong>TAMONGSCO <?=$name.' '?>MEMBERS</strong></h2>
            <p class="mb-xl"></p>
        </div>
    </div>
    <div class="container">
        <div class="row mt-xl">
            <?php if($members){$x = 0;foreach($members as $member){$schools = $override->get('schools','tamongsco_id',$member['id']);?>
                <div class="col-md-4">
                    <div class="feature-box feature-box-tertiary feature-box-style-3">
                        <div class="feature-box-icon">
                            <i class="fa fa-book"></i>
                        </div>
                        <div class="feature-box-info"><?php if($schools){?>
                            <h6 class="mb-sm"><a href="school.php?id=<?=$schools[0]['id']?>"><?=$schools[0]['name'].' '.$schools[0]['category']?></a></h6>
                            <p class="mb-lg"><strong><?=$member['firstname'].' '.$member['middlename'].' '.$member['lastname']?></strong></p>
                            <?php }else{ ?>
                            <p class="mb-lg"><strong><?=$member['firstname'].' '.$member['middlename'].' '.$member['lastname']?></strong></p>
                            <?php }?>
                        </div>
                    </div>
                </div> <?php }}else{?>
                <div class="col-md-offset-0"><h4><p align="center">No Members Registered  </p></h4></div>
            <?php } ?>
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
<script src="vendor/rs-plugin/js/jquery.themepunch.tools.min.js"></script>
<script src="vendor/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>

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
