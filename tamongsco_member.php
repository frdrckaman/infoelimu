<?php
require_once'php/core/init.php';
$user = new User();
$override = new OverideData();$attachment_file='';
$position = 0; $access = 0; $access1 = 0; $isLogin = 0; $activeTab =  null;$check=false;
$pageError = null; $errorMessage = null; $successMessage = null;$leader = null;$zonal=0;
$members = $override->getData('tamongsco');$table=null;$column = null;$regional=0;
$news = null;$pass = null;$info = null;$reg = null;$upld = null;$userColumn =null;
if($user->isLoggedIn()){
    if($user->getSessionTable() == 'tamongsco'){ $isLogin = 1;
        $contentMenu = 'Content Menu';
        $regions = $override->getData('region');
        $zones = $override->getData('zone');
        if($user->data()->leader == 1){$access = 1;
            $level = $user->data()->power_level;
            switch($level){
                case 'headquarter':
                    $access1 = 1;
                    $table = 'headquarter';
                    break;
                case 'zonal':
                    $access1 = 2;
                    $table = 'tamongsco_zone';
                    $column = 'zone_name';
                    $userColumn = $user->data()->zone_name;
                    break;
                case 'regional':
                    $access1 = 3;
                    $column = 'region';
                    $table = 'tamongsco_regions';
                    $userColumn = $user->data()->region;
                    break;
                case 'normalMember':
                    $access1 = 4;
                    break;
            }
        } elseif($user->data()->leader == 0 && $user->data()->power_level == 'normalMember'){$access = 1;$access1 = 4;}else{$access = 0;}
        if($user->data()->position === 'Member'){$position = 1;} else $position = 2;
        if (Input::exists('post')) {
           // if (Token::check(Input::get('token'))) {
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
                            $user->updateRecord('tamongsco',array(
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
                            'unique' => 'tamongsco'
                        ),
                        'other_phone_number' => array(
                            'min' => 10,
                            'max' => 13
                        ),
                        'email_address' => array(
                            'required' => true,
                            'min' => 6,
                            'unique' => 'tamongsco'
                        )
                    ));
                    if ($validation->passed()) {
                            $salt = Hash::salt(32);
                            $user->update(array(
                                'phone_number' => Input::get('phone_number'),
                                'other_phone_number' => Input::get('other_phone_number'),
                                'email_address' => Input::get('email_address')
                            ));
                            $successMessage = 'Your Contact Information have been updated Successful';
                            // Session::flash('home','Your password have been changed');
                            // Redirect::to('tamosco.php');

                    } else {
                        $pageError = $validate->errors();
                    }
                }
                //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                if(Input::get('registerUser')){ $reg = 'active';
                    $news = null; $pass = null; $info = null; $upld = null;
                    if(Input::get('position') === 'Member'){$leader = 0;} else {$leader = 1;}
                    $validate = new validate();
                    $validation = $validate->check($_POST, array(
                        'firstname' => array(
                            'required' => true,
                            'min' => 2,
                        ),
                        'middlename' => array(

                        ),
                        'lastname' => array(
                            'required' => true,
                            'min' => 2,
                        ),
                        'position' => array(
                            'required' => true,
                        ),
                        'jurisdiction_level' => array(
                            'required' => true,
                        ),
                        'zone' => array(
                            'required' => true,
                        ),
                        'region' => array(
                            'required' => true,
                        ),
                        'phone_number' => array(
                            'required' => true,
                            'min' => 10,
                            'max' => 13
                        ),
                        'other_phone_number' => array(
                            'min' => 10,
                            'max' => 13
                        ),
                        'email_address' => array(
                            'min' => 6,
                        )
                    ));
                    if ($validation->passed()) {
                        $salt = Hash::salt(32);
                        $password = '123456';
                        try{
                            $user->createRecord('tamongsco',array(
                                'firstname' => Input::get('firstname'),
                                'middlename' => Input::get('middlename'),
                                'lastname' => Input::get('lastname'),
                                'position' => Input::get('position'),
                                'zone_name' => Input::get('zone'),
                                'region' => Input::get('region'),
                                'phone_number' => Input::get('phone_number'),
                                'other_phone_number' => Input::get('other_phone_number'),
                                'email_address' => Input::get('email_address'),
                                'password' => Hash::make($password, $salt),
                                'salt' => $salt,
                                'leader'=> $leader,
                                'power_level' => Input::get('jurisdiction_level')
                            ));
                            $successMessage = 'Your Contact Information have been updated Successful';
                            // Session::flash('home','Your password have been changed');
                            // Redirect::to('tamosco.php');
                        }
                        catch(PDOException $e){die($e->getMessage());}
                    } else {
                        $pageError = $validate->errors();
                    }
                }
                /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                if(Input::get('uploadNews')){ $upld = 'active';$news = null;
                    if (!empty($_FILES['attachment']["tmp_name"])) {
                        $attach_file = $_FILES['attachment']['type'];
                        if ($attach_file == "application/pdf" || $attach_file == "application/vnd.openxmlformats-officedocument.wordprocessingml.document" || $attach_file == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet") {
                            $folderName = 'attachment/tamongsco/';
                            $attachment_file = $folderName . basename($_FILES['attachment']['name']);
                            if (move_uploaded_file($_FILES['attachment']["tmp_name"], $attachment_file)) {

                            }else{$check=true;$errorMessage = 'not uploaded to a folder';}
                        }else{$check=true;$errorMessage = 'not supported format';}
                    }
                                $validate = new validate();
                                $validate = $validate->check($_POST, array(
                                    'message_title' => array(
                                        'required' => true,
                                    ),
                                    'message_body' => array(
                                        'required' => true,
                                    ),
                                    'accessLevel' => array(
                                        'required' => true,
                                    ),
                                    'zone' => array(
                                        'required' => true,
                                    ),
                                    'region' => array(
                                        'required' => true,
                                    )
                                ));
                                if ($validate->passed() && $check == false) {
                                        switch(Input::get('accessLevel')){
                                            case 'confidentialToZone':
                                                $noMembers = $override->getCounted('tamongsco',$column,$userColumn,'leader',1,'power_level',$user->data()->power_level);
                                                $zoneId = $override->get($table,'zone_id',$userColumn);//print_r($zoneId);
                                                $bundleId = $override->getNews('bundle_usage','org_name',$table,'org_id',$zoneId[0]['id']);

                                                if($user->validateBundle(Input::get('message_body'),$noMembers,$bundleId[0]['id'])){
                                                    foreach($override->selectData('tamongsco',$column,$userColumn,'leader',1,'power_level',$user->data()->power_level) as $sendSms){
                                                         $user->sendSMS($sendSms['phone_number'],Input::get('message_body'));
                                                        $remainSms = $override->getNews('bundle_usage','org_name',$table,'org_id',$zoneId[0]['id'])[0]['sms'] - $user->countWords(Input::get('message_body'),1);
                                                        $user->updateRecord('bundle_usage',array(
                                                            'sms' => $remainSms,
                                                        ),$bundleId[0]['id']);
                                                    }
                                                }
                                                break;
                                            case 'confidentialToRegion':
                                                if($access1 == 2){
                                                    $zoneId = $override->get($table,'zone_id',$userColumn);
                                                    $bundleId = $override->getNews('bundle_usage','org_name',$table,'org_id',$zoneId[0]['id']);
                                                    $noMembers = $override->getCounted('tamongsco','region',Input::get('region'),'leader',1,'power_level','regional');//print_r(Input::get('region'));
                                                  if($user->validateBundle(Input::get('message_body'),$noMembers,$bundleId[0]['id'])){
                                                      foreach($override->selectData('tamongsco',$column,$userColumn,'leader',1,'power_level',$user->data()->power_level) as $sendSms){
                                                         $user->sendSMS($sendSms['phone_number'],Input::get('message_body'));
                                                        $remainSms = $override->getNews('bundle_usage','org_name',$table,'org_id',$zoneId[0]['id'])[0]['sms'] - $user->countWords(Input::get('message_body'),1);
                                                        $user->updateRecord('bundle_usage',array(
                                                            'sms' => $remainSms,
                                                        ),$bundleId[0]['id']);
                                                    }
                                                  }
                                                }elseif($access1 == 3){
                                                    $noMembers = $override->getCounted('tamongsco',$column,$userColumn,'leader',1,'power_level',$user->data()->power_level);
                                                    $regionId = $override->get($table,'region_id',$userColumn);
                                                    $bundleId = $override->getNews('bundle_usage','org_name',$table,'org_id',$regionId[0]['id']);

                                                    if($user->validateBundle(Input::get('message_body'),$noMembers,$bundleId[0]['id'])){
                                                        foreach($override->selectData('tamongsco',$column,$userColumn,'leader',1,'power_level',$user->data()->power_level) as $sendSms){
                                                             $user->sendSMS($sendSms['phone_number'],Input::get('message_body'));
                                                            $remainSms = $override->getNews('bundle_usage','org_name',$table,'org_id',$regionId[0]['id'])[0]['sms'] - $user->countWords(Input::get('message_body'),1);
                                                            $user->updateRecord('bundle_usage',array(
                                                                'sms' => $remainSms,
                                                            ),$override->getNews('bundle_usage','org_name',$table,'org_id',$bundleId[0]['org_id'])[0]['id']);
                                                        }
                                                    }
                                                }
                                                break;
                                            case 'generalToZone':
                                                $zoneId = $override->get($table,'zone_id',$userColumn);
                                                $bundleId = $override->getNews('bundle_usage','org_name',$table,'org_id',$zoneId[0]['id']);
                                                $noMembers = $override->getCount('tamongsco',$column,$userColumn);
                                               // $noSms = $smsSize * $override->getCount('tamongsco','zone_name',$user->data()->zone_name);
                                                $zoneId = $override->get($table,'zone_id',$user->data()->zone_name);
                                                if($user->validateBundle(Input::get('message_body'),$noMembers,$bundleId[0]['id'])){
                                                    foreach($override->get('tamongsco','zone_name',$user->data()->zone_name) as $sendSms){
                                                        $user->sendSMS($sendSms['phone_number'],Input::get('message_body'));
                                                        $remainSms = $override->getNews('bundle_usage','org_name',$table,'org_id',$zoneId[0]['id'])[0]['sms'] - $user->countWords(Input::get('message_body'),1);
                                                        $user->updateRecord('bundle_usage',array(
                                                            'sms' => $remainSms,
                                                        ),$bundleId[0]['id']);
                                                    }
                                                }
                                                break;
                                            case 'generalToRegion':
                                                If($access1==2) {
                                                    $zoneId = $override->get($table, 'zone_id', $userColumn);
                                                    $bundleId = $override->getNews('bundle_usage', 'org_name', $table, 'org_id', $zoneId[0]['id']);
                                                    $noMembers = $override->getCount('tamongsco', 'region', Input::get('region'));
                                                    // $noSms = $smsSize * $override->getCount('tamongsco','zone_name',$user->data()->zone_name);
                                                    $zoneId = $override->get($table, 'zone_id', $user->data()->zone_name);
                                                    if ($user->validateBundle(Input::get('message_body'), $noMembers, $bundleId[0]['id'])) {
                                                        foreach ($override->get('tamongsco', 'region', Input::get('region')) as $sendSms) {
                                                            $user->sendSMS($sendSms['phone_number'],Input::get('message_body'));
                                                            $remainSms = $override->getNews('bundle_usage', 'org_name', $table, 'org_id', $zoneId[0]['id'])[0]['sms'] - $user->countWords(Input::get('message_body'), 1);

                                                            $user->updateRecord('bundle_usage', array(
                                                                'sms' => $remainSms,
                                                            ), $bundleId[0]['id']);
                                                        }
                                                    }
                                                }elseif($access1==3){
                                                   // $regionId = $override->get($table, 'region_id', $userColumn);
                                                    $regionId = $override->get($table, 'region_id', $user->data()->region);
                                                    $bundleId = $override->getNews('bundle_usage', 'org_name', $table, 'org_id', $regionId[0]['id']);
                                                    $noMembers = $override->getCount('tamongsco', 'region', Input::get('region'));
                                                    // $noSms = $smsSize * $override->getCount('tamongsco','zone_name',$user->data()->zone_name);

                                                    if ($user->validateBundle(Input::get('message_body'), $noMembers, $bundleId[0]['id'])) {
                                                        foreach ($override->get('tamongsco', 'region', $user->data()->region) as $sendSms) {
                                                             $user->sendSMS($sendSms['phone_number'],Input::get('message_body'));
                                                            $remainSms = $override->getNews('bundle_usage', 'org_name', $table, 'org_id', $regionId[0]['id'])[0]['sms'] - $user->countWords(Input::get('message_body'), 1);

                                                            $user->updateRecord('bundle_usage', array(
                                                                'sms' => $remainSms,
                                                            ), $bundleId[0]['id']);
                                                        }
                                                    }
                                                }
                                                break;
                                            case 'generalPublic':
                                                break;
                                        }

                                    try {
                                        if($access1 == 2){
                                            if(Input::get('accessLevel') == 'confidentialToRegion' || Input::get('accessLevel') == 'generalToRegion'){
                                                $zonal = 0;$regional = Input::get('region');
                                            }elseif(Input::get('accessLevel') == 'zoneRegion'){$zonal = $user->data()->zone_name;$regional=0;}
                                            elseif(Input::get('accessLevel') == 'allRegion'){
                                                $zonal = $user->data()->zone_name;$regional='all';
                                            }else{$regional = 0;$zonal = Input::get('zone');}
                                        }elseif($access1 == 3){$zonal = 0;$regional = Input::get('region');
                                        }else{$regional = Input::get('region');$zonal = Input::get('zone');}
                                        $user->createRecord('notification', array(
                                             'title' => Input::get('message_title'),
                                             'message' => Input::get('message_body'),
                                             'attachment' => $attachment_file,
                                             'accessLevel' => Input::get('accessLevel'),
                                             'zone_name' => $zonal,
                                             'region' => $regional,
                                             'postTime' => date('Y-m-d H:i'),
                                             'memb_id' => $user->data()->id
                                         ));
                                        $successMessage = 'Announcement have been updated Successful';

                                    } catch (Exception $e) {
                                        die($e->getMessage());
                                    }

                                } else {
                                    $pageError = $validate->errors();
                                }

                }
          //  }
        } else {$news = 'active';}
    }else{Redirect::to('index.php');}
}else{Redirect::to('index.php');}
?>
<!DOCTYPE html>
<html>
<head>

    <!-- Basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Info-Elimu | Tamongsco Member Panel</title>

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
                                <?php if($user->isLoggedIn() && $user->data()->leader){?>
                                <li class="<?=$reg?>">
                                    <a href="#tabsNavigation4" data-toggle="tab"><i class="fa fa-adjust"></i> Register New Member</a>
                                </li>
                                <li class="<?=$upld?>">
                                    <a href="#tabsNavigation5" data-toggle="tab"><i class="fa fa-film"></i> Upload News and Announcements</a>
                                </li>
                                <?php }?>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="tab-pane tab-pane-navigation <?=$news?>" id="tabsNavigation1">
                            <div class="container">
                                    <div class="row">
                                        <div class="col-md-offset-0 col-md-10">
                                            <div class="col-md-12">
                                                <div class="tabs">
                                                    <ul class="nav nav-tabs nav-justified">
                                                        <li class="active">
                                                            <a href="#cNews" data-toggle="tab" class="text-center">Confidential News</a>
                                                        </li>
                                                        <li>
                                                            <a href="#gNews" data-toggle="tab" class="text-center">General News</a>
                                                        </li>
                                                    </ul>
                                                    <div class="tab-content">
                                                        <div id="cNews" class="tab-pane active">
                                                            <?php if($access === 1 && $access1 === 1){
                                                                if($override->getNews('notification','zone_name',$user->data()->zone_name,'region',$user->data()->region)){
                                                                    $a1=0;foreach($override->getNewsOrderBy('notification','zone_name',$user->data()->zone_name,'region',$user->data()->region) as $resultH){
                                                                        if($resultH['accessLevel'] === 'headquarter'){?>
                                                                            <div class="col-md-8">
                                                                                <div class="feature-box feature-box-tertiary feature-box-style-3 appear-animation" data-appear-animation="fadeInUp" data-appear-animation-delay="0">
                                                                                    <div class="feature-box-icon">
                                                                                        <i class="fa fa-envelope"></i>
                                                                                    </div>
                                                                                    <div class="feature-box-info">
                                                                                        <?php if($resultH['attachment'] == ''){?>
                                                                                            <h4 class="mb-sm"><a class="" href="#tamongscoH<?=$a1?>" data-toggle="modal" ><?=$resultH['title']?></a></h4>
                                                                                        <?php }else{?>
                                                                                            <h4 class="mb-sm"><a href="readDocument.php?path=<?=$resultH['attachment']?>" target="_blank"><?=$resultH['title']?></a></h4>
                                                                                        <?php } ?>

                                                                                        <p class="mb-lg"><i>Posted on : </i><?=$resultH['postTime']?></p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <?php if($resultH['attachment'] == ''){?>
                                                                                <div class="modal fade" id = "tamongscoH<?=$a1?>" role="dialog" >
                                                                                    <div class="modal-dialog">
                                                                                        <div class="modal-content">
                                                                                            <div class="modal-header">
                                                                                                <h4><?=$resultH['title']?></h4>
                                                                                            </div>
                                                                                            <div class="modal-body">
                                                                                                <?=$resultH['message']?>
                                                                                                <div class="modal-footer">
                                                                                                    <a class="btn btn-default " data-dismiss="modal">Ok</a>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            <?php }}$a1++;}}?>
                                                            <?php }
                                                            elseif($access === 1 && $access1 === 2){
                                                                if($override->get('notification','zone_name',$user->data()->zone_name)){
                                                                    $a2=0;foreach($override->getOrderBy('notification','zone_name',$user->data()->zone_name,'id') as $result){
                                                                        if($result['accessLevel'] == 'confidentialToZone' || $result['accessLevel'] == 'zoneRegion'){?>
                                                                            <div class="container">
                                                                                <div class="feature-box feature-box-tertiary feature-box-style-3 appear-animation" data-appear-animation="fadeInUp" data-appear-animation-delay="0">
                                                                                    <div class="feature-box-icon">
                                                                                        <i class="fa fa-envelope"></i>
                                                                                    </div>
                                                                                    <div class="feature-box-info">
                                                                                        <?php if($result['attachment'] == ''){?>
                                                                                            <h4 class="mb-sm"><a class="" href="#tamongscoH<?=$a2?>" data-toggle="modal" ><?=$result['title']?></a></h4>
                                                                                        <?php }else{?>
                                                                                            <h4 class="mb-sm"><a href="readDocument.php?path=<?=$result['attachment']?>" target="_blank"><?=$result['title']?></a></h4>
                                                                                        <?php } ?>

                                                                                        <p class="mb-lg"><i>Posted on : </i><?=$result['postTime']?></p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <?php if($result['attachment'] == ''){?>
                                                                                <div class="modal fade" id = "tamongscoH<?=$a2?>" role="dialog" >
                                                                                    <div class="modal-dialog">
                                                                                        <div class="modal-content">
                                                                                            <div class="modal-header">
                                                                                                <h4><?=$result['title']?></h4>
                                                                                            </div>
                                                                                            <div class="modal-body">
                                                                                                <?=$result['message']?>
                                                                                                <div class="modal-footer">
                                                                                                    <a class="btn btn-default " data-dismiss="modal">Ok</a>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            <?php }}$a2++;}}}
                                                            elseif($access === 1 && $access1 === 3){
                                                            $a5=0;if($override->get('notification','region',$user->data()->region)){
                                                            foreach($override->getOrderBy('notification','region',$user->data()->region,'id') as $result0){
                                                            if($result0['accessLevel'] === 'confidentialToRegion') {?>
                                                                <div class="container">
                                                                    <div class="feature-box feature-box-tertiary feature-box-style-3 appear-animation" data-appear-animation="fadeInUp" data-appear-animation-delay="0">
                                                                        <div class="feature-box-icon">
                                                                            <i class="fa fa-envelope"></i>
                                                                        </div>
                                                                        <div class="feature-box-info">
                                                                            <?php if($result0['attachment'] == ''){?>
                                                                                <h4 class="mb-sm"><a class="" href="#tamongscoH<?=$a5?>" data-toggle="modal" ><?=$result0['title']?></a></h4>
                                                                            <?php }else{?>
                                                                                <h4 class="mb-sm"><a href="readDocument.php?path=<?=$result0['attachment']?>" target="_blank"><?=$result0['title']?></a></h4>
                                                                            <?php } ?>

                                                                            <p class="mb-lg"><i>Posted on : </i><?=$result0['postTime']?></p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <?php if($result0['attachment'] == ''){?>
                                                                    <div class="modal fade" id = "tamongscoH<?=$a5?>" role="dialog" >
                                                                        <div class="modal-dialog">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h4><?=$result0['title']?></h4>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <?=$result0['message']?>
                                                                                    <div class="modal-footer">
                                                                                        <a class="btn btn-default " data-dismiss="modal">Ok</a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                            <?php }}$a5++;}}?>
                                                            <?php if($override->getNews('notification','zone_name',$user->data()->zone_name,'accessLevel','zoneRegion')){
                                                                $znR = 0;foreach($override->getNewsOrderBy('notification','zone_name',$user->data()->zone_name,'accessLevel','zoneRegion') as $zoneR){?>
                                                                <div class="container">
                                                                    <div class="feature-box feature-box-tertiary feature-box-style-3 appear-animation" data-appear-animation="fadeInUp" data-appear-animation-delay="0">
                                                                        <div class="feature-box-icon">
                                                                            <i class="fa fa-envelope"></i>
                                                                        </div>
                                                                        <div class="feature-box-info">
                                                                            <?php if($zoneR['attachment'] == ''){?>
                                                                                <h4 class="mb-sm"><a class="" href="#tamongscoH<?=$znR?>" data-toggle="modal" ><?=$zoneR['title']?></a></h4>
                                                                            <?php }else{?>
                                                                                <h4 class="mb-sm"><a href="readDocument.php?path=<?=$zoneR['attachment']?>" target="_blank"><?=$zoneR['title']?></a></h4>
                                                                            <?php } ?>

                                                                            <p class="mb-lg"><i>Posted on : </i><?=$zoneR['postTime']?></p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <?php if($zoneR['attachment'] == ''){?>
                                                                    <div class="modal fade" id = "tamongscoH<?=$znR?>" role="dialog" >
                                                                        <div class="modal-dialog">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h4><?=$zoneR['title']?></h4>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <?=$zoneR['message']?>
                                                                                    <div class="modal-footer">
                                                                                        <a class="btn btn-default " data-dismiss="modal">Ok</a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <?php }$znR++;}}?>
                                                            <?php if($override->selectData('notification','zone_name',$user->data()->zone_name,'region','all','accessLevel','allRegion')){
                                                                $allR=0;foreach($override->selectDataOrderBy('notification','zone_name',$user->data()->zone_name,'region','all','accessLevel','allRegion') as $allRegion){?>
                                                                <div class="container">
                                                                    <div class="feature-box feature-box-tertiary feature-box-style-3 appear-animation" data-appear-animation="fadeInUp" data-appear-animation-delay="0">
                                                                        <div class="feature-box-icon">
                                                                            <i class="fa fa-envelope"></i>
                                                                        </div>
                                                                        <div class="feature-box-info">
                                                                            <?php if($allRegion['attachment'] == ''){?>
                                                                                <h4 class="mb-sm"><a class="" href="#tamongscoH<?=$allRegion?>" data-toggle="modal" ><?=$allRegion['title']?></a></h4>
                                                                            <?php }else{?>
                                                                                <h4 class="mb-sm"><a href="readDocument.php?path=<?=$allRegion['attachment']?>" target="_blank"><?=$allRegion['title']?></a></h4>
                                                                            <?php } ?>

                                                                            <p class="mb-lg"><i>Posted on : </i><?=$allRegion['postTime']?></p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <?php if($allRegion['attachment'] == ''){?>
                                                                    <div class="modal fade" id = "tamongscoH<?=$allR?>" role="dialog" >
                                                                        <div class="modal-dialog">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h4><?=$allRegion['title']?></h4>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <?=$zoneR['message']?>
                                                                                    <div class="modal-footer">
                                                                                        <a class="btn btn-default " data-dismiss="modal">Ok</a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <?php }$allR++;}}}?>
                                                        </div>
                                                        <div id="gNews" class="tab-pane">
                                                            <?php if($access === 1 && $access1 === 2){
                                                                if($override->get('notification','zone_name',$user->data()->zone_name)){
                                                                    $a3=0;foreach($override->getNewsOrderBy('notification','zone_name',$user->data()->zone_name,'accessLevel','generalToZone') as $result1){?>
                                                                        <div class="container">
                                                                            <div class="feature-box feature-box-tertiary feature-box-style-3 appear-animation" data-appear-animation="fadeInUp" data-appear-animation-delay="0">
                                                                                <div class="feature-box-icon">
                                                                                    <i class="fa fa-envelope"></i>
                                                                                </div>
                                                                                <div class="feature-box-info">
                                                                                    <?php if($result1['attachment'] == ''){?>
                                                                                        <h4 class="mb-sm"><a class="" href="#tamongscoH<?=$a3?>" data-toggle="modal" ><?=$result1['title']?></a></h4>
                                                                                    <?php }else{?>
                                                                                        <h4 class="mb-sm"><a href="readDocument.php?path=<?=$result1['attachment']?>" target="_blank"><?=$result1['title']?></a></h4>
                                                                                    <?php } ?>

                                                                                    <p class="mb-lg"><i>Posted on : </i><?=$result1['postTime']?></p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <?php if($result1['attachment'] == ''){?>
                                                                            <div class="modal fade" id = "tamongscoH<?=$a3?>" role="dialog" >
                                                                                <div class="modal-dialog">
                                                                                    <div class="modal-content">
                                                                                        <div class="modal-header">
                                                                                            <h4><?=$result1['title']?></h4>
                                                                                        </div>
                                                                                        <div class="modal-body">
                                                                                            <?=$result1['message']?>
                                                                                            <div class="modal-footer">
                                                                                                <a class="btn btn-default " data-dismiss="modal">Ok</a>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        <?php }$a3++;}}
                                                                elseif($override->get('notification','zone_name',$user->data()->zone_name)){
                                                                         if($override->get('notification','zone_name',$user->data()->zone_name)){
                                                                             $az=0;foreach($override->getNewsOrderBy('notification','zone_name',$user->data()->zone_name,'accessLevel','generalToZone') as $resultZ){?>
                                                                                 <div class="container">
                                                                                     <div class="feature-box feature-box-tertiary feature-box-style-3 appear-animation" data-appear-animation="fadeInUp" data-appear-animation-delay="0">
                                                                                         <div class="feature-box-icon">
                                                                                             <i class="fa fa-envelope"></i>
                                                                                         </div>
                                                                                         <div class="feature-box-info">
                                                                                             <?php if($resultZ['attachment'] == ''){?>
                                                                                                 <h4 class="mb-sm"><a class="" href="#tamongscoH<?=$az?>" data-toggle="modal" ><?=$resultZ['title']?></a></h4>
                                                                                             <?php }else{?>
                                                                                                 <h4 class="mb-sm"><a href="readDocument.php?path=<?=$resultZ['attachment']?>" target="_blank"><?=$resultZ['title']?></a></h4>
                                                                                             <?php } ?>

                                                                                             <p class="mb-lg"><i>Posted on : </i><?=$resultZ['postTime']?></p>
                                                                                         </div>
                                                                                     </div>
                                                                                 </div>
                                                                                 <?php if($resultZ['attachment'] == ''){?>
                                                                                     <div class="modal fade" id = "tamongscoH<?=$az?>" role="dialog" >
                                                                                         <div class="modal-dialog">
                                                                                             <div class="modal-content">
                                                                                                 <div class="modal-header">
                                                                                                     <h4><?=$resultZ['title']?></h4>
                                                                                                 </div>
                                                                                                 <div class="modal-body">
                                                                                                     <?=$resultZ['message']?>
                                                                                                     <div class="modal-footer">
                                                                                                         <a class="btn btn-default " data-dismiss="modal">Ok</a>
                                                                                                     </div>
                                                                                                 </div>
                                                                                             </div>
                                                                                         </div>
                                                                                     </div>
                                                            <?php }$az++;}}}}
                                                            elseif($access === 1 && $access1 === 3){
                                                            if($override->get('notification','region',$user->data()->region)){
                                                                $a4=0;foreach($override->getOrderBy('notification','region',$user->data()->region,'id') as $result2){
                                                                    if($result2['accessLevel'] === 'generalToRegion') {?>
                                                                            <div class="container">
                                                                                <div class="feature-box feature-box-tertiary feature-box-style-3 appear-animation" data-appear-animation="fadeInUp" data-appear-animation-delay="0">
                                                                                    <div class="feature-box-icon">
                                                                                        <i class="fa fa-envelope"></i>
                                                                                    </div>
                                                                                    <div class="feature-box-info">
                                                                                        <?php if($result2['attachment'] == ''){?>
                                                                                <h4 class="mb-sm"><a class="" href="#tamongscoH<?=$a4?>" data-toggle="modal" ><?=$result2['title']?></a></h4>
                                                                            <?php }else{?>
                                                                                <h4 class="mb-sm"><a href="readDocument.php?path=<?=$result2['attachment']?>" target="_blank"><?=$result2['title']?></a></h4>
                                                                            <?php } ?>

                                                                            <p class="mb-lg"><i>Posted on : </i><?=$result2['postTime']?></p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <?php if($result2['attachment'] == ''){?>
                                                                    <div class="modal fade" id = "tamongscoH<?=$a4?>" role="dialog" >
                                                                        <div class="modal-dialog">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h4><?=$result2['title']?></h4>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <?=$result2['message']?>
                                                                                    <div class="modal-footer">
                                                                                        <a class="btn btn-default " data-dismiss="modal">Ok</a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                            <?php }}$a4++;}}}
                                                            elseif($access === 0 && $access1 === 4){
                                                                if($override->get('notification','zone_name',$user->data()->zone_name)){
                                                                $ag=0;foreach($override->getNewsOrderBy('notification','zone_name',$user->data()->zone_name,'accessLevel','generalToZone') as $resultG){?>
                                                                    <div class="container">
                                                                        <div class="feature-box feature-box-tertiary feature-box-style-3 appear-animation" data-appear-animation="fadeInUp" data-appear-animation-delay="0">
                                                                            <div class="feature-box-icon">
                                                                                <i class="fa fa-envelope"></i>
                                                                            </div>
                                                                            <div class="feature-box-info">
                                                                                <?php if($resultG['attachment'] == ''){?>
                                                                                    <h4 class="mb-sm"><a class="" href="#tamongscoH<?=$ag?>" data-toggle="modal" ><?=$resultG['title']?></a></h4>
                                                                                <?php }else{?>
                                                                                    <h4 class="mb-sm"><a href="readDocument.php?path=<?=$resultG['attachment']?>" target="_blank"><?=$resultG['title']?></a></h4>
                                                                                <?php } ?>

                                                                                <p class="mb-lg"><i>Posted on : </i><?=$resultG['postTime']?></p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <?php if($resultG['attachment'] == ''){?>
                                                                        <div class="modal fade" id = "tamongscoH<?=$ag?>" role="dialog" >
                                                                            <div class="modal-dialog">
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header">
                                                                                        <h4><?=$resultG['title']?></h4>
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                        <?=$resultG['message']?>
                                                                                        <div class="modal-footer">
                                                                                            <a class="btn btn-default " data-dismiss="modal">Ok</a>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                            <?php }$ag++;}}}
                                                                if($override->getNews('notification','region',$user->data()->region,'accessLevel','generalToRegion')){
                                                                    $ar=0;foreach($override->getNewsOrderBy('notification','region',$user->data()->region,'accessLevel','generalToRegion') as $genR){?>
                                                                <div class="container">
                                                                    <div class="feature-box feature-box-tertiary feature-box-style-3 appear-animation" data-appear-animation="fadeInUp" data-appear-animation-delay="0">
                                                                        <div class="feature-box-icon">
                                                                            <i class="fa fa-envelope"></i>
                                                                        </div>
                                                                        <div class="feature-box-info">
                                                                            <?php if($genR['attachment'] == ''){?>
                                                                                <h4 class="mb-sm"><a class="" href="#tamongscoH<?=$ar?>" data-toggle="modal" ><?=$genR['title']?></a></h4>
                                                                            <?php }else{?>
                                                                                <h4 class="mb-sm"><a href="readDocument.php?path=<?=$genR['attachment']?>" target="_blank"><?=$genR['title']?></a></h4>
                                                                            <?php } ?>

                                                                            <p class="mb-lg"><i>Posted on : </i><?=$genR['postTime']?></p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <?php if($genR['attachment'] == ''){?>
                                                                    <div class="modal fade" id = "tamongscoH<?=$ar?>" role="dialog" >
                                                                        <div class="modal-dialog">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h4><?=$genR['title']?></h4>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <?=$genR['message']?>
                                                                                    <div class="modal-footer">
                                                                                        <a class="btn btn-default " data-dismiss="modal">Ok</a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                             <?php }$ar++;}}
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <!------------------------------------ start change password  ------------------------------------------------------------------>
                        <div class="tab-pane tab-pane-navigation <?=$pass?>" id="tabsNavigation2">
                            <div class="featured-boxes">
                                <div class="row">
                                    <div class="col-md-offset-1 col-sm-10">
                                        <div class="featured-box featured-box-primary align-left mt-xlg">
                                            <div class="box-content">

                                                <form action="#" data-toggle="validator" method="post">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <?php if(Input::get('changePassword')){
                                                            echo '<label style="color: #ff0000"><strong>'.$errorMessage.'</strong></label>';
                                                            echo '<label style="color: #3f923f"><strong>'.$successMessage.'</strong></label>';
                                                            if(!$pageError == null){foreach($pageError as $error){
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
                                                            <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
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
                        <!--------------------------------- End of change password ------------------------------------------------------------------------------------------>

                        <!---------------------------------start of contact info -------------------------------------------------------------------------------------------->
                        <div class="tab-pane tab-pane-navigation <?=$info?>" id="tabsNavigation3">
                            <div class="featured-boxes">
                                <div class="row">
                                    <div class="col-md-offset-1 col-sm-10">
                                        <div class="featured-box featured-box-primary align-left mt-xlg">
                                            <div class="box-content">

                                                <form  data-toggle="validator" method="post">
                                                    <div class="row">
                                                        <div class="col-md-10">
                                                            <?php if(Input::get('updateInfo')){
                                                            echo '<label style="color: #ff0000"><strong>'.$errorMessage.'</strong></label>';
                                                            echo '<label style="color: #3f923f"><strong>'.$successMessage.'</strong></label>';
                                                            if(!$pageError == null){foreach($pageError as $error){
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
                        <!---------------------------------End of contact info -------------------------------------------------------------------------------------------->

                        <!---------------------------------Start of register member  -------------------------------------------------------------------------------------->
                        <?php if($user->isLoggedIn() && $user->data()->leader == 1){?>
                        <div class="tab-pane tab-pane-navigation <?=$reg?>" id="tabsNavigation4">
                            <div class="featured-boxes">
                                <div class="row">
                                    <div class="col-md-offset-1 col-sm-10">
                                        <div class="featured-box featured-box-primary align-left mt-xlg">
                                            <div class="box-content">

                                                <form action="#" data-toggle="validator" method="post">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <?php if(Input::get('registerUser')){if(!$errorMessage == null){
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
                                                                        <span class="icon"><i class="fa fa-user"></i></span>
                                                                    </span>
                                                                    <input class="form-control" name="firstname" type="text" placeholder="First Name" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="col-md-12">
                                                                <div class="input-group input-group-icon">
                                                                    <span class="input-group-addon">
                                                                        <span class="icon"><i class="fa fa-user"></i></span>
                                                                    </span>
                                                                    <input class="form-control" name="middlename" type="text" placeholder="Middle Name" >
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="col-md-12">
                                                                <div class="help-block with-errors"></div>
                                                                <div class="input-group input-group-icon">
                                                                    <span class="input-group-addon">
                                                                        <span class="icon"><i class="fa fa-user"></i></span>
                                                                    </span>
                                                                    <input class="form-control" name="lastname" type="text" placeholder="Last Name" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="col-md-12">
                                                                <select name="position" class="form-control mb-md">
                                                                    <option value=''> Select Member's Position </option>
                                                                    <option value='Chairperson'> Chairperson </option>
                                                                    <option value='Vice Chairperson'> Vice Chairperson </option>
                                                                    <option value='Secretary'> Secretary </option>
                                                                    <option value='Treasurer'> Treasurer </option>
                                                                    <option value='Member'> Member </option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="col-md-12">
                                                                <select name="jurisdiction_level" class="form-control mb-md">
                                                                    <option value=''> Select Jurisdiction </option>
                                                                    <option value='headquarter'> Headquarter </option>
                                                                    <option value='zonal'> Zonal </option>
                                                                    <option value='regional'> Regional </option>
                                                                    <option value='normalMember'> Normal Member </option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="col-md-12">
                                                                <select name="zone" id="zone" class="form-control mb-md">
                                                                    <option value=""> Select Zone</option>
                                                                    <?php if(!$zones == null){foreach($zones as $zone){if($user->data()->zone_name == $zone['id']){?>
                                                                        <option value="<?=$zone['id']?>"><?=$zone['name']?> </option>
                                                                    <?php }elseif($user->data()->zone_name == 'Headquarter'){ ?>
                                                                        <option value="<?=$zone['id']?>"><?=$zone['name']?> </option>
                                                                    <?php }}} ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="col-md-12">
                                                                <select name="region" id="region" class="form-control mb-md">
                                                                    <option value=""> Select Region </option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="col-md-12">
                                                                <div class="help-block with-errors"></div>
                                                                <div class="input-group input-group-icon">
                                                                    <span class="input-group-addon">
                                                                        <span class="icon"><i class="fa fa-phone"></i></span>
                                                                    </span>
                                                                    <input class="form-control" name="phone_number" type="text" maxlength="13" placeholder="Phone Number" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="col-md-12">
                                                                <div class="input-group input-group-icon">
                                                                    <span class="input-group-addon">
                                                                        <span class="icon"><i class="fa fa-phone"></i></span>
                                                                    </span>
                                                                    <input class="form-control" name="other_phone_number" type="text" maxlength="13" placeholder="Other Phone Number">
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
                                                                    <input class="form-control" name="email_address" type="email" placeholder="Email Address" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-offset-6 col-md-6">
                                                            <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                                                            <input type="submit" name="registerUser" value="Register Member" class="btn btn-primary pull-right mb-xl" data-loading-text="Loading...">
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---------------------------------End of register member  -------------------------------------------------------------------------------------->

                        <!---------------------------------Start of upload news   -------------------------------------------------------------------------------------->
                        <div class="tab-pane tab-pane-navigation <?=$upld?>" id="tabsNavigation5">
                            <div class="featured-boxes">
                                <div class="row">
                                    <div class="col-md-offset-1 col-sm-10">
                                        <div class="featured-box featured-box-primary align-left mt-xlg">
                                            <div class="box-content">

                                                <form action="#" enctype="multipart/form-data" data-toggle="validator" method="post">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <?php if(Input::get('uploadNews')){if(!$errorMessage == null){
                                                                echo '<label style="color: #ff0000"><strong>ERROR: '.$errorMessage.'</strong></label>';}elseif(!$successMessage==null){
                                                                echo '<label style="color: #3f923f"><strong>CONGRATULATION '.$successMessage.'</strong></label>';}
                                                                if(!$pageError == null){echo'<label style="color: #ff0000"><strong> ERRORS :  </strong></label>';foreach($pageError as $error){
                                                                    echo '<label style="color: #ff0000"><strong>'.$error.'</strong></label>'.' , ';
                                                                } echo '<br>';}}?>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="col-md-12">
                                                                <div class="help-block with-errors"></div>
                                                                <div class="input-group input-group-icon">
                                                                    <span class="input-group-addon">
                                                                        <span class="icon"><i class="fa fa-envelope-o"></i></span>
                                                                    </span>
                                                                    <input name="message_title" class="form-control" type="text" placeholder="Message Title" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="col-md-12">
                                                                <div class="help-block with-errors"></div>
                                                               <textarea name="message_body" class="form-control" rows="10" required></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                                                <div class="input-append">
                                                                    <div class="uneditable-input">
                                                                        <i class="fa fa-file fileupload-exists"></i>
                                                                        <span class="fileupload-preview"></span>
                                                                    </div>
                                                                        <span class="btn btn-default btn-file">
                                                                            <span class="fileupload-exists"></span>
                                                                            <span class="fileupload-new">Add Attachment Document</span>
                                                                            <input name="attachment" type="file" />
                                                                        </span>
                                                                    <button type="reset" class="btn btn-default fileupload-exists">Reset</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <select name="accessLevel" class="form-control mb-md">
                                                                <option value=""> Select who sees the announcement</option>
                                                                <?php if($user->data()->power_level == 'headquarter'){?>
                                                                    <option value="confidentialToZone"> Confidential to Zonal Leaders</option>
                                                                    <option value="confidentialToRegion"> Confidential to Regional Leaders</option>
                                                                    <option value="generalPublic"> General Public </option>
                                                                    <option value="generalToMember"> General to All Members </option>
                                                                    <option value="generalToZone"> General to Zone Members </option>
                                                                    <option value="generalToRegion"> General to Region Members</option>
                                                                    <option value="headquarter"> Headquarter </option>
                                                                <?php }elseif($user->data()->power_level == 'zonal'){?>
                                                                    <option value="confidentialToZone"> Confidential to Zonal Leaders</option>
                                                                    <option value="confidentialToRegion"> Confidential to Regional Leaders</option>
                                                                    <option value="zoneRegion"> Confidential to Zonal and Regional Leaders</option>
                                                                    <option value="allRegion"> Confidential to all Regional Leaders</option>
                                                                    <option value="generalToZone"> General to Zone Members </option>
                                                                    <option value="generalToRegion"> General to Region Members</option>
                                                                    <option value="generalPublic"> General Public </option>
                                                                <?php }elseif($user->data()->power_level == 'regional'){?>
                                                                    <option value="confidentialToRegion"> Confidential to Regional Leaders</option>
                                                                    <option value="generalToRegion"> General to Region Members</option>
                                                                    <option value="generalPublic"> General Public </option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <select name="zone" id="zone_id" class="form-control mb-md">
                                                                <option value=""> Select Zone</option>
                                                                <?php if(!$zones == null){foreach($zones as $zone){if($user->data()->zone_name == $zone['id']){?>
                                                                    <option value="<?=$zone['id']?>"><?=$zone['name']?> </option>
                                                                <?php }elseif($user->data()->zone_name == 'Headquarter'){ ?>
                                                                    <option value="<?=$zone['id']?>"><?=$zone['name']?> </option>
                                                                <?php }}} ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <select name="region" id="region_id" class="form-control mb-md">
                                                                <option value=""> Select Region </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-offset-6 col-md-6">
                                                            <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                                                            <input type="submit" name="uploadNews" value="Upload Announcement" class="btn btn-primary pull-right mb-xl" data-loading-text="Loading...">
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---------------------------------End of upload news   -------------------------------------------------------------------------------------->
                        <?php } ?>
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

    $(document).ready(function(){
        $('#zone').change(function(){
            var zone_id = $(this).val();
            $.ajax({
                url:"dataProcess.php?content=zone",
                method:"GET",
                data:{zoneId:zone_id},
                dataType:"text",
                success:function(data){
                    $('#region').html(data);
                }
            });
        });
    });

    $(document).ready(function(){
        $('#zone_id').change(function(){
            var zone_id = $(this).val();
            $.ajax({
                url:"dataProcess.php?content=zone",
                method:"GET",
                data:{zoneId:zone_id},
                dataType:"text",
                success:function(data){
                    $('#region_id').html(data);
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
