<?php
require_once'php/core/init.php';
$user = new User(); $pageError = null; $errorMessage = null;
$override = new OverideData();$content = null; $studClass= null;$successMessage = null;
if($user->isLoggedIn()){
if($user->getSessionTable() === 'teachers' && !$_GET['content'] == null && !$_GET['group'] == null) {
    if($user->getSessionTable() === 'teachers' /*&& $user->data()->position == 'Headmaster' || $user->data()->position == 'SecondMaster'*/) {
        if($_GET['data'] == 'stud_detail') {
            $content = $override->get($_GET['group'], 'id', $_GET['content']);
            if ($user->data()->school_id === $content[0]['school_id']) {
                $studClass = $override->get('class_list', 'id', $content[0]['class_id']);
                if (Input::exists('post')) {
                    if (Input::get('save')) {
                        $validate = new validate();
                        $validation = $validate->check($_POST, array(
                            'firstname' => array(
                                'required' => true,
                                'min' => 1
                            ),
                            'middlename' => array(

                            ),
                            'lastname' => array(
                                'required' => true,
                                'min' => 1
                            ),
                            'gender' => array(
                                'required' => true,
                            ),
                            'student_class' => array(
                                'required' => true,
                            ),
                            'stream' => array(
                                'required' => true,
                            )
                        ));
                        if ($validation->passed()) {
                            try {
                                $user->updateRecord('students', array(
                                    'firstname' => Input::get('firstname'),
                                    'middlename' => Input::get('middlename'),
                                    'lastname' => Input::get('lastname'),
                                    'gender' => Input::get('gender'),
                                    'class_id' => Input::get('student_class'),
                                    'stream' => Input::get('stream')
                                ), $_GET['content']);
                                $successMessage = ' Information have been updated Successful';
                                $reload = 'edit.php?content=' . $_GET['content'] . '&group=' . $_GET['group'].'&data='.$_GET['data'].'&message='.$successMessage;
                                Redirect::to($reload);
                            } catch (Exception $e) {
                                die($e->getMessage());
                            }
                        } else {
                            $pageError = $validate->errors();
                        }
                    }
                    if (Input::get('delete')) {
                        if ($user->deleteRecord('students', 'id', $_GET['content'])) {
                            Redirect::to('teacher.php');
                        }
                    }
                }
            } else {
                Redirect::to('teacher.php');
            }
        }
        elseif($_GET['data'] == 'stud_result'){
            $info=$override->get('results','id',$_GET['content']);
            $content = $override->get('students', 'id', $info[0]['student_id']);
            $content1 = $override->get($_GET['group'],'id',$_GET['rec']);
            $studentClass = $override->get('class_list','id',$content[0]['class_id']);
            $subject = $override->get('subjects','id',$content1[0]['subject_id']);
            if (Input::exists('post')) {
                if (Input::get('save')) {
                    $validate = new validate();
                    $validation = $validate->check($_POST, array(
                        'score' => array(
                            'required' => true,
                        )
                    ));
                    if ($validation->passed()) {
                        try {
                            $user->updateRecord('results',array('score'=>Input::get('score')),$content1[0]['id']);
                            $successMessage = ' Information have been updated Successful';
                            $reload = 'edit.php?content=' . $_GET['content'] . '&group=' . $_GET['group'].'&data='.$_GET['data'].'&rec='.$_GET['rec'].'&message='.$successMessage;
                            Redirect::to($reload);
                        } catch (Exception $e) {
                            die($e->getMessage());
                        }
                    } else {
                        $pageError = $validate->errors();
                        $validateSearch = true;
                    }
                }elseif(Input::get('delete')){
                    if ($user->deleteRecord('results', 'id', $content1[0]['id'])) {
                        Redirect::to('teacher.php');
                    }
                }
            }
        }
    }else{Redirect::to('teacher.php');}
   }else{Redirect::to('teacher.php');}
 }else{Redirect::to('teacher.php');}
