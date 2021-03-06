<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Signupfor Publisher</title>
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
        <a href=#><b>Publisher</a>
      </div>

      <div class="register-box-body">
        <p class="login-box-msg">Register as a Publisher</p>

        <div class="text-red">
            <?=isset($error)?$error : ''; ?>
            <?php echo validation_errors(); ?>
        </div>

        <?php echo form_open('register/publisher'); ?>
        
          <div class="form-group has-feedback">
            <input type="email" name="email"  value="<?=(isset($email)) ? $email : set_value('email')?>"
                   class="form-control" placeholder="Email">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
            <div class="form-group has-feedback">
            <input type="text" name="fullname" value="<?=(isset($fullname)) ? $fullname : set_value('fullname')?>"
                   class="form-control" placeholder="Full name">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="text" name="country" value="<?=(isset($country)) ? $country : set_value('country')?>"
                   class="form-control required" placeholder="Country">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="text" name="city" value="<?=(isset($city)) ? $city : set_value('city')?>"
                   class="form-control required" placeholder="City">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="text" name="phone" value="<?=(isset($phone)) ? $phone : set_value('phone')?>"
                   class="form-control" placeholder="Phone Number">
            <span class="glyphicon glyphicon-phone form-control-feedback"></span>
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
           <a href="<?=base_url()?>register" class="btn bg-olive margin">Register as a Influencer</a>
          
        </div>

      
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
    <script>
      $( document ).ready(function() {
        <?php if ($this->session->flashdata('message')){
          echo 'alert("' . $this->session->flashdata('message') . '");';
        }?>
      });
    </script>
  </body>
</html>
