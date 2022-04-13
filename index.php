<?php
require_once'php/core/init.php';
$user = new User();
$override = new OverideData();
$myAccount = '#';
?>
<!DOCTYPE html>
<html>
<head>

		<!-- Basic -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">	

		<title>Info-Elimu | Home</title>

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

            <div class="slider-container light rev_slider_wrapper">
                <div id="revolutionSlider" class="slider rev_slider" data-plugin-revolution-slider data-plugin-options='{"delay": 9000, "gridwidth": 1170, "gridheight": 500, "disableProgressBar": "on"}'>
                    <ul>
                        <li data-transition="fade">

                            <img src="img/slides/photo.jpg"
                                 alt=""
                                 data-bgposition="center center"
                                 data-bgfit="cover"
                                 data-bgrepeat="no-repeat"
                                 data-kenburns="on"
                                 data-duration="9000"
                                 data-ease="Linear.easeNone"
                                 data-scalestart="150"
                                 data-scaleend="100"
                                 data-rotatestart="0"
                                 data-rotateend="0"
                                 data-offsetstart="0 0"
                                 data-offsetend="0 0"
                                 data-bgparallax="0"
                                 class="rev-slidebg">

                            <div class="tp-caption"
                                 data-x="177"
                                 data-y="180"
                                 data-start="1000"
                                 data-transform_in="x:[-300%];opacity:0;s:500;"></div>

                            <div class="tp-caption top-label"
                                 data-x="227"
                                 data-y="180"
                                 data-start="500"
                                 style="color: #000000; font-weight: bold;"
                                 data-transform_in="y:[-300%];opacity:0;s:500;">Need to efficiently check on your child's progress?</div>

                            <div class="tp-caption"
                                 data-x="480"
                                 data-y="180"
                                 data-start="1000"
                                 data-transform_in="x:[300%];opacity:0;s:500;"></div>

                            <div class="tp-caption main-label"
                                 data-x="135"
                                 data-y="210"
                                 data-start="1500"
                                 data-whitespace="nowrap"
                                 data-transform_in="y:[100%];s:500;"
                                 data-transform_out="opacity:0;s:500;"
                                 style="color: white;"
                                 data-mask_in="x:0px;y:0px;">WELCOME TO INFO-ELIMU</div>

                            <div class="tp-caption bottom-label"
                                 data-x="185"
                                 data-y="280"
                                 data-start="2000"
                                 style="color: #000000;font-weight: bold;"
                                 data-transform_in="y:[100%];opacity:0;s:500;"></div>
                        </li>
                        <li data-transition="fade">

                            <img src="img/slides/photo2.jpg"
                                 alt=""
                                 data-bgposition="right center"
                                 data-bgpositionend="center center"
                                 data-bgfit="cover"
                                 data-bgrepeat="no-repeat"
                                 data-kenburns="on"
                                 data-duration="9000"
                                 data-ease="Linear.easeNone"
                                 data-scalestart="110"
                                 data-scaleend="100"
                                 data-rotatestart="0"
                                 data-rotateend="0"
                                 data-offsetstart="0 0"
                                 data-offsetend="0 0"
                                 data-bgparallax="0"
                                 class="rev-slidebg">

                            <div class="tp-caption featured-label"
                                 data-x="center"
                                 data-y="210"
                                 data-start="500"
                                 style="z-index: 5"
                                 data-transform_in="y:[100%];s:500;"
                                 data-transform_out="opacity:0;s:500;">We Bridge The Communication Gap</div>

                            <div class="tp-caption bottom-label"
                                 data-x="center"
                                 data-y="270"
                                 data-start="1000"
                                 data-transform_idle="o:1;"
                                 data-transform_in="y:[100%];z:0;rZ:-35deg;sX:1;sY:1;skX:0;skY:0;s:600;e:Power4.easeInOut;"
                                 data-transform_out="opacity:0;s:500;"
                                 data-mask_in="x:0px;y:0px;s:inherit;e:inherit;"
                                 data-splitin="chars"
                                 data-splitout="none"
                                 data-responsive_offset="on"
                                 style="font-size: 23px; line-height: 30px;"
                                 data-elementdelay="0.05">An SMS to you can make headway in monitoring your child's progress. Try it now!</div>

                        </li>
                        <li data-transition="fade">

                            <img src="img/slides/library.jpg"
                                 alt=""
                                 data-bgposition="center center"
                                 data-bgfit="cover"
                                 data-bgrepeat="no-repeat"
                                 data-kenburns="on"
                                 data-duration="9000"
                                 data-ease="Linear.easeNone"
                                 data-scalestart="150"
                                 data-scaleend="100"
                                 data-rotatestart="0"
                                 data-rotateend="0"
                                 data-offsetstart="0 0"
                                 data-offsetend="0 0"
                                 data-bgparallax="0"
                                 class="rev-slidebg">

                            <div class="tp-caption"
                                 data-x="177"
                                 data-y="180"
                                 data-start="1000"
                                 data-transform_in="x:[-300%];opacity:0;s:500;"><!--<img src="img/slides/slide-title-border-light.png" alt="">--></div>

                            <div class="tp-caption top-label"
                                 data-x="227"
                                 data-y="180"
                                 data-start="500"
                                 data-transform_in="y:[-300%];opacity:0;s:500;"></div>

                            <div class="tp-caption"
                                 data-x="480"
                                 data-y="180"
                                 data-start="1000"
                                 data-transform_in="x:[300%];opacity:0;s:500;"><!--<img src="img/slides/slide-title-border-light.png" alt="">--></div>

                            <div class="tp-caption main-label"
                                 data-x="135"
                                 data-y="210"
                                 data-start="1500"
                                 data-whitespace="nowrap"
                                 data-transform_in="y:[100%];s:500;"
                                 data-transform_out="opacity:0;s:500;"
                                 data-mask_in="x:0px;y:0px;">Explore schools and colleges</div>

                            <div class="tp-caption bottom-label"
                                 data-x="185"
                                 data-y="280"
                                 data-start="2000"
                                 data-transform_in="y:[100%];opacity:0;s:500;">View schools and colleges from various regions in Tanzania</div>

                        </li>
                        <li data-transition="fade">

                            <img src="img/slides/STUDENT%20PROGRESSnew.jpg"
                                 alt=""
                                 data-bgposition="right center"
                                 data-bgpositionend="center center"
                                 data-bgfit="cover"
                                 data-bgrepeat="no-repeat"
                                 data-kenburns="on"
                                 data-duration="9000"
                                 data-ease="Linear.easeNone"
                                 data-scalestart="110"
                                 data-scaleend="100"
                                 data-rotatestart="0"
                                 data-rotateend="0"
                                 data-offsetstart="0 0"
                                 data-offsetend="0 0"
                                 data-bgparallax="0"
                                 class="rev-slidebg">

                            <div class="tp-caption featured-label"
                                 data-x="center"
                                 data-y="210"
                                 data-start="500"
                                 style="z-index: 5"
                                 data-transform_in="y:[100%];s:500;"
                                 data-transform_out="opacity:0;s:500;"></div>

                            <div class="tp-caption bottom-label"
                                 data-x="center"
                                 data-y="270"
                                 data-start="1000"
                                 data-transform_idle="o:1;"
                                 data-transform_in="y:[100%];z:0;rZ:-35deg;sX:1;sY:1;skX:0;skY:0;s:600;e:Power4.easeInOut;"
                                 data-transform_out="opacity:0;s:500;"
                                 data-mask_in="x:0px;y:0px;s:inherit;e:inherit;"
                                 data-splitin="chars"
                                 data-splitout="none"
                                 data-responsive_offset="on"
                                 style="font-size: 23px; line-height: 30px;"
                                 data-elementdelay="0.05"></div>

                        </li>
                    </ul>
                </div>
            </div>

				<div class="home-intro" id="home-intro">
					<div class="container">

						<div class="row">

							<div class="col-md-12">
								<div class="col-md-offset-0">
                                   <!-- <a href="tamongsco_zone.php?content=1&type=zone" class="btn btn-lg btn-primary">TAMONGSCO NORTH-WEST</a>
									<a href="tamongsco_zone.php?content=4&type=zone" class="btn btn-lg btn-primary">TAMONGSCO KILIMANJARO</a>-->
                                    <a href="tamongscoZone.php" class="btn btn-lg btn-primary">TAMONGSCO ZONES</a>
                                    <a href="advertise.php" class="btn btn-lg btn-primary">CATHOLIC DIOCESE OF MOSHI SCHOOLS AND COLLEGES</a>
								</div>
							</div>
						</div>

					</div>
				</div>

				<div class="container">

					<div class="row center">
						<div class="col-md-12">
							<h2 class="mb-sm word-rotator-title">
                                Get registered at your child's school to receive sms with updates concerning your child's academic progress and behaviour.
							</h2>
						</div>
					</div>

				</div>
            <div class="container">
                <div class="row center">
                    <div class="col-md-12">
                        <img src="img/PHONE.jpg" class="img-responsive appear-animation" data-appear-animation="fadeInUp" alt="dark and light" style="margin: 45px 0px -30px;">
                    </div>
                </div>
            </div>

            <section class="section">
                <div class="container">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12 center">
                                    <h2 class="mb-xs">Our <strong>Services</strong></h2>
                                </div>
                                <div class="col-md-4">
                                    <div class="feature-box feature-box-style-2">
                                        <div class="feature-box-icon">
                                            <img src="img/icons/smsNotification.png" width="56" height="56">
                                        </div>
                                        <br>
                                        <div class="feature-box-info">
                                            <h4 class="mb-none"><a href="services.php?service=1">SMS Notification</a></h4>
                                            <p class="tall">Get to receive sms notifications on your child’s progress at school.</p><br>
                                        </div>
                                    </div>
                                    <div class="feature-box feature-box-style-2">
                                        <div class="feature-box-icon">
                                            <img src="img/icons/schools.png" width="56" height="56">
                                        </div>
                                        <br>
                                        <div class="feature-box-info">
                                            <h4 class="mb-none"><a href="services.php?service=5">Explore Schools and Colleges in Tanzania</a></h4>
                                            <p class="tall">Get to know about schools and colleges in Tanzania.</p>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-4">
                                    <div class="feature-box feature-box-style-2">
                                        <div class="feature-box-icon">
                                            <img src="img/icons/management.png" width="56" height="56">
                                        </div>
                                        <br>
                                        <div class="feature-box-info">
                                            <h4 class="mb-none"><a href="services/1">Planning and Management of Schools</a></h4>
                                            <p class="tall">Get effective Planning and Efficient Management of Schools.</p>
                                        </div>
                                    </div>
                                    <div class="feature-box feature-box-style-2">
                                        <div class="feature-box-icon">
                                            <img src="img/icons/storageResults.png" width="56" height="56">
                                        </div>
                                        <br>
                                        <div class="feature-box-info">
                                            <h4 class="mb-none"><a href="services.php?service=3">Easy Storage and Retrieval of Student's Information</a></h4>
                                            <p class="tall">Students’ information is now easy to store and retrieve..</p>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-md-4">
                                    <div class="feature-box feature-box-style-2">
                                        <div class="feature-box-icon">
                                            <img src="img/icons/webServices.png" width="56" height="56">
                                        </div>
                                        <br>
                                        <div class="feature-box-info">
                                            <h4 class="mb-none"><a href="services.php?service=4">Website Service</a></h4>
                                            <p class="tall">Showcase Your school’s Information as a Webpage at Info-elimu.</p><br>
                                        </div>
                                    </div>
                                    <div class="feature-box feature-box-style-2">
                                        <div class="feature-box-icon">
                                            <img src="img/icons/teacher.png" width="56" height="56">
                                        </div>
                                        <br>
                                        <div class="feature-box-info">
                                            <h4 class="mb-none"><a href="services.php?service=6">Know Vacant Positions for Teachers</a></h4>
                                            <p class="tall">Be informed about vacant positions for teachers in different schools in Tanzania.</p>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </section>

				<div class="row center mt-xl">
					<div class="owl-carousel owl-theme" data-plugin-options='{"items": 6, "autoplay": true, "autoplayTimeout": 3000}'>
						<div>
							<img class="img-responsive" src="img/logos/tangazo4.jpg" alt="">
						</div>
						<div>
							<img class="img-responsive" src="img/logos/tangazo5.jpg" alt="">
						</div>
						<div>
							<img class="img-responsive" src="img/logos/tangazo6.jpg" alt="">
						</div>
                        <div>
                            <img class="img-responsive" src="img/logos/advert.png" alt="">
                        </div>
					</div>
				</div>

				<!--<section class="parallax section section-text-light section-parallax section-center mt-none" data-stellar-background-ratio="0.5" style="background-image: url(img/vicent1.jpg);">
					<div class="container">
						<div class="row">
							<div class="col-md-6 col-md-offset-0">
								<div class="owl-carousel owl-theme nav-bottom rounded-nav" data-plugin-options='{"items": 1, "loop": false}'>
									<div>
										<div class="col-md-12">
											<div class="testimonial testimonial-style-2 testimonial-with-quotes mb-none">
												<div class="testimonial-author">
                                                <br><br>
												</div>
												<blockquote>
													<p>Effective communication between parents and teachers will brighten our children's future. I believe that frequent communication plays a significant role in shaping student's academic performance and good behavior.Therefore,bridging the gap between parents and teachers will enhance the future of our children.
                                                    </p>
												</blockquote>
												<div class="testimonial-author">
													<p><strong>Vincent Shekibula</strong><span>ED & Founder - DV Scorps </span></p>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>-->

				<section class="section m-none">
					<div class="container">
						<div class="row">
							<div class="col-md-12 center">
								<h2 class="mb-xs">Our <strong>System Developers</strong></h2>
							</div>
						</div>
						<div class="row mt-lg">
                            <div class="col-md-2 col-xs-6 center mb-lg col-md-offset-0">
                                <img src="img/team/fredy.jpg" class="img-responsive" alt="">
                                <h5 class="mt-sm mb-none">Fredrick Aman</h5>
                                <p class="mb-none">Head of ICT/System Developer/Programmer</p>
                            </div>
                            <div class="col-md-2 col-xs-6 center mb-lg col-md-offset-0">
                                <img src="img/team/mikidadi%20web.jpg" class="img-responsive" alt="">
                                <h5 class="mt-sm mb-none">Mikidadi Richard</h5>
                                <p class="mb-none">Head of Business Development</p>
                            </div>
