<!DOCTYPE html>

<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title></title>
  <meta name="description" content="">
  <meta name="keywords" content="">

<link rel="stylesheet" href="<?=base_url()?>/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="<?=base_url()?>/dist/css/bootstrap-theme.min.css">
<link rel="stylesheet" href="<?=base_url()?>/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?=base_url()?>/dist/css/style.css">
  <link rel="stylesheet" href="<?=base_url()?>/dist/css/owl.carousel.css">
  <link rel="stylesheet" href="<?=base_url()?>/dist/css/jquery-ui.css">
  <link rel="stylesheet" href="<?=base_url()?>/dist/css/custom.css">
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
   <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?=base_url()?>/dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?=base_url()?>/plugins/iCheck/square/blue.css">
  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,800,600,700" rel="stylesheet" type="text/css">

  <!--[if IE 9]>
    <script src="js/media.match.min.js"></script>
  <![endif]-->
<style type="text/css"></style></head>
<body>

<!-- Start Header -->
<header id="header">
  <div class="container">
    <div class="row">
      <!--<div class="col-md-12">
        <div class="logo">
          <a href="#"><img src="http://radiumatic.com/assets/landing/img/logo.png" alt="logo" class="img-responsive"></a>
        </div>
        <div class="navigation">
          <nav>
            <ul class="custom-list list-inline">
              <li><a href="#brands">Brands</a></li>
              <li><a href="#how-it-works">How it Works</a></li>
              <li><a href="#social-influencers">Social Influencers</a></li>
              <li><a href="#faq">FAQ</a></li>
              <li><a href="#hero" class="btn btn-red">Login</a></li>
            </ul>
          </nav>
          <i class="fa fa-list toggleMenu"></i>
        </div>
      </div>-->
      <nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <!--a class="navbar-brand" href="#"><span class="logo-lg"><b><br>Acquire Social</b></span></a-->
      <a class="navbar-brand" href="#"><span class="logo"> <img src="<?=base_url()?>dist/img/logov2.png" alt="" class="img-responsive"></a>
    </div>

    
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#">Brands</a></li>
              <li><a href="#">How it Works</a></li>
              <li><a href="#">Social Influencers</a></li>
              <li><a href="#">FAQ</a></li>
              <li><a href="<?=base_url()?>login" class="btn btn-red">Login</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
    </div>
  </div>
</header><!-- End Header -->

<!-- Start Hero -->
<section id="hero">
  <div id="gradient"></div>
  <div class="container">
    <div class="row">
      <div class="hero-text">
        <div class="col-md-6">
          <h3 class="title">Social Media Monetization Marketplace</h3>
          <p class="lead">
          A revolutionary and premium social media monetization marketplace where celebrities, public figures, and influencers connects with brands and earns the highest RPMs.
          </p>
        </div>
      </div>
      <div class="col-md-4 col-md-offset-1">
        <div class="hero-form">
            
            
              <a href="<?=base_url()?>register">
              <button type="button" class="btn   btn-success btn-sm">Sign up!</button>
              </a>
              <p> -OR Sign up as - </p>
              <a href="<?=base_url()?>register/publisher">
              <button type="button" class="btn   btn-success btn-sm">Publisher!</button>
              </a>
            <!--
         <?php// echo form_open('register'); ?>
          <input type="hidden" name="pagelinks" value="<?=(isset($pagelinks)) ? $pagelinks : set_value('pagelinks')?>"/>
          <input type="hidden" name="facebook_token" value="<?=(isset($facebook_token)) ? $facebook_token : set_value('facebook_token')?>"/>
          <div class="form-group has-feedback">
            <input type="email" name="email"  value="<?=(isset($email)) ? $email : set_value('email')?>"
                   class="form-control" placeholder="Email">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
            <div class="form-group has-feedback">
            <input type="text" name="fullname" value="<?=(isset($fullname)) ? $fullname : set_value('fullname')?>"
                   class="form-control" placeholder="Name" required>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
       
          <div class="form-group has-feedback">
            <input type="password" name="password" class="form-control" placeholder="Password">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" name="passconf" class="form-control" placeholder="Retype password">
            <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
          </div>
          <div class="row">
            
            </div>
            <div class="col-xs-5 col-xs-offset-7 ">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
            </div>
            
          
          
        </form>
		<div class="social-auth-links text-center">
          <p>- OR -</p>
          <a href="<?php echo $this->facebook->get_facebook_url('/register/logincallback'); ?>" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign up using Facebook</a>
          <a href="<?php echo base_url() . 'register/loginbyreddit/'; ?>" class="btn btn-block bg-red btn-flat"><i class="fa"></i> Sign up using Reddit</a>
          <a href="<?php echo base_url() . 'register/loginbytwitter/'; ?>" class="btn btn-block bg-info btn-flat"><i class="fa"></i> Sign up using Twitter</a>
          <a href="register/publisher" class="btn btn-block bg-purple btn-flat">Sign up as a Publisher</a>
        </div>
        -->
		</div>
        
        </div>
      </div>
    </div>
  </div>
