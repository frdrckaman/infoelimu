<?php
require_once'php/core/init.php';
$user = new User();
$override = new OverideData();$results = null;$studentId = null;$studentsNo = null;
if($user->isLoggedIn()){
if($user->getSessionTable() === 'parents' && !$override->get('students','parent_id',$user->data()->id) == null) {
    if(!$_GET['sc'] == null && !$_GET['cl'] == null && !$_GET['sb'] == null && !$_GET['st'] == null && !$_GET['et'] == null && !$_GET['yr'] == null && !$_GET['p'] == null){
        $results = $override->getStudPosition('results','school_id',$_GET['sc'],'subject_id',$_GET['sb'],'class_id',$_GET['cl'],'exam_id',$_GET['et'],$_GET['yr'],date('Y'));
        $subjectName = $override->get('subjects','id',$_GET['sb']);
        $studentsNo = $override->getCount('students','parent_id',$user->data()->id);

    }else{Redirect::to('index.php');}
    }else{Redirect::to('index.php');}
}else{Redirect::to('index.php');}
?>
<!DOCTYPE html>
<html>
<head>
    <!-- Basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Info-Elimu | Results</title>

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
    <?php include 'header.php'?>
<div role="main" class="main">
    <div class="container">
        <div class="col-md-10 col-md-offset-1">
        <section class="panel">
            <header class="panel-heading">
                <div class="panel-actions">
                    <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                    <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
                </div>

                <h2 class=""><?=$subjectName[0]['name'].' '?> Results</h2>
            </header>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-condensed mb-none">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th class="text-right">Score</th>
                            <th>Grade</th>

                        </tr>
                        </thead>
                        <tbody>
                        <?php $x = 1;$y = 1; $studentName = null;
                        foreach($results as $result){
                                $studentName = 'AF'.$x;
                                $getStudent = $override->get('students','id',$_GET['st']);
                                $name = $getStudent[0]['firstname'].' '.$getStudent[0]['middlename'].' '.$getStudent[0]['lastname'];?>
                        <tr>
                            <td><?=$x?></td>
                            <td><?php if($_GET['p'] == $x){echo '<strong>'.$name.'</strong>';}else{echo $studentName;}?></td>
                            <td class="text-right"><?=$result['score']?></td>
                            <td><?php if($result['score'] >= 81){echo'A';}elseif($result['score']>=61 && $result['score']<=80){echo'B';}elseif($result['score']>=41 && $result['score']<=60){echo'C';}
                                elseif($result['score']>=21 && $result['score']<=40){echo'D';}else{echo'F';}?></td>
                        </tr>
                        <?php $x++; } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
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
