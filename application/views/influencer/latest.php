<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 2 | Starter</title>
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
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect.
    -->
    <script src="<?=base_url()?>dist/clipboard.min.js"></script>
    <link rel="stylesheet" href="<?=base_url()?>/dist/css/skins/skin-purple.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <!--
  BODY TAG OPTIONS:
  =================
  Apply one or more of the following classes to get the
  desired effect
  |---------------------------------------------------------|
  | SKINS         | skin-blue                               |
  |               | skin-black                              |
  |               | skin-purple                             |
  |               | skin-yellow                             |
  |               | skin-red                                |
  |               | skin-green                              |
  |---------------------------------------------------------|
  |LAYOUT OPTIONS | fixed                                   |
  |               | layout-boxed                            |
  |               | layout-top-nav                          |
  |               | sidebar-collapse                        |
  |               | sidebar-mini                            |
  |---------------------------------------------------------|
  -->
  <body class="hold-transition skin-purple sidebar-mini">
        <?php require_once APPPATH. '/libraries/analyticstracking.php'; ?>
    <div class="wrapper">

      <!-- Main Header -->
      <header class="main-header">

        <!-- Logo -->
        <a href='influencer/index' class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini">AS</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Acquire Social</b></span>
        </a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              

              <!-- Notifications Menu -->
              <li class="dropdown notifications-menu">
                <!-- Menu toggle button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-bell-o"></i>
                  <span class="label label-warning">10</span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">You have 10 notifications</li>
                  <li>
                    <!-- Inner Menu: contains the notifications -->
                    <ul class="menu">
                      <li><!-- start notification -->
                        <a href="#">
                          <i class="fa fa-users text-aqua"></i> 5 new members joined today
                        </a>
                      </li><!-- end notification -->
                    </ul>
                  </li>
                  <li class="footer"><a href="#">View all</a></li>
                </ul>
              </li>
              <!-- Tasks Menu -->
             
              <!-- User Account Menu -->
              <li class="dropdown user user-menu">
                <!-- Menu Toggle Button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <!-- The user image in the navbar-->
                  
                  <!-- hidden-xs hides the username on small devices so only the image appears. -->
                  <span class="hidden-xs"><?=$full_name?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- The user image in the menu -->
                  <li class="user-header">
                    
                    <p>
                        <?php echo $full_name;
                        echo "<small>Member since: " ;
                        $date = date_create($timestamp);
                        echo date_format($date, 'jS F Y');
                        echo"</small>";
                        ?>
                     </p>
                  </li>
                  <!-- Menu Body -->
                 
                  <!-- Menu Footer-->
                  <li class="user-footer">
                      <div class="pull-left">
                      <a href="<?=base_url();?>influencer/profile" class='btn btn-default btn-flat'>Profile</a>
                    </div>
                     <div class="pull-right">
                     
                      <a href="<?=base_url();?>register/logout" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
              
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

        

          <!-- search form (Optional) -->
          <form action="<?php echo (basename(current_url()) == 'influencer') ? 'influencer/index' : basename(current_url()) ;?>" method="post" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="search" class="form-control" placeholder="Search...">
              <input type="hidden" name="page" value="<?=basename(current_url());?>" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit"  id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>
          <!-- /.search form -->

          <!-- Sidebar Menu -->
          <ul class="sidebar-menu">
            <li class="header">HEADER</li>
            <!-- Optionally, you can add icons to the links -->
           
           
            
         
                <li <?php echo ($active == 'inf') ? 'class="active"' : '' ;?>><a href="<?php echo base_url();?>influencer/inf"><i class="fa fa-link"></i>Latest Links</a></li>
                <li <?php echo ($active == 'viral') ? 'class="active"' : '' ;?>><a href="<?php echo base_url();?>influencer/viral"><i class="fa fa-link"></i> <span>Viral Links</span></a></li>
            
                <li  <?php echo ($active == 'contact') ? 'class="active"' : '' ;?>><a href="<?php echo base_url();?>influencer/contact"><i class="fa fa-link"></i> <span>Contact Us! </span></a></li>
                <li  <?php echo ($active == 'payment_history') ? 'class="active"' : '' ;?>><a href="<?php echo base_url();?>influencer/payment_history"><i class="fa fa-link"></i> <span>Earnings </span></a></li>
                <li  <?php echo ($active == 'checkout') ? 'class="active"' : '' ;?>><a href="<?php echo base_url();?>influencer/checkout"><i class="fa fa-link"></i> <span>Payment History </span></a></li>
           

           
            
          </ul><!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1> 
            Influencer
            <small>panel</small>
          </h1>
           <?php if (isset($_POST['breadcrumb']))
       echo  $_POST['breadcrumb'];
            else { ?>
               
               <ol class="breadcrumb">
            <li><i class="fa fa-dashboard"></i> Home</a></li>
            
          </ol>
                
        <?php    }
       ?>
        </section>

        <!-- Main content -->
        <section class="content">
            </pre>
            
          <?php if(isset($content))
        {        
             echo "<h4><strong>".$header."</strong></h4>";
                 echo $content;
                 
        } else {
    ?>
        
       <h3>
           Welcome to Influencer Panel
           
           </h3>
           
           </br>
           <p> click on menu to browse </p>
        
        
        
                <?php }
                ?>
       
      
        </br>
     
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <!-- Main Footer -->
      <footer class="main-footer">
        <!-- To the right -->
        <div class="pull-right hidden-xs">
         Acquire Social
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; 2016 </strong> All rights reserved.
      </footer>
 

    <!-- REQUIRED JS SCRIPTS -->

    <!-- jQuery 2.1.4 -->
    <script src="<?=base_url()?>/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?=base_url()?>/bootstrap/js/bootstrap.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?=base_url()?>/dist/js/app.min.js"></script>
        <script src="<?=base_url()?>/plugins/fastclick/fastclick.min.js"></script>
    <script src="//fast.eager.io/PeeUftGO2K.js"></script>

    <script>
      $( document ).ready(function() {
        <?php if ($this->session->flashdata('message')){
          echo 'alert("' . $this->session->flashdata('message') . '");';
        }?>
      });
    </script>
    <!-- Optionally, you can add Slimscroll and FastClick plugins.
         Both of these plugins are recommended to enhance the
         user experience. Slimscroll is required when using the
         fixed layout. -->
       
