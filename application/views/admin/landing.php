<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Acquire Social | Decide</title>
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
       <p>Acquire</b>Social</p>
      </div>

      <div class="box box-info">
          <div class="box-header with-border">
              <h3 class="box-title">Sign up as a</h3>
            </div>


         <div class="box-body">     
           
        <div class="social-auth-links text-center">
       
          <a href="register" class="btn bg-olive margin"> Influencer</a>
           <a href="register/publisher" class="btn bg-purple margin"> Publisher</a>
            <a href="login" class="btn bg-navy margin"> Or Log in</a>
        </div>
        
        <a href="login" class="text-center">I already have a membership</a>
        </div>
     
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
