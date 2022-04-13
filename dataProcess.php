<?php
require_once'php/core/init.php';
$user = new User();
$override = new OverideData();
$getName = '"selectpicker form-control mb-md"'.' multiple data-live-search="true"';
if($_GET['content'] == 'zone') {
    if ($_GET['zoneId']) {
        $regions = $override->get('region', 'zone_id', $_GET['zoneId']);
        echo '<option>Select Region</option>
            <option value="all">All</option>';
        foreach ($regions as $region) {
            echo "<option value=" . $region['id'] . ">" . $region['name'] . "</option>";
        }
    }

    if ($_GET['zoneId'] == 14) {
        $regions = $override->getData('region');
        echo '<option value=' . 'all> All </option>';
        foreach ($regions as $region) {
            echo "<option value=" . $region['id'] . ">" . $region['name'] . "</option>";
        }
    }
}
elseif($_GET['content'] == 'file'){if(!$_GET['attachFile'] == null){?>
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
<?php }} elseif($_GET['content'] == 'teacher'){?>
    <input type="hidden" name="token" value="teachers">
<?php }elseif($_GET['content'] == 'parent'){?>
    <input type="hidden" name="token" value="parents">
<?php }elseif($_GET['content'] == 'general_public'){?>
    <input type="hidden" name="token" value="generalNews">
<?php }elseif($_GET['content'] == 'position'){if($_GET){}}

elseif($_GET['content'] == 'studentList'){ $x=1;
    foreach($override->getNews('students','school_id',$_GET['id'],'class_id',$_GET['classId']) as $studentList){?>
        <tr data-item-id="<?=$x?>">
            <td><?=$x?></td>
            <td><a href="edit.php?content=<?=$studentList['id']?>&group=students&data=stud_detail&message=' '"><?=$studentList['firstname'].' '.$studentList['middlename'].' '.$studentList['lastname']?></a></td>
            <td><?=$studentList['gender']?></td>
            <td><?php foreach($override->get('class_list','id',$studentList['class_id']) as $studentClass){echo $studentClass['class_name'];}?></td>
        </tr>
        <?php $x++;}}
elseif($_GET['content'] == 'year'){
    foreach($override->selectData('results','school_id',$_GET['school'],'student_id',$_GET['student'],'year',$_GET['getYear']) as $result){
        $student = $override->get('students','id',$_GET['student']) ?>
        <tr data-item-id="1">
            <td><?php foreach($override->get('subjects','id',$result['subject_id']) as $subject){echo $subject['name'];} ?></td>
            <td><?php foreach($override->get('class_list','id',$student[0]['class_id']) as $class){echo $class['class_name'];} ?></td>
            <td><?php foreach($override->get('exam_type','id',$result['exam_id']) as $examType){echo $examType['name'];} ?></td>
            <td><?=$result['score']?></td>
        </tr>
    <?php }}