?>
<!DOCTYPE html>
<html>
<head>
    <!-- Basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Info-Elimu | Edit </title>

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
        <br><br><br><br>
        <?php if($_GET['data'] == 'stud_detail'){echo'<h2>Edit Student Information</h2>';}elseif($_GET['data'] == 'stud_result'){echo'<h2>Edit Student Results</h2>';}?>
        <?php if(!$errorMessage == null){
            echo '<label style="color: #ff0000"><strong>ERROR: '.$errorMessage.'</strong></label>';}elseif(!$_GET['message'] == null){
            echo '<label style="color: #3f923f"><strong>'.$_GET['message'].'</strong></label>';}
            if(!$pageError == null){echo '<label style="color: #ff0000"><strong>ERROR: </strong></label>'; foreach($pageError as $error){
                echo '<label style="color: #ff0000"><strong>'.$error.'</strong></label>'.' , ';
            } echo '<br>';}?>
        <?php if($_GET['data'] == 'stud_detail'){ ?>

        <table class="table table-bordered table-striped mb-none" >
            <thead>
            <tr>
                <th>Firstname</th>
                <th>Middlename</th>
                <th>Lastname</th>
                <th>Gender</th>
                <th>Class</th>
                <th>Stream</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody><form method="post">
                <td><input type="text" name="firstname" class="form-control mb-md" value="<?=$content[0]['firstname']?>"></td>
                <td><input type="text" name="middlename" class="form-control mb-md" value="<?=$content[0]['middlename']?>"></td>
                <td><input type="text" name="lastname" class="form-control mb-md" value="<?=$content[0]['lastname']?>"></td>
                <td><select name="gender" class="form-control mb-md"><option value="<?=$content[0]['gender']?>"><?=$content[0]['gender']?></option> <option value="Male">Male</option><option value="Female">Female</option></select></td>
                <td><select name="student_class" class="form-control mb-md" title="Choose Stream" required >
                        <option value="<?=$studClass[0]['id']?>"><?=$studClass[0]['class_name'] ?></option>
                        <?php if(!$override->getData('class_list') == null){
                            foreach($override->getData('class_list') as $class){?>
                                <option value='<?=$class['id']?>'> <?=$class['class_name']?> </option>
                            <?php }}?>
                    </select></td>
                <td><select name="stream"  class="form-control mb-md" title="Choose Stream" required>
                        <option value="<?=$content[0]['stream']?>"><?=$content[0]['stream']?></option>
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
                    </select></td>
            <td class="actions">
                <button name="save" value="save" class="on-editing save-row"><i class="fa fa-save"></i></button>
                <a href="#" class="hidden on-editing cancel-row"><i class="fa fa-times"></i></a>
                <a href="#" class="hidden on-default edit-row"><i class="fa fa-pencil"></i></a>
                <button name="delete" value="delete" class="on-default remove-row" onclick="javascript: return confirm('Are you SURE you wish to delete this Record?');" ><i class="fa fa-trash-o"></i></button>
            </td>
                </form>
            </tbody>
        </table>
        <?php }elseif($_GET['data'] == 'stud_result'){?>
            <table class="table table-bordered table-striped mb-none" >
                <thead>
                <tr>
                    <th>Firstname</th>
                    <th>Middlename</th>
                    <th>Lastname</th>
                    <th>Class</th>
                    <th>Stream</th>
                    <th>Score</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody><form method="post">
                    <td><input type="text" name="firstname" class="form-control mb-md" value="<?=$content[0]['firstname']?>"></td>
                    <td><input type="text" name="middlename" class="form-control mb-md" value="<?=$content[0]['middlename']?>"></td>
                    <td><input type="text" name="lastname" class="form-control mb-md" value="<?=$content[0]['lastname']?>"></td>
                    <td><select name="student_class" class="form-control mb-md" title="Choose Stream" required >
                            <option value="<?=$studentClass[0]['id']?>"><?=$studentClass[0]['class_name'] ?></option>
                            <?php if(!$override->getData('class_list') == null){
                                foreach($override->getData('class_list') as $class){?>
                                    <option value='<?=$class['id']?>'> <?=$class['class_name']?> </option>
                                <?php }}?>
                        </select></td>
                    <td><select name="stream"  class="form-control mb-md" title="Choose Stream" required>
                            <option value="<?=$content[0]['stream']?>"><?=$content[0]['stream']?></option>
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
                        </select></td>
                    <td><input name="score" class="form-control" value="<?=$content1[0]['score']?>"></td>
                    <td class="actions">
                        <button name="save" value="save" class="on-editing save-row"><i class="fa fa-save"></i></button>
                        <a href="#" class="hidden on-editing cancel-row"><i class="fa fa-times"></i></a>
                        <a href="#" class="hidden on-default edit-row"><i class="fa fa-pencil"></i></a>
                        <button name="delete" value="delete" class="on-default remove-row" onclick="javascript: return confirm('Are you SURE you wish to delete this Record?');" ><i class="fa fa-trash-o"></i></button>
                    </td>
                </form>
                </tbody>
            </table>
        <?php } ?>

    </div>
</div>
<br><br><br><br><br><br><br><br><br>
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
