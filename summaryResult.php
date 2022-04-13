<?php
require_once'php/core/init.php';
$user = new User();
$tCiv=0;$tHis=0;$tKi=0;$tEn=0;$tGe=0;$tBi=0;$tChe=0;$tPh=0;$tbk=0;$tCo=0;$tM=0;$arb=0;
$override = new OverideData();$results = null;$studentId = null;$studentsNo = null;$error=null;$success=null;
$arth=0;$read=0;$wrt=0;$health=0;$science=0;$vs=0;$pds=0;$ag=0;$phn=0;$rel=0;$cn=0;$st=0;$am=0;$ec=0;$ac=0;$gs=0;$lan=0;$ict=0;
$dsa=0;$arc=0;$dbt=0;$kus=0;$lt=0;$kua=0;$kuh=0;$maa=0;$ent=0;$fre=0;$cou=0;$psd=0;$arb=0;$social=0;$civics=0;$history=0;$Mathematics=0;
$Physics=0;$Chemistry=0;$Mathematics=0;$Biology=0;$Geography=0;$Commerce=0;$Book=0;$kiswahili=0;$cm=0;$send=false;
$sub=0;$arthT=0;$readT=0;$wrtT=0;$healthT=0;$scienceT=0;$vsT=0;$pdsT=0;$agT=0;$phnT=0;$relT=0;$cnT=0;$stT=0;$amT=0;$ecT=0;$acT=0;$gsT=0;$lanT=0;$ictT=0;
$dsaT=0;$arcT=0;$dbtT=0;$kusT=0;$ltT=0;$kuaT=0;$kuhT=0;$maaT=0;$entT=0;$freT=0;$couT=0;$psdT=0;$arbT=0;$socialT=0;$cmT=0;
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
            }elseif(Input::get('sendPrimary')){
                    if($user->validateBundle(Input::get('message'),Input::get('noStud'),Input::get('bundleId'))){
                        //$user->sendSMS($parent[0]['phone_number'],$sms);
                        $success='Messages was sent Successfully';$send=true;
                    }else{$error='You do not have sufficient bundle to complete this request';}
            }elseif(Input::get('sendSecondary')){
                if($user->validateBundle(Input::get('message'),Input::get('noStud'),Input::get('bundleId'))){
                    //$user->sendSMS($parent[0]['phone_number'],$sms);
                    $success='Messages was sent Successfully';$send=true;
                }else{$error='You do not have sufficient bundle to complete this request';}
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
<a href="#" class="btn btn-default" onclick="window.print()">Print</a>
<form method="post"><input type="submit" value="Home" name="home" class="btn btn-default pull-right"></form>
<h3 align="center"><?=$schoolName[0]['name'].' '.$schoolName[0]['category']?> </h3>
<h4 align="center"><?php if($_GET['J']){echo$classN[0]['class_name'].' '.$examN[0]['name'].' Examination Result '.$_GET['y'];}?> </h4>
<?php if($error){?>
    <div class="alert alert-danger">
        <strong>Oops!</strong> <?=$error?>
    </div>
<?php }elseif($success){?>
    <div class="alert alert-success">
        <strong>Well done!</strong> <?=$success?>
    </div>
<?php }?>
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
                    <div class="modal-footer">
                        <input type="submit" name="search" value="Search" class="btn btn-primary">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php if($_GET['J'] == 1 && $_GET['c'] >=8 && $_GET['c'] <=11){?>
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
        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;A/Mth</th>
        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Lit</th>
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
                    case 'Arthmetics':
                        $arth= $subject['score'];
                        $f +=1;$ar=$subject['subject_id'];$arthT+=$subject['score'];
                        break;
                    case 'Reading':
                        $read= $subject['score'];
                        $f +=1;$re=$subject['subject_id'];$readT+=$subject['score'];
                        break;
                    case 'Writing':
                        $wrt= $subject['score'];
                        $f +=1;$wr=$subject['subject_id'];$wrtT+=$subject['score'];
                        break;
                    case 'Health and Environment':
                        $health=$subject['score'];
                        $f +=1;$co=$subject['subject_id'];$healthT+=$subject['score'];
                        break;
                    case 'Science':
                        $science=$subject['score'];
                        $f +=1;$sc=$subject['subject_id'];$scienceT+=$subject['score'];
                        break;
                    case 'Vocational Skills(VS)':
                        $vs=$subject['score'];
                        $f +=1;$v=$subject['subject_id'];$vsT+=$subject['score'];
                        break;
                    case 'Physical Development Studies':
                        $pds=$subject['score'];
                        $f +=1;$pds=$subject['subject_id'];$pdsT+=$subject['score'];
                        break;
                    case 'Arts and Games':
                        $ag=$subject['score'];
                        $f +=1;$art=$subject['subject_id'];$agT+=$subject['score'];
                        break;
                    case 'Phonics':
                        $phn=$subject['score'];
                        $f +=1;$pho=$subject['subject_id'];$phnT+=$subject['score'];
                        break;
                    case 'Religion':
                        $rel=$subject['score'];
                        $f +=1;$re=$subject['subject_id'];$relT+=$subject['score'];
                        break;
                    case 'Civic and Moral':
                        $cm=$subject['score'];
                        $f +=1;$ci=$subject['subject_id'];$cmT+=$subject['score'];
                        break;
                    case 'Science and Technology':
                        $st=$subject['score'];
                        $f +=1;$snt=$subject['subject_id'];$stT+=$subject['score'];
                        break;
                    case 'Applied Mathematics':
                        $am=$subject['score'];
                        $f +=1;$ma=$subject['subject_id'];$amT+=$subject['score'];
                        break;
                    case 'Economics':
                        $ec=$subject['score'];
                        $f +=1;$ec=$subject['subject_id'];$ecT+=$subject['score'];
                        break;
                    case 'Accounts':
                        $ac=$subject['score'];
                        $f +=1;$ac=$subject['subject_id'];$acT+=$subject['score'];
                        break;
                    case 'General Studies':
                        $gs=$subject['score'];
                        $f +=1;$gs=$subject['subject_id'];$ag+=$subject['score'];
                        break;
                    case 'Language':
                        $lan=$subject['score'];
                        $f +=1;$la=$subject['subject_id'];$lanT+=$subject['score'];
                        break;
                    case 'ICT':
                        $ict=$subject['score'];
                        $f +=1;$ic=$subject['subject_id'];$ictT+=$subject['score'];
                        break;
                    case 'Developing Sports & Arts':
                        $dsa=$subject['score'];
                        $f +=1;$ds=$subject['subject_id'];$dsaT+=$subject['score'];
                        break;
                    case 'Arts & Crafts':
                        $arc=$subject['score'];
                        $f +=1;$ar=$subject['subject_id'];$arcT+=$subject['score'];
                        break;
                    case 'Debate':
                        $dbt=$subject['score'];
                        $f +=1;$de=$subject['subject_id'];$dbtT+=$subject['score'];
                        break;
                    case 'Kusoma':
                        $kus=$subject['score'];
                        $f +=1;$ku=$subject['subject_id'];$kusT+=$subject['score'];
                        break;
                    case 'Literature':
                        $lt=$subject['score'];
                        $f +=1;$li=$subject['subject_id'];$ltT+=$subject['score'];
                        break;
                    case 'Kuandika':
                        $kua=$subject['score'];
                        $f +=1;$ka=$subject['subject_id'];$kuaT+=$subject['score'];
                        break;
                    case 'Kuhesabu':
                        $kuh=$subject['score'];
                        $f +=1;$kh=$subject['subject_id'];$kuhT+=$subject['score'];
                        break;
                    case 'Maadili':
                        $maa=$subject['score'];
                        $f +=1;$ma=$subject['subject_id'];$maaT+=$subject['score'];
                        break;
                    case 'Enterpreneurship':
                        $ent=$subject['score'];
                        $f +=1;$en=$subject['subject_id'];$entT+=$subject['score'];
                        break;
                    case 'French':
                        $fre=$subject['score'];
                        $f +=1;$fr=$subject['subject_id'];$freT+=$subject['score'];
                        break;
                    case 'Counting':
                        $cou=$subject['score'];
                        $f +=1;$cn=$subject['subject_id'];$couT+=$subject['score'];
                        break;
                    case 'PSD':
                        $psd=$subject['score'];
                        $f +=1;$sd=$subject['subject_id'];$psdT+=$subject['score'];
                        break;
                    case 'Arabic':
                        $arb=$subject['score'];
                        $f +=1;$ab=$subject['subject_id'];$arbT+=$subject['score'];
                        break;
                    case 'Social Studies':
                        $social=$subject['score'];
                        $f +=1;$scs=$subject['subject_id'];$socialT+=$subject['score'];
                        break;
                    default:

                        break;
                }}$average=round(($total/$f),1);$noSms=0;
            //TODO Sending sms
            $bundleId=$override->get('bundle_usage','org_id',$user->data()->school_id);
            $noStud=$override->countData('students','school_id',$user->data()->school_id,'class_id',$_GET['c']);
            $sms=$schoolName[0]['name'].' '.$schoolName[0]['category'].' , '.$examN[0]['name'].' Examination Result for '.$student[0]['firstname'].' '.$student[0]['middlename'].' '.$student[0]['lastname'].'. Average : '
            .$average.', Grade : '.$user->grade($average).', Position : '.$x.' out of '.$noStud;
            $parent=$override->get('parents','id',$student[0]['parent_id']);
            if($send){
                $user->sendSMS($parent[0]['phone_number'],$sms);
                $noSms = $bundleId[0]['sms'] - $user->countSms($sms);
                $user->updateRecord('bundle_usage',array('sms' => $noSms),$bundleId[0]['id']);
            }
            ?>
            <td>
                <table width=100% class="table table-bordered table-striped table-condensed mb-none">
                    <tr>
                        <td><?php if($civics){echo$civics;}else{echo'-';}?></td>
                        <td><?php if($civics){echo$user->gradeO($civics);}else{echo'-';}?></td>
                        <td><?php if($civics){$j=1;foreach($override->studPosition($user->data()->school_id,$_GET['e'],$ci,$_GET['c'],$_GET['y']) as $pos){
                                if($result['id'] == $pos['id']){echo$j;}
                                $j++;}}else{echo'-';}?></td>
                    </tr>
                </table>
            </td>
            <td>
                <table width=100% class="table table-bordered table-striped table-condensed mb-none">
                    <tr>
                        <td><?php if($history){echo$history;}else{echo'-';}?></td>
                        <td><?php if($history){echo$user->gradeO($history);}else{echo'-';}?></td>
                        <td><?php if($history){$j=1;foreach($override->studPosition($user->data()->school_id,$_GET['e'],$hi,$_GET['c'],$_GET['y']) as $pos){
                                if($result['id'] == $pos['id']){echo$j;}
                                $j++;}}else{echo'-';}?></td>
                    </tr>
                </table>
            </td>
            <td>
                <table width=100% class="table table-bordered table-striped table-condensed mb-none">
                    <tr>
                        <td><?php if($kiswahili){echo$kiswahili;}else{echo'-';}?></td>
                        <td><?php if($kiswahili){echo$user->gradeO($kiswahili);}else{echo'-';}?></td>
                        <td><?php if($kiswahili){$j=1;foreach($override->studPosition($user->data()->school_id,$_GET['e'],$ki,$_GET['c'],$_GET['y']) as $pos){
                                if($result['id'] == $pos['id']){echo$j;}
                                $j++;}}else{echo'-';}?></td>
                    </tr>
                </table>
            </td>
            <td>
                <table width=100% class="table table-bordered table-striped table-condensed mb-none">
                    <tr>
                        <td><?php if($English){echo$English;}else{echo'-';}?></td>
                        <td><?php if($English){echo$user->gradeO($English);}else{echo'-';}?></td>
                        <td><?php if($English){$j=1;foreach($override->studPosition($user->data()->school_id,$_GET['e'],$en,$_GET['c'],$_GET['y']) as $pos){
                                if($result['id'] == $pos['id']){echo$j;}
                                $j++;}}else{echo'-';}?></td>
                    </tr>
                </table>
            </td>
            <td>
                <table width=100% class="table table-bordered table-striped table-condensed mb-none">
                    <tr>
                        <td><?php if($Geography){echo$Geography;}else{echo'-';}?></td>
                        <td><?php if($Geography){echo$user->gradeO($Geography);}else{echo'-';}?></td>
                        <td><?php if($Geography){$j=1;foreach($override->studPosition($user->data()->school_id,$_GET['e'],$ge,$_GET['c'],$_GET['y']) as $pos){
                                if($result['id'] == $pos['id']){echo$j;}
                                $j++;}}else{echo'-';}?></td>
                    </tr>
                </table >
            </td>
            <td>
                <table width=100% class="table table-bordered table-striped table-condensed mb-none">
                    <tr>
                        <td><?php if($Biology){echo$Biology;}else{echo'-';}?></td>
                        <td><?php if($Biology){echo$user->gradeO($Biology);}else{echo'-';}?></td>
                        <td><?php if($Biology){$j=1;foreach($override->studPosition($user->data()->school_id,$_GET['e'],$bo,$_GET['c'],$_GET['y']) as $pos){
                                if($result['id'] == $pos['id']){echo$j;}
                                $j++;}}else{echo'-';}?></td>
                    </tr>
                </table>
            </td>
            <td>
                <table width=100% class="table table-bordered table-striped table-condensed mb-none">
                    <tr>
                        <td><?php if($Chemistry){echo$Chemistry;}else{echo'-';}?></td>
                        <td><?php if($Chemistry){echo$user->gradeO($Chemistry);}else{echo'-';}?></td>
                        <td><?php if($Chemistry){$j=1;foreach($override->studPosition($user->data()->school_id,$_GET['e'],$ch,$_GET['c'],$_GET['y']) as $pos){
                                if($result['id'] == $pos['id']){echo$j;}
                                $j++;}}else{echo'-';}?></td>
                    </tr>
                </table>
            </td>
            <td>
                <table width=100% class="table table-bordered table-striped table-condensed mb-none">
                    <tr>
                        <td><?php if($Physics){echo$Physics;}else{echo'-';}?></td>
                        <td><?php if($Physics){echo$user->gradeO($Physics);}else{echo'-';}?></td>
                        <td><?php if($Physics){$j=1;foreach($override->studPosition($user->data()->school_id,$_GET['e'],$ph,$_GET['c'],$_GET['y']) as $pos){
                                if($result['id'] == $pos['id']){echo$j;}
                                $j++;}}else{echo'-';}?></td>
                    </tr>
                </table>
            </td>
            <td>
                <table width=100% class="table table-bordered table-striped table-condensed mb-none">
                    <tr>
                        <td><?php if($Book){echo$Book;}else{echo'-';}?></td>
                        <td><?php if($Book){echo$user->gradeO($Book);}else{echo'-';}?></td>
                        <td><?php if($Book){$j=1;foreach($override->studPosition($user->data()->school_id,$_GET['e'],$bo,$_GET['c'],$_GET['y']) as $pos){
                                if($result['id'] == $pos['id']){echo$j;}
                                $j++;}}else{echo'-';}?></td>
                    </tr>
                </table>
            </td>
            <td>
                <table width=100% class="table table-bordered table-striped table-condensed mb-none">
                    <tr>
                        <td><?php if($Commerce){echo$Commerce;}else{echo'-';}?></td>
                        <td><?php if($Commerce){echo$user->gradeO($Commerce);}else{echo'-';}?></td>
                        <td><?php if($Commerce){$j=1;foreach($override->studPosition($user->data()->school_id,$_GET['e'],$co,$_GET['c'],$_GET['y']) as $pos){
                                if($result['id'] == $pos['id']){echo$j;}
                                $j++;}}else{echo'-';}?></td>
                    </tr>
                </table>
            </td>
            <td>
                <table width=100% class="table table-bordered table-striped table-condensed mb-none">
                    <tr>
                        <td><?php if($Mathematics){echo$Mathematics;}else{echo'-';}?></td>
                        <td><?php if($Mathematics){echo$user->gradeO($Mathematics);}else{echo'-';}?></td>
                        <td><?php if($Mathematics){$j=1;foreach($override->studPosition($user->data()->school_id,$_GET['e'],$ma,$_GET['c'],$_GET['y']) as $pos){
                                if($result['id'] == $pos['id']){echo$j;}
                                $j++;}}else{echo'-';}?></td>
                    </tr>
                </table>
            </td>
            <td>
                <table width=100% class="table table-bordered table-striped table-condensed mb-none">
                    <tr>
                        <td><?php if($am){echo$am;}else{echo'-';}?></td>
                        <td><?php if($am){echo$user->gradeO($am);}else{echo'-';}?></td>
                        <td><?php if($am){$j=1;foreach($override->studPosition($user->data()->school_id,$_GET['e'],$ma,$_GET['c'],$_GET['y']) as $pos){
                                if($result['id'] == $pos['id']){echo$j;}
                                $j++;}}else{echo'-';}?></td>
                    </tr>
                </table>
            </td>
            <td>
                <table width=100% class="table table-bordered table-striped table-condensed mb-none">
                    <tr>
                        <td><?php if($lt){echo$lt;}else{echo'-';}?></td>
                        <td><?php if($lt){echo$user->gradeO($lt);}else{echo'-';}?></td>
                        <td><?php if($lt){$j=1;foreach($override->studPosition($user->data()->school_id,$_GET['e'],$li,$_GET['c'],$_GET['y']) as $pos){
                                if($result['id'] == $pos['id']){echo$j;}
                                $j++;}}else{echo'-';}?></td>
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
        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$amT?></th>
        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$ltT?></th>
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
        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$mrk[11]=round($amT/($x-1),1)?></th>
        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$mrk[11]=round($ltT/($x-1),1)?></th>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <th>Grd</th>
        <td></td>
        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$user->gradeO(round($tCiv/($x-1),1))?></th>
        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$user->gradeO(round($tHis/($x-1),1))?></th>
        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$user->gradeO(round($tKi/($x-1),1))?></th>
        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$user->gradeO(round($tEn/($x-1),1))?></th>
        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$user->gradeO(round($tGe/($x-1),1))?></th>
        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$user->gradeO(round($tBi/($x-1),1))?></th>
        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$user->gradeO(round($tChe/($x-1),1))?></th>
        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$user->gradeO(round($tPh/($x-1),1))?></th>
        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$user->gradeO(round($tbk/($x-1),1))?></th>
        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$user->gradeO(round($tCo/($x-1),1))?></th>
        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$user->gradeO(round($tM/($x-1),1))?></th>
        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$user->gradeO(round($amT/($x-1),1))?></th>
        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$user->gradeO(round($ltT/($x-1),1))?></th>
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
        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php $a=1;foreach($mrk as $p){if($p == round($amT/($x-1),1)){echo$a;}$a++;}?></th>
        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php $a=1;foreach($mrk as $p){if($p == round($ltT/($x-1),1)){echo$a;}$a++;}?></th>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>

    </tbody>
    </table>
    <?php if($bundleId){?>
        <form method="post">
            <input type="hidden" name="noStud" value="<?=$noStud?>">
            <input type="hidden" name="bundleId" value="<?=$bundleId[0]['id']?>">
            <input type="hidden" name="parent" value="<?=$parent[0]['phone_number']?>">
            <input type="hidden" name="message" value="<?=$sms?>">
            <div class="col-md-offset-6">
                <input type="submit" class="btn btn-info" value="Send Results to parents" name="sendSecondary">
            </div>
        </form>
    <?php }?>
    </div>
    <br><h4>Abbreviations</h4>
    <p><strong>Civ = Civics , His = History , Kis = Kiswahil , Eng = English , Geo = Geography , Bio = Biology , Che = Chemistry , Phy = Physics , B/Mth = Basic Mathematics , A/Mth = Applied Mathematics ,
            B/K = Book-Keeping , Com = Commerce , Read = Reading , Write = Writing , Arth = Arithmetics , Kus = Kusoma , Kua = Kuandika , Hes = Kuhesabu ,
            Sc$Tec = Science and Technology , Soc = Social Studies , Civ&Mor = Civics And Moral , Rel = Religion , Fre = French , Ent = Entrepreneurship ,
            Spo = Development,Sports & Arts , Arb = Arabic , Sci = Science , A/Math = Applied Mathematics , Vcs = Vocational Skills , </strong></p>
    <ul class="list list-icons list-icons-style-3 list-icons-sm">
        <li><strong><i class="fa fa-check"></i> A = 75 - 100 , Excellent</strong></li>
        <li><strong><i class="fa fa-check"></i> B = 65 - 74 , Very Good</strong></li>
        <li><strong><i class="fa fa-check"></i> C = 45 - 64 , Good</strong></li>
        <li><strong><i class="fa fa-check"></i> D = 30 - 44 , Pass</strong></li>
        <li><strong><i class="fa fa-check"></i> F = 0 - 20 , Fail</strong></li>
    </ul>
