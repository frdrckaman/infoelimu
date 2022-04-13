<footer id="footer" class="color color-quaternary">
    <div class="container">
        <div class="row">
            <div class="footer-ribbon">
                <span>Get in Touch</span>
            </div>
            <div class="col-md-3">
                <div class="newsletter">
                    <h4>Newsletter</h4>
                    <p>Keep up on our always evolving features and technology. Enter your e-mail and subscribe to our newsletter.</p>

                    <div class="alert alert-success hidden" id="newsletterSuccess">
                        <strong>Success!</strong> You've been added to our email list.
                    </div>

                    <div class="alert alert-danger hidden" id="newsletterError"></div>

                    <form id="newsletterForm" action="" method="POST">
                        <div class="input-group">
                            <input class="form-control" placeholder="Email Address" name="newsletterEmail" id="newsletterEmail" type="text">
										<span class="input-group-btn">
											<button class="btn btn-default" type="submit">Go!</button>
										</span>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-3">
                <h4>Latest Tweets</h4>
                <div id="tweet" class="twitter" data-plugin-tweets data-plugin-options='{"username": "dvscorps", "count": 2}'>
                    <p>Please wait...</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="contact-details">
                    <h4>Contact Us</h4>
                    <ul class="contact">
                        <li><p><i class="fa fa-map-marker"></i> <strong>Address:</strong> Plot 471, Block 46, Sinza Mori, Dar es Salaam, Tanzania</p></li>
                        <li><p><i class="fa fa-phone"></i> <strong>Phone:</strong> +255 762 949 965</p></li>
                        <li><p><i class="fa fa-envelope"></i> <strong>Email:</strong> <a href="#">info@infoelimu.ac.tz</a></p></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-2">
                <h4>Follow Us</h4>
                <ul class="social-icons">
                    <li class="social-icons-facebook"><a href="http://www.facebook.com/" target="_blank" title="Facebook"><i class="fa fa-facebook"></i></a></li>
                    <li class="social-icons-twitter"><a href="http://www.twitter.com/" target="_blank" title="Twitter"><i class="fa fa-twitter"></i></a></li>
                    <li class="social-icons-linkedin"><a href="http://www.linkedin.com/" target="_blank" title="Linkedin"><i class="fa fa-linkedin"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="footer-copyright">
        <div class="container">
            <div class="row">
                <div class="col-md-2">
                    <a href="#" class="">
                        <img alt="dv scorps logo" class="img-responsive" src="img/logo1.png">
                    </a>
                </div>
                <div class="col-md-5">
                    <p>© Copyright 2016. All Rights Reserved.</p>
                </div>
                <div class="col-md-5">
                    <nav id="sub-menu">
                        <ul>
                            <li><a href="#">FAQ's</a></li>
                            <li><a href="privacy.php">Privacy</a></li>
                            <li><a href="terms.php">Terms of Use</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</footer>