</section>
<!-- End Hero -->

<!-- Start Tour -->
<section id="brands">
<section id="tour">
  
  <div class="part first-part">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <div class="preamble text-left">
            <h3>Connect Your Audience With Premium Marketplace</h3>
            <p class="lead">Connecting your social audience with brands is not always an easy task, especially when you don't know how your audience will react to certain brands.</p>
          </div>
          <p>At Radiumatic, we're trying to evolve digital advertising industry by connecting social media celebrities, artists, public figures, and other large influencers with the highest paying brands. Use your trust and engage your social followers to maximazine your earnings.</p>       
        </div>
        <div class="col-md-6">
          <img src="<?=base_url()?>dist/img/connect-social-media.png" alt="" class="img-responsive">
        </div>
      </div>
    </div>
  </div>
  <div class="part second-part gray-bg">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <img src="<?=base_url()?>dist/img/viral.png" alt="" class="img-responsive">
        </div>
        <div class="col-md-6">
          <div class="preamble text-left">
            <h3>Most Viral &amp; Engaging Content</h3>
            <p class="lead">The key to success in digital advertising is to discover the right content that your audience will engage with and appreciates in terms of revenue. Radiumatic creative team is constantly working with brands to craft original, custom content.</p>
          </div>
          <div class="quotes">
            <div class="quote-single">
              <blockquote>
            “Establishing an online presence has multiple benefits, from the initial creation of viral content, it's ongoing dissemination, as well as its ultimate monetization.”
                <div class="clearfix"></div>
                <h5>Ken Poirot</h5>
              </blockquote>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</section>
<!-- End Tour -->

<!-- Start About -->
<section id="how-it-works">
<section id="about">
  <div class="container">
    <div class="row">
    <div class="col-md-8 col-md-offset-2 preamble viral-engage-heading">
            <h3>HOW IT WORKS?</h3>
      </div>
      <div class="col-md-4 person">
      <div class="icon-box icon-horizontal icon-lg">
               <a href="http://radiumatic.com/#"> <div data-wow-delay=".5s" class="icon-content img-circle wow bounceInUp animated" style="visibility: visible; animation-delay: 0.5s; animation-name: bounceInUp;"><i style="margin-top: 70px;" class="fa fa-user-plus"></i></div></a>
                <div class="icon-box-content">
                    <p class="how-it-works">Signup at Radiumatic and join the premium marketplace of content distribution</p> 
                  </div>
              </div>

      </div>
      <div class="col-md-4 person">
      <div class="icon-box icon-horizontal icon-lg">
                <div data-wow-delay=".5s" class="icon-content img-circle wow bounceInUp animated" style="visibility: visible; animation-delay: 0.5s; animation-name: bounceInUp;"><i style="margin-top: 90px;" class="fa fa-link"></i></div>
                <div class="icon-box-content">
                 <p class="how-it-works"> Generate and share engaging links from our easy to navigate campaigns page</p> 
                  </div>
              </div>

      </div>
      <div class="col-md-4 person">
      <div class="icon-box icon-horizontal icon-lg">
                <div data-wow-delay=".5s" class="icon-content img-circle wow bounceInUp animated" style="visibility: visible; animation-delay: 0.5s; animation-name: bounceInUp;"><i style="margin-top: 80px;" class="fa fa-usd"></i></div>
                <div class="icon-box-content">
                  <p class="how-it-works">Earn the highest RPMs by distributing the most engaging content created by some of the industry's biggest brands</p> 
                  </div>
              </div>
      </div>
    </div>
  </div>
</section>
</section>
<!-- End About -->

<!-- Start Features -->
<section id="social-influencers">
<section id="features">
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2 preamble publisher-site">
        <h3>Our Publishers Have Earned Over $100,000,00 Using</h3>
      </div>
      <div class="col-md-6 feature">
        <div class="feature-icon">
          <i style="font-size:7em; margin-left: 10px;" class="fa fa-mobile fa-4x"></i>
        </div>
        <div class="feature-content">
          <h4>Dedicated Tools For Publishers</h4>
          <p>While developing Radiumatic our main goal was to focus on publishers and brands needs. Therefore, the Radiumatic team has built powerful dedicated tools for publishers and advertisers, while keeping them easy and simple to use. </p>
        </div>
      </div>
      <div class="col-md-6 feature">
        <div class="feature-icon">
          <i class="fa fa-comments-o fa-4x"></i>
        </div>
        <div class="feature-content">
          <h4>Personal Assistance</h4>
          <p>Radiumatic creative and support team are determined to help publishers and advertiser 24x7 by responding to the questions, suggesting the ways to maximize earnings, and helping publishers on how to use our services. </p>
        </div>
      </div>
      <div class="col-md-6 feature">
        <div class="feature-icon">
          <i class="fa fa-credit-card fa-4x"></i>
        </div>
        <div class="feature-content">
          <h4>Payments</h4>
          <p>At Radiumatic, we've created a very diversifying payment system. You can use our self withdrawal method or be a part of our scheldued payments using PayPal and Wire Transfer. We are determined to bring many more payment methods in future. </p>
        </div>
      </div>
      <div class="col-md-6 feature">
        <div class="feature-icon">
          <i class="fa fa-list-alt fa-4x"></i>
        </div>
        <div class="feature-content">
          <h4>Higher Engaged Content</h4>
          <p>Discover and share the most viral and high engaging content using our lucrative campaigns. Our creative, video, and viral content teams work with brands to craft original, custom content.