<!---------------------------------------------------------------------------------------------------------------------------------------------------->
							<div class="col-md-2 col-xs-6 center mb-lg">
								<img src="img/team/mariaa%20web.jpg" class="img-responsive" alt="">
								<h5 class="mt-sm mb-none">Maria Proches</h5>
								<p class="mb-none">Technical Sales Manager/Graphics Designer</p>
							</div>
							<div class="col-md-2 col-xs-6 center mb-lg">
								<img src="img/team/eunice%20web.jpg" class="img-responsive" alt="">
								<h5 class="mt-sm mb-none">Eunice Jengo</h5>
								<p class="mb-none">System Analyst/Graphics Designer</p>
							</div>
							<div class="col-md-2 col-xs-6 center mb-lg">
								<img src="img/team/mathew.jpg" class="img-responsive" alt="">
								<h5 class="mt-sm mb-none">MATHEW Rugaimukamu</h5>
								<p class="mb-none">Business Developement Manager</p>
							</div>
							<div class="col-md-2 col-xs-6 center mb-lg">
								<img src="img/team/joy%20id.jpg" class="img-responsive" alt="">
								<h5 class="mt-sm mb-none">Joyce Pantaleo</h5>
								<p class="mb-none">Quality Manager/Database administrator</p>
							</div>
						</div>
					</div>
				</section>
				<div class="row center mt-xl">
					<div class="owl-carousel owl-theme" data-plugin-options='{"items": 6, "autoplay": true, "autoplayTimeout": 3000}'>
						<div>
							<img class="img-responsive" src="img/logos/tangazo%203.jpg" alt="">
						</div>
						<div>
							<img class="img-responsive" src="img/logos/tangazo111.jpg" alt="">
						</div>
						<div>
							<img class="img-responsive" src="img/logos/tangazo7.jpg" alt="">
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
