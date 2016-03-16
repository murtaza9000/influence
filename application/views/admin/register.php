<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Registration Page as a Influencer</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?=base_url()?>/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?=base_url()?>/dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?=base_url()?>/plugins/iCheck/square/blue.css">

    <style rel="stylesheet" type="text/css">
      .register-background {
        background-image: url(<?=base_url()?>/img/registration-background.jpg);
        background-size: cover;
      }
      .logo a{
        color: white;
      }
    </style>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition register-page register-background">
    <div class="register-box">
      <div class="register-logo">
        <a href="../../index2.html"><b>Influence</b>ME</a>
      </div>

      <div class="register-box-body">
        <p class="login-box-msg">Register a new membership as a Influencer</p>

        <div class="text-red">
            <?=isset($error)?$error : ''; ?>
            <?php echo validation_errors(); ?>
        </div>

        <?php echo form_open('register'); ?>
          <input type="hidden" name="pagelinks" value="<?=(isset($pagelinks)) ? $pagelinks : set_value('pagelinks')?>"/>
          <input type="hidden" name="facebook_token" value="<?=(isset($facebook_token)) ? $facebook_token : set_value('facebook_token')?>"/>
          <div class="form-group has-feedback">
            <input type="email" name="email"  value="<?=(isset($email)) ? $email : set_value('email')?>"
                   class="form-control" placeholder="Email">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
            <div class="form-group has-feedback">
            <input type="text" name="fullname" value="<?=(isset($fullname)) ? $fullname : set_value('fullname')?>"
                   class="form-control" placeholder="Username / UTM" required>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <!-- div class="form-group has-feedback">
            <input type="text" name="displayname" value="<?=set_value('displayname')?>"
                   class="form-control" placeholder="Display Name">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="text" name="fullname" value="<?=(isset($fullname)) ? $fullname : set_value('fullname')?>"
                   class="form-control" placeholder="Full name">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="email" name="email"  value="<?=(isset($email)) ? $email : set_value('email')?>"
                   class="form-control" placeholder="Email">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
              <input type="text" name="bankacc" value="<?=set_value('bankacc')?>"
                     class="form-control" placeholder="Bank Account Number">

          </div>
          <div class="form-group has-feedback">
              <input type="text" name="country" value="<?=set_value('country')?>"
                     class="form-control" placeholder="Country">

          </div -->
          <div class="form-group has-feedback">
            <input type="password" name="password" class="form-control" placeholder="Password">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" name="passconf" class="form-control" placeholder="Retype password">
            <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-8">
              <div class="checkbox icheck">
                <label>
                  <input type="checkbox"> I agree to the <a href="#">terms</a>
                </label>
              </div>
            </div><!-- /.col -->
            <div class="col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
            </div><!-- /.col -->
          </div>
        </form>

        <div class="social-auth-links text-center">
          <p>- OR -</p>
          <a href="<?=$facebook?>" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign up using Facebook</a>
          <a href="<?php echo base_url() . 'register/loginbyreddit/'; ?>" class="btn btn-block bg-red btn-flat"><i class="fa"></i> Sign up using Reddit</a>
          <a href="<?php echo base_url() . 'register/loginbytwitter/'; ?>" class="btn btn-block bg-info btn-flat"><i class="fa"></i> Sign up using Twitter</a>
          <a href="register/publisher" class="btn btn-block bg-purple btn-flat">Sign up as a Publisher</a>
        </div>

        <a href="login" class="text-center">I already have a membership</a>
      </div><!-- /.form-box -->
    </div><!-- /.register-box -->

    <!-- jQuery 2.1.4 -->
    <script src="<?=base_url()?>/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?=base_url()?>/bootstrap/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="<?=base_url()?>/plugins/iCheck/icheck.min.js"></script>
    <script src="//fast.eager.io/PeeUftGO2K.js"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
  </body>
</html>
