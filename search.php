<?php
require_once'php/core/init.php';
$user = new User();
$override = new OverideData(); $results = null;$pages = null;
if(!$_GET['srch'] == null){
    if($_GET['num'] == 0 || !$_GET['num'] == null ) {
        $count = $override->countSearch($_GET['srch']);
        $page = ceil($count / 40);if($_GET['num'] == 1){$pages = 1;}else{$page = ($_GET['num']*40)-40; $pages = $_GET['num'];}
        if($_GET['num'] == 1){$page = 0;}else{$page = ($_GET['num']*40)-40;}
        $results = $override->search($_GET['srch'], $page);
        $page = ceil($count / 40);
    }else{Redirect::to('index.php');}
  }else{Redirect::to('index.php');}
?>
<!DOCTYPE html>
<html>
<head>
    <!-- Basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Info-Elimu | Search Page </title>

    <meta name="keywords" content="infoelimu" />
    <meta name="description" content="infoelimu website">
    <meta name="author" content="infoelimu.ac.tz">

    <!-- Favicon -->
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
        <h4>Search Results for "<?=$_GET['srch']?>"</h4>
        <div class="row">
            <div class="col-md-12">
                <section class="panel">
                    <div class="panel-body">
                    <?php if(!$results == null){  ?>
                    <table class="table table-bordered table-striped table-condensed mb-none">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th class="text-right">Type</th>
                            <th class="text-right">Status</th>
                            <th class="text-right">Region</th>
                            <th class="text-right">District</th>
                            <th class="text-right">Website</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $x = 1; foreach($results as $result){ $region = $override->get('region','id',$result['region_id']);
                            $district = $override->get('district','id',$result['district_id']); ?>
                        <tr>
                            <td><a href="school.php?id=<?=$result['id']?>"><?=$result['name'].'  '.$result['category']?></a></td>
                            <td class="text-right"><?=$result['type']?></td>
                            <td class="text-right"><?=$result['status']?></td>
                            <td class="text-right"><?=$region[0]['name']?></td>
                            <td class="text-right"><?=$district[0]['name']?></td>
                            <td class="text-right"><?$result['website']?></td>
                        </tr>
                        <?php $x++; } ?>
                        </tbody>
                    </table>
                        <ul class="pagination pagination-sm">
                            <li><a href="search.php?srch=<?=$_GET['srch']?>&num=<?php if($_GET['num']-1 > 0){echo $_GET['num']-1;}else{ echo 1;} ?>"><i class="fa fa-chevron-left"></i></a></li>
                            <?php for($i=1;$i<=$page;$i++){?>
                            <li class="<?php if($i == $pages){echo 'active';}?>"><a href="search.php?srch=<?=$_GET['srch']?>&num=<?=$i?>"><?=$i?></a></li>
                            <?php } ?>
                            <li><a href="search.php?srch=<?=$_GET['srch']?>&num=<?php if($_GET['num']+1 <= $page){echo $_GET['num']+1;}else{ echo $i-1;} ?>"><i class="fa fa-chevron-right"></i></a></li>
                        </ul>
                    <?php  } else {echo '<h1>No results found</h1>';}?>

                  </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'?>


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
