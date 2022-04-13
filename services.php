<?php
require_once'php/core/init.php';
$user = new User();
$override = new OverideData();
$sms = null;$storage = null;$web = null;$explore = null;$vacant = null;$manage = null;
if($_GET['service']) {
    switch ($_GET['service']) {
        case 1:
            $sms = 'in';
            break;
        case 2:
            $manage = 'in';
            break;
        case 3:
            $storage = 'in';
            break;
        case 4:
            $web = 'in';
            break;
        case 5:
            $explore = 'in';
            break;
        case 6:
            $vacant = 'in';
            break;
        default:
            $sms = 'in';
    }
}else{Redirect::to('index.php');}
?>
    <!DOCTYPE html>
    <html>
    <head>
        <!-- Basic -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title>Info-Elimu | Services </title>

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
            <br><br><br>
            <div class="row">
                <div class="col-md-12">
                    <h2><strong>OUR SERVICES</strong></h2>
                        <div class="panel-group panel-group-primary" id="accordion2Primary">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2Primary" href="#collapse2PrimaryOne">
                                            SMS Notification
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse2PrimaryOne" class="accordion-body collapse <?=$sms?>">
                                    <div class="panel-body">
                                        <p>Your child’s progress is an aspect that should be followed closely. At Info_Elimu, we value the importance.
                                            Teachers need to communicate with parents about their children's progress at school. This allows them to follow up on the child's development, both academically and socially.
                                           At Info_Elimu, we consider this our top priority, and we are working hand in hand to facilitate it. We strive to make sure that parents are up to date with their children’s performance and behavior at school.
                                            The SMS feature at our site enables parents and teachers to communicate frequently and consistently.
                                        <P> A school or college is now able to easily disseminate information to parents via SMS. Academic progress being one of the aspects a parent is ever curious about concerning a child, can be easily intimated by a teacher via SMS.
                                            For example, parents are rarely informed of results for weekly or monthly tests is given out. Utilizing our SMS feature can enable the dissemination of these results. Parents can also be informed of their child’s conduct.
                                            A parent can also be informed about a child’s health.
                                           The information given to parents via SMS can potentially go beyond the perspective of a child’s academic, social and behavioural status. A parent can be informed about the school’s opening and closing dates, a parents-teachers meeting,
                                            reminder of Graduation dates, a change in the general school calendar and others.</P>
                                        <P>To benefit from the SMS feature, a school must be registered at the Info_Elimu platform.</P>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2Primary" href="#collapse2PrimaryTwo">
                                            Management of Academic Institutions
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse2PrimaryTwo" class="accordion-body collapse <?=$manage?>">
                                    <div class="panel-body">
                                        <p>At Info_Elimu, schools and colleges can be managed better. A Head of School, for example, can perform activities such as view general school information,
                                            view a list of teachers and students in the respective school and also check students’ performances through Info_Elimu. </p>
                                        <P>New students and teachers can also be registered through the same system. Announcements and news can be uploaded and viewed on the profile of logged in users.
                                            Subjects can also be allocated to the registered teachers.</P>
                                        <P>To utilize this feature, a user needs to be logged in as a teacher on the website. If you are a teacher and not yet registered at our site, please check with your
                                            Head of School and get registered. You will however not be able to do so if your school or college is not registered at our site.</P>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2Primary" href="#collapse2PrimaryThree">
                                            Easy Storage and Retrieval of Student's Information
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse2PrimaryThree" class="accordion-body collapse <?=$storage?>">
                                    <div class="panel-body">
                                        <p>Through Info_Elimu, teachers can upload their students’ information online for easy and secure access.
                                            Teachers can also upload their students’ results, which can later be viewed by them or by the student’s their respective parents.
                                            They can be continuous assessment test results, results of monthly tests, all the way to end-semester or annual examination results.
                                            A school or college needs to be registered into Info_Elimu to utilize this feature.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2Primary" href="#collapse2PrimaryFour">
                                            Website Service
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse2PrimaryFour" class="accordion-body collapse <?=$web?>">
                                    <div class="panel-body">
                                        <p>We provide schools and organizations a page in our platform to showcase their credentials for a very minimum and affordable price.
                                            With this you will be able to make your school more known and gain more customers. Contact our office for this service.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2Primary" href="#collapse2PrimaryFive">
                                            Explore Schools and Colleges in Tanzania
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse2PrimaryFive" class="accordion-body collapse <?=$explore?>">
                                    <div class="panel-body">
                                        <p>With this service, you can quickly and easily access a number of schools and colleges together with their details pertaining to your requirements.
                                            It will assist you in making the right and best choices when looking for a school to take your child to. You will be able to see the general details
                                            including location, subjects offered, programs and category of the school whether it is co-education, boy, girls, day or boarding.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2Primary" href="#collapse2PrimarySix">
                                            Know Vacant Positions for Teachers
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse2PrimarySix" class="accordion-body collapse <?=$vacant?>">
                                    <div class="panel-body">
                                        <p>At Info_Elimu you can know various vacant positions for teachers from schools in need of them.  These schools are registerd at Info_Elimu, making it easier to post directly on the same platform.</p>
                                    </div>
                                </div>
                            </div>
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
