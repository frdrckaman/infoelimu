<?php
require_once'php/core/init.php';
$user = new User();$smsCount=false;
$override = new OverideData();$regCon = null;$CV = false;$cont = false;$upld = null;$upTch = null;$upGn = null;$file = false;
$checkUser = 0;$news = null; $info = null;$pass = null;$pageError = null; $errorMessage = null; $successMessage = null;$regT = null;
$upldCont = null;$errorC = false;$teachers = null;$upldError = false;$attachment_file = '';$listT=null;$errorC = false;$errorUp=false;
if($user->getSessionTable() === 'org_member'){
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
                $user->updateRecord('teachers',array(
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
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    if(Input::get('updateInfo')){ $info = 'active';
        $news = null; $pass = null; $reg = null; $upld = null;
        $validate = new validate();
        $validation = $validate->check($_POST, array(
            'phone_number' => array(
                'required' => true,
                'min' => 10,
                'max' => 13,
                'unique' => 'teachers'
            ),
            'other_phone_number' => array(
                'min' => 10,
                'max' => 13
            ),
            'email_address' => array(
                'required' => true,
                'min' => 6,
                'unique' => 'teachers'
            )
        ));
        if ($validation->passed()) {
            $salt = Hash::salt(32);
            $user->updateRecord('teachers',array(
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
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    if(Input::get('teacherReg')){ $regT = 'active';$news = null;
        $validate = new validate();
        $validate = $validate->check($_POST, array(
            'firstname' => array(
                'required' => true,
                'min' => 1,
            ),
            'middlename' => array(
                'min' => 1,
            ),
            'lastname' => array(
                'required' => true,
                'min' => 2,
            ),
            'gender' => array(
                'required' => true,
            ),
            'position' => array(
                'required' => true,
            ),
            'phone_number' => array(
                'min' => 10,
                'max' => 13,
                'required' => true,
                'unique' => 'teachers'
            ),
            'school' => array(
                'required' => true,
            ),
            'other_phone_number' => array(
                'unique' => 'teachers'
            ),
            'email_address' => array(
                'min' => 6,
                'unique' => 'teachers'
            ),
        ));
        if ($validate->passed()) {
            $salt = Hash::salt(32);
            $password = '123456';
            try {
                $user->createRecord('teachers', array(
                    'firstname' => Input::get('firstname'),
                    'middlename' => Input::get('middlename'),
                    'lastname' => Input::get('lastname'),
                    'gender' => Input::get('gender'),
                    'school_id' => Input::get('school'),
                    'position' => Input::get('position'),
                    'class_teacher' => '',
                    'stream' => '',
                    'phone_number' => Input::get('phone_number'),
                    'other_phone_number' => Input::get('other_phone_number'),
                    'email_address' => Input::get('email_address'),
                    'password' => Hash::make($password, $salt),
                    'salt' => $salt,
                    'org_id' => $user->data()->org_id
                ));
                $successMessage = 'Teacher have been Successful Registered';
             
            } catch (Exception $e) {
                die($e->getMessage());
            }
        } else {
            $pageError = $validate->errors();
        }
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    if(Input::get('uploadCont')){ $upldCont = 'active';
        if (!empty($_FILES['attach_contract']["tmp_name"])) {
            $attach_file = $_FILES['attach_contract']['type'];
            if ($attach_file == "application/pdf" || $attach_file == "application/vnd.openxmlformats-officedocument.wordprocessingml.document" || $attach_file == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet") {
                $folderName = 'attachment/contracts/';
                $attachment_file = $folderName . basename($_FILES['attach_contract']['name']);
                if (move_uploaded_file($_FILES['attach_contract']["tmp_name"], $attachment_file)) {
                    $file = true;
                } else {
                    $errorMessage = 'File Not Uploaded ,';$errorC = true;
                }
            } else $errorMessage = 'None supported file format';//not supported format
            $errorC = true;
        } //else $errorMessage = 'No attached file ,';//no attached file

        $validate = new validate();
        $validate = $validate->check($_POST, array(
            'teacher' => array(
                'required' => true,
            ),
            'start_date' => array(
                'required' => true,
            ),
            'end_date' => array(
                'required' => true,
            ),
        ));

        if ($validate->passed() && $errorC == false) {
            $techSchool = $override->get('teachers','id',Input::get('teacher'));
            try {
                $user->createRecord('contract', array(
                    'start_date' => Input::get('start_date'),
                    'end_date' => Input::get('end_date'),
                    'teacher_id' => Input::get('teacher'),
                    'school_id' => $techSchool[0]['school_id'],
                    'org_id' => $user->data()->org_id,
                    'contract_doc'=>$attachment_file,
                   ));
                $successMessage = 'Contract have been successfully uploaded';
            } catch (Exception $e) {
                die($e->getMessage());
            }
        } else {
            $pageError = $validate->errors();
        }
    }
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    if(Input::get('uploadNews')) {$upld = 'active';
        if (!empty($_FILES['attachment']["tmp_name"])) {
            $attach_file = $_FILES['attachment']['type'];
            if ($attach_file == "application/pdf" || $attach_file == "application/vnd.openxmlformats-officedocument.wordprocessingml.document" || $attach_file == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet") {
                $folderName = 'attachment/school_notification/';
                $attachment_file = $folderName . basename($_FILES['attachment']['name']);
                if (move_uploaded_file($_FILES['attachment']["tmp_name"], $attachment_file)) {
                    $file = true;
                } else {
                    {
                        $errorUp = true;
                        $errorMessage = 'File Not Uploaded ,';
                    }
                }
            } else {
                $errorUp = true;
                $errorMessage = 'None supported file format';
            }//not supported format
        } //else $errorMessage = 'No attached file ,';//no attached file
        // print_r($error);
        if (Input::get('teacher') == null && Input::get('postTo') == 'teachers') {
            $upldError = true;
            $errorMessage = 'Teacher is required ,';
        }
        $validate = new validate();
        $validate = $validate->check($_POST, array(
            'message_title' => array(
                'required' => true,
            ),
            'message_body' => array(
                'required' => true,
            ),
        ));
        if (Input::get('postTo') == 'teachers') {$upTch = 'active';
            if ($validate->passed() && $upldError == false && $errorUp == false){
                if(Input::get('postTo') == 'teachers'){$upTch = 'active';$cnt=0;
                    foreach(Input::get('teacher') as $count){$cnt++;}
                    $orgId = $override->get('edu_org', 'id', $user->data()->org_id);
                    $bundleId = $override->getNews('bundle_usage', 'org_name', 'edu_org', 'org_id', $orgId[0]['id']);
                    if ($user->validateBundle(Input::get('message_body'), $cnt, $bundleId[0]['id'])) {
                        $checkPoint = true;
                    }
                    foreach(Input::get('teacher') as $teacher){
                        if($teacher == 'all'){
                            $noMembers = $override->getCount('teachers','org_id',$user->data()->org_id);
                            $orgId = $override->get('edu_org','id',$user->data()->org_id);
                            $bundleId = $override->getNews('bundle_usage','org_name','edu_org','org_id',$orgId[0]['id']);
                            if($user->validateBundle(Input::get('message_body'),$noMembers,$bundleId[0]['id'])) {$smsCount=true;
                                foreach ($override->getNews('teachers','org_id',$user->data()->org_id,'position','Headmaster') as $orgTeacher) {
                                    $user->sendSMS($orgTeacher['phone_number'],Input::get('message_body'));
                                    $remainSms = $override->getNews('bundle_usage', 'org_name', 'edu_org', 'org_id', $orgId[0]['id'])[0]['sms'] - $user->countWords(Input::get('message_body'), 1);

                                    $user->updateRecord('bundle_usage', array(
                                        'sms' => $remainSms,
                                    ), $override->getNews('bundle_usage', 'org_name', 'edu_org', 'org_id', $bundleId[0]['org_id'])[0]['id']);
                                }
                            }
                            if($smsCount==true){
                            try {
                                $user->createRecord('school_notification', array(
                                    'title' => Input::get('message_title'),
                                    'message' => Input::get('message_body'),
                                    'org_news' => $user->data()->org_id,
                                    'school_news'=>'teacherAll',
                                    'attachment' => $attachment_file,
                                    'postTime' => date('d-m-Y'),
                                ));
                                $successMessage = 'The announcement has been successfully uploaded';
                                break;
                            } catch (Exception $e) {

                                die($e->getMessage());
                            }}else{$errorMessage = "There is no sufficient messages please recharge!";}
                        }else {
                            $noT = 0;
                            if($checkPoint){
                                $getTechInfo = $override->get('teachers', 'id', $teacher);
                                $noMembers = $override->getCount('teachers', 'org_id', $user->data()->org_id);
                                $orgId = $override->get('edu_org', 'id', $user->data()->org_id);
                                $bundleId = $override->getNews('bundle_usage', 'org_name', 'edu_org', 'org_id', $orgId[0]['id']);
                                if ($user->validateBundle(Input::get('message_body'), $noMembers, $bundleId[0]['id'])) {$smsCount=true;
                                     $user->sendSMS($getTechInfo[0]['phone_number'],Input::get('message_body'));
                                    $remainSms = $override->getNews('bundle_usage', 'org_name', 'edu_org', 'org_id', $orgId[0]['id'])[0]['sms'] - $user->countWords(Input::get('message_body'), 1);

                                    $user->updateRecord('bundle_usage', array(
                                        'sms' => $remainSms,
                                    ), $override->getNews('bundle_usage', 'org_name', 'edu_org', 'org_id', $bundleId[0]['org_id'])[0]['id']);
                                }
                                    if($smsCount==true){
                                try {
                                     $user->createRecord('school_notification', array(
                                         'title' => Input::get('message_title'),
                                         'message' => Input::get('message_body'),
                                         'teacher_id' => $teacher,
                                         'school_id' => $getTechInfo[0]['school_id'],
                                         'attachment' => $attachment_file,
                                         'postTime' => date('d-m-Y'),
                                     ));
                                    $successMessage = 'The announcement has been successfully uploaded';
                                } catch (Exception $e) {
                                    die($e->getMessage());
                                }
                                    }
                                    else{$errorMessage = "There is no sufficient messages please recharge!";}
                            }
                        }
                    }
                }
            } else {
                $pageError = $validate->errors();
            }
        }

        elseif(Input::get('postTo') === 'generalNews'){ $upGn = 'active';
        if ($validate->passed() && $errorUp == false){$upGn = 'active';
            try {
                $user->createRecord('school_notification', array(
                    'title' => Input::get('message_title'),
                    'message' => Input::get('message_body'),
                    'org_news' => $user->data()->org_id,
                    'general_news'=>1,
                    'attachment' => $attachment_file,
                    'postTime' => date('d-m-Y'),
                ));
                $successMessage = 'The announcement has been successfully uploaded';
            } catch (Exception $e) {
                die($e->getMessage());
            }
        } else {
            $pageError = $validate->errors();
        }
    }
    }
    if(Input::get('deleteTeacher') == 'del'){ $listT='active';
        $user->deleteRecord('contract','teacher_id',Input::get('delT'));
        $listT = 'active';
    }
  }else{$news = 'active';$upTch = 'active';}
}else{Redirect::to('index.php');}
?>
<!DOCTYPE html>
<html>
<head>

    <!-- Basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Info-Elimu | Catholic Moshi </title>

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
    <link rel="stylesheet" href="css/bootstrap-datepicker.min.css">
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
            <li>
                <a href="#tabsNavigation4" data-toggle="tab"><i class="fa fa-adjust"></i> List of Teachers</a>
            </li>
            <li>
                <a href="#tabsNavigation5" data-toggle="tab"><i class="fa fa-adjust"></i> Contract About to Expire </a>
            </li>
            <li>
                <a href="#tabsNavigation6" data-toggle="tab"><i class="fa fa-adjust"></i> Contract Expired </a>
            </li>
            <li class="<?=$regT?>">
                <a href="#tabsNavigation7" data-toggle="tab"><i class="fa fa-adjust"></i> Register New Teacher </a>
            </li>
            <li class="<?=$upldCont?>">
                <a href="#tabsNavigation8" data-toggle="tab"><i class="fa fa-adjust"></i> Register New Contract </a>
            </li>
            <li class="<?=$upld?>">
                <a href="#tabsNavigation9" data-toggle="tab"><i class="fa fa-adjust"></i> Upload New Announcement </a>
            </li>
        </ul>
    </div>
</div>
<div class="col-md-8">
    <!------------------------------------ tab1  --------------------------------------------------------------------------------------->
    <div class="tab-pane tab-pane-navigation <?=$news?>" id="tabsNavigation1">
        <div class="container">
            <div class="row">
                <?php if($override->get('school_notification','org_news',$user->data()->org_id)){
                foreach($override->get('school_notification','org_news',$user->data()->org_id) as $orgNews){?>
                <div class="col-md-offset-1 col-md-8">
                    <div class="feature-box feature-box-tertiary feature-box-style-6 appear-animation" data-appear-animation="fadeInUp" data-appear-animation-delay="0">
                        <div class="feature-box-icon">
                            <i class="icon-envelope icons"></i>
                        </div>
                        <div class="feature-box-info">
                            <h5 class="mb-sm"><a href="readDocument.php?path=<?=$orgNews['attachment']?>" target="_blank"><?=$orgNews['title']?></a></h5>
                            <p class="mb-sm"><i>Posted on : </i><?=$orgNews['postTime']?></p>
                        </div>
                    </div>
                </div>
                <?php }}else{ ?>
                    <div class="col-md-offset-0"><h4>No news amd Announcement at the moment</h4></div>
                <?php }?>
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
    <div class="tab-pane tab-pane-navigation <?=$listT?>" id="tabsNavigation4">
        <div class="container col-md-12">
            <table class="table table-bordered table-striped mb-none" id="datatable-editable">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Teacher Name</th>
                    <th>School</th>
                    <th>Attached Document</th>
                    <th>Contract Duration</th>
                    <th>Remaining Time</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
               <?php $x = 1; foreach($override->get('contract','org_id',$user->data()->org_id) as $orgTeacher){
                      $teacherName = $override->get('teachers','id',$orgTeacher['teacher_id']);
                      $teacherSchool = $override->get('schools','id',$teacherName[0]['school_id']);
                      $contractDuration = $override->getDate($orgTeacher['start_date'],$orgTeacher['end_date']);//print_r($contractDuration);
                      $today = date('Y-m-d');$remainDays = $override->getDate($today,$orgTeacher['end_date']);//print_r($remainDays);
                   ?>
                       <tr data-item-id="1">
                           <td><?=$x?></td>
                           <td><?=$teacherName[0]['firstname'].' '.$teacherName[0]['middlename'].' '.$teacherName[0]['lastname']?></td>
                           <td><?=$teacherSchool[0]['name'].' '.$teacherSchool[0]['category']?></td>
                           <td><a href="readDocument.php?path=<?=$orgTeacher['contract_doc']?>" target="_blank">Contract Document</a></td>
                           <td><?if($contractDuration[0]['endDate']<0){echo 0;}else{echo $contractDuration[0]['endDate']; }?></td>
                           <td><?php if($remainDays[0]['endDate'] > 0){echo $remainDays[0]['endDate'];}else{echo 0;}?></td>
                           <td class="actions">
                               <a href="editContract.php?data=contract&group=contract&content=<?=$orgTeacher['teacher_id']?>&message=" class="on-default edit-row"><i class="fa fa-pencil"></i></a>
                               <form method="post">
                               <input type="hidden" name="delT" value="<?=$teacherName[0]['id']?>">
                               <button type="submit" name="deleteTeacher" value="del" class="on-default remove-row" onclick="javascript: return confirm('Are you SURE you wish to delete this Record?');" ><i class="fa fa-trash-o"></i></button>
                               </form>
                           </td>
                       </tr>
                <?php $x++; } ?>
                </tbody>
            </table>
        </div>
    </div>
    <!----------------------------------- tab5 Teacher List ---------------------------------------------------------------------------->
    <div class="tab-pane tab-pane-navigation" id="tabsNavigation5">
        <div class="container col-md-12">
            <table class="table table-bordered table-striped mb-none" id="datatable-editable">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Teacher Name</th>
                    <th>School</th>
                    <th>Remaining Time</th>
                </tr>
                </thead>
                <tbody>
                <?php $y = 1; foreach($override->get('contract','org_id',$user->data()->org_id) as $orgTeacher){
                    $remainTime = $override->getDate($today,$orgTeacher['end_date']);
                    if($remainTime[0]['endDate'] <= 90 && $remainTime[0]['endDate'] > 0){
                        $teacherName = $override->get('teachers','id',$orgTeacher['teacher_id']);
                        $teacherSchool = $override->get('schools','id',$teacherName[0]['school_id']);
                    ?>
                <tr data-item-id="1">
                    <td><?=$y?></td>
                    <td><?=$teacherName[0]['firstname'].' '.$teacherName[0]['middlename'].' '.$teacherName[0]['lastname']?></td>
                    <td><?=$teacherSchool[0]['name'].' '.$teacherSchool[0]['category']?></td>
                    <td><?=$remainTime[0]['endDate']?></td>
                </tr>
                <?php }$y++;} ?>
                </tbody>
            </table>
        </div>
    </div>
    <!----------------------------------- tab6  Results -------------------------------------------------------------------------------->
    <div class="tab-pane tab-pane-navigation" id="tabsNavigation6">
            <div class="container col-md-12">
                <table class="table table-bordered table-striped mb-none" id="datatable-editable">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Teacher Name</th>
                        <th>School</th>
                        <th>Remaining Time</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $k = 0; foreach($override->get('contract','org_id',$user->data()->org_id) as $orgTeacher){
                    $remainTime = $override->getDate($today,$orgTeacher['end_date']);
                    if($remainTime[0]['endDate'] <= 0){
                    $teacherName = $override->get('teachers','id',$orgTeacher['teacher_id']);
                    $teacherSchool = $override->get('schools','id',$teacherName[0]['school_id']);
                    ?>
                    <tr data-item-id="1">
                        <td><?=$k?></td>
                        <td><?=$teacherName[0]['firstname'].' '.$teacherName[0]['middlename'].' '.$teacherName[0]['lastname']?></td>
                        <td><?=$teacherSchool[0]['name'].' '.$teacherSchool[0]['category']?></td>
                        <td style="color: #ff0000"><strong>Expired</strong></td>
                    </tr>
                    <?php }$k++;}?>
                    </tbody>
                </table>
            </div>
        </div>
    <!----------------------------------- tab7  Results -------------------------------------------------------------------------------->
    <div class="tab-pane tab-pane-navigation <?=$regT?>" id="tabsNavigation7">
        <div class="featured-boxes">
            <div class="row">
                <div class="col-md-offset-1 col-sm-10">
                    <div class="featured-box featured-box-primary align-left mt-xlg">
                        <div class="box-content">

                            <form action="#" data-toggle="validator" method="post">
                                <div class="row">
                                    <div class="col-md-12">
                                        <?php if(Input::get('teacherReg')){if(!$errorMessage == null){
                                            echo '<label style="color: #ff0000"><strong>'.$errorMessage.'</strong></label>';}elseif(!$successMessage==null){
                                            echo '<label style="color: #3f923f"><strong>'.$successMessage.'</strong></label>';}
                                            if(!$pageError == null){echo '<label style="color: #ff0000"><strong> ERRORS :  </strong></label>';foreach($pageError as $error){
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
                                                <input class="form-control" name="middlename" type="text" placeholder="Middle Name">
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
                                            <select name="gender" class="form-control mb-md">
                                                <option>Select Gender</option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <select name="school" class="selectpicker form-control mb-md" data-live-search="true" title="Select School" required>
                                                <?php foreach($override->get('schools','org_id',$user->data()->org_id) as $orgSchools){?>
                                                    <option value="<?=$orgSchools['id']?>"><?=$orgSchools['name'].' '.$orgSchools['category']?></option>
                                                <?php }?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="help-block with-errors"></div>
                                        <select name="position"  class="selectpicker form-control mb-md" data-live-search="true" title="Choose Teacher's Position" required>
                                            <option value="Headmaster">Headmaster/Headmistress</option>
                                            <option value="SecondMaster">Second(Master/Mistress)</option>
                                            <option value="Academic">Academic(Master/Mistress)</option>
                                            <option value="Discipline">Discipline(Master/Mistress)</option>
                                            <option value="NormalTeacher">Normal Teacher</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <div class="help-block with-errors"></div>
                                            <div class="input-group input-group-icon">
                                                <span class="input-group-addon">
                                                    <span class="icon"><i class="fa fa-phone"></i></span>
                                                </span>
                                                <input class="form-control" type="text" name="phone_number" maxlength="13" placeholder="Phone Number" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <div class="input-group input-group-icon">
                                                <span class="input-group-addon">
                                                    <span class="icon"><i class="fa fa-phone"></i></span>
                                                </span>
                                                <input class="form-control" type="text" name="other_phone_number" placeholder="Other Phone Number">
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
                                                <input class="form-control" type="email" name="email_address" placeholder="Email Address" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-offset-6 col-md-6">
                                        <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                                        <input type="submit" value="Register Teacher" name="teacherReg" class="btn btn-primary pull-right mb-xl" data-loading-text="Loading...">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    <!----------------------------------- tab8  Results -------------------------------------------------------------------------------->
    <div class="tab-pane tab-pane-navigation <?=$upldCont?>" id="tabsNavigation8">
        <div class="featured-boxes">
            <div class="row">
                <div class="col-md-offset-1 col-sm-10">
                    <div class="featured-box featured-box-primary align-left mt-xlg">
                        <div class="box-content">
                            <form action="#" enctype="multipart/form-data" data-toggle="validator" method="post">
                                <div class="row">
                                    <div class="col-md-12">
                                        <?php if(Input::get('uploadCont')){
                                            echo '<label style="color: #ff0000"><strong>'.$errorMessage.'</strong></label>';
                                            echo '<label style="color: #3f923f"><strong>'.$successMessage.'</strong></label>';
                                            if(!$pageError == null){foreach($pageError as $error){
                                                echo '<label style="color: #ff0000"><strong>'.$error.'</strong></label>'.' , ';
                                            } echo '<br>';}}?>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <div class="help-block with-errors"></div>
                                            <select name="teacher" id="teacher" class="selectpicker form-control mb-md" data-live-search="true" title="Choose Teacher" >
                                                <?php foreach($override->get('teachers','org_id',$user->data()->org_id) as $teacher){?>
                                                    <option value="<?=$teacher['id']?>"><?=$teacher['firstname'].' '.$teacher['middlename'].' '.$teacher['lastname']?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <div class="help-block with-errors"></div>
                                            <div class="input-group input-group-icon">
                                                <span class="input-group-addon">
                                                    <span class="icon"><i class="fa fa-calendar"></i></span>
                                                </span>
                                                <input name="start_date" id="start_date" class="form-control" type="date" placeholder="Contract Beginning Date" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <div class="help-block with-errors"></div>
                                            <div class="input-group input-group-icon">
                                                <span class="input-group-addon">
                                                    <span class="icon"><i class="fa fa-calendar"></i></span>
                                                </span>
                                                <input name="end_date" id="end_date" class="form-control" type="date" placeholder="Contract End Date" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12" id="file_attached">
                                        <div class="fileupload fileupload-new" data-provides="fileupload">
                                            <div class="input-append">
                                                <div class="uneditable-input">
                                                    <i class="fa fa-file fileupload-exists"></i>
                                                    <span class="fileupload-preview"></span>
                                                </div>
                                                <span class="btn btn-default btn-file">
                                                    <span class="fileupload-exists"></span>
                                                    <span class="fileupload-new">Add Attachment Document</span>
                                                    <input name="attach_contract" type="file" />
                                                </span>
                                                <button type="reset" class="btn btn-default fileupload-exists">Reset</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12" id="teacher_news">

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-offset-6 col-md-6">
                                        <input type="submit" name="uploadCont" value="Upload Contract" class = "btn btn-primary pull-right mb-xl" >
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!----------------------------------- tab9  Results -------------------------------------------------------------------------------->
    <div class="tab-pane tab-pane-navigation <?=$upld?>" id="tabsNavigation9">
    <div class="featured-boxes">
    <div class="row">
    <div class="col-md-12">
    <div class="tabs">
    <ul class="nav nav-tabs nav-justified">
        <li class="<?=$upTch?>">
            <a href="#teachers" data-toggle="tab" class="text-center"> Teachers</a>
        </li>
        <li class="<?=$upGn?>">
            <a href="#general" data-toggle="tab" class="text-center">General News</a>
        </li>
    </ul>
    <div class="tab-content">
    <div id="teachers" class="tab-pane <?=$upTch?>">
        <div class="featured-boxes">
            <div class="row">
                <div class="col-sm-12">
                    <div class="featured-box featured-box-primary align-left mt-xlg">
                        <div class="box-content">
                            <form action="#" enctype="multipart/form-data" data-toggle="validator" method="post">
                                <div class="row">
                                    <div class="col-md-12">
                                        <?php if(Input::get('uploadNews') && Input::get('postTo') == 'teachers'){
                                            echo '<label style="color: #ff0000"><strong>'.$errorMessage.'</strong></label>';
                                            echo '<label style="color: #3f923f"><strong>'.$successMessage.'</strong></label>';
                                            if(!$pageError == null){foreach($pageError as $error){
                                                echo '<label style="color: #ff0000"><strong>'.$error.'</strong></label>'.' , ';
                                            } echo '<br>';}}?>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <div class="help-block with-errors"></div>
                                            <select name="teacher[]" id="teacher" class="selectpicker form-control mb-md" data-live-search="true" multiple title="Choose Teacher" required>
                                                <option value="all">All</option>
                                                <?php foreach($override->getNews('teachers','org_id',$user->data()->org_id,'position','Headmaster') as $teacher){?>
                                                    <option value="<?=$teacher['id']?>"><?=$teacher['firstname'].' '.$teacher['middlename'].' '.$teacher['lastname']?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
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
                                    <div class="col-md-12" id="file_attached">
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
                                <div class="row">
                                    <div class="col-md-offset-6 col-md-6">
                                        <input type="hidden" name="postTo" value="teachers">
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
    <div id="general" class="tab-pane <?=$upGn?>">
        <div class="featured-boxes">
            <div class="row">
                <div class="col-sm-12">
                    <div class="featured-box featured-box-primary align-left mt-xlg">
                        <div class="box-content">
                            <form action="#" enctype="multipart/form-data" data-toggle="validator" method="post">
                                <div class="row">
                                    <div class="col-md-12">
                                        <?php if(Input::get('uploadNews') && Input::get('postTo') == 'generalNews'){
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
                                                    <span class="icon"><i class="fa fa-envelope-o"></i></span>
                                                </span>
                                                <input name="message_title" class="form-control" type="text" placeholder="Message Title" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <div class="help-block with-errors"></div>
                                            <textarea name="message_body" class="form-control" rows="10" ></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12" id="file_attached2">
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
                                <div class="row">
                                    <div class="col-md-offset-6 col-md-6">
                                        <input type="hidden" name="postTo" value="generalNews">
                                        <input type="submit" name="uploadNews" value="Upload Announcement" class="btn btn-primary pull-right mb-xl" data-loading-text="Loading...">  </div>
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
    </div>
    </div>
    </div>
    <!---------------------------------------------------------------------------------------------------------------------------------->

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
<script src="vendor/jquery/bootstrap-datepicker.min.js"></script>
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
        $('#yearOfStudy').change(function(){
            var study_year = $(this).val();
            $.ajax({
                url:"dataProcess.php?content=year&school=<?=$students[0]['school_id']?>&student=<?=$students[0]['id']?>",
                method:"GET",
                data:{getYear:study_year},
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