elseif($_GET['content'] == 'editStud'){foreach($override->get('students','id',$_GET['studId']) as $studInfo){ ?>
    <tr data-item-id="1">
        <td><input type="text" name="firstname" value="<?=$studInfo['firstname']?>"></td>
        <td><input type="text" name="middlename" value="<?=$studInfo['middlename']?>"></td>
        <td><input type="text" name="lastname" value="<?=$studInfo['lastname']?>"></td>
        <td><select name="gender"><option value="Male">Male</option><option value="Female">Female</option></select></td>
        <td><select name="student_class" class="form-control mb-md" title="Choose Student Class">
                <option value="">Choose Student Class</option>
                <?php if(!$override->getData('class_list') == null){
                    foreach($override->getData('class_list') as $class){?>
                        <option value='<?=$class['id']?>'> <?=$class['class_name']?> </option>
                    <?php }}?>
            </select>
        </td>
        <td><select name="stream"  class="form-control mb-md" title="Choose Stream" required>
                <option value="">Choose Stream</option>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
                <option value="D">D</option>
                <option value="E">E</option>
                <option value="F">F</option>
                <option value="G">G</option>
                <option value="H">H</option>
            </select>
        </td>
    </tr>
<?php }}
elseif($_GET['content'] == 'student'){ $x = 0; ?>

<!--<ul class="list list-icons">-->
<div class="panel-group panel-group-primary" id="accordion2Primary">
<?php $school = $override->get('students','id',$_GET['getStudent']);//print_r($school);echo $school[0]['school_id'];echo date('Y');echo $_GET['getStudent'];
foreach($override->getExamType('results','school_id',$school[0]['school_id'],'student_id',$_GET['getStudent'],'years',date('Y')) as $examType){;
    foreach($override->get('exam_type','id',$examType['exam_id']) as $exam){?>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2Primary" href="#collapse2PrimaryOne<?=$x?>">
                        <?=$exam['name']?>
                    </a>
                </h4>
            </div>
            <div id="collapse2PrimaryOne<?=$x?>" class="accordion-body collapse">
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-condensed mb-none">
                            <thead>
                            <tr>
                                <th class="text-right">Subject Name</th>
                                <th class="text-right">Score</th>
                                <th class="text-right">Grade</th>
                                <th class="text-right">Position</th>
                                <th class="text-right">Highest Score</th>
                                <th class="text-right">Lowest Score</th>
                                <th class="text-right">Class Average</th>
                                <th class="text-right">More Details</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $examResults = $override->getSelectDataNoRepeat('results','score','subject_id','class_id','school_id',$school[0]['school_id'],'student_id',$_GET['getStudent'],'years',date('Y'),'exam_id',$exam['id']);
                            $numStud = $override->rowCounted('students','school_id',$school[0]['school_id'],'class_id',$examResults[0]['class_id']);
                            foreach($examResults as  $examResult){$getSubject = $override->get('subjects','id',$examResult['subject_id']);
                                $avg = $getPosition = $override->getStudAvg('results','school_id',$school[0]['school_id'],'subject_id',$examResult['subject_id'],'class_id',$examResult['class_id'],'exam_id',$exam['id'],'years',date('Y'));
                                $getPosition = $override->getStudPosition('results','school_id',$school[0]['school_id'],'subject_id',$examResult['subject_id'],'class_id',$examResult['class_id'],'exam_id',$exam['id'],'years',date('Y'));
                                $y = 1; $studentPosition = null;$highScore = null;$lowScore = null;foreach($getPosition as $studPosition){
                                    if($y == 1){ $highScore = $studPosition['score'];}
                                    if ($studPosition['student_id'] == $_GET['getStudent']){$studentPosition = $y;}
                                    if($y == $numStud){$lowScore = $studPosition['score'];}
                                    $y++;} ?>
                                <tr>
                                    <td class="text-right"><?=$getSubject[0]['name']?></td>
                                    <td class="text-right"><?=$examResult['score']?></td>
                                    <td class="text-right"><?php if($examResult['score'] >= 81){echo'A';}elseif($examResult['score']>=61 && $examResult['score']<=80){echo'B';}elseif($examResult['score']>=41 && $examResult['score']<=60){echo'C';}
                                        elseif($examResult['score']>=21 && $examResult['score']<=40){echo'D';}else{echo'F';}?></td>
                                    <td class="text-right"><?=$studentPosition?></td>
                                    <td class="text-right"><?=$highScore?></td>
                                    <td class="text-right"><?=$lowScore?></td>
                                    <td class="text-right"><?=ceil($avg[0]['AVG(score)'])?></td>
                                    <td class="text-right"><a href="result.php?sc=<?=$school[0]['school_id']?>&cl=<?=$examResult['class_id']?>&sb=<?=$examResult['subject_id']?>&st=<?=$_GET['getStudent']?>&et=<?=$exam['id']?>&yr=<?=date('Y')?>&p=<?=$studentPosition?>" target="_blank"> view more</a></td>
                                </tr>
                            <?php  }  ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    <?php }$x++;}
echo '</div>';
}
elseif($_GET['content'] == 'student_class'){ $x = 0;?>
<div class="panel-group panel-group-primary" id="accordion2Primary">
    <?php $school = $override->get('students','id',$_GET['student']);
    foreach($override->getExamType('results','school_id',$school[0]['school_id'],'student_id',$_GET['student'],'class_id',$_GET['getStudentClass']) as $examType){
        foreach($override->get('exam_type','id',$examType['exam_id']) as $exam){?>
            <!-- <li><i class="fa fa-bookmark"></i><a href="parent.php?exam=<?=$exam['id']?>"><?=$exam['name']?></a></li> -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2Primary" href="#collapse2PrimaryOne<?=$x?>">
                            <?=$exam['name']?>
                        </a>
                    </h4>
                </div>
                <div id="collapse2PrimaryOne<?=$x?>" class="accordion-body collapse">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-condensed mb-none">
                                <thead>
                                <tr>
                                    <th class="text-right">Subject Name</th>
                                    <th class="text-right">Score</th>
                                    <th class="text-right">Grade</th>
                                    <th class="text-right">Position</th>
                                    <th class="text-right">Highest Score</th>
                                    <th class="text-right">Lowest Score</th>
                                    <th class="text-right">Class Average</th>
                                    <th class="text-right">More Details</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $examResults = $override->getSelectDataNoRepeat('results','score','subject_id','class_id','school_id',$school[0]['school_id'],'student_id',$_GET['student'],'class_id',$_GET['getStudentClass'],'exam_id',$exam['id']);
                                $numStud = $override->rowCounted('students','school_id',$school[0]['school_id'],'class_id',$examResults[0]['class_id']);
                                foreach($examResults as  $examResult){$getSubject = $override->get('subjects','id',$examResult['subject_id']);
                                    $avg = $getPosition = $override->getStudAvg('results','school_id',$school[0]['school_id'],'subject_id',$examResult['subject_id'],'class_id',$examResult['class_id'],'exam_id',$exam['id'],'years',date('Y'));
                                    $getPosition = $override->getStudPosition('results','school_id',$school[0]['school_id'],'subject_id',$examResult['subject_id'],'class_id',$examResult['class_id'],'exam_id',$exam['id'],'years',date('Y'));
                                    $y = 1; $studentPosition = null;$highScore = null;$lowScore = null;foreach($getPosition as $studPosition){
                                        if($y == 1){ $highScore = $studPosition['score'];}
                                        if ($studPosition['student_id'] == $_GET['student']){$studentPosition = $y;}
                                        if($y == $numStud){$lowScore = $studPosition['score'];}
                                        $y++;} ?>
                                    <tr>
                                        <td class="text-right"><?=$getSubject[0]['name']?></td>
                                        <td class="text-right"><?=$examResult['score']?></td>
                                        <td class="text-right"></td>
                                        <td class="text-right"><?=$studentPosition?></td>
                                        <td class="text-right"><?=$highScore?></td>
                                        <td class="text-right"><?=$lowScore?></td>
                                        <td class="text-right"><?=ceil($avg[0]['AVG(score)'])?></td>
                                        <td class="text-right"><a href="result.php?sc=<?=$school[0]['school_id']?>&cl=<?=$examResult['class_id']?>&sb=<?=$examResult['subject_id']?>&st=<?=$_GET['student']?>&et=<?=$exam['id']?>&yr=<?=date('Y')?>&p=<?=$studentPosition?>"> view more</a></td>
                                    </tr>
                                <?php  }  ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        <?php }$x++;} echo '</div>';}

    elseif($_GET['content'] == 'prevSubj'){ ?>
        <div class="form-group">
            <div class="col-md-4">
                <div class="help-block with-errors"></div>
                <select name="previous_subject"  id="" class="form-control mb-md" required>
                    <option>Select Previous Subject</option>
                    <?php foreach($override->getSelectNoRepeat('teaching_subject','subject_id','school_id',$_GET['id'],'teacher_id',$_GET['prevSubj']) as $prevSubjects){
                        foreach($override->get('subjects','id',$prevSubjects['subject_id']) as $prevSubject){ ?>
                            <option value="<?=$prevSubject['id']?>"><?=$prevSubject['name']?></option>
                        <?php }}?>
                </select>
            </div>
            <div class="col-md-4">
                <div class="help-block with-errors"></div>
                <select name="previous_subject"  id="" class="form-control mb-md" required>
                    <option>Select Previous Class</option>
                    <?php foreach($override->getNoRepeat3('teaching_subject','class_id','school_id',$_GET['id'],'subject_id',$prevSubject['id'],'teacher_id',$_GET['prevSubj']) as $techClass){
                        foreach($override->get('class_list','id',$techClass['class_id']) as $teachingClass){?>
                            <option value="<?=$teachingClass['id']?>"><?=$teachingClass['class_name']?></option>
                        <?php }} ?>
                </select>
            </div>
            <div class="col-md-4">
                <div class="help-block with-errors"></div>
                <select name="previous_subject"  id="new_allocation" class="form-control mb-md" required>
                    <option>Select Stream</option>
                    <?php foreach($override->getNoRepeat3('teaching_subject','stream','school_id',$_GET['id'],'subject_id',$prevSubject['id'],'teacher_id',$_GET['prevSubj']) as $techStream){?>
                        <option value="<?=$techStream['stream']?>"><?=$techStream['stream']?></option>
                    <?php } ?>
                </select>
            </div>
        </div>


        <div class="form-group">
            <div class="col-md-4">
                <div class="help-block with-errors"></div>
                <select name="subject"  class="form-control mb-md" required>
                    <option>Select New Subject</option>
                    <?php foreach($override->getData('subjects') as $teachingSubject){?>
                        <option value="<?=$teachingSubject['id']?>"><?=$teachingSubject['name']?></option>
                    <?php }?>
                </select>
            </div>
            <div class="col-md-4">
                <div class="help-block with-errors"></div>
                <select name="teaching_class" class="form-control mb-md"  title="Choose Class" required>
                    <option>Select Class</option>
                    <?php foreach($override->getData('class_list') as $teachingClass){?>
                        <option value="<?=$teachingClass['id']?>"><?=$teachingClass['class_name']?></option>
                    <?php }?>
                </select>
            </div>
            <div class="col-md-4">
                <div class="help-block with-errors"></div>
                <select name="stream" id="techStream" class="form-control mb-md" required>
                    <option>Select Stream</option>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                    <option value="D">D</option>
                    <option value="E">E</option>
                    <option value="F">F</option>
                    <option value="G">G</option>
                    <option value="H">H</option>
                </select>
            </div>
        </div>

    <?php }
    elseif($_GET['content'] == 'newAllocation'){?>
        <div class="col-md-4">
            <div class="help-block with-errors"></div>
            <select name="subject"  class="selectpicker form-control mb-md" data-live-search="true" title="Choose New Subject" required>
                <?php foreach($override->getData('subjects') as $teachingSubject){?>
                    <option value="<?=$teachingSubject['id']?>"><?=$teachingSubject['name']?></option>
                <?php }?>
            </select>
        </div>
        <div class="col-md-4">
            <div class="help-block with-errors"></div>
            <select name="teaching_class" id="techClass" class="selectpicker form-control mb-md" data-live-search="true" title="Choose Class" required>
                <?php foreach($override->getData('class_list') as $teachingClass){?>
                    <option value="<?=$teachingClass['id']?>"><?=$teachingClass['class_name']?></option>
                <?php }?>
            </select>
        </div>
        <div class="col-md-4">
            <div class="help-block with-errors"></div>
            <select name="stream" id="techStream" class="selectpicker form-control mb-md" data-live-search="true" title="Choose Stream" required>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
                <option value="D">D</option>
                <option value="E">E</option>
                <option value="F">F</option>
                <option value="G">G</option>
                <option value="H">H</option>
            </select>
        </div>
    <?php }
    elseif($_GET['content'] == 'prevStream'){} ?>