</p>
        </div>
      </div>
    </div>
  </div>
</section>
</section>
<!-- End Features -->

<!-- Start FAQ -->
<section id="faq">
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2 preamble">
        <h3>FAQ</h3>
        <p class="lead">Learn more about the most frequently asked questions by our publishers.</p>
      </div>
      <div class="col-md-6">
        <div class="question">
          <i class="fa fa-comment"></i><h4 class="title">What is Radiumatic?</h4>
          <p>Radiumatic is a premium marketplace to monetize your social media followers/audience. It simplifies the process of monezating your social audience by distributing the best content that suits your audience.</p>
        </div>
        <div class="question">
          <i class="fa fa-comment"></i><h4 class="title">How do I signup for an account?</h4>
          <p>Becoming a publisher is easy and simple. Just go to our <a href="http://radiumatic.com/login/register" target="_blank" class="faq-link"> registration</a> page, and verify your account information including who you are and how would you like to get paid.</p>
        </div>
        <div class="question">
         <i class="fa fa-comment"></i><h4 class="title">How and when do I get paid?</h4>     
          <p>All payments at Radiumatic are instant and scheduled. A publisher can withdraw up to $500.00 in a given calendar month using self withdrawal. Scheduled Payments are processed when your earnings exceeds $500.00 USD (five hundred united states dollars) in NET 7 days i.e. after the last day of the given calendar month which excludes bank holidays.</p>
        </div>
      </div>
      <div class="col-md-6">
        <div class="question">
        <i class="fa fa-comment"></i><h4 class="title">What are the minimum thresholds</h4>
          <p>The minimum payment threshold for PayPal is $50.00 USD, and for wire transfers it's $500.00 USD.</p>
        </div>
        <div class="question">
          <i class="fa fa-comment"></i><h4 class="title">What are the payment methods?</h4>
          <p>There are currently two payment options as of now: PayPal, and Wire Transfer.</p>
        </div>
        <div class="question">
          <i class="fa fa-comment"></i><h4 class="title">What is Radiumatic’s pricing model?</h4>
          <p>Radiumatic is a CPC (cost-per-click) platform.</p>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- End FAQ -->

<!-- Start Footer -->
<footer id="footer">
  <div class="container">
    <div class="row">
      <div class="col">
        <h2>About Us</h2>
        <ul class="navi list-inline">
         <li><a href="#">Terms of Services</a></li>
          <li><a href="#">Privacy Policy</a></li>
          <li><a href="#">Payment Agreement</a></li>
          <li><a href="#">Help Center</a></li>
        </ul>
		</div>
		<div class="col">
		  <h2>Publishers</h2>
        <ul class="navi list-inline">
          <li><a href="#">Terms of Services</a></li>
          <li><a href="#">Privacy Policy</a></li>
          <li><a href="#">Payment Agreement</a></li>
          <li><a href="#">Help Center</a></li>
        </ul>
		</div>
		<div class="col">
		  <h2>featured on</h2>
        <ul class="navi list-inline">
          <li><a href="#">Terms of Services</a></li>
          <li><a href="#">Privacy Policy</a></li>
          <li><a href="#">Payment Agreement</a></li>
          <li><a href="#">Help Center</a></li>
        </ul>
		</div>

      <div class="col-last">
        <h2><i class="fa fa-facebook"></i> <i class="fa fa-twitter"></i></h2>
        <ul class="navi list-inline">
          <li><a href="#">Terms of Services</a></li>
          <li><a href="#">Privacy Policy</a></li>
          <li><a href="#">Payment Agreement</a></li>
          <li><a href="#">Help Center</a></li>
        </ul>
		</div>


      <div class="col-md-12">
        <br><br><p>Copyright © 2016 Aquire.Social. All rights reserved.</p>
      </div>
    </div>
  </div>
</footer>
<!-- End Footer -->


<!-- Scripts -->
<script src="<?=base_url()?>dist/js/jquery-2.1.4.min.js"></script>
<script src="<?=base_url()?>dist/js/scripts.js"></script>
<script src="<?=base_url()?>dist/js/owl.carousel.min.js"></script>
<script src="<?=base_url()?>dist/js/jquery.easing.min.js"></script>
<script src="<?=base_url()?>dist/js/jquery.ba-outside-events.min.js"></script>
<script src="<?=base_url()?>dist/js/jquery.ui.min.js"></script>
<script src="<?=base_url()?>dist/js/bootstrap.min.js"></script>


</body></html>