<script>
    
    var reachedEnd = false; /*Flag to check the end of records*/
 
/*checking the end of the document*/
$(window).scroll(function(){
  if ($(window).scrollTop() == $(document).height() - $(window).height()){
 
    /*calling the function to get the ajax data*/
    lastPostFunc();
  }
});

function lastPostFunc() {
 
  var trs = $('div#latest'); /*get the number of trs*/
  var count = trs.length; /*this will work as the offset*/
 console.log(count);
 console.log(window.location.origin);
  /*Restricting the request if the end is reached.*/
  if (reachedEnd == false) {
    $.ajax({
      url: '<?=base_url()?>' + "influencer/inf_ajax/"+count  ,
      async: false,
      dataType: "html",
      success: function(data) {
        if (data != "end")
        {
        
          $('section.content').append(data);
        }
        else{
        $('section.content').append('<div class="callout callout-warning"><p>No more links</p></div>');
          reachedEnd = true;
        }
      }
    })
    
  }
}


</script>




      <script>
      
          
       //   function K(copyit){
   //  $(copyit).button();
    //  $(copyit).unbind("click").click(function() {

    var clipboard = new Clipboard('.copyit');

    clipboard.on('success', function(e) {
        console.log(e);
       
     
    });

    clipboard.on('error', function(e) {
        console.log(e);
      
    });
                 
        
       
  //    }  
         
    </script>    

  </body>
</html>
