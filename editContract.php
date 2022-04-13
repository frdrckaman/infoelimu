<?php
require_once'php/core/init.php';
$user = new User(); $pageError = null; $errorMessage = null;
$override = new OverideData();$content = null; $studClass= null;$successMessage = null;
if($user->isLoggedIn()) {
    if ($user->getSessionTable() === 'org_member' && !$_GET['content'] == null && !$_GET['group'] == null) {
        $techContract = $override->get('contract','teacher_id',$_GET['content']);
        $teacherInfo = $override->get('teachers','id',$_GET['content']);//print_r($teacherInfo);
        $teacherSchool = $override->get('schools','id',$teacherInfo[0]['school_id']);//print_r($teacherSchool);
        if (Input::exists('post')) {
            if (Token::check(Input::get('token'))) {
                if (!empty($_FILES['attach_contract']["tmp_name"])) {
                    $attach_file = $_FILES['attach_contract']['type'];
                    if ($attach_file == "application/pdf" || $attach_file == "application/vnd.openxmlformats-officedocument.wordprocessingml.document" || $attach_file == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet") {
                        $folderName = 'attachment/contracts/';
                        $attachment_file = $folderName . basename($_FILES['attach_contract']['name']);
                        if (move_uploaded_file($_FILES['attach_contract']["tmp_name"], $attachment_file)) {
                            $file = true;
                            $error = true;
                        } else {
                            $errorMessage = 'File Not Uploaded ,';
                        }
                    } else $errorMessage = 'None supported file format';//not supported format
                } else $errorMessage = 'No attached file ,';//no attached file

                $validate = new validate();
                $validate = $validate->check($_POST, array(
                    'start_date' => array(
                        'required' => true,
                    ),
                    'end_date' => array(
                        'required' => true,
                    ),
                ));

                if ($validate->passed() && $error == true) {
                    try {
                        $user->updateRecord('contract', array(
                            'start_date' => Input::get('start_date'),
                            'end_date' => Input::get('end_date'),
                            'contract_doc' => $attachment_file,
                        ),$techContract[0]['id']);
                        $successMessage = 'Contract have been Changed Successfully';
                        $reload = 'editContract.php?content=' . $_GET['content'] . '&group=' . $_GET['group'].'&data='.$_GET['data'].'&message='.$successMessage;
                        Redirect::to($reload);
                    } catch (Exception $e) {
                        die($e->getMessage());
                    }
                } else {
                    $pageError = $validate->errors();
                }
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
    <div class="container">
        <br><br>
        <h2>Edit Teacher's Contract</h2>
        <?php if(!$errorMessage == null){
            echo '<label style="color: #ff0000"><strong>ERROR: '.$errorMessage.'</strong></label>';}elseif(!$_GET['message'] == null){
            echo '<label style="color: #3f923f"><strong>'.$_GET['message'].'</strong></label>';}
        if(!$pageError == null){echo '<label style="color: #ff0000"><strong>ERROR: </strong></label>'; foreach($pageError as $error){
            echo '<label style="color: #ff0000"><strong>'.$error.'</strong></label>'.' , ';
        } echo '<br>';}?>
        <form enctype="multipart/form-data" method="post">
            <table class="table table-bordered table-striped mb-none" >
                <thead>
                <tr>
                    <th>Teacher Name</th>
                    <th>School Name</th>
                    <th>Contract Begin At</th>
                    <th>Contract End At</th>
                    <th>Attach Contract</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                  <td><?=$teacherInfo[0]['firstname'].' '.$teacherInfo[0]['middlename'].' '.$teacherInfo[0]['lastname']?></td>
                  <td><?=$teacherSchool[0]['name'].' '.$teacherSchool[0]['category']?></td>
                  <td><input name="start_date" type="date" required></td>
                  <td><input name="end_date" type="date" required></td>
                  <td><input name="attach_contract" type="file" required></td>
                  <td class="actions">
                      <input type="hidden" name="token" value="<?php echo Token::generate()?>">
                      <button name="save" value="save" class="on-editing save-row"><i class="fa fa-save"></i></button>
                  </td>
                </tbody>
            </table>
        </form>
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
