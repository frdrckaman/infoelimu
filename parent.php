<?php
require_once'php/core/init.php';
$user = new User();
$override = new OverideData();$prevResult = null;$rslt = null;$studentDetails = null;$year = null;$checkNull = null;
$checkUser = 0;$news = null; $info = null;$pass = null;$pageError = null; $errorMessage = null; $successMessage = null;
if($user->isLoggedIn()){
    if($user->getSessionTable() === 'parents' && !$override->get('students','parent_id',$user->data()->id) == null) {
        $students = $override->get('students','parent_id',$user->data()->id);
        if (Input::exists('post')) {
            if(Input::get('changePassword')) { $pass = 'active';
                $news = null; $info = null; $reg = null; $upld = null;
                $validate = new validate();
                $validation = $validate->check($_POST, array(
                    'Old_Password' => array(
                        'required' => true,
                        'min' => 6
                    ),
                    'New_Password' => array(
                        'required' => true,
                        'min' => 6,
                        'max' => 20
                    ),
                    'Re-Enter_Password' => array(
                        'required' => true,
                        'min' => 6,
                        'matches' => 'New_Password'
                    )
                ));
                if ($validation->passed()) {
                    if (Hash::make(Input::get('Old_Password'), $user->data()->salt) !== $user->data()->password) {
                        $errorMessage = 'Your current password is wrong';
                    } else {
                        $salt = Hash::salt(32);
                        $user->updateRecord('parents',array(
                            'password' => Hash::make(Input::get('New_Password'), $salt),
                            'salt' => $salt
                        ),$user->data()->id);
                        $successMessage = 'Your Password is Successful Changed';
                        // Session::flash('home','Your password have been changed');
                        // Redirect::to('tamosco.php');
                    }
                } else {
                    $pageError = $validate->errors();
                }
            }
            ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            if(Input::get('updateInfo')){ $info = 'active';
                $news = null; $pass = null; $reg = null; $upld = null;
                $validate = new validate();
                $validation = $validate->check($_POST, array(
                    'phone_number' => array(
                        'required' => true,
                        'min' => 10,
                        'max' => 13,
                        'unique' => 'parents'
                    ),
                    'other_phone_number' => array(
                        'min' => 10,
                        'max' => 13
                    ),
                    'email_address' => array(
                        'required' => true,
                        'min' => 6,
                        'unique' => 'parents'
                    )
                ));
                if ($validation->passed()) {
                    $salt = Hash::salt(32);
                    $user->updateRecord('parents',array(
                        'phone_number' => Input::get('phone_number'),
                        'other_phone_number' => Input::get('other_phone_number'),
                        'email_address' => Input::get('email_address')
                    ),$user->data()->id);
                    $successMessage = 'Your Contact Information have been updated Successful';
                    // Session::flash('home','Your password have been changed');
                    // Redirect::to('tamosco.php');

                } else {
                    $pageError = $validate->errors();
                }
            }
            //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            if(Input::get('result')){ $rslt = 'active';
                $prevResult = Input::get('student');
                $studentDetails = $override->get('students','id',$prevResult);
            }
        }else{$news='active';$upTch='active';$newAll='active';}
        //////////////

    }else { Redirect::to('index.php'); }
} else { Redirect::to('index.php'); }
?>
<!DOCTYPE html>
<html>
<head>

    <!-- Basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Info-Elimu | Parent Panel </title>

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
    <link rel="stylesheet" href="css/bootstrap-select.min.css">
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

        <div class="row">
            <div class="col-md-12">
                <h1 class="mb-lg">Content Menu</h1>

                <div class="row">
                    <div class="col-md-4">
                        <div class="tabs tabs-vertical tabs-left tabs-navigation">
                            <ul class="nav nav-tabs col-sm-3">
                                <li class="<?=$news?>">
                                    <a href="#tabsNavigation1" data-toggle="tab"><i class="fa fa-group"></i> News and Announcements </a>
                                </li>
                                <li class="<?=$pass?>">
                                    <a href="#tabsNavigation2" data-toggle="tab"><i class="fa fa-file"></i>Change Password</a>
                                </li>
                                <li class="<?=$info?>">
                                    <a href="#tabsNavigation3" data-toggle="tab"><i class="fa fa-google-plus"></i> Contact Information</a>
                                </li>

                                <li class="<?=$rslt?>">
                                    <a href="#tabsNavigation5" data-toggle="tab"><i class="fa fa-adjust"></i> Results </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <!------------------------------------ tab1  --------------------------------------------------------------------------------------->
                        <div class="tab-pane tab-pane-navigation <?=$news?>" id="tabsNavigation1">
                                        <div class="col-md-12">
                                            <div class="tabs">
                                                <ul class="nav nav-tabs nav-justified">
                                                    <li class="active">
                                                        <a href="#pNews" data-toggle="tab" class="text-center">Personal News</a>
                                                    </li>
                                                    <li>
                                                        <a href="#cNews" data-toggle="tab" class="text-center">Class News</a>
                                                    </li>
                                                    <li>
                                                        <a href="#gNews" data-toggle="tab" class="text-center">General News</a>
                                                    </li>
                                                </ul>
                                                <div class="tab-content">
                                                    <div id="pNews" class="tab-pane active">
                                                        <?php $y=0;if($override->get('school_notification','parent_id',$user->data()->id)){foreach($override->get('school_notification','parent_id',$user->data()->id) as $parentNews){ ?>
                                                        <div class="container">
                                                        <div class="feature-box feature-box-tertiary feature-box-style-6 appear-animation" data-appear-animation="fadeInUp" data-appear-animation-delay="0">
                                                                    <div class="feature-box-icon">
                                                                        <i class="icon-envelope icons"></i>
                                                                    </div>
                                                                    <div class="feature-box-info">
                                                                        <?php if($parentNews['attachment'] == ''){?>
                                                                        <h5 class="mb-sm"><a class="" href="#contact<?=$y?>" data-toggle="modal" ><?=$parentNews['title']?></a></h5>
                                                                        <?php }else{ ?>
                                                                        <h5 class="mb-sm"><a href="readDocument.php?path=<?=$parentNews['attachment']?>" target="_blank"><?=$parentNews['title']?></a></h5>
                                                                        <?php }?>
                                                                        <p class="mb-sm"><i>Posted on : </i><?=$parentNews['postTime']?></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <?php if($parentNews['attachment'] == ''){?>
                                                                <div class="modal fade" id = "contact<?=$y?>" role="dialog" >
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h4><?=$parentNews['title']?></h4>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <p><?=$parentNews['message']?></p>
                                                                                <div class="modal-footer">
                                                                                    <a class="btn btn-default " data-dismiss="modal">Ok</a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            <br>
                                                        <?php }$y++;}}else{ ?>
                                                            <h4>No news amd Announcement at the moment</h4>
                                                        <?php } ?>
                                                    </div>
                                                    <div id="cNews" class="tab-pane">
                                                        <?php $x = 0;
                                                        foreach($override->getNoRepeatD3('students','school_id','class_id','stream','parent_id',$user->data()->id) as $myChild1){
                                                        if($override->selectData4('school_notification','school_id',$myChild1['school_id'],'school_news','streamAll','class_id',$myChild1['class_id'],'stream',$myChild1['stream']) ){$checkNull = 1;
                                                        foreach($override->selectData4('school_notification','school_id',$myChild1['school_id'],'school_news','streamAll','class_id',$myChild1['class_id'],'stream',$myChild1['stream']) as $streamNews){?>
                                                            <div class="container">
                                                                <div class="feature-box feature-box-tertiary feature-box-style-6 appear-animation" data-appear-animation="fadeInUp" data-appear-animation-delay="0">
                                                                    <div class="feature-box-icon">
                                                                        <i class="icon-envelope icons"></i>
                                                                    </div>
                                                                    <div class="feature-box-info">
                                                                        <?php if($streamNews['attachment'] == ''){?>
                                                                            <h5 class="mb-sm"><a class="" href="#contact<?=$x?>" data-toggle="modal" ><?=$streamNews['title']?></a></h5>
                                                                        <?php }else{ ?>
                                                                            <h5 class="mb-sm"><a href="readDocument.php?path=<?=$streamNews['attachment']?>" target="_blank"><?=$streamNews['title']?></a></h5>
                                                                        <?php }?>
                                                                        <p class="mb-sm"><i>Posted on : </i><?=$streamNews['postTime']?></p>
                                                                    </div>
                                                                </div>
                                                            </div><br>
                                                            <?php if($streamNews['attachment'] == ''){?>
                                                            <div class="modal fade" id = "contact<?=$x?>" role="dialog" >
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h4><?=$streamNews['title']?></h4>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <?=$streamNews['message']?>
                                                                                <div class="modal-footer">
                                                                                    <a class="btn btn-default " data-dismiss="modal">Ok</a>
                                                                                </div>
                                                                            </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php }$x++;}}elseif($checkNull == null) {?>
                                                            <h4>No news amd Announcement at the moment</h4>
                                                        <?php }} ?>
                                                    </div>
                                                    <div id="gNews" class="tab-pane">
                                                        <?php $z=0;if($override->getNoRepeat('students','school_id','parent_id',$user->data()->id)){
                                                            foreach($override->getNoRepeat('students','school_id','parent_id',$user->data()->id) as $myChild){
                                                                foreach($override->getNews('school_notification','school_id',$myChild['school_id'],'school_news','parentAll') as $parentNews2){ ?>
                                                                    <div class="container">
                                                                        <div class="feature-box feature-box-tertiary feature-box-style-6 appear-animation" data-appear-animation="fadeInUp" data-appear-animation-delay="0">
                                                                            <div class="feature-box-icon">
                                                                                <i class="icon-envelope icons"></i>
                                                                            </div>
                                                                            <div class="feature-box-info">
                                                                                <?php if($parentNews2['attachment'] == ''){ ?>
                                                                                    <h5 class="mb-sm"><a class="" href="#contact<?=$z?>" data-toggle="modal" ><?=$parentNews2['title']?></a></h5>
                                                                                <?php }else{?>
                                                                                    <h5 class="mb-sm"><a href="readDocument.php?path=<?=$parentNews2['attachment']?>" target="_blank"><?=$parentNews2['title']?></a></h5>
                                                                                 <?php }?>
                                                                                <p class="mb-sm"><i>Posted on : </i><?=$parentNews2['postTime']?></p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <?php if($parentNews2['attachment'] == ''){?>
                                                                        <div class="modal fade" id = "contact<?=$z?>" role="dialog" >
                                                                            <div class="modal-dialog">
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header">
                                                                                        <h4><?=$parentNews2['title']?></h4>
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                        <?=$parentNews2['message']?>
                                                                                        <div class="modal-footer">
                                                                                            <a class="btn btn-default " data-dismiss="modal">Ok</a>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    <br>
                                                                <?php }$z++;}}}else{ ?>
                                                            <h4>No news amd Announcement at the moment</h4>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                        </div>
                        <!------------------------------------ tab2  --------------------------------------------------------------------------------------->
                        <div class="tab-pane tab-pane-navigation <?=$pass?>" id="tabsNavigation2">
                            <div class="featured-boxes">
                                <div class="row">
                                    <div class="col-md-offset-1 col-sm-10">
                                        <div class="featured-box featured-box-primary align-left mt-xlg">
                                            <div class="box-content">

                                                <form action="#" data-toggle="validator" method="post">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <?php if(Input::get('changePassword')){if(!$errorMessage == null){
                                                                echo '<label style="color: #ff0000"><strong>ERROR: '.$errorMessage.'</strong></label>';}elseif(!$successMessage==null){
                                                                echo '<label style="color: #3f923f"><strong>CONGRATULATION!!'.$successMessage.'</strong></label>';}
                                                                if(!$pageError == null){echo'<label style="color: #ff0000"><strong> ERRORS :  </strong></label>';foreach($pageError as $error){
                                                                    echo '<label style="color: #ff0000"><strong>'.$error.'</strong></label>'.' , ';
                                                                } echo '<br>';}}?>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="col-md-12">
                                                                <div class="help-block with-errors"></div>
                                                                <div class="input-group input-group-icon">
                                                                    <span class="input-group-addon">
                                                                        <span class="icon"><i class="fa fa-key"></i></span>
                                                                    </span>
                                                                    <input class="form-control" name="Old_Password" type="password" placeholder="Old Password" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="col-md-12">
                                                                <div class="help-block with-errors"></div>
                                                                <div class="input-group input-group-icon">
                                                                    <span class="input-group-addon">
                                                                        <span class="icon"><i class="fa fa-key"></i></span>
                                                                    </span>
                                                                    <input class="form-control" name="New_Password" type="password" placeholder="New Password" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="col-md-12">
                                                                <div class="help-block with-errors"></div>
                                                                <div class="input-group input-group-icon">
                                                                    <span class="input-group-addon">
                                                                        <span class="icon"><i class="fa fa-key"></i></span>
                                                                    </span>
                                                                    <input class="form-control" name="Re-Enter_Password" type="password" placeholder="Re-Enter Password" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-offset-6 col-md-6">
                                                            <input type="submit" name="changePassword" value="Change Password" class="btn btn-primary pull-right mb-xl" data-loading-text="Loading...">
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!------------------------------------ tab3 ---------------------------------------------------------------------------------------->
                        <div class="tab-pane tab-pane-navigation <?=$info?>" id="tabsNavigation3">
                            <div class="featured-boxes">
                                <div class="row">
                                    <div class="col-md-offset-1 col-sm-10">
                                        <div class="featured-box featured-box-primary align-left mt-xlg">
                                            <div class="box-content">

                                                <form  data-toggle="validator" method="post">
                                                    <div class="row">
                                                        <div class="col-md-10">
                                                            <?php if(Input::get('updateInfo')){if(!$errorMessage == null){
                                                                echo '<label style="color: #ff0000"><strong>'.$errorMessage.'</strong></label>';}elseif(!$successMessage==null){
                                                                echo '<label style="color: #3f923f"><strong>'.$successMessage.'</strong></label>';}
                                                                if(!$pageError == null){echo '<label style="color: #ff0000"><strong> ERRORS :  </strong></label>'; foreach($pageError as $error){
                                                                    echo '<label style="color: #ff0000"><strong>'.$error.'</strong></label>'.' , ';
                                                                } echo '<br>';}}?>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="col-md-12">
                                                                <div class="help-block with-errors"></div>
                                                                <div class="input-group input-group-icon">
                                                                    <span class="input-group-addon">
                                                                        <span class="icon"><i class="fa fa-phone"></i></span>
                                                                    </span>
                                                                    <input class="form-control" name="phone_number" type="text" maxlength="13" placeholder="Your phone number" required >
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="col-md-12">
                                                                <div class="help-block with-errors"></div>
                                                                <div class="input-group input-group-icon">
                                                                    <span class="input-group-addon">
                                                                        <span class="icon"><i class="fa fa-phone"></i></span>
                                                                    </span>
                                                                    <input class="form-control" name="other_phone_number" type="text" maxlength="13" placeholder="Other phone number"  >
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="col-md-12">
                                                                <div class="help-block with-errors"></div>
                                                                <div class="input-group input-group-icon">
                                                                    <span class="input-group-addon">
                                                                        <span class="icon"><i class="fa fa-envelope"></i></span>
                                                                    </span>
                                                                    <input class="form-control" name="email_address" type="email" placeholder="Your Email Address" required >
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">

                                                        <div class="col-md-offset-6 col-md-6">
                                                            <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                                                            <input type="submit" name="updateInfo" value="Change Contact Info" class="btn btn-primary pull-right mb-xl" data-loading-text="Loading...">
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!----------------------------------- tab4  ---------------------------------------------------------------------------------------->

                        <!----------------------------------- tab5 Teacher List ---------------------------------------------------------------------------->
                        <div class="tab-pane tab-pane-navigation <?=$rslt?>" id="tabsNavigation5">
                            <div class="container col-md-12">
                                <section class="panel">
                                    <div class="panel-body">
                                        <?php if($prevResult == null){ ?>
                                        <form method="post">
                                            <div class="form-group">
                                        <div class="col-md-6">
                                            <div class="help-block with-errors"></div>
                                            <select class="selectpicker form-control mb-md" name="student" id="student" data-live-search="true" title="Select Student" required>
                                                <?php if(!$override->get('students','parent_id',$user->data()->id) == null){
                                                    foreach($override->get('students','parent_id',$user->data()->id) as $getStudent){?>
                                                        <option value="<?=$getStudent['id']?>"><?=$getStudent['firstname'].' '.$getStudent['middlename'].' '.$getStudent['lastname']?></option>
                                                    <?php }}?>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="submit" name="result" value="View Previous Results" class="btn btn-primary pull-right mb-xl" >
                                        </div>
                                                </div>
                                        </form>
                                        <?php }else{ ?>
                                            <div class="col-md-4">
                                                <select class="selectpicker form-control mb-md"  id="student_class" data-live-search="true" title="Select Class"  required>
                                                    <?php foreach($override->getNoRepeat2('results','class_id','years','student_id',$prevResult) as $getClass){
                                                        foreach($override->get('class_list','id',$getClass['class_id']) as $studClass){?>
                                                            <option value="<?=$studClass['id']?>"><?=$studClass['class_name']?></option>
                                                        <?php }} ?>
                                                </select>
                                            </div>
                                            <div class="col-md-8"><h4>Student Name : <?=$studentDetails[0]['firstname'].' '.$studentDetails[0]['middlename'].' '.$studentDetails[0]['lastname']?></h4></div>
                                        <?php } ?>
                                    </div>
                                    <div id="result">

                                    </div>
                                    <div id="prev_result">

                                    </div>
                                </section>
                            </div>
                        </div>
                        <!----------------------------------- tab6  Results -------------------------------------------------------------------------------->

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
<script src="vendor/jquery/bootstrap-select.min.js"></script>
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
    $(document).ready(function(){
    $('#student').change(function(){
        var student = $(this).val();
        $.ajax({
            url:"dataProcess.php?content=student",
            method:"GET",
            data:{getStudent:student},
            dataType:"text",
            success:function(data){
                $('#result').html(data);
            }
        });
      });
        $('#student_class').change(function(){
            var studentClass = $(this).val();
            $.ajax({
                url:"dataProcess.php?content=student_class&student=<?=$prevResult?>",
                method:"GET",
                data:{getStudentClass:studentClass},
                dataType:"text",
                success:function(data){
                    $('#result').html(data);
                }
            });
        });

    });

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
