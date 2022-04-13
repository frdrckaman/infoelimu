<?php
require_once'php/core/init.php';
$user = new User();
$override = new OverideData(); $checkUser = 0; $type = null;$upTch=null;$upPr=null;$upGn=null;$total = 0;$totalM=0;$totalF=0;$checkTNews=null;
$news = null;$pass = null;$info = null;$reg = null;$upld = null;$subAl= null;$sInfo= null;$males = 0;$female = 0;$errorM=false;
$regT = null;$regS = null;$listS = null;$listT = null;$upldR = null;$studR = null;$zone=null;$region=null;$sum = 0;$upldError = false;
$pageError = null; $errorMessage = null; $successMessage = null;$file = false;$noFile= false;$no = 0;$name = null;$attachment_file = '';
$newAll=null;$changeS=null;$changeP=null;$checkP=false;$updateSubject=false;$getResult=null;$validateSearch = false;$nextStage =null;
$selectClass = null;$selectParent = null;$checkPoint = null;$getClassId = null;$getStreamId = null;$sendSmsTo=false;
if($user->isLoggedIn()){
    if($user->getSessionTable() === 'teachers') {
        if($user->getSessionTable() === 'teachers' && $user->data()->position == 'Headmaster' || $user->data()->position == 'SecondMaster') {
            $checkUser = 1;
            $contentMenu = 'Content Menu';
        }elseif($user->getSessionTable() == 'teachers' && $user->data()->position == 'Normal Teacher' ) {
            $checkUser = 2;
        }
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
                ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                if(Input::get('uploadNews')){ $upld = 'active';$news = null;
                  /*  if(!$schoolLocationInfo == null){$zone = $schoolLocationInfo[0]['zone_id'];$region = $schoolLocationInfo[0]['region_id'];}
                    if ($validate->passed() && $errorM = false) {
                        try {
                            /*$user->createRecord('school_notification', array(
                                'title' => Input::get('message_title'),
                                'message' => Input::get('message_body'),
                                'attachment' => $attachment_file,
                                'accessLevel' => Input::get('intended_to'),
                                'postTime' => date('Y/m/d'),
                                'school_id'=>$user->data()->school_id,
                                'teacher_id' => $user->data()->id
                            ));
                            //$user->sendSMS(Input::get('intended_to'),Input::get('message_body'));
                            if(Input::get('intended_to') == 'all' && Input::get('token')=='teachers') {
                                foreach ($override->get('teachers', 'school_id', $user->data()->school_id) as $sendAll) {
                                   // $user->sendSMS($sendAll['phone_number'],Input::get('message_body'));
                                }
                            }elseif(Input::get('intended_to') == 'all' && Input::get('token') == 'parents'){
                                foreach ($override->get('students', 'school_id', $user->data()->school_id) as $sendAll) {
                                    foreach($override->get('parents','id',$sendAll['parent_id']) as $allParent){
                                       // $user->sendSMS($allParent['phone_number'],Input::get('message_body'));
                                    }
                                }
                            }elseif(Input::get('token') =='parents'){
                                foreach($override->getNews('students','school_id',$user->data()->school_id,'class_id',Input::get('intended_to')) as $getStudClass){
                                    foreach($override->get('parents','id',$getStudClass['parent_id']) as $parentClass){
                                       // $user->sendSMS($parentClass['phone_number'],Input::get('message_body'));
                                    }
                                }
                            } elseif(Input::get('token')=='teachers'){$user->sendSMS(Input::get('intended_to'),Input::get('message_body'));}
                            $successMessage = 'Announcement have been updated Successful';
                        } catch (Exception $e) {
                            die($e->getMessage());
                        }
                    } else {
                        $pageError = $validate->errors();
                    }*/
                    if (!empty($_FILES['attachment']["tmp_name"])) {
                        $attach_file = $_FILES['attachment']['type'];
                        if ($attach_file == "application/pdf" || $attach_file == "application/vnd.openxmlformats-officedocument.wordprocessingml.document" || $attach_file == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet") {
                            $folderName = 'attachment/school_notification/';
                            $attachment_file = $folderName . basename($_FILES['attachment']['name']);
                            if (move_uploaded_file($_FILES['attachment']["tmp_name"], $attachment_file)) {
                                $file = true;
                            } else {
                                {
                                    $errorM = true;
                                    $errorMessage = 'File Not Uploaded ,';
                                }
                            }
                        } else {
                            $errorM = true;
                            $errorMessage = 'None supported file format';
                        }//not supported format
                    } //else $errorMessage = 'No attached file ,';//no attached file

                    if (Input::get('postTo') == 'teachers') {$upTch = 'active';
                        $validate = new validate();
                        $validate = $validate->check($_POST, array(
                            'message_title' => array(
                                'required' => true,
                            ),
                            'message_body' => array(
                                'required' => true,
                            ),
                        ));
                        if (Input::get('teacher') == null && Input::get('postTo') == 'teachers') {
                            $upldError = true;
                            $errorMessage = 'Teacher is required ,';
                        }
                        if ($validate->passed() && $upldError == false && $errorM == false) {
                            if (Input::get('postTo') == 'teachers') {$upTch = 'active';
                                $noTeacher = count(Input::get('teacher'));
                                $num = $override->getCount('teachers','school_id',$user->data()->school_id);
                                $bundleId = $override->getNews('bundle_usage','org_name','schools','org_id',$user->data()->school_id);
                                if($user->validateBundle(Input::get('message_body'),$noTeacher,$bundleId[0]['id'])){$sendSmsTo=true;}
                                foreach (Input::get('teacher') as $teacher) {
                                    if ($teacher == 'all') {
                                        $teachers = $override->get('teachers','school_id',$user->data()->school_id);
                                        if($user->validateBundle(Input::get('message_body'),$num,$bundleId[0]['id'])){
                                            foreach($teachers as $teacherz){
                                                $user->sendSMS($teacherz['phone_number'],Input::get('message_body'));
                                                $remainSms = $override->get('bundle_usage','id',$bundleId[0]['id'])[0]['sms'] - $user->countWords(Input::get('message_body'),1);
                                                $user->updateRecord('bundle_usage',array(
                                                    'sms' => $remainSms,
                                                ),$bundleId[0]['id']);
                                            }
                                            try {
                                                $user->createRecord('school_notification', array(
                                                    'title' => Input::get('message_title'),
                                                    'message' => Input::get('message_body'),
                                                    'school_id' => $user->data()->school_id,
                                                    'school_news' => 'teacherAll',
                                                    'attachment' => $attachment_file,
                                                    'postTime' => date('d-m-Y'),
                                                ));
                                                $successMessage = 'Announcement have been successfully uploaded';
                                                break;
                                            } catch (Exception $e) {
                                                die($e->getMessage());
                                            }
                                        }else{$errorMessage='No sufficient sms to complete this request';}
                                    }
                                    else {
                                        $getTechInfo = $override->get('teachers', 'id', $teacher);
                                       if($sendSmsTo == true){
                                           try {
                                               $user->createRecord('school_notification', array(
                                                   'title' => Input::get('message_title'),
                                                   'message' => Input::get('message_body'),
                                                   'teacher_id' => $teacher,
                                                   'school_id' => $user->data()->school_id,
                                                   'attachment' => $attachment_file,
                                                   'postTime' => date('d-m-Y'),
                                               ));
                                               $user->sendSMS($getTechInfo[0]['phone_number'],Input::get('message_body'));
                                               $remainSms = $override->get('bundle_usage','id',$bundleId[0]['id'])[0]['sms'] - $user->countWords(Input::get('message_body'),1);
                                               $user->updateRecord('bundle_usage',array(
                                                   'sms' => $remainSms,
                                               ),$bundleId[0]['id']);
                                               $successMessage = 'Announcement have been successfully uploaded';
                                           } catch (Exception $e) {
                                               die($e->getMessage());
                                           }
                                       }
                                       else{$errorMessage='No sufficient sms to complete this request';}
                                    }
                                }
                            }
                        } else {
                            $pageError = $validate->errors();
                        }
                        /////////////////////////////////////// Select class and stream ////////////////////////////////////////////////////////////////
                    }
                    elseif(Input::get('uploadNews') && Input::get('chooseParent') == 'getParent'){
                       $upPr = 'active';
                        $validate = new validate();
                        $validate = $validate->check($_POST, array(
                            'class' => array(
                                'required' => true,
                            ),
                            'stream' => array(
                                'required' => true,
                            ),
                        ));
                        if ($validate->passed() && $errorM == false){$nextStage = 'nextStage';
                            if(!Input::get('class') == null && !Input::get('stream') == null){
                                if(Input::get('class') == 'all'){
                                    $selectClass = $override->get('students','school_id',$user->data()->school_id);
                                    $checkPoint = 'allClass';$getClassId = Input::get('class');$getStreamId = Input::get('stream');
                                }elseif(Input::get('stream') == 'all'){
                                    $selectClass = $override->getNews('students','school_id',$user->data()->school_id,'class_id',Input::get('class'));
                                   $checkPoint= 'allStream';$getClassId = Input::get('class');$getStreamId = Input::get('stream');
                                }else{
                                    $selectClass = $override->selectData('students','school_id',$user->data()->school_id,'class_id',Input::get('class'),'stream',Input::get('stream'));
                                   $checkPoint = 'classStream';$getClassId = Input::get('class');$getStreamId = Input::get('stream');
                                }
                            }
                        } else {
                            $pageError = $validate->errors();
                        }
                        /////////////////////////////////////////// uploads to parents ///////////////////////////////////////////////////////////////////////////////

                    }
                    elseif(Input::get('postTo') === 'parentNews'){$upPr = 'active';
                        $validate = new validate();
                        $validate = $validate->check($_POST, array(
                            'message_title' => array(
                                'required' => true,
                            ),
                            'message_body' => array(
                                'required' => true,
                            ),
                        ));
                        if (Input::get('studParent') == null) {
                            $upldError = true;
                            $errorMessage = 'Select Student(s) ,';
                        }
                        if ($validate->passed() && $errorM == false && $upldError == false){$upPr = 'active';
                            $noPr=count(Input::get('studPaarent'));
                            $bundleId = $override->getNews('bundle_usage','org_name','schools','org_id',$user->data()->school_id);
                            if($user->validateBundle(Input::get('message_body'),$noPr,$bundleId[0]['id'])){$sendSmsTo=true;}
                         foreach(Input::get('studParent') as $parentStud){
                             if($parentStud == 'all' && Input::get('checkPoint') == 'allClass'){
                                 $noParent = $override->getCount('parents','school_id',$user->data()->school_id);print_r($user->countWords(Input::get('message_body'),$noParent));
                                 $parentRqd = $override->get('parents','school_id',$user->data()->school_id);
                                 if($user->validateBundle(Input::get('message_body'),$noParent,$bundleId[0]['id'])){
                                     foreach($parentRqd as $parentR){
                                         $user->sendSMS($parentR['phone_number'],Input::get('message_body'));
                                         $remainSms = $override->get('bundle_usage','id',$bundleId[0]['id'])[0]['sms'] - $user->countWords(Input::get('message_body'),1);
                                         $user->updateRecord('bundle_usage',array(
                                             'sms' => $remainSms,
                                         ),$bundleId[0]['id']);
                                     }
                                     try {
                                         $user->createRecord('school_notification', array(
                                             'title' => Input::get('message_title'),
                                             'message' => Input::get('message_body'),
                                             'school_id' => $user->data()->school_id,
                                             'school_news' =>'parentAll',
                                             'attachment' => $attachment_file,
                                             'postTime' => date('d-m-Y'),
                                         ));
                                         $successMessage = 'Announcement have been successfully posted';
                                         $redirect='teacher.php?s='.$successMessage;Redirect::to($redirect);
                                         break;
                                     } catch (Exception $e) {
                                         die($e->getMessage());
                                     }
                                 }else{$errorMessage='No sufficient sms to complete this request';$redirect='teacher.php?s='.$errorMessage;Redirect::to($redirect);}
                             }
                             elseif($parentStud == 'all' && Input::get('checkPoint') == 'allStream'){
                                 $getStudent = $override->getNews('students','school_id',$user->data()->school_id,'class_id',Input::get('classId'));
                                 $noStudent = $override->countData('students','school_id',$user->data()->school_id,'class_id',Input::get('classId'));

                                 if($user->validateBundle(Input::get('message_body'),$noStudent,$bundleId[0]['id'])){
                                     foreach($getStudent as $stdnt){$stdParent=$override->get('parents','id',$stdnt['parent_id']);
                                         $user->sendSMS($stdParent[0]['phone_number'],Input::get('message_body'));
                                         $remainSms = $override->get('bundle_usage','id',$bundleId[0]['id'])[0]['sms'] - $user->countWords(Input::get('message_body'),1);
                                         $user->updateRecord('bundle_usage',array(
                                             'sms' => $remainSms,
                                         ),$bundleId[0]['id']);
                                     }
                                     try {
                                         $user->createRecord('school_notification', array(
                                             'title' => Input::get('message_title'),
                                             'message' => Input::get('message_body'),
                                             'school_id' => $user->data()->school_id,
                                             'school_news' =>'classAll',
                                             'class_id' => Input::get('classId'),
                                             'attachment' => $attachment_file,
                                             'postTime' => date('d-m-Y'),
                                         ));
                                         $successMessage = 'Announcement have been successfully uploaded';
                                         $redirect='teacher.php?s='.$successMessage;Redirect::to($redirect);
                                         break;
                                     } catch (Exception $e) {
                                         die($e->getMessage());
                                     }
                                 }else{$errorMessage='No sufficient sms to complete this request';$redirect='teacher.php?s='.$errorMessage;Redirect::to($redirect);}
                             }
                             elseif($parentStud == 'all' && Input::get('checkPoint') == 'classStream'){
                                 $getStudent = $override->selectData('students','school_id',$user->data()->school_id,'class_id',Input::get('classId'),'stream',Input::get('streamId'));
                                 $noStudent = $override->getCounted('students','school_id',$user->data()->school_id,'class_id',Input::get('classId'),'stream',Input::get('streamId'));
                                 if($user->validateBundle(Input::get('message_body'),$noStudent,$bundleId[0]['id'])){
                                     foreach($getStudent as $stdnt){$stdParent=$override->get('parents','id',$stdnt['parent_id']);
                                         $user->sendSMS($stdParent[0]['phone_number'],Input::get('message_body'));
                                         $remainSms = $override->get('bundle_usage','id',$bundleId[0]['id'])[0]['sms'] - $user->countWords(Input::get('message_body'),1);
                                         $user->updateRecord('bundle_usage',array(
                                             'sms' => $remainSms,
                                         ),$bundleId[0]['id']);
                                     }
                                     try {
                                         $user->createRecord('school_notification', array(
                                             'title' => Input::get('message_title'),
                                             'message' => Input::get('message_body'),
                                             'school_id' => $user->data()->school_id,
                                             'school_news' =>'streamAll',
                                             'class_id' => Input::get('classId'),
                                             'stream' => Input::get('streamId'),
                                             'attachment' => $attachment_file,
                                             'postTime' => date('d-m-Y'),
                                         ));
                                         $successMessage = 'Announcement have been successfully uploaded';
                                         $redirect='teacher.php?s='.$successMessage;Redirect::to($redirect);
                                         break;
                                     } catch (Exception $e) {
                                         die($e->getMessage());
                                     }
                                 }else{$errorMessage='No sufficient sms to complete this request';$redirect='teacher.php?s='.$errorMessage;Redirect::to($redirect);}
                             }
                             else{
                                 if($sendSmsTo == true){
                                     $stdParent=$override->get('parents','id',$parentStud);
                                     try {
                                         $user->createRecord('school_notification', array(
                                             'title' => Input::get('message_title'),
                                             'message' => Input::get('message_body'),
                                             'school_id' => $user->data()->school_id,
                                             'class_id' => Input::get('classId'),
                                             'parent_id'=> $parentStud,
                                             'stream' => Input::get('streamId'),
                                             'attachment' => $attachment_file,
                                             'postTime' => date('d-m-Y'),
                                         ));
                                         $user->sendSMS($stdParent[0]['phone_number'],Input::get('message_body'));
                                         $remainSms = $override->get('bundle_usage','id',$bundleId[0]['id'])[0]['sms'] - $user->countWords(Input::get('message_body'),1);
                                         $user->updateRecord('bundle_usage',array(
                                             'sms' => $remainSms,
                                         ),$bundleId[0]['id']);
                                         $successMessage = 'Announcement have been successfully uploaded';
                                     } catch (Exception $e) {
                                         die($e->getMessage());
                                     }
                                 }else{$errorMessage='No sufficient sms to complete this request';}
                             }
                             //// sending data to the database //////
                         }
                        } else {$nextStage = 'nextStage';
                            $pageError = $validate->errors();
                        }
                        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                    }
                    elseif(Input::get('postTo') === 'generalNews'){ $upGn = 'active';
                        $validate = new validate();
                        $validate = $validate->check($_POST, array(
                            'message_title' => array(
                                'required' => true,
                            ),
                            'message_body' => array(
                                'required' => true,
                            ),
                        ));
                        if ($validate->passed() && $errorM == false){$upGn = 'active';
                            try {
                                $user->createRecord('school_notification', array(
                                    'title' => Input::get('message_title'),
                                    'message' => Input::get('message_body'),
                                    'school_id' => $user->data()->school_id,
                                    'general_news' => 1,
                                    'attachment' => $attachment_file,
                                    'postTime' => date('d-m-Y'),
                                ));
                                $successMessage = 'Announcement have been successfully uploaded';
                            } catch (Exception $e) {
                                die($e->getMessage());
                            }
                        } else {
                            $pageError = $validate->errors();
                        }
                    }
                }
                //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
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
                                        'min' => 1,
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
                                    'other_phone_number' => array(
                                        'unique' => 'teachers'
                                    ),
                                    'email_address' => array(
                                        'min' => 6,
                                        'unique' => 'teachers'
                                    ),
                                ));
                                if ($validate->passed()) {
                                    $schoolId = $user->data()->school_id;
                                    $salt = Hash::salt(32);
                                    $password = '123456';
                                    try {
                                        $user->createRecord('teachers', array(
                                            'firstname' => Input::get('firstname'),
                                            'middlename' => Input::get('middlename'),
                                            'lastname' => Input::get('lastname'),
                                            'gender' => Input::get('gender'),
                                            'school_id' => $schoolId,
                                            'position' => Input::get('position'),
                                            'class_teacher' => '',
                                            'stream' => '',
                                            'phone_number' => Input::get('phone_number'),
                                            'other_phone_number' => Input::get('other_phone_number'),
                                            'email_address' => Input::get('email_address'),
                                            'password' => Hash::make($password, $salt),
                                            'salt' => $salt
                                        ));
                                        $successMessage = 'The teacher has been successfully registered';
                                        // Session::flash('home','You have been register you can log in now');
                                        // Redirect::to('tamosco.php');

                                    } catch (Exception $e) {
                                        die($e->getMessage());
                                    }
                                } else {
                                    $pageError = $validate->errors();
                                }
                            }
                //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                if(Input::get('regStudent')){ $regS = 'active';$news = null;
                    $validate = new validate();
                    $validate = $validate->check($_POST, array(
                        'student_firstname' => array(
                            'required' => true,
                            'min' => 2,
                            'max' => 20
                        ),
                        'student_middlename' => array(

                            'min' => 2,
                            'max' => 20
                        ),
                        'student_lastname' => array(
                            'required' => true,
                            'min' => 2,
                            'max' => 20
                        ),
                        'student_class' => array(
                            'required' => true,
                        ),
                        'gender' => array(
                            'required' => true,
                        ),
                        'stream' => array(
                            'required' => true,
                        ),
                        'parent_firstname' => array(
                            'required' => true,
                        ),
                        'parent_middlename' => array(
                            'min' => 2,
                            'max' => 20
                        ),
                        'parent_lastname' => array(
                            'required' => true,
                        ),
                        'relationship' => array(
                            'required' => true,
                        ),
                        'phone_number' => array(
                            'required' => true,
                            'min' => 10,
                            'max' => 13,

                        ),
                        'other_phone_number' => array(
                            'min' => 10,
                            'max' => 13,
                        ),
                        'email_address' => array(
                            'min' => 10,
                            'max' => 30,

                        )
                    ));
                    if ($validate->passed()) {
                        try {
                            $getParent = $override->getNews('parents','lastname',Input::get('parent_lastname'),'phone_number',Input::get('phone_number'));
                            $salt = Hash::salt(32);
                            $password = '123456';
                            $schoolId = $user->data()->school_id;
                            if($getParent == null) {
                                $user->createRecord('parents', array(
                                    'firstname' => Input::get('parent_firstname'),
                                    'middlename' => Input::get('parent_middlename'),
                                    'lastname' => Input::get('parent_lastname'),
                                    'school_id' => $schoolId,
                                    'relationship' => Input::get('relationship'),
                                    'phone_number' => Input::get('phone_number'),
                                    'other_phone_number' => Input::get('other_phone_number'),
                                    'email_address' => Input::get('email_address'),
                                    'password' => Hash::make($password, $salt),
                                    'salt' => $salt,
                                ));
                                $getParentId = $override->getNews('parents','phone_number',Input::get('phone_number'),'lastname',Input::get('parent_lastname'));
                                $parentID = $getParentId[0]['id'];
                            } elseif(!$getParent == null){
                                $getParent = $override->getNews('parents','lastname',Input::get('parent_lastname'),'phone_number',Input::get('phone_number'));
                                $parentID = $getParent[0]['id'];
                            }else{$errorMessage = 'An Error Occurred,Information not saved in database';}
                            if(!$parentID == null) {
                                $user->createRecord('students', array(
                                    'firstname' => Input::get('student_firstname'),
                                    'middlename' => Input::get('student_middlename'),
                                    'lastname' => Input::get('student_lastname'),
                                    'gender' => Input::get('gender'),
                                    'school_id' => $schoolId,
                                    'class_id' => Input::get('student_class'),
                                    'stream' => Input::get('stream'),
                                    'parent_id' => $parentID
                                ));
                                $successMessage = 'New student has been successfully registered';
                            }else{$errorMessage = 'An Error Occurred,Information not saved in database';}

                        } catch (Exception $e) {
                            die($e->getMessage());
                        }
                    } else {
                        $pageError = $validate->errors();
                    }
                }
                //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                if(Input::get('allocation')){$subAl='active';
                    if(Input::get('token') == 'newAllocation'){$newAll='active';/*if(Input::get('position')== null){$checkP=true;$errorMessage='Teacher position is required, ';}*/}
                    elseif(Input::get('token')=='changeSubject'){$changeS='active';if(Input::get('previous_subject')== null || Input::get('previous_stream')== null || Input::get('previous_teaching_class')== null){$checkP=true;
                    $errorMessage = 'Previous Subject,Class or Stream is required';}else{$previous = $override->updateSubject('teaching_subject','school_id',$user->data()->school_id,'teacher_id',Input::get('teacher_name'),'subject_id',
                        Input::get('previous_subject'),'class_id',Input::get('previous_teaching_class'),'stream',Input::get('previous_stream'));if($previous == null){$errorMessage='ERROR: Wrong Previous Subject Information';$updateSubject=true;}
                    }
                    }elseif(Input::get('token')=='changePosition'){$changeP='active';
                    if(!Input::get('teacher_name') == null && !Input::get('position') == null){
                        $user->updateRecord('teachers', array(
                            'position' => Input::get('position')
                        ), Input::get('teacher_name'));
                        $successMessage = 'Position have been updated Successful';
                    }elseif(Input::get('teacher_name') == null || Input::get('position') == null){$errorMessage = 'Teacher name of position must not be empty';}
                    }
                    if(Input::get('token') =='newAllocation' || Input::get('token') == 'changeSubject'){

                    $validate = new validate();
                    $validate = $validate->check($_POST, array(
                        'teacher_name' => array(
                            'required' => true,
                        ),
                        'subject' => array(
                            'required' => true,
                        ),
                        'teaching_class' => array(
                            'required' => true,
                        ),
                        'stream' => array(
                            'required' => true,
                        )
                    ));
                    if ($validate->passed() && $checkP == false && $updateSubject == false) {
                        try { if(Input::get('token') == 'newAllocation'){
                            $user->createRecord('teaching_subject', array(
                                'school_id' => $user->data()->school_id,
                                'teacher_id' => Input::get('teacher_name'),
                                'class_id' => Input::get('teaching_class'),
                                'subject_id' => Input::get('subject'),
                                'stream' => Input::get('stream'),
                            ));
                            /*$user->updateRecord('teachers', array(
                                'position' => Input::get('position')
                            ), Input::get('teacher_name'));*/
                            $successMessage = 'Congratulations!! The subject has been allocated successfully';
                        }elseif(Input::get('token') == 'changeSubject'){
                            $user->updateSubject('teaching_subject',array(
                                'class_id' => Input::get('teaching_class'),
                                'subject_id' => Input::get('subject'),
                                'stream' => Input::get('stream'),
                            ),Input::get('teacher_name'));
                            $successMessage = 'The subject allocation has been updated Successfully';
                         }
                        } catch (Exception $e) {
                            die($e->getMessage());
                        }
                    } else {
                        $pageError = $validate->errors();
                    }

                    }
                }
                /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                if(Input::get('selectResult')){
                    if(Input::get('selectR') == 'student_result'){$studR = 'active';}elseif(Input::get('selectR') == 'select_upload'){$upldR = 'active';}
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
                        'exam_date' => array(
                            'required' => true,
                        )
                    ));
                    if ($validate->passed()) {
                       $getResult = $override->rowCounted('students','class_id',Input::get('class'),'stream',Input::get('stream'));
                    } else {
                        $pageError = $validate->errors();
                        $validateSearch = true;
                    }
                }
                /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                if(Input::get('uploadResult')){$upldR = 'active';$y = 0;
                    if($override->checkRepeatExam('results','school_id',$user->data()->school_id,'subject_id',Input::get('subId')[$y],'exam_id',Input::get('examType'),'class_id',Input::get('classId')[$y],'year',date('Y'),'stream',Input::get('stream')) == null) {
                     foreach ($_POST['student'] as $send) {
                            $student = $override->get('students', 'id', Input::get('student')[$y]);
                        }//upload stream and use it to compare
                        while ($y < Input::get('noRows')) {
                            try {
                                $user->createRecord('results', array(
                                    'school_id' => $user->data()->school_id,
                                    'student_id' => Input::get('student')[$y],
                                    'subject_id' => Input::get('subId')[$y],
                                    'exam_id' => Input::get('examType'),
                                    'score' => Input::get('score')[$y],
                                    'issued_date' => date('Y/m/d'),
                                    'exam_date' => Input::get('examDate'),
                                    'class_id' => Input::get('classId')[$y],
                                    'year' => date('Y'),
                                    'stream' =>'A',
                                ));
                                // foreach(Input::get('student')[$y] as ){}
                                $student = $override->get('students', 'id', Input::get('student')[$y]);
                                $parent = $override->get('parents', 'id', $student[0]['parent_id']);
                                $text = 'Physic Exam Result for ' . $student[0]['firstname'] . ' ' . $student[0]['lastname'] . ' Score : ' . Input::get('score')[$y];
                                 $user->sendSMS($parent[0]['phone_number'],$text);
                                $successMessage = 'Student Results Successful Uploaded';
                            } catch (PDOException $e) {
                                die($e->getMessage());
                            }
                            $y++;
                        }
                    }else{$errorMessage = 'Records Already Exist';}
                }
                ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                if(Input::get('studentResult')){$studR = 'active';
                    echo Input::get('examType');
                }
                if(Input::get('deleteTeacher') == 'del'){ $listT='active';
                    $user->deleteRecord('teachers','id',Input::get('delT'));
                }
            }else{$news='active';$upTch='active';$newAll='active';}
       //////////////
    }else { Redirect::to('index.php'); }
} else { Redirect::to('index.php');}
?>
<!DOCTYPE html>
<html>
<head>
    <!-- Basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Info-Elimu | Teacher Panel</title>
    <!--<meta http-equiv="refresh" content="5">-->
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
                                <?php if($user->data()->position == 'Headmaster' || $user->data()->position == 'Academic' || $user->data()->position == 'SecondMaster'){?>
                                <li class="<?=$regT?>">
                                    <a href="#tabsNavigation4" data-toggle="tab"><i class="fa fa-adjust"></i> Register New Teacher</a>
                                </li>
                                <li class="<?=$regS?>">
                                    <a href="#tabsNavigation5" data-toggle="tab"><i class="fa fa-adjust"></i> Register New Student</a>
                                </li>
                                    <li class="">
                                        <a href="uploadResult.php?id=9&f=2" ><i class="fa fa-phone"></i> Parent Phone Numbers</a>
                                    </li>
                                <li class="<?=$upld?>">
                                    <a href="#tabsNavigation6" data-toggle="tab"><i class="fa fa-film"></i> Upload News and Announcements</a>
                                </li>
                                <li class="<?=$listT?>">
                                    <a href="#tabsNavigation7" data-toggle="tab"><i class="fa fa-adjust"></i> List of Teachers </a>
                                </li>
                                <li class="<?=$listS?>">
                                    <a href="#tabsNavigation8" data-toggle="tab"><i class="fa fa-adjust"></i> List of Students</a>
                                </li>
                                <li class="<?=$upldR?>">
                                    <a href="uploadResult.php?id=0&f=0" ><i class="fa fa-adjust"></i> Upload Results</a>
                                </li>
                                    <li class="">
                                        <a href="#tabsNavigation13" data-toggle="tab"><i class="fa fa-adjust"></i> My Teaching Subjects</a>
                                    </li>
                                <li class="<?=$studR?>">
                                    <a href="uploadResult.php?id=1&f=0" ><i class="fa fa-adjust"></i> Student Results</a>
                                </li>
                                    <?php if($user->data()->position == 'Headmaster' || $user->data()->position == 'Academic' || $user->data()->position == 'SecondMaster'){?>
                                        <li class="">
                                            <a href="summaryResult.php?J=0" ><i class="fa fa-adjust"></i> Result Summary</a>
                                        </li>
                                    <?php }?>
                                <li class="<?=$subAl?>">
                                    <a href="#tabsNavigation11" data-toggle="tab"><i class="fa fa-adjust"></i> Subject Allocation</a>
                                </li>
                                <li class="<?=$sInfo?>">
                                    <a href="#tabsNavigation12" data-toggle="tab"><i class="fa fa-adjust"></i> School Information</a>
                                </li>
                                <?php }elseif($user->data()->position == 'Discipline'|| $user->data()->position == 'NormalTeacher'){?>
                                    <li class="<?=$upldR?>">
                                        <a href="uploadResult.php?id=0&f=0" ><i class="fa fa-adjust"></i> Upload Results</a>
                                    </li>
                                    <li class="<?=$studR?>">
                                        <a href="uploadResult.php?id=1&f=0"><i class="fa fa-adjust"></i> Student Results</a>
                                    </li>
                                    <li class="">
                                        <a href="#tabsNavigation13" data-toggle="tab"><i class="fa fa-adjust"></i> My Teaching Subjects</a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-8">
                    <?php echo '<label style="color: dodgerblue"><strong>'.$_GET['s'].'</strong></label>';?>
                        <!------------------------------------ tab1  ------------------------------------------------------------------------------------->
                        <div class="tab-pane tab-pane-navigation <?=$news?>" id="tabsNavigation1">
                            <div class="col-md-12">
                                <div class="tabs">
                                    <ul class="nav nav-tabs nav-justified">
                                        <li class="active">
                                            <a href="#myPnewz" data-toggle="tab" class="text-center">Personal News</a>
                                        </li>
                                        <li>
                                            <a href="#genNewz" data-toggle="tab" class="text-center">General News</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div id="myPnewz" class="tab-pane active">
                                                <?php $x=0;if($override->getNews('school_notification','school_id',$user->data()->school_id,'teacher_id',$user->data()->id)){
                                                    foreach($override->getNewsOrderBy('school_notification','school_id',$user->data()->school_id,'teacher_id',$user->data()->id) as $teacherNews){ ?>
                                                        <div class="feature-box feature-box-tertiary feature-box-style-6 appear-animation" data-appear-animation="fadeInUp" data-appear-animation-delay="0">
                                                            <div class="feature-box-icon">
                                                                <i class="icon-envelope icons"></i>
                                                            </div>
                                                            <div class="feature-box-info">
                                                                <?php if($teacherNews['attachment'] == ''){?>
                                                                    <h5 class="mb-sm"><a class="" href="#teacherNew<?=$x?>" data-toggle="modal" ><?=$teacherNews['title']?></a></h5>
                                                                <?php }else{?>
                                                                    <h5 class="mb-sm"><a href="readDocument.php?path=<?=$teacherNews['attachment']?>" target="_blank"><?=$teacherNews['title']?></a></h5>
                                                                <?php } ?>
                                                                <p class="mb-sm"><?=$teacherNews['postTime']?></p>
                                                            </div>
                                                        </div>
                                                    <?php if($teacherNews['attachment'] == ''){?>
                                                        <div class="modal fade" id = "teacherNew<?=$x?>" role="dialog" >
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h4><?=$teacherNews['title']?></h4>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <?=$teacherNews['message']?>
                                                                        <div class="modal-footer">
                                                                            <a class="btn btn-default " data-dismiss="modal">Ok</a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php }$x++;}}else{ ?>
                                                    <h4>There is no news or announcement at the moment</h4>
                                            <?php } ?>
                                        </div>
                                        <div id="genNewz" class="tab-pane">
                                            <?php $aa=0;if($user->data()->position == 'Headmaster' && !$user->data()->org_id == 0){foreach($override->getNewsOrderBy('school_notification','org_news',$user->data()->org_id,'school_news','teacherAll') as $tOrgNews){?>
                                                <div class="feature-box feature-box-tertiary feature-box-style-6 appear-animation" data-appear-animation="fadeInUp" data-appear-animation-delay="0">
                                                    <div class="feature-box-icon">
                                                        <i class="icon-envelope icons"></i>
                                                    </div>
                                                    <div class="feature-box-info">
                                                        <?php if($tOrgNews['attachment'] == ''){?>
                                                            <h5 class="mb-sm"><a class="" href="#teacherNewz<?=$aa?>" data-toggle="modal" ><?=$tOrgNews['title']?></a></h5>
                                                        <?php }else{?>
                                                            <h5 class="mb-sm"><a href="readDocument.php?path=<?=$tOrgNews['attachment']?>" target="_blank"><?=$tOrgNews['title']?></a></h5>
                                                        <?php } ?>
                                                        <p class="mb-sm"><?=$tOrgNews['postTime']?></p>
                                                    </div>
                                                </div>
                                                <?php if($tOrgNews['attachment'] == ''){?>
                                                    <div class="modal fade" id = "teacherNewz<?=$aa?>" role="dialog" >
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4><?=$tOrgNews['title']?></h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <?=$tOrgNews['message']?>
                                                                    <div class="modal-footer">
                                                                        <a class="btn btn-default " data-dismiss="modal">Ok</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php }$aa++;}}?>
                                            <?php $a=0;foreach($override->getNews('school_notification','school_id',$user->data()->school_id,'school_news','teacherAll') as $teacherNews2){ ?>
                                                    <div class="feature-box feature-box-tertiary feature-box-style-6 appear-animation" data-appear-animation="fadeInUp" data-appear-animation-delay="0">
                                                        <div class="feature-box-icon">
                                                            <i class="icon-envelope icons"></i>
                                                        </div>
                                                        <div class="feature-box-info">
                                                            <?php if($teacherNews2['attachment'] == ''){?>
                                                                <h5 class="mb-sm"><a class="" href="#teacherNewz<?=$a?>" data-toggle="modal" ><?=$teacherNews2['title']?></a></h5>
                                                            <?php }else{?>
                                                                <h5 class="mb-sm"><a href="readDocument.php?path=<?=$teacherNews2['attachment']?>" target="_blank"><?=$teacherNews2['title']?></a></h5>
                                                            <?php } ?>
                                                            <p class="mb-sm"><?=$teacherNews2['postTime']?></p>
                                                        </div>
                                                    </div>

                                                <?php if($teacherNews2['attachment'] == ''){?>
                                                    <div class="modal fade" id = "teacherNewz<?=$a?>" role="dialog" >
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4><?=$teacherNews2['title']?></h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <?=$teacherNews2['message']?>
                                                                    <div class="modal-footer">
                                                                        <a class="btn btn-default " data-dismiss="modal">Ok</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php }$a++;} ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!------------------------------------ tab2  ------------------------------------------------------------------------------------->
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
                        <!------------------------------------ tab3 -------------------------------------------------------------------------------------->
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
                                                                    <input class="form-control" name="email_address" type="email" placeholder="Your Email Address">
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
                        <?php if($user->data()->position == 'Headmaster' || $user->data()->position == 'Academic' || $user->data()->position == 'SecondMaster'){?>
                        <!----------------------------------- tab4  -------------------------------------------------------------------------------------->
                        <div class="tab-pane tab-pane-navigation <?=$regT?>" id="tabsNavigation4">
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
                                                        <div class="col-md-12">
                                                            <div class="help-block with-errors"></div>
                                                            <select name="position"  class="selectpicker form-control mb-md" data-live-search="true" title="Choose Teacher's Position" required>
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
                                                                    <input class="form-control" type="email" name="email_address" placeholder="Email Address">
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
                        <!----------------------------------- tab5  -------------------------------------------------------------------------------------->
                        <div class="tab-pane tab-pane-navigation <?=$regS?>" id="tabsNavigation5">
                            <div class="featured-boxes">
                                <div class="row">
                                    <div class="col-md-offset-1 col-sm-10">
                                        <div class="featured-box featured-box-primary align-left mt-xlg">
                                            <div class="box-content">

                                                <form action="#" data-toggle="validator" method="post">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <?php if(Input::get('regStudent')){if(!$errorMessage==null){
                                                                echo '<label style="color: #ff0000"><strong>ERRORS :'.$errorMessage.'</strong></label>';}elseif(!$successMessage==null){
                                                                echo '<label style="color: #3f923f"><strong>CONGRATULATION!! '.$successMessage.'</strong></label>';}
                                                                if(!$pageError == null){ echo '<label style="color: #ff0000"><strong> ERRORS :  </strong></label>'
                                                                ;foreach($pageError as $error){
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
                                                                    <input class="form-control" name="student_firstname" type="text" placeholder="Student's First Name" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="col-md-12">
                                                                <div class="input-group input-group-icon">
                                                                    <span class="input-group-addon">
                                                                        <span class="icon"><i class="fa fa-user"></i></span>
                                                                    </span>
                                                                    <input class="form-control" name="student_middlename" type="text" placeholder="Student's Middle Name">
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
                                                                    <input class="form-control" name="student_lastname" type="text" placeholder="Student's Last Name" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="col-md-12">
                                                                <select name="gender" class="form-control mb-md">
                                                                    <option value="">Select Gender</option>
                                                                    <option value="Male">Male</option>
                                                                    <option value="Female">Female</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="col-md-12">
                                                                <select name="student_class" class="selectpicker form-control mb-md" data-live-search="true" title="Choose Student Class">
                                                                    <?php if(!$override->getData('class_list') == null){
                                                                        foreach($override->getData('class_list') as $class){?>
                                                                            <option value='<?=$class['id']?>'> <?=$class['class_name']?> </option>
                                                                        <?php } }?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="col-md-12">
                                                                <select name="stream"  class="selectpicker form-control mb-md" data-live-search="true" title="Choose Stream" required>
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
                                                        </div>
                                                        <div class="form-group">
                                                        <div class="col-md-12">
                                                            <div class="help-block with-errors"></div>
                                                            <div class="input-group input-group-icon">
                                                                    <span class="input-group-addon">
                                                                        <span class="icon"><i class="fa fa-user"></i></span>
                                                                    </span>
                                                                <input class="form-control" type="text" name="parent_firstname" placeholder="Parent's First Name" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                        <div class="form-group">
                                                            <div class="col-md-12">
                                                                <div class="input-group input-group-icon">
                                                                    <span class="input-group-addon">
                                                                        <span class="icon"><i class="fa fa-user"></i></span>
                                                                    </span>
                                                                    <input class="form-control" type="text" name="parent_middlename" placeholder="Parent's Middle Name">
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
                                                                    <input class="form-control" type="text" name="parent_lastname" placeholder="Parent's Last Name" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="col-md-12">
                                                                <select name="relationship" class="selectpicker form-control mb-md" data-live-search="true" >
                                                                    <option value=''> Select your relationship with student </option>
                                                                    <option value='Father'> Father </option>
                                                                    <option value='Mother'> Mother  </option>
                                                                    <option value='Stepfather'> Stepfather </option>
                                                                    <option value='Stepmother'> Stepmother </option>
                                                                    <option value='Brother'> Brother </option>
                                                                    <option value='Sister'> Sister </option>
                                                                    <option value='Uncle'> Uncle </option>
                                                                    <option value='Grandmother'> Grandmother </option>
                                                                    <option value='Grandfather'> Grandfather </option>
                                                                    <option value='Aunt'> Aunt </option>
                                                                    <option value='Guardian'> Guardian </option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="col-md-12">
                                                                <div class="help-block with-errors"></div>
                                                                <div class="input-group input-group-icon">
                                                                    <span class="input-group-addon">
                                                                        <span class="icon"><i class="fa fa-mobile-phone"></i></span>
                                                                    </span>
                                                                    <input class="form-control" type="text" name="phone_number" placeholder="Parent Phone Number" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="col-md-12">
                                                                <div class="input-group input-group-icon">
                                                                    <span class="input-group-addon">
                                                                        <span class="icon"><i class="fa fa-mobile-phone"></i></span>
                                                                    </span>
                                                                    <input class="form-control" type="text" name="other_phone_number" placeholder="Parent Other Phone Number">
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
                                                                    <input class="form-control" type="email" name="email_address" placeholder="Parent Email Address">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-offset-6 col-md-6">
                                                            <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                                                            <input type="submit" name="regStudent" value="Register Student" class="btn btn-primary pull-right mb-xl" data-loading-text="Loading...">
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---------------------------------  tab6   -------------------------------------------------------------------------------------->
                        <div class="tab-pane tab-pane-navigation <?=$upld?>" id="tabsNavigation6">
                            <div class="featured-boxes">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="tabs">
                                            <ul class="nav nav-tabs nav-justified">
                                                <li class="<?=$upTch?>">
                                                    <a href="#teachers" data-toggle="tab" class="text-center"> Teachers</a>
                                                </li>
                                                <li class="<?=$upPr?>">
                                                    <a href="#parents" data-toggle="tab" class="text-center">Parents</a>
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
                                                                                        <select name="teacher[]" id="teacher" class="selectpicker form-control mb-md" multiple data-live-search="true" title="Choose Teacher" >
                                                                                            <option value="all">All</option>
                                                                                            <?php foreach($override->get('teachers','school_id',$user->data()->school_id) as $teacher){?>
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
                                                                                <div class="col-md-12" id="file_attach">
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
                                                                                <div class="col-md-12" id="teacher_news">

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
                                                <div id="parents" class="tab-pane <?=$upPr?>">
                                                    <div class="featured-boxes">
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="featured-box featured-box-primary align-left mt-xlg">
                                                                    <div class="box-content">
                                                                        <?php if( $nextStage == 'nextStage'){ ?>
                                                                        <form action="#" enctype="multipart/form-data" data-toggle="validator" method="post">
                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <?php if(Input::get('uploadNews') && Input::get('postTo')=='parentNews'){
                                                                                        echo '<label style="color: #ff0000"><strong>'.$errorMessage.'</strong></label>';
                                                                                        echo '<label style="color: #3f923f"><strong>'.$successMessage.'</strong></label>';
                                                                                        if(!$pageError == null){foreach($pageError as $error){
                                                                                            echo '<label style="color: #ff0000"><strong>'.$error.'</strong></label>'.' , ';
                                                                                        } echo '<br>';}}?>
                                                                                </div>

                                                                                <div class="form-group">
                                                                                    <div class="col-md-12">
                                                                                        <div class="help-block with-errors"></div>
                                                                                        <select name="studParent[]" id="parent" class="selectpicker form-control mb-md" data-live-search="true" multiple title="Choose Student" >
                                                                                            <option value="all">All</option>
                                                                                            <?php foreach($selectClass as $getClass){$parentNo = $override->get('parents','id',$getClass['parent_id']);?>
                                                                                                <option value="<?=$parentNo[0]['id']?>"><?=$getClass['firstname'].' '.$getClass['middlename'].' '.$getClass['lastname']?></option>
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
                                                                                <div class="col-md-12" id="file_attached1">
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
                                                                                <div class="col-md-12" id="parent_new">

                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-offset-6 col-md-6">
                                                                                    <input type="hidden" name="postTo" value="parentNews">
                                                                                    <input type="hidden" name="classId" value="<?=$getClassId?>">
                                                                                    <input type="hidden" name="streamId" value="<?=$getStreamId?>">
                                                                                    <input type="hidden" name="checkPoint" value="<?=$checkPoint?>">
                                                                                    <input type="submit" name="uploadNews" value="Upload Announcement" class="btn btn-primary pull-right mb-xl" data-loading-text="Loading...">
                                                                                </div>
                                                                            </div>

                                                                        </form>
                                                                        <?php }
                                                                        else { ?>
                                                                        <form method="post">
                                                                            <div class="col-md-12">
                                                                                <?php if($_GET['s']){echo '<label style="color: deepskyblue"><strong>'.$_GET['s'].'</strong></label>';}
                                                                                if(Input::get('uploadNews') && Input::get('chooseParent') == 'getParent'){
                                                                                    echo '<label style="color: #ff0000"><strong>'.$errorMessage.'</strong></label>';
                                                                                    if(!$pageError == null){foreach($pageError as $error){
                                                                                        echo '<label style="color: #ff0000"><strong>'.$error.'</strong></label>'.' , ';
                                                                                    } echo '<br>';}}?>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <div class="col-md-12">
                                                                                    <div class="help-block with-errors"></div>
                                                                                    <select name="class" id="parent" class="selectpicker form-control mb-md" data-live-search="true" title="Choose Class" >
                                                                                        <option value="all">All</option>
                                                                                        <?php foreach($override->getData('class_list') as $getClass){?>
                                                                                            <option value="<?=$getClass['id']?>"><?=$getClass['class_name']?></option>
                                                                                        <?php } ?>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <div class="col-md-12">
                                                                                    <div class="help-block with-errors"></div>
                                                                                    <select name="stream"  class="selectpicker form-control mb-md" data-live-search="true" title="Choose Stream" >
                                                                                        <option value="all">All</option>
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
                                                                            <div class="row">
                                                                                <div class="col-md-offset-6 col-md-6">
                                                                                    <input type="hidden" name="chooseParent" value="getParent">
                                                                                    <input type="submit" name="uploadNews" value="Select" class="btn btn-primary pull-right mb-xl" data-loading-text="Loading...">
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                        <?php }?>
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
                                                                                <div class="col-md-12" id="file_attached22">
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
                                                                                <div class="col-md-12" id="general_new">

                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-offset-6 col-md-6">
                                                                                    <input type="hidden" name="postTo" value="generalNews">
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
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---------------------------------  tab7   -------------------------------------------------------------------------------------->
                        <div class="tab-pane tab-pane-navigation <?=$listT?>" id="tabsNavigation7">
                            <div class="container col-md-12">
                                <section class="panel">
                                    <div class="panel-body"><p id="demo"></p>
                                        <table class="table table-bordered table-striped mb-none" id="datatable-editable1">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Full Name</th>
                                                <th>Position</th>
                                                <th>Teaching Class</th>
                                                <th>Subjects</th>
                                                <th>Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php if($override->get('teachers','school_id',$user->data()->school_id)){$x=1;
                                            foreach($override->get('teachers','school_id',$user->data()->school_id) as $teacherList){?>
                                            <tr data-item-id="<?=$x?>">
                                                <td><?=$x?></td>
                                                <td><?=$teacherList['firstname'].' '.$teacherList['middlename'].' '.$teacherList['lastname']?></td>
                                                <td><?=$teacherList['position']?></td>
                                                <td>
                                                    <?php foreach($override->getSelectNoRepeat('teaching_subject','class_id','school_id',$user->data()->school_id,'teacher_id',$teacherList['id']) as $classes){
                                                        foreach($override->get('class_list','id',$classes['class_id']) as $classT){
                                                            echo $classT['class_name'].' ,';}}?>
                                                </td><td>
                                                <?php foreach($override->getSelectNoRepeat('teaching_subject','subject_id','school_id',$user->data()->school_id,'teacher_id',$teacherList['id']) as $subjects){
                                                    foreach($override->get('subjects','id',$subjects['subject_id']) as $subject){
                                                    echo $subject['name'].' ,';}}?></td>
                                                <td class="actions">
                                                    <?php if($teacherList['position'] == 'Discipline' || $teacherList['position'] == 'Academic' || $teacherList['position'] == 'NormalTeacher' || $teacherList['position'] == 'SecondMaster'){?>
                                                    <form method="post">
                                                        <input type="hidden" name="delT" value="<?=$teacherList['id']?>">
                                                        <button type="submit" name="deleteTeacher" value="del"  onclick="javascript: return confirm('Are you SURE you wish to delete this Record?');"><i class="fa fa-trash-o"></i></button>
                                                    </form>
                                                    <?php } ?>
                                                </td>

                                            </tr>
                                            <?php $x++;}}?>
                                            </tbody>
                                        </table>
                                    </div>
                                </section>
                            </div>
                        </div>
                        <!---------------------------------  tab8   -------------------------------------------------------------------------------------->
                        <div class="tab-pane tab-pane-navigation <?=$listS?>" id="tabsNavigation8">
                            <div class="container col-md-12">
                                <section class="panel">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="mb-md">
                                                    <form action="" id="frmSignIn" method="post">
                                                        <div class="form-group">
                                                            <div class="col-md-6">
                                                                <div class="help-block with-errors"></div>
                                                                <select class="selectpicker form-control mb-md" id="studentTable" data-live-search="true" title="Select Student Class" required>
                                                                    <?php if(!$override->getData('class_list')==null){
                                                                        foreach($override->getData('class_list') as $teachingClass){?>
                                                                            <option value="<?=$teachingClass['id']?>"><?=$teachingClass['class_name']?></option>
                                                                        <?php }}?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <table class="table table-bordered table-striped mb-none" >
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Student Name</th>
                                                <th>Gender</th>
                                                <th>Class</th>
                                            </tr>
                                            </thead>
                                            <tbody id="studentList">

                                            </tbody>
                                        </table>
                                    </div>
                                </section>
                            </div>
                        </div>
                        <!---------------------------------  tab9   -------------------------------------------------------------------------------------->
                        <div class="tab-pane tab-pane-navigation <?=$upldR?>" id="tabsNavigation9">
                            <div class="container col-md-12">
                                <section class="panel">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="mb-md">
                                                    <form action=""  method="post">

                                                            <?php if(Input::get('selectResult')){if(!$errorMessage == null){
                                                                echo '<label style="color: #ff0000"><strong>ERROR: '.$errorMessage.'</strong></label>';}elseif(!$successMessage == null){
                                                                echo '<label style="color: #3f923f"><strong>CONGRATULATION!!!'.$successMessage.'</strong></label>';}
                                                                if(!$pageError == null){echo '<label style="color: #ff0000"><strong>ERROR: </strong></label>'; foreach($pageError as $error){
                                                                    echo '<label style="color: #ff0000"><strong>'.$error.'</strong></label>'.' , ';
                                                                } echo '<br>';}}?>

                                                        <div class="form-group">
                                                            <div class="col-md-3">
                                                                <select name="exam" class="selectpicker form-control mb-md" data-live-search="true" title="Select Examination" required="">
                                                                    <?php foreach($override->getData('exam_type') as $exam){ ?>
                                                                            <option value="<?=$exam['id']?>"><?=$exam['name']?></option>
                                                                        <?php } ?>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <select name="subject" class="selectpicker form-control mb-md" data-live-search="true" title="Select Subject" required="">
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
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="col-md-6">
                                                                <input name="exam_date" class="form-control" type="month">
                                                            </div>
                                                            <div class="col-md-2">
                                                                <input type="hidden" name="selectR" value="select_upload">
                                                                <input type="submit" value="Select" id="selectResult" name="selectResult" class="btn btn-primary pull-right mb-xl" data-loading-text="Loading...">
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <form method="post">
                                            <input type="hidden" class="" name="noRows" value="<?=$getResult?>">
                                            <input type="hidden" class="" name="examType" value="<?=Input::get('exam')?>">
                                            <input type="hidden" class="" name="examDate" value="<?=Input::get('exam_date')?>">
                                            <a href="uploadResult.php?school=<?=$user->data()->school_id?>&class=<?=Input::get('class')?>&stream=<?=Input::get('stream')?>"></a>
                                            <?php if(Input::get('uploadResult')){
                                                $red = 'uploadResult.php?school='.$user->data()->school_id.'&class='.Input::get('class').'&stream='.Input::get('stream').'&type='.Input::get('exam');
                                                Redirect::to($reg);
                                                if(!$errorMessage == null){
                                                echo '<label style="color: #ff0000"><strong>ERROR: '.$errorMessage.'</strong></label>';}elseif(!$successMessage == null){
                                                echo '<label style="color: #3f923f"><strong>CONGRATULATION!!!'.$successMessage.'</strong></label>';}
                                                if(!$pageError == null){echo '<label style="color: #ff0000"><strong>ERROR: </strong></label>'; foreach($pageError as $error){
                                                    echo '<label style="color: #ff0000"><strong>'.$error.'</strong></label>'.' , ';
                                                } echo '<br>';}}if(Input::get('selectResult') && Input::get('selectR') == 'select_upload'){?>
                                        <table class="table table-bordered table-striped mb-none" id="datatable-editable10">
                                            <thead>
                                            <tr>
                                                <th>Student Name</th>
                                                <th>Class</th>
                                                <th>Stream</th>
                                                <th>Subject</th>
                                                <th>Score</th>
                                            </tr>
                                            </thead>
                                            <tbody id="load_table">
                                            <?php if(!$override->selectData('students','school_id',$user->data()->school_id,'class_id',Input::get('class'),'stream',Input::get('stream')) == null && Input::get('selectR') == 'select_upload' ){
                                                $x=1;foreach($override->selectData('students','school_id',$user->data()->school_id,'class_id',Input::get('class'),'stream',Input::get('stream')) as $resultS){ ?>
                                                <tr data-item-id="<?=$x?>">
                                                    <td><?=$resultS['firstname'].' '.$resultS['middlename'].' '.$resultS['lastname']?></td>
                                                    <td><?=$override->get('class_list','id',$resultS['class_id'])[0]['class_name'] ?></td>
                                                    <td><?=$resultS['stream']?></td>
                                                    <td><?=$override->get('subjects','id',Input::get('subject'))[0]['name'] ?></td>
                                                    <td class="actions">
                                                        <input type="number" class="" name="score[]" min="0" max="100">
                                                        <input type="hidden" class="" name="subId[]" value="<?=Input::get('subject')?>">
                                                        <input type="hidden" class="" name="frdId[]" value="<?=$resultS['stream']?>">
                                                        <input type="hidden" class="" name="classId[]" value="<?=Input::get('class')?>">
                                                        <input type="hidden" class="" name="student[]" value="<?=$resultS['id']?>">
                                                    </td>
                                                </tr>
                                            <?php $x++;}} ?>

                                            </tbody>
                                        </table><br>
                                            <div class="col-md-offset-6 col-md-6">
                                                <input type="submit" value="Submit Results"  name="uploadResult" class="btn btn-primary pull-right mb-xl" data-loading-text="Loading...">
                                            </div>
                                            <?php } ?>
                                        </form>
                                    </div>
                                </section>
                            </div>
                        </div>
                        <!---------------------------------  tab10   ------------------------------------------------------------------------------------->
                        <div class="tab-pane tab-pane-navigation <?=$studR?>" id="tabsNavigation10">
                            <div class="container col-md-12">
                                <section class="panel">
                                    <div class="panel-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="mb-md">
                                                <form action=""  method="post">
                                                    <?php if(Input::get('studentResult')){if(!$errorMessage == null){
                                                        echo '<label style="color: #ff0000"><strong>ERROR: '.$errorMessage.'</strong></label>';}elseif(!$successMessage == null){
                                                        echo '<label style="color: #3f923f"><strong>CONGRATULATION!!!'.$successMessage.'</strong></label>';}
                                                        if(!$pageError == null){echo '<label style="color: #ff0000"><strong>ERROR: </strong></label>'; foreach($pageError as $error){
                                                            echo '<label style="color: #ff0000"><strong>'.$error.'</strong></label>'.' , ';
                                                        } echo '<br>';}}?>
                                                    <div class="form-group">
                                                        <div class="col-md-3">
                                                            <select name="exam" class="selectpicker form-control mb-md" data-live-search="true" title="Select Examination" required>
                                                                <?php foreach($override->getData('exam_type') as $exam){ ?>
                                                                    <option value="<?=$exam['id']?>"><?=$exam['name']?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <select name="subject" class="selectpicker form-control mb-md" data-live-search="true" title="Select Subject" required="">
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
                                                            </select>
                                                        </div>
                                                    </div>
                                                        <div class="form-group">
                                                            <div class="col-md-6">
                                                                <input name="exam_date" class="form-control" type="month">
                                                            </div>
                                                        <div class="col-md-2">
                                                            <input type="hidden" name="selectR" value="student_result">
                                                            <input type="submit" value="Select" id="selectResult" name="selectResult" class="btn btn-primary pull-right mb-xl" data-loading-text="Loading...">
                                                        </div>
                                                        </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                        <form method="post">
                                            <input type="hidden" name="noRows" value="<?=$getResult?>">
                                            <input type="hidden" class="" name="examType" value="<?=Input::get('exam')?>">
                                            <input type="hidden" class="" name="examDate" value="<?=Input::get('exam_date')?>">

                                        <table class="table table-bordered table-striped mb-none" id="datatable-editable7">
                                            <thead>
                                            <tr>
                                                <th>Student Name</th>
                                                <th>Class</th>
                                                <th>Stream</th>
                                                <th>Subject</th>
                                                <th>Score</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php if(!$override->selectData('students','school_id',$user->data()->school_id,'class_id',Input::get('class'),'stream',Input::get('stream')) == null && Input::get('selectR') == 'student_result' && $validateSearch == false){
                                                $x=0;foreach($override->selectData('students','school_id',$user->data()->school_id,'class_id',Input::get('class'),'stream',Input::get('stream')) as $resultS){ ?>
                                                    <tr data-item-id="<?=$x?>">
                                                        <td><?=$resultS['firstname'].' '.$resultS['middlename'].' '.$resultS['lastname']?></td>
                                                        <td><?=$override->get('class_list','id',$resultS['class_id'])[0]['class_name'] ?></td>
                                                        <td><?=$resultS['stream']?></td>
                                                        <td><?=$override->get('subjects','id',Input::get('subject'))[0]['name'] ?></td>
                                                        <td><?php $frd = $override->updateSubject('results','school_id',$user->data()->school_id,'student_id',$resultS['id'],'subject_id',$override->get('subjects','id',Input::get('subject'))[0]['id'],
                                                                'exam_id',Input::get('exam'),'exam_date',Input::get('exam_date'));print_r($frd[0]['score'])?></td>
                                                        <td class="actions">
                                                            <a href="#" class="hidden on-editing save-row"><i class="fa fa-save"></i></a>
                                                            <a href="#" class="hidden on-editing cancel-row"><i class="fa fa-times"></i></a>
                                                            <a href="edit.php?content=<?=$resultS['id']?>&group=results&data=stud_result&message=''" class="on-default edit-row"><i class="fa fa-pencil"></i></a>
                                                            <a href="#" class="hidden on-default remove-row"><i class="fa fa-trash-o"></i></a>
                                                        </td>
                                                    </tr>
                                                    <?php $x++;}} ?>
                                            </tbody>
                                        </table>

                                        </form>
                                    </div>
                                </section>
                            </div>
                        </div>
                        <!---------------------------------  tab11   ------------------------------------------------------------------------------------->
                        <div class="tab-pane tab-pane-navigation <?=$subAl?>" id="tabsNavigation11">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="tabs">
                                        <ul class="nav nav-tabs nav-justified">
                                            <li class="<?=$newAll?>">
                                                <a href="#newAllocation" data-toggle="tab" class="text-center">New Allocation</a>
                                            </li>
                                            <li class="<?=$changeS?>">
                                                <a href="#changeSubject" data-toggle="tab" class="text-center">Change Subject</a>
                                            </li>
                                            <li class="<?=$changeP?>">
                                                <a href="#changePosition" data-toggle="tab" class="text-center">Change Position</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content">
                                            <div id="newAllocation" class="tab-pane <?=$newAll?>">
                                                <div class="featured-boxes">
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="featured-box featured-box-primary align-left mt-xlg">
                                                                <div class="box-content">
                                                                    <form action="#" enctype="multipart/form-data" data-toggle="validator" method="post">
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <?php if(Input::get('allocation') && Input::get('token') == 'newAllocation'){if(!$errorMessage == null){
                                                                                    echo '<label style="color: #ff0000"><strong>ERROR: '.$errorMessage.'</strong></label>';}elseif(!$successMessage == null){
                                                                                    echo '<label style="color: #3f923f"><strong>CONGRATULATION!!!'.$successMessage.'</strong></label>';}
                                                                                    if(!$pageError == null){echo '<label style="color: #ff0000"><strong>ERROR: </strong></label>'; foreach($pageError as $error){
                                                                                        echo '<label style="color: #ff0000"><strong>'.$error.'</strong></label>'.' , ';
                                                                                    } echo '<br>';}}?>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <div class="col-md-12">
                                                                                    <div class="help-block with-errors"></div>
                                                                                    <select name="teacher_name" id="teacher" class="selectpicker form-control mb-md" data-live-search="true" title="Choose Teacher's Name" required>
                                                                                        <?php if(!$override->get('teachers','school_id',$user->data()->school_id)==null){
                                                                                            foreach($override->get('teachers','school_id',$user->data()->school_id) as $teacherName){?>
                                                                                                <option value="<?=$teacherName['id']?>"><?=$teacherName['firstname'].' '.$teacherName['middlename'].' '.$teacherName['lastname']?></option>
                                                                                        <?php }}?>
                                                                                    </select>
                                                                                </div>

                                                                            </div>
                                                                            <div class="form-group">
                                                                                <div class="col-md-4">
                                                                                    <div class="help-block with-errors"></div>
                                                                                    <select name="subject"  class="selectpicker form-control mb-md" data-live-search="true" title="Choose Subject" required>
                                                                                        <?php if(!$override->getData('subjects')==null){
                                                                                            foreach($override->getData('subjects') as $teachingSubject){?>
                                                                                                <option value="<?=$teachingSubject['id']?>"><?=$teachingSubject['name']?></option>
                                                                                            <?php }}?>
                                                                                    </select>
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                    <div class="help-block with-errors"></div>
                                                                                    <select name="teaching_class"  class="selectpicker form-control mb-md" data-live-search="true" title="Choose Class" required>
                                                                                        <?php if(!$override->getData('class_list')==null){
                                                                                            foreach($override->getData('class_list') as $teachingClass){?>
                                                                                                <option value="<?=$teachingClass['id']?>"><?=$teachingClass['class_name']?></option>
                                                                                            <?php }}?>
                                                                                    </select>
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                    <div class="help-block with-errors"></div>
                                                                                    <select name="stream"  class="selectpicker form-control mb-md" data-live-search="true" title="Choose Stream" required>
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
                                                                            </div>
                                                                         </div>

                                                                        <div class="row">
                                                                            <div class="col-md-offset-6 col-md-6">
                                                                                <input type="hidden" name="token" value="newAllocation">
                                                                                <input type="submit" name="allocation" value="Allocate Subject" class="btn btn-primary pull-right mb-xl" data-loading-text="Loading...">
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="changeSubject" class="tab-pane <?=$changeS?>">
                                                <div class="featured-boxes">
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="featured-box featured-box-primary align-left mt-xlg">
                                                                <div class="box-content">
                                                                    <form action="#" enctype="multipart/form-data" data-toggle="validator" method="post">
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <?php if(Input::get('allocation') && Input::get('token')=='changeSubject'){if(!$errorMessage==null){
                                                                                    echo '<label style="color: #ff0000"><strong>ERROR: '.$errorMessage.'</strong></label>';}elseif(!$successMessage==null){
                                                                                    echo '<label style="color: #3f923f"><strong>CONGRATULATION!!!'.$successMessage.'</strong></label>';}
                                                                                    if(!$pageError == null){echo '<label style="color: #ff0000"><strong>ERROR: </strong></label>'; foreach($pageError as $error){
                                                                                        echo '<label style="color: #ff0000"><strong>'.$error.'</strong></label>'.' , ';
                                                                                    } echo '<br>';}}?>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <div class="col-md-12">
                                                                                    <div class="help-block with-errors"></div>
                                                                                    <select name="teacher_name" id="prev_subj" class="selectpicker form-control mb-md" data-live-search="true" title="Choose Teacher's Name" required>
                                                                                        <?php if(!$override->get('teachers','school_id',$user->data()->school_id)==null){
                                                                                            foreach($override->get('teachers','school_id',$user->data()->school_id) as $teacherName){?>
                                                                                                <option value="<?=$teacherName['id']?>"><?=$teacherName['firstname'].' '.$teacherName['middlename'].' '.$teacherName['lastname']?></option>
                                                                                            <?php }}?>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div id="techSubj">


                                                                            </div>
                                                                        </div>

                                                                        <div class="row">
                                                                            <div class="col-md-offset-6 col-md-6">
                                                                                <input type="hidden" name="token" value="changeSubject">
                                                                                <input type="submit" name="allocation" value="Change Subject" class="btn btn-primary pull-right mb-xl" data-loading-text="Loading...">
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="changePosition" class="tab-pane <?=$changeP?>">
                                                <div class="featured-boxes">
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="featured-box featured-box-primary align-left mt-xlg">
                                                                <div class="box-content">
                                                                    <form action="#" enctype="multipart/form-data" data-toggle="validator" method="post">
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <?php if(Input::get('allocation') && Input::get('token')=='changePosition'){if(!$errorMessage==null){
                                                                                    echo '<label style="color: #ff0000"><strong>ERROR: '.$errorMessage.'</strong></label>';}elseif(!$successMessage==null){
                                                                                    echo '<label style="color: #3f923f"><strong>CONGRATULATION!!!'.$successMessage.'</strong></label>';}
                                                                                    if(!$pageError == null){echo '<label style="color: #ff0000"><strong>ERROR: </strong></label>'; foreach($pageError as $error){
                                                                                        echo '<label style="color: #ff0000"><strong>'.$error.'</strong></label>'.' , ';
                                                                                    } echo '<br>';}}?>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <div class="col-md-8">
                                                                                    <div class="help-block with-errors"></div>
                                                                                    <select name="teacher_name" id="teacher" class="selectpicker form-control mb-md" data-live-search="true" title="Choose Teacher's Name" required>
                                                                                        <?php if(!$override->get('teachers','school_id',$user->data()->school_id)==null){
                                                                                            foreach($override->get('teachers','school_id',$user->data()->school_id) as $teacherName){?>
                                                                                                <option value="<?=$teacherName['id']?>"><?=$teacherName['firstname'].' '.$teacherName['middlename'].' '.$teacherName['lastname']?></option>
                                                                                            <?php }}?>
                                                                                    </select>
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                    <div class="help-block with-errors"></div>
                                                                                    <select name="position"  class="selectpicker form-control mb-md" data-live-search="true" title="Choose Teacher's Position" required>
                                                                                        <option value="SecondMaster">Second(Master/Mistress)</option>
                                                                                        <option value="Academic">Academic(Master/Mistress)</option>
                                                                                        <option value="Discipline">Discipline(Master/Mistress)</option>
                                                                                        <option value="NormalTeacher">Normal Teacher</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="row">
                                                                            <div class="col-md-offset-6 col-md-6">
                                                                                <input type="hidden" name="token" value="changePosition">
                                                                                <input type="submit" name="allocation" value="Change Position" class="btn btn-primary pull-right mb-xl" data-loading-text="Loading...">
                                                                            </div>
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
                            <div class="tab-pane tab-pane-navigation " id="tabsNavigation13">
                                <div class="container col-md-12">
                                    <section class="panel">
                                        <div class="panel-body">
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-striped table-condensed mb-none">
                                                    <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th class="text-right">Class</th>
                                                        <th class="text-right">Stream</th>
                                                        <th>Subject Name</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php $x = 1;if(!$override->getSelectNoRepeat2('teaching_subject','class_id','stream','school_id',$user->data()->school_id,'teacher_id',$user->data()->id) == null){
                                                        foreach($override->getSelectNoRepeat2('teaching_subject','class_id','stream','school_id',$user->data()->school_id,'teacher_id',$user->data()->id) as $techClass) {
                                                            foreach($override->get('class_list','id',$techClass['class_id']) as $className){ ?>
                                                                <tr>
                                                                    <td><?=$x?></td>
                                                                    <td class="text-right"><?=$className['class_name']?></td>
                                                                    <td class="text-right"><?=$techClass['stream']?></td>
                                                                    <td>
                                                                        <?php foreach($override->getSelectDataNoRepeat1('teaching_subject','subject_id','school_id',$user->data()->school_id,'teacher_id',$user->data()->id,'stream',$techClass['stream'],'class_id',$techClass['class_id']) as $techSubjects){
                                                                            foreach($override->get('subjects','id',$techSubjects['subject_id']) as $techSubject){echo $techSubject['name'].' ,';}}?>
                                                                    </td>
                                                                </tr>
                                                            <?php }$x++;}}?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                            </div>
                        <!---------------------------------  tab12   ------------------------------------------------------------------------------------->
                        <div class="tab-pane tab-pane-navigation <?=$sInfo?>" id="tabsNavigation12">
                            <div class="container col-md-12">
                                <section class="panel">
                                    <div class="panel-body">
                                        <table class="table table-bordered table-striped mb-none" >
                                            <thead>
                                            <tr>
                                                <th>Class Name</th>
                                                <th>Male</th>
                                                <th>Female</th>
                                                <th>Total</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php if($override->get('schools','id',$user->data()->school_id)[0]['category'] =='Primary School'){$no = 7;$x = 0;
                                                while($x < $no){
                                                    $name = $override->getData('class_list')[$x]['class_name'];
                                                    $males = $override->getCounted('students','school_id',$user->data()->school_id,'class_id',$override->getData('class_list')[$x]['id'],'gender','Male');
                                                    $female = $override->getCounted('students','school_id',$user->data()->school_id,'class_id',$override->getData('class_list')[$x]['id'],'gender','Female');
                                                    $sum = $males + $female;$totalM += $males;$totalF += $female;$total += $sum ?>
                                                    <tr data-item-id="<?=$x?>">
                                                        <td><?=$name?></td>
                                                        <td><?=$males?></td>
                                                        <td><?=$female?></td>
                                                        <td class="actions"><?=$sum?></td>
                                                    </tr>
                                               <?php $x++; }?>
                                            </tbody>
                                            <thead>
                                            <tr>
                                                <th>Total</th>
                                                <th><?=$totalM?></th>
                                                <th><?=$totalF?></th>
                                                <th><?=$total?></th>
                                            </tr>
                                            </thead>
                                        </table>
                                        <br>
                                        <h4>Teacher Info </h4>
                                        <table class="table table-bordered table-striped mb-none" >
                                            <thead>
                                            <tr>
                                                <th>School's Teachers</th>
                                                <th>Male</th>
                                                <th>Females</th>
                                                <th>Total</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $males = $override->countData('teachers','school_id',$user->data()->school_id,'gender','Male');
                                                  $female = $override->countData('teachers','school_id',$user->data()->school_id,'gender','Female');
                                                    $sum = $males + $female;?>
                                            <tr data-item-id="1">
                                                <td>Teachers</td>
                                                <td><?=$males?></td>
                                                <td><?=$female?></td>
                                                <td class="actions"><?=$sum?></td>
                                            </tr>
                                            </tbody>
                                            </table>
                                        <?php }elseif($override->get('schools','id',$user->data()->school_id)[0]['category'] =='Secondary School'){$no = 13;$x = 7;
                                        while($x < $no){
                                            $name = $override->getData('class_list')[$x]['class_name'];
                                            $males = $override->getCounted('students','school_id',$user->data()->school_id,'class_id',$override->getData('class_list')[$x]['id'],'gender','Male');
                                            $female = $override->getCounted('students','school_id',$user->data()->school_id,'class_id',$override->getData('class_list')[$x]['id'],'gender','Female');
                                            $sum = $males + $female;$totalM += $males;$totalF += $female;$total += $sum ?>
                                            <tr data-item-id="<?=$x?>">
                                                <td><?=$name?></td>
                                                <td><?=$males?></td>
                                                <td><?=$female?></td>
                                                <td class="actions"><?=$sum?></td>
                                            </tr>
                                            <?php $x++; }?>
                                        </tbody>
                                        <thead>
                                        <tr>
                                            <th>Total</th>
                                            <th><?=$totalM?></th>
                                            <th><?=$totalF?></th>
                                            <th><?=$total?></th>
                                        </tr>
                                        </thead>
                                        </table>
                                        <br>
                                        <h4>Teacher Info </h4>
                                        <table class="table table-bordered table-striped mb-none" >
                                            <thead>
                                            <tr>
                                                <th>School's Teachers</th>
                                                <th>Male</th>
                                                <th>Females</th>
                                                <th>Total</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $males = $override->countData('teachers','school_id',$user->data()->school_id,'gender','Male');
                                            $female = $override->countData('teachers','school_id',$user->data()->school_id,'gender','Female');
                                            $sum = $males + $female;?>
                                            <tr data-item-id="1">
                                                <td>Teachers</td>
                                                <td><?=$males?></td>
                                                <td><?=$female?></td>
                                                <td class="actions"><?=$sum?></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <?php } ?>
                                    </div>
                                </section>
                            </div>
                        </div>
                        <?php }elseif($user->data()->position == 'Discipline'|| $user->data()->position == 'NormalTeacher'){?>
                            <div class="tab-pane tab-pane-navigation <?=$upldR?>" id="tabsNavigation9">
                                <div class="container col-md-12">
                                    <section class="panel">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="mb-md">
                                                        <form action=""  method="post">

                                                            <?php if(Input::get('selectResult')){if(!$errorMessage == null){
                                                                echo '<label style="color: #ff0000"><strong>ERROR: '.$errorMessage.'</strong></label>';}elseif(!$successMessage == null){
                                                                echo '<label style="color: #3f923f"><strong>CONGRATULATION!!!'.$successMessage.'</strong></label>';}
                                                                if(!$pageError == null){echo '<label style="color: #ff0000"><strong>ERROR: </strong></label>'; foreach($pageError as $error){
                                                                    echo '<label style="color: #ff0000"><strong>'.$error.'</strong></label>'.' , ';
                                                                } echo '<br>';}}?>

                                                            <div class="form-group">
                                                                <div class="col-md-3">
                                                                    <select name="exam" class="selectpicker form-control mb-md" data-live-search="true" title="Select Examination" required="">
                                                                        <?php foreach($override->getData('exam_type') as $exam){ ?>
                                                                            <option value="<?=$exam['id']?>"><?=$exam['name']?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <select name="subject" class="selectpicker form-control mb-md" data-live-search="true" title="Select Subject" required="">
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
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="col-md-6">
                                                                    <input name="exam_date" class="form-control" type="month">
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <input type="hidden" name="selectR" value="select_upload">
                                                                    <input type="submit" value="Select" id="selectResult" name="selectResult" class="btn btn-primary pull-right mb-xl" data-loading-text="Loading...">
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <form method="post">
                                                <input type="hidden" class="" name="noRows" value="<?=$getResult?>">
                                                <input type="hidden" class="" name="examType" value="<?=Input::get('exam')?>">
                                                <input type="hidden" class="" name="examDate" value="<?=Input::get('exam_date')?>">
                                                <?php if(Input::get('uploadResult')){if(!$errorMessage == null){
                                                    echo '<label style="color: #ff0000"><strong>ERROR: '.$errorMessage.'</strong></label>';}elseif(!$successMessage == null){
                                                    echo '<label style="color: #3f923f"><strong>CONGRATULATION!!!'.$successMessage.'</strong></label>';}
                                                    if(!$pageError == null){echo '<label style="color: #ff0000"><strong>ERROR: </strong></label>'; foreach($pageError as $error){
                                                        echo '<label style="color: #ff0000"><strong>'.$error.'</strong></label>'.' , ';
                                                    } echo '<br>';}}if(Input::get('selectResult') && Input::get('selectR') == 'select_upload'){?>
                                                    <table class="table table-bordered table-striped mb-none" id="datatable-editable10">
                                                        <thead>
                                                        <tr>
                                                            <th>Student Name</th>
                                                            <th>Class</th>
                                                            <th>Stream</th>
                                                            <th>Subject</th>
                                                            <th>Score</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody id="load_table">
                                                        <?php if(!$override->selectData('students','school_id',$user->data()->school_id,'class_id',Input::get('class'),'stream',Input::get('stream')) == null && Input::get('selectR') == 'select_upload' ){
                                                            $x=1;foreach($override->selectData('students','school_id',$user->data()->school_id,'class_id',Input::get('class'),'stream',Input::get('stream')) as $resultS){ ?>
                                                                <tr data-item-id="<?=$x?>">
                                                                    <td><?=$resultS['firstname'].' '.$resultS['middlename'].' '.$resultS['lastname']?></td>
                                                                    <td><?=$override->get('class_list','id',$resultS['class_id'])[0]['class_name'] ?></td>
                                                                    <td><?=$resultS['stream']?></td>
                                                                    <td><?=$override->get('subjects','id',Input::get('subject'))[0]['name'] ?></td>
                                                                    <td class="actions">
                                                                        <input type="number" class="" name="score[]" min="0" max="100">
                                                                        <input type="hidden" class="" name="classId[]" value="<?=Input::get('class')?>">
                                                                        <input type="hidden" class="" name="subId[]" value="<?=Input::get('subject')?>">
                                                                        <input type="hidden" class="" name="student[]" value="<?=$resultS['id']?>">
                                                                    </td>
                                                                </tr>
                                                                <?php $x++;}} ?>

                                                        </tbody>
                                                    </table><br>
                                                    <div class="col-md-offset-6 col-md-6">
                                                        <input type="submit" value="Submit Results"  name="uploadResult" class="btn btn-primary pull-right mb-xl" data-loading-text="Loading...">
                                                    </div>
                                                <?php } ?>
                                            </form>
                                        </div>
                                    </section>
                                </div>
                            </div>
                        <!---------------------------------  tab13   ------------------------------------------------------------------------------------->
                        <div class="tab-pane tab-pane-navigation <?=$studR?>" id="tabsNavigation10">
                            <div class="container col-md-12">
                                <section class="panel">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="mb-md">
                                                    <form action=""  method="post">
                                                        <?php if(Input::get('studentResult')){if(!$errorMessage == null){
                                                            echo '<label style="color: #ff0000"><strong>ERROR: '.$errorMessage.'</strong></label>';}elseif(!$successMessage == null){
                                                            echo '<label style="color: #3f923f"><strong>CONGRATULATION!!!'.$successMessage.'</strong></label>';}
                                                            if(!$pageError == null){echo '<label style="color: #ff0000"><strong>ERROR: </strong></label>'; foreach($pageError as $error){
                                                                echo '<label style="color: #ff0000"><strong>'.$error.'</strong></label>'.' , ';
                                                            } echo '<br>';}}?>
                                                        <div class="form-group">
                                                            <div class="col-md-3">
                                                                <select name="exam" class="selectpicker form-control mb-md" data-live-search="true" title="Select Examination" required>
                                                                    <?php foreach($override->getData('exam_type') as $exam){ ?>
                                                                        <option value="<?=$exam['id']?>"><?=$exam['name']?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <select name="subject" class="selectpicker form-control mb-md" data-live-search="true" title="Select Subject" required="">
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
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="col-md-6">
                                                                <input name="exam_date" class="form-control" type="month">
                                                            </div>
                                                            <div class="col-md-2">
                                                                <input type="hidden" name="selectR" value="student_result">
                                                                <input type="submit" value="Select" id="selectResult" name="selectResult" class="btn btn-primary pull-right mb-xl" data-loading-text="Loading...">
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <form method="post">
                                            <input type="hidden" name="noRows" value="<?=$getResult?>">
                                            <input type="hidden" class="" name="examType" value="<?=Input::get('exam')?>">
                                            <input type="hidden" class="" name="examDate" value="<?=Input::get('exam_date')?>">
                                            <?php if(Input::get('studentResult') && Input::get('selectR') == 'student_result'){?>
                                                <table class="table table-bordered table-striped mb-none" id="datatable-editable7">
                                                    <thead>
                                                    <tr>
                                                        <th>Student Name</th>
                                                        <th>Class</th>
                                                        <th>Stream</th>
                                                        <th>Subject</th>
                                                        <th>Score</th>
                                                        <th>Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php if(!$override->getNews('students','class_id',Input::get('class'),'stream',Input::get('stream')) == null && Input::get('selectR') == 'student_result' && $validateSearch == false){
                                                        $x=0;foreach($override->getNews('students','class_id',Input::get('class'),'stream',Input::get('stream')) as $resultS){ ?>
                                                            <tr data-item-id="<?=$x?>">
                                                                <td><?=$resultS['firstname'].' '.$resultS['middlename'].' '.$resultS['lastname']?></td>
                                                                <td><?=$override->get('class_list','id',$resultS['class_id'])[0]['class_name'] ?></td>
                                                                <td><?=$resultS['stream']?></td>
                                                                <td><?=$override->get('subjects','id',Input::get('subject'))[0]['name'] ?></td>
                                                                <td><?=$override->updateSubject('results','school_id',$user->data()->school_id,'student_id',$resultS['id'],'subject_id',$override->get('subjects','id',Input::get('subject'))[0]['id'],
                                                                        'exam_id',Input::get('exam'),'exam_date',Input::get('exam_date'))[0]['score']?></td>
                                                                <td class="actions">
                                                                    <a href="#" class="hidden on-editing save-row"><i class="fa fa-save"></i></a>
                                                                    <a href="#" class="hidden on-editing cancel-row"><i class="fa fa-times"></i></a>
                                                                    <a href="edit.php?content=<?=$resultS['id']?>&group=results&data=stud_result&message=''" class="on-default edit-row"><i class="fa fa-pencil"></i></a>
                                                                    <a href="#" class="hidden on-default remove-row"><i class="fa fa-trash-o"></i></a>
                                                                </td>
                                                            </tr>
                                                            <?php $x++;}} ?>
                                                    </tbody>
                                                </table>
                                            <?php } ?>
                                        </form>
                                    </div>
                                </section>
                            </div>
                        </div>
                            <!---------------------------------  tab13   --------------------------------------------------------------------------------->
                        <div class="tab-pane tab-pane-navigation " id="tabsNavigation13">
                            <div class="container col-md-12">
                                <section class="panel">
                                    <div class="panel-body">
                                        <div class="table-responsive">
                                            <?php if(!$override->getSelectNoRepeat2('teaching_subject','class_id','stream','school_id',$user->data()->school_id,'teacher_id',$user->data()->id) == null){?>
                                            <table class="table table-bordered table-striped table-condensed mb-none">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th class="text-right">Class</th>
                                                    <th class="text-right">Stream</th>
                                                    <th>Subject Name</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php $x = 1;foreach($override->getSelectNoRepeat2('teaching_subject','class_id','stream','school_id',$user->data()->school_id,'teacher_id',$user->data()->id) as $techClass) {
                                                    foreach($override->get('class_list','id',$techClass['class_id']) as $className){ ?>
                                                <tr>
                                                    <td><?=$x?></td>
                                                    <td class="text-right"><?=$className['class_name']?></td>
                                                    <td class="text-right"><?=$techClass['stream']?></td>
                                                    <td>
                                                    <?php foreach($override->getSelectDataNoRepeat1('teaching_subject','subject_id','school_id',$user->data()->school_id,'teacher_id',$user->data()->id,'stream',$techClass['stream'],'class_id',$techClass['class_id']) as $techSubjects){
                                                      foreach($override->get('subjects','id',$techSubjects['subject_id']) as $techSubject){echo $techSubject['name'].' ,';}}?>
                                                    </td>
                                                </tr>
                                                    <?php }$x++;}?>
                                                </tbody>
                                            </table>
                                            <?php }else{echo "<h2>You don't teach any Subject</h2>";} ?>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
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

    $(document).ready(function(){
        $('#attach').change(function(){
            var attach_file = $(this).val();
            $.ajax({
                url:"dataProcess.php?content=file",
                method:"GET",
                data:{attachFile:attach_file},
                dataType:"text",
                success:function(data){
                    $('#file_attached').html(data);
                }
            });
        });
        $('#teacher').change(function(){
            var teacher = $(this).val();
            $.ajax({
                url:"dataProcess.php?content=teacher",
                method:"GET",
                data:{teacherNews:teacher},
                dataType:"text",
                success:function(data){
                    $('#teacher_news').html(data);
                }
            });
        });
        $('#parent').change(function(){
            var parents = $(this).val();
            $.ajax({
                url:"dataProcess.php?content=parent",
                method:"GET",
                data:{parentNews:parents},
                dataType:"text",
                success:function(data){
                    $('#parent_news').html(data);
                }
            });
        });
        $('#general_public').change(function(){
            var generalN = $(this).val();
            $.ajax({
                url:"dataProcess.php?content=general_public",
                method:"GET",
                data:{parentNews:generalN},
                dataType:"text",
                success:function(data){
                    $('#general_news').html(data);
                }
            });
        });
        $('#attach1').change(function(){
            var attach_file = $(this).val();
            $.ajax({
                url:"dataProcess.php?content=file",
                method:"GET",
                data:{attachFile:attach_file},
                dataType:"text",
                success:function(data){
                    $('#file_attached1').html(data);
                }
            });
        });
        $('#attach2').change(function(){
            var attach_file = $(this).val();
            $.ajax({
                url:"dataProcess.php?content=file",
                method:"GET",
                data:{attachFile:attach_file},
                dataType:"text",
                success:function(data){
                    $('#file_attached2').html(data);
                }
            });
        });
        $('#position').change(function(){
            var teacher_position = $(this).val();
            $.ajax({
                url:"dataProcess.php?content=position",
                method:"GET",
                data:{attachFile:teacher_position},
                dataType:"text",
                success:function(data){
                    $('#class_teacher').html(data);
                }
            });
        });
        $('#studentTable').change(function(){
            var student_list = $(this).val();
            $.ajax({
                url:"dataProcess.php?content=studentList&id=<?=$user->data()->school_id?>",
                method:"GET",
                data:{classId:student_list},
                dataType:"text",
                success:function(data){
                    $('#studentList').html(data);
                }
            });
        });
        $('#uploadResult').change(function(){
            var student_result = $(this).val();
            $.ajax({
                url:"dataProcess.php?content=uploadResult&id=<?=$user->data()->school_id?>",
                method:"GET",
                data:{resultId:student_result},
                dataType:"text",
                success:function(data){
                    $('#load_table').html(data);
                }
            });
        });
        $('#studId').change(function(){
            var student_Id = $(this).val();
            $.ajax({
                url:"dataProcess.php?content=editStud&id=<?=$user->data()->school_id?>",
                method:"GET",
                data:{studId:student_Id},
                dataType:"text",
                success:function(data){
                    $('#studentList').html(data);
                }
            });
        });

        $('#prev_subj').change(function(){
            var prev_subj = $(this).val();
            $.ajax({
                url:"dataProcess.php?content=prevSubj&id=<?=$user->data()->school_id?>",
                method:"GET",
                data:{prevSubj:prev_subj},
                dataType:"text",
                success:function(data){
                    $('#techSubj').html(data);
                }
            });
        });

        $('#new_allocation').change(function(){
            var new_allocation = $(this).val();
            $.ajax({
                url:"dataProcess.php?content=newAllocation&id=<?=$user->data()->school_id?>",
                method:"GET",
                data:{newAllocation:new_allocation},
                dataType:"text",
                success:function(data){
                    $('#new_sub_allocation').html(data);
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
