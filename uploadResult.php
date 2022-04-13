<?php
require_once'php/core/init.php';
$user = new User();$errorMessage=null;$successMessage=null;$pageError=null;$subjectName=null;$className=null;$streamName=null;
$override = new OverideData();$results=null;$studentId=null;$studentsNo=null;$done=0;
if($user->isLoggedIn()){
if($user->getSessionTable() === 'teachers') {
    if (Input::exists('post')) {
        if (Input::get('selectResult')) {
            $streamName = $_GET['stream'];
            $validate = new validate();
            $validate = $validate->check($_POST, array(
                'subject' => array(
                    'required' => true,
                ),
                'class' => array(
                    'required' => true,
                ),
                'stream' => array(
                    'required' => true,
                ),
            ));
            if ($validate->passed()) {
                $getResult = $override->getCounted('students','school_id',$user->data()->school_id, 'class_id', Input::get('class'), 'stream', Input::get('stream'));
                $red = 'uploadResult.php?school=' . $user->data()->school_id . '&class=' . Input::get('class') . '&stream=' . Input::get('stream') . '&type=' . Input::get('exam') . '&num=' . $getResult . '&sub=' . Input::get('subject').'&f=1&id=0';
                $red1 = 'uploadResult.php?school=' . $user->data()->school_id . '&class=' . Input::get('class') . '&stream=' . Input::get('stream') . '&type=' . Input::get('exam') . '&num=' . $getResult . '&sub=' . Input::get('subject').'&f=2&id=1';
                if($_GET['id']==0){Redirect::to($red);}elseif($_GET['id']==1){Redirect::to($red1);}elseif($_GET['id']==0){Redirect::to($red);}elseif($_GET['id']==1){Redirect::to($red1);}
            } else {
                $pageError = $validate->errors();
                $validateSearch = true;
            }
        }
        if(Input::get('uploadResult')){$upldR = 'active';$y = 0;
        if ($override->checkRepeatExam('results', 'school_id', $user->data()->school_id, 'subject_id', $_GET['sub'], 'exam_id', $_GET['type'], 'class_id', $_GET['class'], 'years', date('Y'), 'stream', $_GET['stream']) == null) {
            foreach ($_POST['student'] as $send) {
                $student = $override->get('students', 'id', Input::get('student')[$y]);
            }//upload stream and use it to compare
            while ($y < $_GET['num']) {
                try {
                    $user->createRecord('results', array(
                        'school_id' => $user->data()->school_id,
                        'student_id' => Input::get('student')[$y],
                        'subject_id' => $_GET['sub'],
                        'exam_id' => $_GET['type'],
                        'score' => Input::get('score')[$y],
                        'issued_date' => date('Y/m/d'),
                        'exam_date' => Input::get('examDate'),
                        'class_id' => $_GET['class'],
                        'years' => date('Y'),
                        'stream' => $_GET['stream'],
                    ));
                    // foreach(Input::get('student')[$y] as ){}
                    $student = $override->get('students', 'id', Input::get('student')[$y]);
                    $parent = $override->get('parents', 'id', $student[0]['parent_id']);
                    $text = 'Physic Exam Result for ' . $student[0]['firstname'] . ' ' . $student[0]['lastname'] . ' Score : ' . Input::get('score')[$y];
                    // $user->sendSMS($parent[0]['phone_number'],$text);
                    $successMessage = 'Student Results Successful Uploaded';
                } catch (PDOException $e) {
                    die($e->getMessage());
                }
                $y++;
            }
        } else {
            $errorMessage = 'Records Already Exist';
          }
        }
        if(Input::get('edit_p')){
            $validate = new validate();
            $validate = $validate->check($_POST, array(
                'firstname' => array(
                    'required' => true,
                ),
                'lastname' => array(
                    'required' => true,
                ),
                'phone_number' => array(
                    'required' => true,
                ),
            ));
            if ($validate->passed()) {
                try{
                    $user->updateRecord('parents',array(
                        'firstname' => Input::get('firstname'),
                        'middlename'=>Input::get('middlename'),
                        'lastname'=>Input::get('lastname'),
                        'phone_number'=>Input::get('phone_number')
                    ),Input::get('id'));
                    $successMessage='Parent information updated successful';
                } catch(Exception $e){
                    die($e->getMessage());
                }
                } else {
                $pageError = $validate->errors();
                $validateSearch = true;
            }
        }
    }

    }else{Redirect::to('login.php');}
}else{Redirect::to('login.php');}
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
    <link rel="stylesheet" href="css/bootstrap-datepicker3.min.css">
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
    <div class="container">
        <div class="col-md-10 col-md-offset-1">
            <section class="panel">
                <!--<header class="panel-heading">
                    <div class="panel-actions">
                        <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                        <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
                    </div>
                    <h2 class=""> Results</h2>
                </header>--><br><br><br>
                <?php if($_GET['id']==0){echo'<h2>Uploading Students Results</h2>';}
                elseif($_GET['id']==1){echo'<h2>Students Results</h2>';}
                elseif($_GET['id']==1){echo'<h2>Students Results</h2>';}?>
                <?php if($_GET['id']==9){?>
                <?php }else{?>
                    <form method="post">
                        <div class="form-group">
                            <div class="col-md-3">
                                <select name="exam" class="selectpicker form-control mb-md" data-live-search="true" title="Examination" required="">
                                    <?php foreach($override->getData('exam_type') as $exam){ ?>
                                        <option value="<?=$exam['id']?>"><?=$exam['name']?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <select name="subject" class="selectpicker form-control mb-md" data-live-search="true" title="Subject" required="">
                                    <?php foreach($override->getSelectNoRepeat('teaching_subject','subject_id','school_id',$user->data()->school_id,'teacher_id',$user->data()->id) as $teachClass){
                                        foreach($override->get('subjects','id',$teachClass['subject_id']) as $teachSubject){?>
                                            <option value="<?=$teachSubject['id']?>"><?=$teachSubject['name']?></option>
                                        <?php }} ?>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <select name="class" class="selectpicker form-control mb-md" data-live-search="true" title="Class" required>
                                    <?php foreach($override->getSelectNoRepeat('teaching_subject','class_id','school_id',$user->data()->school_id,'teacher_id',$user->data()->id) as $teachClass){
                                        foreach($override->get('class_list','id',$teachClass['class_id']) as $teachSubject){?>
                                            <option value="<?=$teachSubject['id']?>"><?=$teachSubject['class_name']?></option>
                                        <?php }} ?>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <select name="stream" class="selectpicker form-control mb-md" data-live-search="true" title="Stream" required>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="C">C</option>
                                    <option value="D">D</option>
                                    <option value="E">E</option>
                                    <option value="F">F</option>
                                    <option value="G">G</option>
                                    <option value="H">H</option>
                                    <option value="I">I</option>
                                    <option value="J">J</option>
                                    <option value="K">K</option>
                                    <option value="L">L</option>
                                    <option value="M">M</option>
                                    <option value="N">N</option>
                                    <option value="O">O</option>
                                    <option value="P">P</option>
                                    <option value="Q">Q</option>
                                    <option value="R">R</option>
                                    <option value="S">S</option>
                                    <option value="T">T</option>
                                    <option value="U">U</option>
                                    <option value="V">V</option>
                                    <option value="W">W</option>
                                    <option value="X">X</option>
                                    <option value="Y">Y</option>
                                    <option value="Z">Z</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <select name="year" class="selectpicker form-control mb-md" data-live-search="true" title="" required>
                                    <option value="<?=date('Y')?>"><?=date('Y')?></option>
                                    <?php foreach($override->getNoRepeatOrderBy('results','years','school_id',$user->data()->school_id) as $year){
                                        if($year['years'] == date('Y')){}else{?>
                                            <option value="<?=$year['years']?>"><?=$year['years']?></option>
                                        <?php }} ?>
                                </select>
                            </div>
                            <div class="col-md-1">
                                <input type="hidden" name="done" value="ItsDone">
                                <input type="submit" value="Select" id="selectResult" name="selectResult" class="btn btn-primary pull-right mb-xl" data-loading-text="Loading...">
                            </div>
                        </div>
                    </form>
                <?php }if($successMessage){?>
                    <div class="alert alert-success">
                        <strong>Well done! </strong><?=$successMessage?>
                    </div>
                <?php }elseif($errorMessage){?>
                    <div class="alert alert-danger">
                        <strong>Oops! </strong><?=$errorMessage?>
                    </div>
                <?php }elseif($pageError){?>
                    <div class="alert alert-danger">
                        <strong>Oops! </strong><?php foreach($pageError as $error){echo$error.' , ';}?>
                    </div>
                <?php }?>
                <div class="panel-body">
                    <?php if(!$_GET['f'] == 0){?>
                    <div class="table-responsive">
                        <?php {
                            if($_GET['id'] == 0){?>
                                <form method="post">
                                    <?php $subjectName = $override->get('subjects','id',$_GET['sub']);$exam = $override->get('exam_type','id',$_GET['type']);$className=$override->get('class_list','id',$_GET['class'])?>
                                    <h4><strong>Result for : </strong><?=$exam[0]['name']?>&nbsp;&nbsp;<strong>Subject : </strong><?=$subjectName[0]['name']?>&nbsp;&nbsp;<strong>Class : </strong><?=$className[0]['class_name']?>&nbsp;&nbsp;<strong>Stream : </strong><?=$_GET['stream']?></h4>

                                    <table class="table table-bordered table-striped table-condensed mb-none">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Student Name</th>
                                            <th class="text-left">Student Score</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php  if(!$override->selectData('students','school_id',$user->data()->school_id,'class_id',$_GET['class'],'stream',$_GET['stream']) == null ){
                                            $x=1;foreach($override->selectData('students','school_id',$user->data()->school_id,'class_id',$_GET['class'],'stream',$_GET['stream']) as $resultS){ ?>
                                                <tr data-item-id="<?=$x?>">
                                                    <td><?=$x?></td>
                                                    <td><?=$resultS['firstname'].' '.$resultS['middlename'].' '.$resultS['lastname']?></td>
                                                    <td class="actions">
                                                        <input type="number" class="" name="score[]" min="0" max="100">
                                                        <input type="hidden" class="" name="student[]" value="<?=$resultS['id']?>">
                                                    </td>
                                                </tr>
                                                <?php $x++;}} ?>
                                        </tbody>
                                    </table><br><br>
                                    <div class="col-md-offset-6 col-md-6">
                                        <input type="submit" value="Submit Results"  name="uploadResult" class="btn btn-primary pull-right mb-xl" data-loading-text="Loading...">
                                    </div>
                                </form>
                            <?php }
                            elseif($_GET['id'] == 1){ ?>
                                <?php $subjectName = $override->get('subjects','id',$_GET['sub']);$exam = $override->get('exam_type','id',$_GET['type']);$className=$override->get('class_list','id',$_GET['class'])?>
                                <h4><strong>Result for : </strong><?=$exam[0]['name']?>&nbsp;&nbsp;<strong>Subject : </strong><?=$subjectName[0]['name']?>&nbsp;&nbsp;<strong>Class : </strong><?=$className[0]['class_name']?>&nbsp;&nbsp;<strong>Stream : </strong><?=$_GET['stream']?></h4>
                                <table class="table table-bordered table-striped mb-none" id="datatable-editable7">
                                    <thead>
                                    <tr>
                                        <th>Student Name</th>
                                        <th>Score</th>
                                        <th>Grade</th>
                                        <th>Position</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php if(!$override->selectData('students','school_id',$user->data()->school_id,'class_id',$_GET['class'],'stream',$_GET['stream']) == null){
                                        $x=1;foreach($override->updateSubjectSort('results','school_id',$user->data()->school_id,'class_id',$_GET['class'],'subject_id',$_GET['sub'],
                                            'exam_id',$_GET['type'],'stream',$_GET['stream'],'score') as $resultS){ ?>
                                            <tr data-item-id="<?=$x?>">
                                                <?php $student=$override->get('students','id',$resultS['student_id']) ?>
                                                <td><?=$student[0]['firstname'].' '.$student[0]['middlename'].' '.$student[0]['lastname']?></td>
                                                <td><?=$resultS['score']?></td>
                                                <td><?php if($resultS['score'] >= 81){echo'A';}elseif($resultS['score']>=61 && $resultS['score']<=80){echo'B';}elseif($resultS['score']>=41 && $resultS['score']<=60){echo'C';}
                                                    elseif($resultS['score']>=21 && $resultS['score']<=40){echo'D';}else{echo'F';}?></td>
                                                <td><?=$x?></td>
                                                <td class="actions">
                                                    <a href="#" class="hidden on-editing save-row"><i class="fa fa-save"></i></a>
                                                    <a href="#" class="hidden on-editing cancel-row"><i class="fa fa-times"></i></a>
                                                    <a href="edit.php?content=<?=$resultS['id']?>&group=results&data=stud_result&rec=<?=$resultS['id']?>&message=" class="on-default edit-row"><i class="fa fa-pencil"></i></a>
                                                    <a href="#" class="hidden on-default remove-row"><i class="fa fa-trash-o"></i></a>
                                                </td>
                                            </tr>
                                            <?php $x++;}} ?>
                                    </tbody>
                                </table>
                            <?php }
                            elseif($_GET['id'] == 9){ ?>
                                <div class="pull-right"><button onclick="window.print()">Print</button> </div>
                                <table class="table table-bordered table-striped mb-none" id="datatable-editable7">
                                    <thead>
                                    <tr>
                                        <th>Student Name</th>
                                        <th>Parent Name</th>
                                        <th>Class</th>
                                        <th>Stream</th>
                                        <th>Phone Number</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php if($override->get('students','school_id',$user->data()->school_id)){
                                        $x=1;foreach($override->getOrderBy('students','school_id',$user->data()->school_id,'class_id') as $student){ ?>
                                            <tr data-item-id="<?=$x?>">
                                                <?php $parent=$override->get('parents','id',$student['parent_id']) ?>
                                                <td><?=$student['firstname'].' '.$student['middlename'].' '.$student['lastname']?></td>
                                                <td><?=$parent[0]['firstname'].' '.$parent[0]['middlename'].' '.$parent[0]['lastname']?></td>
                                                <td><?=$override->get('class_list','id',$student['class_id'])[0]['class_name']?></td>
                                                <td><?=$student['stream']?></td>
                                                <td><?=$parent[0]['phone_number']?></td>
                                                <td><a href="#" data-toggle="modal" data-target="#formModal<?=$x?>"><i class="fa fa-pencil"></i></a></td>
                                            </tr>
                                            <div class="modal fade" id="formModal<?=$x?>" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <form  class="form-horizontal mb-lg" method="post">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                            <h4 class="modal-title" id="formModalLabel">Edit Parent Information</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                                <div class="form-group mt-lg">
                                                                    <label class="col-sm-3 control-label">First Name</label>
                                                                    <div class="col-sm-9">
                                                                        <input type="text" name="firstname" class="form-control" value="<?=$parent[0]['firstname']?>"/>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-sm-3 control-label">Middle Name</label>
                                                                    <div class="col-sm-9">
                                                                        <input type="text" name="middlename" class="form-control" value="<?=$parent[0]['middlename']?>"/>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-sm-3 control-label">Last Name</label>
                                                                    <div class="col-sm-9">
                                                                        <input type="text" name="lastname" class="form-control" value="<?=$parent[0]['lastname']?>" />
                                                                    </div>
                                                                </div>
                                                                <div class="form-group mt-lg">
                                                                    <label class="col-sm-3 control-label">Phone Number</label>
                                                                    <div class="col-sm-9">
                                                                        <input type="text" name="phone_number" class="form-control" value="<?=$parent[0]['phone_number']?>"/>
                                                                    </div>
                                                                </div>

                                                        </div>
                                                        <div class="modal-footer">
                                                            <input type="hidden" name="id" value="<?=$parent[0]['id']?>">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                            <input type="submit" value="Save Changes" class="btn btn-primary" name="edit_p">
                                                        </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php $x++;}} ?>
                                    </tbody>
                                </table>
                            <?php }
                        }?>
                    </div>
                    <?php }?>
                </div>
            </section>
        </div>
    </div>
</div>

    <?php if(!$_GET['id'] == 9){include 'footer.php'?><?php }?>
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
<script src="vendor/jquery/bootstrap-datepicker.min.js"></script>
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
