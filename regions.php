<?php
require_once'php/core/init.php';
$user = new User();
$override = new OverideData();
$pr = null;$sec = null; $vtc = null; $col = null;
if(!$_GET['id'] == null){if($_GET['page']) {$numRec = 30;
    switch($_GET['tab']){
        case $_GET['tab'] == 'pr':
            $pr = 'active';
            break;
        case $_GET['tab'] == 'sec':
            $sec = 'active';
            break;
        case $_GET['tab'] == 'col':
            $col = 'active';
            break;
        case $_GET['tab'] == 'vtc':
            $vtc = 'active';
            break;
       default:
            $pr = 'active';
    }
    $region = $override->get('region', 'id', $_GET['id']);
    $districts = $override->get('district', 'region_id', $region[0]['id']);

 }else{/* redirect to 404 error page */}
}else{Redirect::to('index.php');}
?>
<!DOCTYPE html>
<html>
<head>
    <!-- Basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Info-Elimu | Regions</title>

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
    <link rel="stylesheet" href="css/skins/default.css">
    <script src="master/style-switcher/style.switcher.localstorage.js"></script>

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
        <div class="row">
                <div class="col-md-12">
                    <h2 class="mb-lg"><?=$region[0]['name']?> Region</h2>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="tabs tabs-vertical tabs-left tabs-navigation">
                                <ul class="nav nav-tabs col-sm-3">
                                    <?php $x = 1; foreach($districts as $district){?>
                                        <li class="<?php if($x == $_GET['dis']){echo 'active';}?>">
                                            <a href="#tabsNavigation<?=$x?>" data-toggle="tab"><i class="fa fa-group"></i><?=$district['name']?></a>
                                        </li>
                                        <?php $x++;} ?>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <?php $y = 1; foreach($districts as $district){?>
                                <div class="tab-pane tab-pane-navigation <?php if($y == $_GET['dis']){echo 'active';}?>" id="tabsNavigation<?=$y?>">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="tabs">
                                                <ul class="nav nav-tabs nav-justified">
                                                    <li class="<?=$pr?>">
                                                        <a href="#primary<?=$y?>" data-toggle="tab" class="text-center">Primary Schools</a>
                                                    </li>
                                                    <li class="<?=$sec?>">
                                                        <a href="#secondary<?=$y?>" data-toggle="tab" class="text-center">Secondary Schools</a>
                                                    </li>
                                                    <li class="<?=$col?>">
                                                        <a href="#colleges<?=$y?>" data-toggle="tab" class="text-center">Colleges</a>
                                                    </li>
                                                    <li class="<?=$vtc?>">
                                                        <a href="#vct<?=$y?>" data-toggle="tab" class="text-center">Vocation Training</a>
                                                    </li>
                                                </ul>
                                                <div class="tab-content">
                                                    <div id="primary<?=$y?>" class="tab-pane <?=$pr?>">
                                                            <section class="panel">
                                                                <div class="panel-body">
                                                                    <?php if(!$override->getCounted('schools', 'region_id', $_GET['id'], 'district_id', $district['id'], 'category', 'Primary School') == 0){?>
                                                                    <table class="table table-bordered table-striped mb-none" >
                                                                        <thead>
                                                                        <tr>
                                                                            <th>School Name</th>
                                                                            <th>Type</th>
                                                                            <th>Status</th>
                                                                            <th>Postal Address</th>
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                        <?php
                                                                        $pagNumP = $override->getCounted('schools', 'region_id', $_GET['id'], 'district_id', $district['id'], 'category', 'Primary School');
                                                                              $pagesP = ceil($pagNumP / 30);if($_GET['page'] == 1){$page = 0;}else{$page = ($_GET['page']*30)-30;}
                                                                        foreach($override->getSchools('schools','region_id',$_GET['id'],'district_id',$district['id'],'category','Primary School',$page,$numRec) as $primarySchools){ ?>
                                                                            <tr>
                                                                                <td><a href="school.php?id=<?=$primarySchools['id']?>"><?=$primarySchools['name']?></a></td>
                                                                                <td><?=$primarySchools['type']?></td>
                                                                                <td><?=$primarySchools['status']?></td>
                                                                                <td><?=$primarySchools['postal_address']?></td>
                                                                            </tr>
                                                                        <?php } ?>
                                                                        </tbody>
                                                                    </table>
                                                                    <div class="col-md-12">
                                                                        <ul class="pagination pagination-sm">
                                                                            <li><a href="regions.php?id=<?=$_GET['id']?>&page=<?php if(($_GET['page']-1) > 0){echo $_GET['page']-1;}else{echo 1;}?>&tab=pr&dis=<?=$y?>"><i class="fa fa-chevron-left"></i></a></li>
                                                                            <?php for($i=1;$i<=$pagesP;$i++){?>
                                                                                <li class="<?php if($i == $_GET['page']){echo 'active';}?>"><a href="regions.php?id=<?=$_GET['id']?>&page=<?=$i?>&tab=pr&dis=<?=$y?>"><?=$i?></a></li>
                                                                            <?php } ?>
                                                                            <li><a href="regions.php?id=<?=$_GET['id']?>&page=<?php if(($_GET['page']+1) <= $pagesP){echo $_GET['page']+1;}else{echo $i-1;}?>&tab=pr&dis=<?=$y?>"><i class="fa fa-chevron-right"></i></a></li>
                                                                        </ul>
                                                                    </div>
                                                                    <?php }else{echo '<h4>No Schools Registered for this District at the moment</h4>';}?>
                                                                </div>
                                                            </section>
                                                    </div>
                                                    <div id="secondary<?=$y?>" class="tab-pane <?=$sec?>">
                                                        <section class="panel">
                                                            <div class="panel-body">
                                                                <?php if(!$override->getCounted('schools', 'region_id', $_GET['id'], 'district_id', $district['id'], 'category', 'Secondary School') == 0){?>
                                                                <table class="table table-bordered table-striped mb-none" >
                                                                    <thead>
                                                                    <tr>
                                                                        <th>School Name</th>
                                                                        <th>Type</th>
                                                                        <th>Status</th>
                                                                        <th>Postal Address</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    <?php $pagNum = $override->getCounted('schools', 'region_id', $_GET['id'], 'district_id', $district['id'], 'category', 'Secondary School');
                                                                             $pages = ceil($pagNum / 30);if($_GET['page'] == 1){$page = 0;}else{$page = ($_GET['page']*30)-30;}
                                                                    foreach($override->getSchools('schools','region_id',$_GET['id'],'district_id',$district['id'],'category','Secondary School',$page,$numRec) as $secondarySchools){ ?>
                                                                        <tr>
                                                                            <td><a href="school.php?id=<?=$secondarySchools['id']?>"><?=$secondarySchools['name']?></a></td>
                                                                            <td><?=$secondarySchools['type']?></td>
                                                                            <td><?=$secondarySchools['status']?></td>
                                                                            <td><?=$secondarySchools['postal_address']?></td>
                                                                        </tr>
                                                                    <?php } ?>
                                                                    </tbody>
                                                                </table>
                                                                <div class="col-md-12">
                                                                    <ul class="pagination pagination-sm">
                                                                        <li><a href="regions.php?id=<?=$_GET['id']?>&page=<?php if(($_GET['page']-1) > 0){echo $_GET['page']-1;}else{echo 1;}?>&tab=sec&dis=<?=$y?>"><i class="fa fa-chevron-left"></i></a></li>
                                                                        <?php for($i=1;$i<=$pages;$i++){?>
                                                                        <li class="<?php if($i == $_GET['page']){echo 'active';}?>"><a href="regions.php?id=<?=$_GET['id']?>&page=<?=$i?>&tab=sec&dis=<?=$y?>"><?=$i?></a></li>
                                                                        <?php } ?>
                                                                        <li><a href="regions.php?id=<?=$_GET['id']?>&page=<?php if(($_GET['page']+1) <= $pages){echo $_GET['page']+1;}else{echo $i-1;}?>&tab=sec&dis=<?=$y?>"><i class="fa fa-chevron-right"></i></a></li>
                                                                    </ul>
                                                                </div>
                                                                <?php }else{echo '<h4>No Schools Registered for this District at the moment</h4>';}?>
                                                            </div>
                                                        </section>
                                                    </div>
                                                    <div id="colleges<?=$y?>" class="tab-pane <?=$col?>">
                                                        <section class="panel">
                                                            <div class="panel-body">
                                                                <?php if(!$override->getCounted('schools', 'region_id', $_GET['id'], 'district_id', $district['id'], 'category', 'College') == 0){?>
                                                                <table class="table table-bordered table-striped mb-none" >
                                                                    <thead>
                                                                    <tr>
                                                                        <th>College Name</th>
                                                                        <th>Status</th>
                                                                        <th>Postal Address</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    <?php $pagNumC = $override->getCounted('schools', 'region_id', $_GET['id'], 'district_id', $district['id'], 'category', 'College');
                                                                          $pagesC = ceil($pagNumC / 30);if($_GET['page'] == 1){$page = 0;}else{$page = ($_GET['page']*30)-30;}
                                                                    foreach($override->getSchools('schools','region_id',$_GET['id'],'district_id',$district['id'],'category','College',$page,$numRec) as $college){ ?>
                                                                        <tr>
                                                                            <td><?=$college['name']?></td>
                                                                            <td><?=$college['status']?></td>
                                                                            <td><?=$college['postal_address']?></td>
                                                                        </tr>
                                                                    <?php } ?>
                                                                    </tbody>
                                                                </table>
                                                                <div class="col-md-12">
                                                                    <ul class="pagination pagination-sm">
                                                                        <li><a href="regions.php?id=<?=$_GET['id']?>&page=<?php if(($_GET['page']-1) > 0){echo $_GET['page']-1;}else{echo 1;}?>&tab=col&dis=<?=$y?>"><i class="fa fa-chevron-left"></i></a></li>
                                                                        <?php for($i=1;$i<=$pagesC;$i++){?>
                                                                            <li class="<?php if($i == $_GET['page']){echo 'active';}?>"><a href="regions.php?id=<?=$_GET['id']?>&page=<?=$i?>&tab=col&dis=<?=$y?>"><?=$i?></a></li>
                                                                        <?php } ?>
                                                                        <li><a href="regions.php?id=<?=$_GET['id']?>&page=<?php if(($_GET['page']+1) <= $pagesC){echo $_GET['page']+1;}else{echo $i-1;}?>&tab=col&dis=<?=$y?>"><i class="fa fa-chevron-right"></i></a></li>
                                                                    </ul>
                                                                </div>
                                                                <?php }else{echo '<h4>No Colleges Registered for this District at the moment</h4>';} ?>
                                                            </div>
                                                        </section>
                                                    </div>
                                                    <div id="vct<?=$y?>" class="tab-pane <?=$vtc?>">
                                                        <section class="panel">
                                                            <div class="panel-body">
                                                                <?php if(!$override->getCounted('schools', 'region_id', $_GET['id'], 'district_id', $district['id'], 'category', 'Vocation Training') == 0){?>
                                                                <table class="table table-bordered table-striped mb-none" >
                                                                    <thead>
                                                                    <tr>
                                                                        <th>VTC Name</th>
                                                                        <th>Status</th>
                                                                        <th>Postal Address</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    <?php $pagNumV = $override->getCounted('schools', 'region_id', $_GET['id'], 'district_id', $district['id'], 'category', 'Vocation Training');
                                                                          $pagesV = ceil($pagNumV / 30);if($_GET['page'] == 1){$page = 0;}else{$page = ($_GET['page']*30)-30;}
                                                                    foreach($override->getSchools('schools','region_id',$_GET['id'],'district_id',$district['id'],'category','Vocation Training',$page,$numRec) as $vocationTraining){ ?>
                                                                        <tr>
                                                                            <td><?=$vocationTraining['name']?></td>
                                                                            <td><?=$vocationTraining['status']?></td>
                                                                            <td><?=$vocationTraining['postal_address']?></td>
                                                                        </tr>
                                                                    <?php } ?>
                                                                    </tbody>
                                                                </table>
                                                                <div class="col-md-12">
                                                                    <ul class="pagination pagination-sm">
                                                                        <li><a href="regions.php?id=<?=$_GET['id']?>&page=<?php if(($_GET['page']-1) > 0){echo $_GET['page']-1;}else{echo 1;}?>&tab=vtc&dis=<?=$y?>"><i class="fa fa-chevron-left"></i></a></li>
                                                                        <?php for($i=1;$i<=$pagesV;$i++){?>
                                                                            <li class="<?php if($i == $_GET['page']){echo 'active';}?>"><a href="regions.php?id=<?=$_GET['id']?>&page=<?=$i?>&tab=vtc&dis=<?=$y?>"><?=$i?></a></li>
                                                                        <?php } ?>
                                                                        <li><a href="regions.php?id=<?=$_GET['id']?>&page=<?php if(($_GET['page']+1) <= $pagesV){echo $_GET['page']+1;}else{echo $i-1;}?>&tab=vtc&dis=<?=$y?>"><i class="fa fa-chevron-right"></i></a></li>
                                                                    </ul>
                                                                </div>
                                                                <?php }else{echo'<h4>No VCT Registered for this District at the moment</h4>';}?>
                                                            </div>
                                                        </section>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php $y++; $x++;} ?>
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