<?php }
elseif($_GET['J'] == 1 && $_GET['c'] >=1 && $_GET['c'] <=7){?>
    <div class="table-responsive">
    <table class="table table-bordered table-striped table-condensed mb-none">
    <thead>
    <tr>
        <th>#</th>
        <th>Student Name</th>
        <th>Sex</th>
        <!-- class 1 & 2-->
        <?php if($_GET['c'] >=1 && $_GET['c'] <=2){$sub=6;?>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Read</th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Write</th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Arith</th>

            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kus</th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kua</th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Hes</th>
        <!-- class 3 & 4-->
        <?php }elseif($_GET['c'] >=3 && $_GET['c'] <=4){$sub=11?>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kis</th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Eng</th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Math</th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sc&Tec</th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Soc</th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Civ&Mor</th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Rel</th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Fre</th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ara</th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ent</th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Spo</th>
        <!-- class 5,6 & 7-->
        <?php }elseif($_GET['c'] >=5 && $_GET['c'] <=7){$sub=10?>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kis</th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Eng</th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Math</th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sci</th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Geo</th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;His</th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Civ</th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Rel</th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Vcs</th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Spo</th>
        <?php }?>
        <th>Total</th>
        <th>Avg</th>
        <th>Grd</th>
        <th>Pos</th>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>

        <?php $x=0;while($x<$sub){?>
            <td>
                <table width=100% class="table table-bordered table-striped table-condensed mb-none">
                    <tr>
                        <th>M</th>
                        <th>G</th>
                        <th>P</th>
                    </tr>
                </table>
            </td>
            <?php $x++;}?>
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
                    case 'Arthmetics':
                        $arth= $subject['score'];
                        $f +=1;$ar=$subject['subject_id'];$arthT+=$subject['score'];
                        break;
                    case 'Reading':
                        $read= $subject['score'];
                        $f +=1;$re=$subject['subject_id'];$readT+=$subject['score'];
                        break;
                    case 'Writing':
                        $wrt= $subject['score'];
                        $f +=1;$wr=$subject['subject_id'];$wrtT+=$subject['score'];
                        break;
                    case 'Health and Environment':
                        $health=$subject['score'];
                        $f +=1;$co=$subject['subject_id'];$healthT+=$subject['score'];
                        break;
                    case 'Science':
                        $science=$subject['score'];
                        $f +=1;$sc=$subject['subject_id'];$scienceT+=$subject['score'];
                        break;
                    case 'Vocational Skills(VS)':
                        $vs=$subject['score'];
                        $f +=1;$v=$subject['subject_id'];$vsT+=$subject['score'];
                        break;
                    case 'Physical Development Studies':
                        $pds=$subject['score'];
                        $f +=1;$pds=$subject['subject_id'];$pdsT+=$subject['score'];
                        break;
                    case 'Arts and Games':
                        $ag=$subject['score'];
                        $f +=1;$art=$subject['subject_id'];$agT+=$subject['score'];
                        break;
                    case 'Phonics':
                        $phn=$subject['score'];
                        $f +=1;$pho=$subject['subject_id'];$phnT+=$subject['score'];
                        break;
                    case 'Religion':
                        $rel=$subject['score'];
                        $f +=1;$re=$subject['subject_id'];$relT+=$subject['score'];
                        break;
                    case 'Civic and Moral':
                        $cm=$subject['score'];
                        $f +=1;$ci=$subject['subject_id'];$cmT+=$subject['score'];
                        break;
                    case 'Science and Technology':
                        $st=$subject['score'];
                        $f +=1;$snt=$subject['subject_id'];$stT+=$subject['score'];
                        break;
                    case 'Applied Mathematics':
                        $am=$subject['score'];
                        $f +=1;$ma=$subject['subject_id'];$amT+=$subject['score'];
                        break;
                    case 'Economics':
                        $ec=$subject['score'];
                        $f +=1;$ec=$subject['subject_id'];$ecT+=$subject['score'];
                        break;
                    case 'Accounts':
                        $ac=$subject['score'];
                        $f +=1;$ac=$subject['subject_id'];$acT+=$subject['score'];
                        break;
                    case 'General Studies':
                        $gs=$subject['score'];
                        $f +=1;$gs=$subject['subject_id'];$ag+=$subject['score'];
                        break;
                    case 'Language':
                        $lan=$subject['score'];
                        $f +=1;$la=$subject['subject_id'];$lanT+=$subject['score'];
                        break;
                    case 'ICT':
                        $ict=$subject['score'];
                        $f +=1;$ic=$subject['subject_id'];$ictT+=$subject['score'];
                        break;
                    case 'Developing Sports & Arts':
                        $dsa=$subject['score'];
                        $f +=1;$ds=$subject['subject_id'];$dsaT+=$subject['score'];
                        break;
                    case 'Arts & Crafts':
                        $arc=$subject['score'];
                        $f +=1;$ar=$subject['subject_id'];$arcT+=$subject['score'];
                        break;
                    case 'Debate':
                        $dbt=$subject['score'];
                        $f +=1;$de=$subject['subject_id'];$dbtT+=$subject['score'];
                        break;
                    case 'Kusoma':
                        $kus=$subject['score'];
                        $f +=1;$ku=$subject['subject_id'];$kusT+=$subject['score'];
                        break;
                    case 'Literature':
                        $lt=$subject['score'];
                        $f +=1;$li=$subject['subject_id'];$ltT+=$subject['score'];
                        break;
                    case 'Kuandika':
                        $kua=$subject['score'];
                        $f +=1;$ka=$subject['subject_id'];$kuaT+=$subject['score'];
                        break;
                    case 'Kuhesabu':
                        $kuh=$subject['score'];
                        $f +=1;$kh=$subject['subject_id'];$kuhT+=$subject['score'];
                        break;
                    case 'Maadili':
                        $maa=$subject['score'];
                        $f +=1;$ma=$subject['subject_id'];$maaT+=$subject['score'];
                        break;
                    case 'Enterpreneurship':
                        $ent=$subject['score'];
                        $f +=1;$en=$subject['subject_id'];$entT+=$subject['score'];
                        break;
                    case 'French':
                        $fre=$subject['score'];
                        $f +=1;$fr=$subject['subject_id'];$freT+=$subject['score'];
                        break;
                    case 'Counting':
                        $cou=$subject['score'];
                        $f +=1;$cn=$subject['subject_id'];$couT+=$subject['score'];
                        break;
                    case 'PSD':
                        $psd=$subject['score'];
                        $f +=1;$sd=$subject['subject_id'];$psdT+=$subject['score'];
                        break;
                    case 'Arabic':
                        $arb=$subject['score'];
                        $f +=1;$ab=$subject['subject_id'];$arbT+=$subject['score'];
                        break;
                    case 'Social Studies':
                        $social=$subject['score'];
                        $f +=1;$scs=$subject['subject_id'];$socialT+=$subject['score'];
                        break;
                    default:

                        break;
                }}$average=round(($total/$f),1);$noSms=0;
            //Sending sms to the parent
            $bundleId=$override->get('bundle_usage','org_id',$user->data()->school_id);//print_r($bundleId);
            $noStud=$override->countData('students','school_id',$user->data()->school_id,'class_id',$_GET['c']);
            $sms=$schoolName[0]['name'].' '.$schoolName[0]['category'].' , '.$examN[0]['name'].' Examination Result for '.$student[0]['firstname'].' '.$student[0]['middlename'].' '.$student[0]['lastname'].'. Average : '
                .$average.', Grade : '.$user->grade($average).', Position : '.$x.' out of '.$noStud;
            $parent=$override->get('parents','id',$student[0]['parent_id']);
            if($send){
                    $user->sendSMS($parent[0]['phone_number'],$sms);
                $noSms = $bundleId[0]['sms'] - $user->countSms($sms);
                $user->updateRecord('bundle_usage',array('sms' => $noSms),$bundleId[0]['id']);
            }
            ?>
            <?php if($_GET['c'] >=1 && $_GET['c'] <=2){?>
                <td>
                    <table width=100% class="table table-bordered table-striped table-condensed mb-none">
                        <tr>
                            <td><?php if($read){echo$read;}else{echo'-';}?></td>
                            <td><?php if($read){echo$user->grade($read);}else{echo'-';}?></td>
                            <td><?php if($read){$j=1;foreach($override->studPosition($user->data()->school_id,$_GET['e'],$re,$_GET['c'],$_GET['y']) as $pos){
                                    if($result['id'] == $pos['id']){echo$j;}
                                    $j++;}}else{echo'-';}?></td>
                        </tr>
                    </table>
                </td>
                <td>
                    <table width=100% class="table table-bordered table-striped table-condensed mb-none">
                        <tr>
                            <td><?php if($wrt){echo$wrt;}else{echo'-';}?></td>
                            <td><?php if($wrt){echo$user->grade($wrt);}else{echo'-';}?></td>
                            <td><?php if($wrt){$j=1;foreach($override->studPosition($user->data()->school_id,$_GET['e'],$wr,$_GET['c'],$_GET['y']) as $pos){
                                    if($result['id'] == $pos['id']){echo$j;}
                                    $j++;}}else{echo'-';}?></td>
                        </tr>
                    </table>
                </td>
                <td>
                    <table width=100% class="table table-bordered table-striped table-condensed mb-none">
                        <tr>
                            <td><?php if($arth){echo$arth;}else{echo'-';}?></td>
                            <td><?php if($arth){echo$user->grade($arth);}else{echo'-';}?></td>
                            <td><?php if($arth){$j=1;foreach($override->studPosition($user->data()->school_id,$_GET['e'],$ar,$_GET['c'],$_GET['y']) as $pos){
                                    if($result['id'] == $pos['id']){echo$j;}
                                    $j++;}}else{echo'-';}?></td>
                        </tr>
                    </table>
                </td>
                <td>
                    <table width=100% class="table table-bordered table-striped table-condensed mb-none">
                        <tr>
                            <td><?php if($kus){echo$kus;}else{echo'-';}?></td>
                            <td><?php if($kus){echo$user->grade($kus);}else{echo'-';}?></td>
                            <td><?php if($kus){$j=1;foreach($override->studPosition($user->data()->school_id,$_GET['e'],$ku,$_GET['c'],$_GET['y']) as $pos){
                                    if($result['id'] == $pos['id']){echo$j;}
                                    $j++;}}else{echo'-';}?></td>
                        </tr>
                    </table>
                </td>
                <td>
                    <table width=100% class="table table-bordered table-striped table-condensed mb-none">
                        <tr>
                            <td><?php if($kua){echo$kua;}else{echo'-';}?></td>
                            <td><?php if($kua){echo$user->grade($kua);}else{echo'-';}?></td>
                            <td><?php if($kua){$j=1;foreach($override->studPosition($user->data()->school_id,$_GET['e'],$ka,$_GET['c'],$_GET['y']) as $pos){
                                    if($result['id'] == $pos['id']){echo$j;}
                                    $j++;}}else{echo'-';}?></td>
                        </tr>
                    </table>
                </td>
                <td>
                    <table width=100% class="table table-bordered table-striped table-condensed mb-none">
                        <tr>
                            <td><?php if($kuh){echo$kuh;}else{echo'-';}?></td>
                            <td><?php if($kuh){echo$user->grade($kuh);}else{echo'-';}?></td>
                            <td><?php if($kuh){$j=1;foreach($override->studPosition($user->data()->school_id,$_GET['e'],$kh,$_GET['c'],$_GET['y']) as $pos){
                                    if($result['id'] == $pos['id']){echo$j;}
                                    $j++;}}else{echo'-';}?></td>
                        </tr>
                    </table>
                </td>
            <?php }
            elseif($_GET['c'] >=3 && $_GET['c'] <=4){?>
                <td>
                    <table width=100% class="table table-bordered table-striped table-condensed mb-none">
                        <tr>
                            <td><?php if($kiswahili){echo$kiswahili;}else{echo'-';}?></td>
                            <td><?php if($kiswahili){echo$user->grade($kiswahili);}else{echo'-';}?></td>
                            <td><?php if($kiswahili){$j=1;foreach($override->studPosition($user->data()->school_id,$_GET['e'],$ki,$_GET['c'],$_GET['y']) as $pos){
                                    if($result['id'] == $pos['id']){echo$j;}
                                    $j++;}}else{echo'-';}?></td>
                        </tr>
                    </table>
                </td>
                <td>
                    <table width=100% class="table table-bordered table-striped table-condensed mb-none">
                        <tr>
                            <td><?php if($English){echo$English;}else{echo'-';}?></td>
                            <td><?php if($English){echo$user->grade($English);}else{echo'-';}?></td>
                            <td><?php if($English){$j=1;foreach($override->studPosition($user->data()->school_id,$_GET['e'],$en,$_GET['c'],$_GET['y']) as $pos){
                                    if($result['id'] == $pos['id']){echo$j;}
                                    $j++;}}else{echo'-';}?></td>
                        </tr>
                    </table>
                </td>
                <td>
                    <table width=100% class="table table-bordered table-striped table-condensed mb-none">
                        <tr>
                            <td><?php if($Mathematics){echo$Mathematics;}else{echo'-';}?></td>
                            <td><?php if($Mathematics){echo$user->grade($Mathematics);}else{echo'-';}?></td>
                            <td><?php if($Mathematics){$j=1;foreach($override->studPosition($user->data()->school_id,$_GET['e'],$ma,$_GET['c'],$_GET['y']) as $pos){
                                    if($result['id'] == $pos['id']){echo$j;}
                                    $j++;}}else{echo'-';}?></td>
                        </tr>
                    </table>
                </td>
                <td>
                    <table width=100% class="table table-bordered table-striped table-condensed mb-none">
                        <tr>
                            <td><?php if($st){echo$st;}else{echo'-';}?></td>
                            <td><?php if($st){echo$user->grade($st);}else{echo'-';}?></td>
                            <td><?php if($st){$j=1;foreach($override->studPosition($user->data()->school_id,$_GET['e'],$snt,$_GET['c'],$_GET['y']) as $pos){
                                    if($result['id'] == $pos['id']){echo$j;}
                                    $j++;}}else{echo'-';}?></td>
                        </tr>
                    </table>
                </td>
                <td>
                    <table width=100% class="table table-bordered table-striped table-condensed mb-none">
                        <tr>
                            <td><?php if($social){echo$social;}else{echo'-';}?></td>
                            <td><?php if($social){echo$user->grade($social);}else{echo'-';}?></td>
                            <td><?php if($social){$j=1;foreach($override->studPosition($user->data()->school_id,$_GET['e'],$scs,$_GET['c'],$_GET['y']) as $pos){
                                    if($result['id'] == $pos['id']){echo$j;}
                                    $j++;}}else{echo'-';}?></td>
                        </tr>
                    </table>
                </td>
                <td>
                    <table width=100% class="table table-bordered table-striped table-condensed mb-none">
                        <tr>
                            <td><?php if($cm){echo$cm;}else{echo'-';}?></td>
                            <td><?php if($cm){echo$user->grade($cm);}else{echo'-';}?></td>
                            <td><?php if($cm){$j=1;foreach($override->studPosition($user->data()->school_id,$_GET['e'],$ci,$_GET['c'],$_GET['y']) as $pos){
                                    if($result['id'] == $pos['id']){echo$j;}
                                    $j++;}}else{echo'-';}?></td>
                        </tr>
                    </table>
                </td>
                <td>
                    <table width=100% class="table table-bordered table-striped table-condensed mb-none">
                        <tr>
                            <td><?php if($rel){echo$rel;}else{echo'-';}?></td>
                            <td><?php if($rel){echo$user->grade($rel);}else{echo'-';}?></td>
                            <td><?php if($rel){$j=1;foreach($override->studPosition($user->data()->school_id,$_GET['e'],$re,$_GET['c'],$_GET['y']) as $pos){
                                    if($result['id'] == $pos['id']){echo$j;}
                                    $j++;}}else{echo'-';}?></td>
                        </tr>
                    </table>
                </td>
                <td>
                    <table width=100% class="table table-bordered table-striped table-condensed mb-none">
                        <tr>
                            <td><?php if($fre){echo$fre;}else{echo'-';}?></td>
                            <td><?php if($fre){echo$user->grade($fre);}else{echo'-';}?></td>
                            <td><?php if($fre){$j=1;foreach($override->studPosition($user->data()->school_id,$_GET['e'],$fr,$_GET['c'],$_GET['y']) as $pos){
                                    if($result['id'] == $pos['id']){echo$j;}
                                    $j++;}}else{echo'-';}?></td>
                        </tr>
                    </table>
                </td>
                <td>
                    <table width=100% class="table table-bordered table-striped table-condensed mb-none">
                        <tr>
                            <td><?php if($arb){echo$arb;}else{echo'-';}?></td>
                            <td><?php if($arb){echo$user->grade($arb);}else{echo'-';}?></td>
                            <td><?php if($arb){$j=1;foreach($override->studPosition($user->data()->school_id,$_GET['e'],$ab,$_GET['c'],$_GET['y']) as $pos){
                                    if($result['id'] == $pos['id']){echo$j;}
                                    $j++;}}else{echo'-';}?></td>
                        </tr>
                    </table>
                </td>
                <td>
                    <table width=100% class="table table-bordered table-striped table-condensed mb-none">
                        <tr>
                            <td><?php if($ent){echo$ent;}else{echo'-';}?></td>
                            <td><?php if($ent){echo$user->grade($ent);}else{echo'-';}?></td>
                            <td><?php if($ent){$j=1;foreach($override->studPosition($user->data()->school_id,$_GET['e'],$en,$_GET['c'],$_GET['y']) as $pos){
                                    if($result['id'] == $pos['id']){echo$j;}
                                    $j++;}}else{echo'-';}?></td>
                        </tr>
                    </table>
                </td>
                <td>
                    <table width=100% class="table table-bordered table-striped table-condensed mb-none">
                        <tr>
                            <td><?php if($dsa){echo$dsa;}else{echo'-';}?></td>
                            <td><?php if($dsa){echo$user->grade($dsa);}else{echo'-';}?></td>
                            <td><?php if($dsa){$j=1;foreach($override->studPosition($user->data()->school_id,$_GET['e'],$ds,$_GET['c'],$_GET['y']) as $pos){
                                    if($result['id'] == $pos['id']){echo$j;}
                                    $j++;}}else{echo'-';}?></td>
                        </tr>
                    </table>
                </td>
            <?php }
            elseif($_GET['c'] >=5 && $_GET['c'] <=7){?>
                <td>
                    <table width=100% class="table table-bordered table-striped table-condensed mb-none">
                        <tr>
                            <td><?php if($kiswahili){echo$kiswahili;}else{echo'-';}?></td>
                            <td><?php if($kiswahili){echo$user->grade($kiswahili);}else{echo'-';}?></td>
                            <td><?php if($kiswahili){$j=1;foreach($override->studPosition($user->data()->school_id,$_GET['e'],$ki,$_GET['c'],$_GET['y']) as $pos){
                                    if($result['id'] == $pos['id']){echo$j;}
                                    $j++;}}else{echo'-';}?></td>
                        </tr>
                    </table>
                </td>
                <td>
                    <table width=100% class="table table-bordered table-striped table-condensed mb-none">
                        <tr>
                            <td><?php if($English){echo$English;}else{echo'-';}?></td>
                            <td><?php if($English){echo$user->grade($English);}else{echo'-';}?></td>
                            <td><?php if($English){$j=1;foreach($override->studPosition($user->data()->school_id,$_GET['e'],$en,$_GET['c'],$_GET['y']) as $pos){
                                    if($result['id'] == $pos['id']){echo$j;}
                                    $j++;}}else{echo'-';}?></td>
                        </tr>
                    </table>
                </td>
                <td>
                    <table width=100% class="table table-bordered table-striped table-condensed mb-none">
                        <tr>
                            <td><?php if($Mathematics){echo$Mathematics;}else{echo'-';}?></td>
                            <td><?php if($Mathematics){echo$user->grade($Mathematics);}else{echo'-';}?></td>
                            <td><?php if($Mathematics){$j=1;foreach($override->studPosition($user->data()->school_id,$_GET['e'],$ma,$_GET['c'],$_GET['y']) as $pos){
                                    if($result['id'] == $pos['id']){echo$j;}
                                    $j++;}}else{echo'-';}?></td>
                        </tr>
                    </table>
                </td>
                <td>
                    <table width=100% class="table table-bordered table-striped table-condensed mb-none">
                        <tr>
                            <td><?php if($science){echo$science;}else{echo'-';}?></td>
                            <td><?php if($science){echo$user->grade($science);}else{echo'-';}?></td>
                            <td><?php if($science){$j=1;foreach($override->studPosition($user->data()->school_id,$_GET['e'],$sc,$_GET['c'],$_GET['y']) as $pos){
                                    if($result['id'] == $pos['id']){echo$j;}
                                    $j++;}}else{echo'-';}?></td>
                        </tr>
                    </table>
                </td>
                <td>
                    <table width=100% class="table table-bordered table-striped table-condensed mb-none">
                        <tr>
                            <td><?php if($Geography){echo$Geography;}else{echo'-';}?></td>
                            <td><?php if($Geography){echo$user->grade($Geography);}else{echo'-';}?></td>
                            <td><?php if($Geography){$j=1;foreach($override->studPosition($user->data()->school_id,$_GET['e'],$ge,$_GET['c'],$_GET['y']) as $pos){
                                    if($result['id'] == $pos['id']){echo$j;}
                                    $j++;}}else{echo'-';}?></td>
                        </tr>
                    </table>
                </td>
                <td>
                    <table width=100% class="table table-bordered table-striped table-condensed mb-none">
                        <tr>
                            <td><?php if($history){echo$history;}else{echo'-';}?></td>
                            <td><?php if($history){echo$user->grade($history);}else{echo'-';}?></td>
                            <td><?php if($history){$j=1;foreach($override->studPosition($user->data()->school_id,$_GET['e'],$hi,$_GET['c'],$_GET['y']) as $pos){
                                    if($result['id'] == $pos['id']){echo$j;}
                                    $j++;}}else{echo'-';}?></td>
                        </tr>
                    </table>
                </td>
                <td>
                    <table width=100% class="table table-bordered table-striped table-condensed mb-none">
                        <tr>
                            <td><?php if($civics){echo$civics;}else{echo'-';}?></td>
                            <td><?php if($civics){echo$user->grade($civics);}else{echo'-';}?></td>
                            <td><?php if($civics){$j=1;foreach($override->studPosition($user->data()->school_id,$_GET['e'],$ci,$_GET['c'],$_GET['y']) as $pos){
                                    if($result['id'] == $pos['id']){echo$j;}
                                    $j++;}}else{echo'-';}?></td>
                        </tr>
                    </table>
                </td>
                <td>
                    <table width=100% class="table table-bordered table-striped table-condensed mb-none">
                        <tr>
                            <td><?php if($rel){echo$rel;}else{echo'-';}?></td>
                            <td><?php if($rel){echo$user->grade($rel);}else{echo'-';}?></td>
                            <td><?php if($rel){$j=1;foreach($override->studPosition($user->data()->school_id,$_GET['e'],$re,$_GET['c'],$_GET['y']) as $pos){
                                    if($result['id'] == $pos['id']){echo$j;}
                                    $j++;}}else{echo'-';}?></td>
                        </tr>
                    </table>
                </td>
                <td>
                    <table width=100% class="table table-bordered table-striped table-condensed mb-none">
                        <tr>
                            <td><?php if($vs){echo$vs;}else{echo'-';}?></td>
                            <td><?php if($vs){echo$user->grade($vs);}else{echo'-';}?></td>
                            <td><?php if($vs){$j=1;foreach($override->studPosition($user->data()->school_id,$_GET['e'],$v,$_GET['c'],$_GET['y']) as $pos){
                                    if($result['id'] == $pos['id']){echo$j;}
                                    $j++;}}else{echo'-';}?></td>
                        </tr>
                    </table>
                </td>
                <td>
                    <table width=100% class="table table-bordered table-striped table-condensed mb-none">
                        <tr>
                            <td><?php if($dsa){echo$dsa;}else{echo'-';}?></td>
                            <td><?php if($dsa){echo$user->grade($dsa);}else{echo'-';}?></td>
                            <td><?php if($dsa){$j=1;foreach($override->studPosition($user->data()->school_id,$_GET['e'],$ds,$_GET['c'],$_GET['y']) as $pos){
                                    if($result['id'] == $pos['id']){echo$j;}
                                    $j++;}}else{echo'-';}?></td>
                        </tr>
                    </table>
                </td>
            <?php }?>
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
        <?php if($_GET['c'] >=1 && $_GET['c'] <=2){?>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$readT?></th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$wrtT?></th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$arthT?></th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$kusT?></th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$kuaT?></th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$kuhT?></th>
        <?php }elseif($_GET['c'] >=3 && $_GET['c'] <=4){?>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$tKi?></th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$tEn?></th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$tM?></th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$stT?></th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$socialT?></th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$cmT?></th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$relT?></th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$freT?></th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$arbT?></th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$entT?></th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$dsaT?></th>
        <?php }elseif($_GET['c'] >=5 && $_GET['c'] <=7){?>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$tKi?></th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$tEn?></th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$tM?></th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$scienceT?></th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$tGe?></th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$tHis?></th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$tCiv?></th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$relT?></th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$vsT?></th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$dsaT?></th>
        <?php }?>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <th>Avg</th>
        <td></td>
        <?php if($_GET['c'] >=1 && $_GET['c'] <=2){?>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$mrk[1]=round($readT/($x-1),1)?></th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$mrk[2]=round($wrtT/($x-1),1)?></th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$mrk[3]=round($arthT/($x-1),1)?></th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$mrk[4]=round($kusT/($x-1),1)?></th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$mrk[5]=round($kuaT/($x-1),1)?></th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$mrk[6]=round($kuhT/($x-1),1)?></th>
        <?php }elseif($_GET['c'] >=3 && $_GET['c'] <=4){?>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$mrk[1]=round($tKi/($x-1),1)?></th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$mrk[2]=round($tEn/($x-1),1)?></th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$mrk[3]=round($tM/($x-1),1)?></th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$mrk[4]=round($stT/($x-1),1)?></th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$mrk[5]=round($socialT/($x-1),1)?></th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$mrk[6]=round($cmT/($x-1),1)?></th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$mrk[7]=round($relT/($x-1),1)?></th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$mrk[8]=round($freT/($x-1),1)?></th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$mrk[9]=round($arbT/($x-1),1)?></th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$mrk[10]=round($entT/($x-1),1)?></th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$mrk[11]=round($dsaT/($x-1),1)?></th>
        <?php }elseif($_GET['c'] >=5 && $_GET['c'] <=7){?>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$mrk[1]=round($tKi/($x-1),1)?></th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$mrk[2]=round($tEn/($x-1),1)?></th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$mrk[3]=round($tM/($x-1),1)?></th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$mrk[4]=round($scienceT/($x-1),1)?></th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$mrk[5]=round($tGe/($x-1),1)?></th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$mrk[6]=round($tHis/($x-1),1)?></th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$mrk[7]=round($tCiv/($x-1),1)?></th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$mrk[8]=round($relT/($x-1),1)?></th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$mrk[9]=round($vsT/($x-1),1)?></th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$mrk[10]=round($dsaT/($x-1),1)?></th>
        <?php }?>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <th>Grd</th>
        <td></td>
        <?php if($_GET['c'] >=1 && $_GET['c'] <=2){?>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$user->grade(round($readT/($x-1),1))?></th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$user->grade(round($wrtT/($x-1),1))?></th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$user->grade(round($arthT/($x-1),1))?></th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$user->grade(round($kusT/($x-1),1))?></th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$user->grade(round($kuaT/($x-1),1))?></th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$user->grade(round($kuhT/($x-1),1))?></th>
        <?php }elseif($_GET['c'] >=3 && $_GET['c'] <=4){?>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$user->grade(round($tKi/($x-1),1))?></th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$user->grade(round($tEn/($x-1),1))?></th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$user->grade(round($tM/($x-1),1))?></th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$user->grade(round($stT/($x-1),1))?></th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$user->grade(round($socialT/($x-1),1))?></th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$user->grade(round($cmT/($x-1),1))?></th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$user->grade(round($relT/($x-1),1))?></th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$user->grade(round($freT/($x-1),1))?></th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$user->grade(round($arbT/($x-1),1))?></th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$user->grade(round($entT/($x-1),1))?></th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$user->grade(round($dsaT/($x-1),1))?></th>
        <?php }elseif($_GET['c'] >=5 && $_GET['c'] <=7){?>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$user->grade(round($tKi/($x-1),1))?></th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$user->grade(round($tEn/($x-1),1))?></th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$user->grade(round($tM/($x-1),1))?></th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$user->grade(round($scienceT/($x-1),1))?></th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$user->grade(round($tGe/($x-1),1))?></th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$user->grade(round($tHis/($x-1),1))?></th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$user->grade(round($tCiv/($x-1),1))?></th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$user->grade(round($relT/($x-1),1))?></th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$user->grade(round($vsT/($x-1),1))?></th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$user->grade(round($dsaT/($x-1),1))?></th>
        <?php }?>
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
        <?php if($_GET['c'] >=1 && $_GET['c'] <=2){?>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php $n=1;foreach($mrk as $p){if($p == round($readT/($x-1),1)){echo$n;}$n++;}?></th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php $a=1;foreach($mrk as $p){if($p == round($wrtT/($x-1),1)){echo$a;}$a++;}?></th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php $a=1;foreach($mrk as $p){if($p == round($arthT/($x-1),1)){echo$a;}$a++;}?></th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php $a=1;foreach($mrk as $p){if($p == round($kusT/($x-1),1)){echo$a;}$a++;}?></th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php $a=1;foreach($mrk as $p){if($p == round($kuaT/($x-1),1)){echo$a;}$a++;}?></th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php $a=1;foreach($mrk as $p){if($p == round($kuhT/($x-1),1)){echo$a;}$a++;}?></th>
        <?php }elseif($_GET['c'] >=3 && $_GET['c'] <=4){?>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php $n=1;foreach($mrk as $p){if($p == round($tKi/($x-1),1)){echo$n;}$n++;}?></th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php $a=1;foreach($mrk as $p){if($p == round($tEn/($x-1),1)){echo$a;}$a++;}?></th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php $a=1;foreach($mrk as $p){if($p == round($tM/($x-1),1)){echo$a;}$a++;}?></th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php $a=1;foreach($mrk as $p){if($p == round($stT/($x-1),1)){echo$a;}$a++;}?></th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php $a=1;foreach($mrk as $p){if($p == round($socialT/($x-1),1)){echo$a;}$a++;}?></th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php $a=1;foreach($mrk as $p){if($p == round($cmT/($x-1),1)){echo$a;}$a++;}?></th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php $n=1;foreach($mrk as $p){if($p == round($relT/($x-1),1)){echo$n;}$n++;}?></th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php $a=1;foreach($mrk as $p){if($p == round($freT/($x-1),1)){echo$a;}$a++;}?></th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php $a=1;foreach($mrk as $p){if($p == round($arbT/($x-1),1)){echo$a;}$a++;}?></th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php $a=1;foreach($mrk as $p){if($p == round($entT/($x-1),1)){echo$a;}$a++;}?></th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php $a=1;foreach($mrk as $p){if($p == round($dsaT/($x-1),1)){echo$a;}$a++;}?></th>
        <?php }elseif($_GET['c'] >=5 && $_GET['c'] <=7){?>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php $n=1;foreach($mrk as $p){if($p == round($tKi/($x-1),1)){echo$n;}$n++;}?></th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php $a=1;foreach($mrk as $p){if($p == round($tEn/($x-1),1)){echo$a;}$a++;}?></th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php $a=1;foreach($mrk as $p){if($p == round($tM/($x-1),1)){echo$a;}$a++;}?></th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php $a=1;foreach($mrk as $p){if($p == round($scienceT/($x-1),1)){echo$a;}$a++;}?></th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php $a=1;foreach($mrk as $p){if($p == round($tGe/($x-1),1)){echo$a;}$a++;}?></th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php $a=1;foreach($mrk as $p){if($p == round($tHis/($x-1),1)){echo$a;}$a++;}?></th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php $n=1;foreach($mrk as $p){if($p == round($tCiv/($x-1),1)){echo$n;}$n++;}?></th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php $a=1;foreach($mrk as $p){if($p == round($relT/($x-1),1)){echo$a;}$a++;}?></th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php $a=1;foreach($mrk as $p){if($p == round($vsT/($x-1),1)){echo$a;}$a++;}?></th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php $a=1;foreach($mrk as $p){if($p == round($dsaT/($x-1),1)){echo$a;}$a++;}?></th>
        <?php }?>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>

    </tbody>
    </table><br>
    <?php if($bundleId){?>
        <form method="post">
            <input type="hidden" name="noStud" value="<?=$noStud?>">
            <input type="hidden" name="bundleId" value="<?=$bundleId[0]['id']?>">
            <input type="hidden" name="parent" value="<?=$parent[0]['phone_number']?>">
            <input type="hidden" name="message" value="<?=$sms?>">
            <div class="col-md-offset-5">
                <input type="submit" class="btn btn-info" value="Send Results to parents" name="sendPrimary">
            </div>
        </form>
    <?php }?>
    </div>
    <br><h4>Abbreviations</h4>
    <p><strong>Civ = Civics , His = History , Kis = Kiswahil , Eng = English , Geo = Geography , Bio = Biology , Che = Chemistry , Phy = Physics , B/Mth = Basic Mathematics , A/Mth = Applied Mathematics ,
            B/K = Book-Keeping , Com = Commerce , Read = Reading , Write = Writing , Arth = Arithmetics , Kus = Kusoma , Kua = Kuandika , Hes = Kuhesabu ,
        Sc$Tec = Science and Technology , Soc = Social Studies , Civ&Mor = Civics And Moral , Rel = Religion , Fre = French , Ent = Entrepreneurship ,
        Spo = Development,Sports & Arts , Arb = Arabic , Sci = Science , A/Math = Applied Mathematics , Vcs = Vocational Skills , </strong></p>
    <ul class="list list-icons list-icons-style-3 list-icons-sm">
        <li><strong><i class="fa fa-check"></i> A = 81 - 100 , Excellent</strong></li>
        <li><strong><i class="fa fa-check"></i> B = 61 - 80 , Very Good</strong></li>
        <li><strong><i class="fa fa-check"></i> C = 41 - 60 , Good</strong></li>
        <li><strong><i class="fa fa-check"></i> D = 21 - 40 , Pass</strong></li>
        <li><strong><i class="fa fa-check"></i> F = 0 - 20 , Fail</strong></li>
    </ul>
<?php }
elseif($_GET['J'] == 1 && $_GET['c'] >=12 && $_GET['c'] <=13){?>
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