<?php
require_once'php/core/init.php';
$user = new User();
$tCiv=0;$tHis=0;$tKi=0;$tEn=0;$tGe=0;$tBi=0;$tChe=0;$tPh=0;$tbk=0;$tCo=0;$tM=0;
$override = new OverideData();$results = null;$studentId = null;$studentsNo = null;
if($user->isLoggedIn()){
    if($user->getSessionTable() === 'teachers') {
        $results=$override->get('results','id',$user->data()->school_id);
        $schoolName=$override->get('schools','id',$user->data()->school_id);
        if(Input::exists('post')){
            if(Input::get('search')){
                $redirect='summaryResult.php?id='.$user->data()->school_id.'&e='.Input::get('exam').'&c='.Input::get('class').'&y='.Input::get('year').'&J=1';
                Redirect::to($redirect);
            }elseif(Input::get('home')){
                Redirect::to('teacher.php?s=');
            }
        }
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
    <link rel="stylesheet" href="css/skins/default.css">
    <script src="master/style-switcher/style.switcher.localstorage.js"></script>

    <!-- Theme Custom CSS -->
    <link rel="stylesheet" href="css/custom.css">

    <!-- Head Libs -->
    <script src="vendor/modernizr/modernizr.min.js"></script>
    <style>
        @media print {
            body, html, #wrapper {
                width: 100%;
            }
        }
    </style>
</head>
<body>

<div class="body">
    <div role="main" class="main">
        <div class="">
            <div class="col-md-12 col-md-offset-0">
                <section class="panel">
                    <header class="panel-heading">
                        <div class="panel-actions">
                            <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                            <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
                        </div>
                        <h2 class=""></h2>
                    </header>
                    <div class="panel-body">
                        <?php if($_GET['J'] == 1){$classN=$override->get('class_list','id',$_GET['c']);$examN=$override->get('exam_type','id',$_GET['e']);}?>
                        <a href="#" class="btn btn-default" data-toggle="modal" data-target="#largeModal">Search</a>
                        <!--<a href="#" class="btn btn-default" onclick="window.print()">Print</a>-->
                        <form method="post"><input type="submit" value="Home" name="home" class="btn btn-default pull-right"></form>
                        <h3 align="center"><?=$schoolName[0]['name'].' '.$schoolName[0]['category']?> </h3>
                        <h4 align="center"><?php if($_GET['J']){echo$classN[0]['class_name'].' '.$examN[0]['name'].' Examination Result '.$_GET['y'];}?> </h4>
                        <div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title" id="largeModalLabel">Search for Summary Report</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form id="demo-form" class="form-horizontal mb-lg" novalidate="novalidate" method="post">
                                            <div class="form-group mt-lg">
                                                <div class="col-sm-4">
                                                    <select name="exam" class="selectpicker form-control mb-md" data-live-search="true" title="Examination" required="">
                                                        <option value="">Select Examination</option>
                                                        <?php foreach($override->getNoRepeat('results','exam_id','school_id',$user->data()->school_id) as $exam){$examName=$override->get('exam_type','id',$exam['exam_id'])?>
                                                            <option value="<?=$exam['exam_id']?>"><?=$examName[0]['name']?></option>
                                                        <?php }?>
                                                    </select>
                                                </div>
                                                <div class="col-sm-3">
                                                    <select name="class" class="selectpicker form-control mb-md" data-live-search="true" title="Examination" required="">
                                                        <option value="">Select Class</option>
                                                        <?php foreach($override->getNoRepeat('results','class_id','school_id',$user->data()->school_id) as $class){$className=$override->get('class_list','id',$class['class_id'])?>
                                                            <option value="<?=$class['class_id']?>"><?=$className[0]['class_name']?></option>
                                                        <?php }?>
                                                    </select>
                                                </div>
                                                <div class="col-sm-3">
                                                    <select name="year" class="selectpicker form-control mb-md" data-live-search="true" title="Examination" required="">
                                                        <option value="">Select Year</option>
                                                        <?php foreach($override->getNoRepeat('results','years','school_id',$user->data()->school_id) as $year){?>
                                                            <option value="<?=$year['years']?>"><?=$year['years']?></option>
                                                        <?php }?>
                                                    </select>
                                                </div>
                                            </div>
                                            <a href="joy.php" target="_blank">Print</a>
                                            <div class="modal-footer">
                                                <input type="submit" name="search" value="Search" class="btn btn-primary">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php if($_GET['J'] == 1){?>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-condensed mb-none">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Student Name</th>
                                        <th>Sex</th>
                                        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Civ</th>
                                        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;His</th>
                                        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kis</th>
                                        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Eng</th>
                                        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Geo</th>
                                        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Bio</th>
                                        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Che</th>
                                        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Phy</th>
                                        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;B/K</th>
                                        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Com</th>
                                        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;B/Mth</th>
                                        <th>Total</th>
                                        <th>Avg</th>
                                        <th>Grd</th>
                                        <th>Pos</th>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <table width=100% class="table table-bordered table-striped table-condensed mb-none">
                                                <tr>
                                                    <th>M</th>
                                                    <th>G</th>
                                                    <th>P</th>
                                                </tr>
                                            </table>
                                        </td>
                                        <td>
                                            <table width=100% class="table table-bordered table-striped table-condensed mb-none">
                                                <tr>
                                                    <th>M</th>
                                                    <th>G</th>
                                                    <th>P</th>
                                                </tr>
                                            </table>
                                        </td>
                                        <td>
                                            <table width=100% class="table table-bordered table-striped table-condensed mb-none">
                                                <tr>
                                                    <th>M</th>
                                                    <th>G</th>
                                                    <th>P</th>
                                                </tr>
                                            </table>
                                        </td>
                                        <td>
                                            <table width=100% class="table table-bordered table-striped table-condensed mb-none">
                                                <tr>
                                                    <th>M</th>
                                                    <th>G</th>
                                                    <th>P</th>
                                                </tr>
                                            </table>
                                        </td>
                                        <td>
                                            <table width=100% class="table table-bordered table-striped table-condensed mb-none">
                                                <tr>
                                                    <th>M</th>
                                                    <th>G</th>
                                                    <th>P</th>
                                                </tr>
                                            </table>
                                        </td>
                                        <td>
                                            <table width=100% class="table table-bordered table-striped table-condensed mb-none">
                                                <tr>
                                                    <th>M</th>
                                                    <th>G</th>
                                                    <th>P</th>
                                                </tr>
                                            </table>
                                        </td>
                                        <td>
                                            <table width=100% class="table table-bordered table-striped table-condensed mb-none">
                                                <tr>
                                                    <th>M</th>
                                                    <th>G</th>
                                                    <th>P</th>
                                                </tr>
                                            </table>
                                        </td>
                                        <td>
                                            <table width=100% class="table table-bordered table-striped table-condensed mb-none">
                                                <tr>
                                                    <th>M</th>
                                                    <th>G</th>
                                                    <th>P</th>
                                                </tr>
                                            </table>
                                        </td>
                                        <td>
                                            <table width=100% class="table table-bordered table-striped table-condensed mb-none">
                                                <tr>
                                                    <th>M</th>
                                                    <th>G</th>
                                                    <th>P</th>
                                                </tr>
                                            </table>
                                        </td>
                                        <td>
                                            <table width=100% class="table table-bordered table-striped table-condensed mb-none">
                                                <tr>
                                                    <th>M</th>
                                                    <th>G</th>
                                                    <th>P</th>
                                                </tr>
                                            </table>
                                        </td>
                                        <td>
                                            <table width=100% class="table table-bordered table-striped table-condensed mb-none">
                                                <tr>
                                                    <th>M</th>
                                                    <th>G</th>
                                                    <th>P</th>
                                                </tr>
                                            </table>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php //print_r($override->sortResult($user->data()->school_id,$_GET['e'],$_GET['c'],$_GET['y']));
                                    $x=1;$sortValue=null;foreach($override->sortResult($user->data()->school_id,$_GET['e'],$_GET['c'],$_GET['y']) as $result){
                                        $subjects=$override->selectData4('results','student_id',$result['id'],'class_id',$_GET['c'],'exam_id',$_GET['e'],'years',$_GET['y']);
                                        //$override->selectData4('results','school_id',$user->data()->school_id,'class_id',$_GET['c'],'exam_id',$_GET['e'],'year',$_GET['y'])
                                        $student=$override->get('students','id',$result['id']);
                                        ?>
                                        <tr>
                                            <td><?=$x?></td>
                                            <td><?=$student[0]['firstname'].' '.$student[0]['middlename'].' '.$student[0]['lastname']?></td>
                                            <td><?php if($student[0]['gender'] == 'Female'){echo'F';}else{echo'M';}?></td>
                                            <?php $total=0;$f=0;foreach($subjects as $subject){$subjectId=$override->get('subjects','id',$subject['subject_id']);
                                                $total += $subject['score'];//print_r($override->studPosition($user->data()->school_id,$_GET['e'],$subject['subject_id'],$_GET['c'],$_GET['y']));
                                                switch($subjectId[0]['name']){
                                                    case 'Civics':
                                                        $civics = $subject['score'];
                                                        $f +=1;$ci=$subject['subject_id'];$tCiv+=$subject['score'];
                                                        break;
                                                    case 'kiswahili':
                                                        $kiswahili = $subject['score'];
                                                        $f +=1;$ki=$subject['subject_id'];$tKi+=$subject['score'];
                                                        break;
                                                    case 'English':
                                                        $English= $subject['score'];
                                                        $f +=1;$en=$subject['subject_id'];$tEn+=$subject['score'];
                                                        break;
                                                    case 'Geography':
                                                        $Geography= $subject['score'];
                                                        $f +=1;$ge=$subject['subject_id'];$tGe+=$subject['score'];
                                                        break;
                                                    case 'Biology':
                                                        $Biology= $subject['score'];
                                                        $f +=1;$bi=$subject['subject_id'];$tBi+=$subject['score'];
                                                        break;
                                                    case 'Chemistry':
                                                        $Chemistry= $subject['score'];
                                                        $f +=1;$ch=$subject['subject_id'];$tChe+=$subject['score'];
                                                        break;
                                                    case 'Physics':
                                                        $Physics= $subject['score'];
                                                        $f +=1;$ph=$subject['subject_id'];$tPh+=$subject['score'];
                                                        break;
                                                    case 'Mathematics':
                                                        $Mathematics= $subject['score'];
                                                        $f +=1;$ma=$subject['subject_id'];$tM+=$subject['score'];
                                                        break;
                                                    case 'History':
                                                        $history= $subject['score'];
                                                        $f +=1;$hi=$subject['subject_id'];$tHis+=$subject['score'];
                                                        break;
                                                    case 'Book-keeping':
                                                        $Book= $subject['score'];
                                                        $f +=1;$bo=$subject['subject_id'];$tbk+=$subject['score'];
                                                        break;
                                                    case 'Commerce':
                                                        $Commerce= $subject['score'];
                                                        $f +=1;$co=$subject['subject_id'];$tCo+=$subject['score'];
                                                        break;
                                                }}$average=round(($total/$f),1);?>
                                            <td>
                                                <table width=100% class="table table-bordered table-striped table-condensed mb-none">
                                                    <tr>
                                                        <td><?php if($civics){echo$civics;}else{echo'-';}?></td>
                                                        <td><?=$user->grade($civics)?></td>
                                                        <td><?php $j=1;foreach($override->studPosition($user->data()->school_id,$_GET['e'],$ci,$_GET['c'],$_GET['y']) as $pos){
                                                                if($result['id'] == $pos['id']){echo$j;}
                                                                $j++;}?></td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td>
                                                <table width=100% class="table table-bordered table-striped table-condensed mb-none">
                                                    <tr>
                                                        <td><?php if($history){echo$history;}else{echo'-';}?></td>
                                                        <td><?=$user->grade($history)?></td>
                                                        <td><?php $j=1;foreach($override->studPosition($user->data()->school_id,$_GET['e'],$hi,$_GET['c'],$_GET['y']) as $pos){
                                                                if($result['id'] == $pos['id']){echo$j;}
                                                                $j++;}?></td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td>
                                                <table width=100% class="table table-bordered table-striped table-condensed mb-none">
                                                    <tr>
                                                        <td><?php if($kiswahili){echo$kiswahili;}else{echo'-';}?></td>
                                                        <td><?=$user->grade($kiswahili)?></td>
                                                        <td><?php $j=1;foreach($override->studPosition($user->data()->school_id,$_GET['e'],$ki,$_GET['c'],$_GET['y']) as $pos){
                                                                if($result['id'] == $pos['id']){echo$j;}
                                                                $j++;}?></td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td>
                                                <table width=100% class="table table-bordered table-striped table-condensed mb-none">
                                                    <tr>
                                                        <td><?php if($English){echo$English;}else{echo'-';}?></td>
                                                        <td><?=$user->grade($English)?></td>
                                                        <td><?php $j=1;foreach($override->studPosition($user->data()->school_id,$_GET['e'],$en,$_GET['c'],$_GET['y']) as $pos){
                                                                if($result['id'] == $pos['id']){echo$j;}
                                                                $j++;}?></td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td>
                                                <table width=100% class="table table-bordered table-striped table-condensed mb-none">
                                                    <tr>
                                                        <td><?php if($Geography){echo$Geography;}else{echo'-';}?></td>
                                                        <td><?=$user->grade($Geography)?></td>
                                                        <td><?php $j=1;foreach($override->studPosition($user->data()->school_id,$_GET['e'],$ge,$_GET['c'],$_GET['y']) as $pos){
                                                                if($result['id'] == $pos['id']){echo$j;}
                                                            $j++;}?></td>
                                                    </tr>
                                                </table >
                                            </td>
                                            <td>
                                                <table width=100% class="table table-bordered table-striped table-condensed mb-none">
                                                    <tr>
                                                        <td><?php if($Biology){echo$Biology;}else{echo'-';}?></td>
                                                        <td><?=$user->grade($Biology)?></td>
                                                        <td><?php $j=1;foreach($override->studPosition($user->data()->school_id,$_GET['e'],$bo,$_GET['c'],$_GET['y']) as $pos){
                                                                if($result['id'] == $pos['id']){echo$j;}
                                                                $j++;}?></td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td>
                                                <table width=100% class="table table-bordered table-striped table-condensed mb-none">
                                                    <tr>
                                                        <td><?php if($Chemistry){echo$Chemistry;}else{echo'-';}?></td>
                                                        <td><?=$user->grade($Chemistry)?></td>
                                                        <td><?php $j=1;foreach($override->studPosition($user->data()->school_id,$_GET['e'],$ch,$_GET['c'],$_GET['y']) as $pos){
                                                                if($result['id'] == $pos['id']){echo$j;}
                                                                $j++;}?></td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td>
                                                <table width=100% class="table table-bordered table-striped table-condensed mb-none">
                                                    <tr>
                                                        <td><?php if($Physics){echo$Physics;}else{echo'-';}?></td>
                                                        <td><?=$user->grade($Physics)?></td>
                                                        <td><?php $j=1;foreach($override->studPosition($user->data()->school_id,$_GET['e'],$ph,$_GET['c'],$_GET['y']) as $pos){
                                                                if($result['id'] == $pos['id']){echo$j;}
                                                                $j++;}?></td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td>
                                                <table width=100% class="table table-bordered table-striped table-condensed mb-none">
                                                    <tr>
                                                        <td><?php if($Book){echo$Book;}else{echo'-';}?></td>
                                                        <td><?=$user->grade($Book)?></td>
                                                        <td><?php $j=1;foreach($override->studPosition($user->data()->school_id,$_GET['e'],$bo,$_GET['c'],$_GET['y']) as $pos){
                                                                if($result['id'] == $pos['id']){echo$j;}
                                                                $j++;}?></td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td>
                                                <table width=100% class="table table-bordered table-striped table-condensed mb-none">
                                                    <tr>
                                                        <td><?php if($Commerce){echo$Commerce;}else{echo'-';}?></td>
                                                        <td><?=$user->grade($Commerce)?></td>
                                                        <td><?php $j=1;foreach($override->studPosition($user->data()->school_id,$_GET['e'],$co,$_GET['c'],$_GET['y']) as $pos){
                                                                if($result['id'] == $pos['id']){echo$j;}
                                                                $j++;}?></td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td>
                                                <table width=100% class="table table-bordered table-striped table-condensed mb-none">
                                                    <tr>
                                                        <td><?php if($Mathematics){echo$Mathematics;}else{echo'-';}?></td>
                                                        <td><?=$user->grade($Mathematics)?></td>
                                                        <td><?php $j=1;foreach($override->studPosition($user->data()->school_id,$_GET['e'],$ma,$_GET['c'],$_GET['y']) as $pos){
                                                                if($result['id'] == $pos['id']){echo$j;}
                                                                $j++;}?></td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <th><?=$total?></th>
                                            <th><?=$average?></th>
                                            <th><?=$user->grade($average)?></th>
                                            <th><?=$x?></th>
                                        </tr>
                                        <?php $x++;}$f=1;$arr=null;?>
                                    <tr>
                                        <td></td>
                                        <th>Total</th>
                                        <td></td>
                                        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$tCiv?></th>
                                        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$tHis?></th>
                                        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$tKi?></th>
                                        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$tEn?></th>
                                        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$tGe?></th>
                                        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$tBi?></th>
                                        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$tChe?></th>
                                        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$tPh?></th>
                                        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$tbk?></th>
                                        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$tCo?></th>
                                        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$tM?></th>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <th>Avg</th>
                                        <td></td>
                                        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$mrk[1]=round($tCiv/($x-1),1)?></th>
                                        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$mrk[2]=round($tHis/($x-1),1)?></th>
                                        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$mrk[3]=round($tKi/($x-1),1)?></th>
                                        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$mrk[4]=round($tEn/($x-1),1)?></th>
                                        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$mrk[5]=round($tGe/($x-1),1)?></th>
                                        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$mrk[6]=round($tBi/($x-1),1)?></th>
                                        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$mrk[7]=round($tChe/($x-1),1)?></th>
                                        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$mrk[8]=round($tPh/($x-1),1)?></th>
                                        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$mrk[9]=round($tbk/($x-1),1)?></th>
                                        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$mrk[10]=round($tCo/($x-1),1)?></th>
                                        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$mrk[11]=round($tM/($x-1),1)?></th>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <th>Grd</th>
                                        <td></td>
                                        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$user->grade(round($tCiv/($x-1),1))?></th>
                                        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$user->grade(round($tHis/($x-1),1))?></th>
                                        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$user->grade(round($tKi/($x-1),1))?></th>
                                        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$user->grade(round($tEn/($x-1),1))?></th>
                                        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$user->grade(round($tGe/($x-1),1))?></th>
                                        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$user->grade(round($tBi/($x-1),1))?></th>
                                        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$user->grade(round($tChe/($x-1),1))?></th>
                                        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$user->grade(round($tPh/($x-1),1))?></th>
                                        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$user->grade(round($tbk/($x-1),1))?></th>
                                        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$user->grade(round($tCo/($x-1),1))?></th>
                                        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$user->grade(round($tM/($x-1),1))?></th>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <?php array_multisort($mrk,SORT_DESC)?>
                                        <td></td>
                                        <th>Pos</th>
                                        <th></th>
                                        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php $n=1;foreach($mrk as $p){if($p == round($tCiv/($x-1),1)){echo$n;}$n++;}?></th>
                                        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php $a=1;foreach($mrk as $p){if($p == round($tHis/($x-1),1)){echo$a;}$a++;}?></th>
                                        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php $a=1;foreach($mrk as $p){if($p == round($tKi/($x-1),1)){echo$a;}$a++;}?></th>
                                        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php $a=1;foreach($mrk as $p){if($p == round($tEn/($x-1),1)){echo$a;}$a++;}?></th>
                                        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php $a=1;foreach($mrk as $p){if($p == round($tGe/($x-1),1)){echo$a;}$a++;}?></th>
                                        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php $a=1;foreach($mrk as $p){if($p == round($tBi/($x-1),1)){echo$a;}$a++;}?></th>
                                        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php $a=1;foreach($mrk as $p){if($p == round($tChe/($x-1),1)){echo$a;}$a++;}?></th>
                                        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php $a=1;foreach($mrk as $p){if($p == round($tPh/($x-1),1)){echo$a;}$a++;}?></th>
                                        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php $n=1;foreach($mrk as $p){if($p == round($tbk/($x-1),1)){echo$n;}$n++;}?></th>
                                        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php $a=1;foreach($mrk as $p){if($p == round($tCo/($x-1),1)){echo$a;}$a++;}?></th>
                                        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php $a=1;foreach($mrk as $p){if($p == round($tM/($x-1),1)){echo$a;}$a++;}?></th>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    </tbody>
                                </table>

                            </div>
                            <br><h4>Abbreviations</h4>
                            <p><strong>Civ = Civics , His = History , Kis = Kiswahil , Eng = English , Geo = Geography , Bio = Biology , Che = Chemistry , Phy = Physics , B/Mth = Basic Mathematics , A/Mth = Applied Mathematics , B/K = Book-Keeping , Com = Commerce</strong></p>
                        <?php }?>
                    </div>
                </section>
            </div>
        </div>
    </div>

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
