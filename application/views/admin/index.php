
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Acquire Social</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?=base_url()?>bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?=base_url()?>dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect.
    -->
    <link rel="stylesheet" href="<?=base_url()?>dist/css/skins/skin-purple.min.css">
    <link rel="stylesheet" href="<?=base_url()?>dist/css/skins/skin-red.min.css">
    <link rel="stylesheet" href="<?=base_url()?>plugins/datatables/dataTables.bootstrap.css">
 
        <!-- daterange picker -->
    <link rel="stylesheet" href="<?=base_url()?>plugins/daterangepicker/daterangepicker-bs3.css">

    <!-- Bootstrap time Picker -->
    <link rel="stylesheet" href="<?=base_url()?>plugins/timepicker/bootstrap-timepicker.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="<?=base_url()?>plugins/select2/select2.min.css">
    <!-- Select2 -->


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
  <body class="hold-transition skin-red sidebar-mini">
      <?php require_once APPPATH. '/libraries/analyticstracking.php'; ?>
    <div class="wrapper">

      <!-- Main Header -->
      <header class="main-header">

        <!-- Logo -->
       <a href='<?= base_url() ?>admin/index' class="logo" >
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini">AS</span>
          <!-- logo for regular state and mobile devices -->
         <span class="logo-lg"><img src="<?=base_url()?>dist/img/logov2.png" alt="" class="img-responsive" style="
    margin-top: 5px;
"></span>
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
                  <span class="label label-warning"><?=is_null($notification_links) ? '0' : $notification_links ?></span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">You have <?=is_null($notification_links) ? '0' : $notification_links ?> notifications</li>
                  <li>
                    <!-- Inner Menu: contains the notifications -->
                     <?php  if (!(is_null($notification_links))) { ?>
                                <ul class="menu">
                                    <li><!-- start notification -->
                                    
                                        <a href="<?= base_url(); ?>admin/inf">
                                            <i class="fa fa-users text-aqua"></i><?=$notification_links?> more Users are added
                                        </a>
                      </li><!-- end notification -->
                    </ul>
                     <?php } ?>
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
              <!-- Notifications Menu -->
             
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
                      <a href="<?=base_url();?>admin/profile" class='btn btn-default'>Profile</a>
                    </div>
                     <div class="pull-right">
                     
                      <a href="<?=base_url();?>registeradmin/out" class="btn btn-default btn-flat">Sign out</a>
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

          <!-- Sidebar user panel (optional) -->
       
          <!-- search form (Optional) -->
           <form action="<?php echo (basename(current_url()) == 'influencer') ? 'index' : basename(current_url()) ;?>" method="post" class="sidebar-form">
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
            <li class="header">Main Menu</li>
            <!-- Optionally, you can add icons to the links -->
            <li  <?php echo ($active == 'inf') ? 'class="active"' : '' ;?>><a href="<?php echo base_url();?>admin/inf"><i class="fa fa-link"></i> <span>List of Influencer</span></a></li>
            <!--li   <?php //echo ($active == 'pub' || $active == 'dom') ? 'class="active"' : '' ;?>><a href="<?php echo base_url();?>admin/pub"><i class="fa fa-link"></i> <span>List of Publisher</span></a></li-->
            <li   <?php echo ($active == 'viral') ? 'class="active"' : '' ;?>><a href="<?php echo base_url();?>admin/viral"><i class="fa fa-link"></i> <span>List of Viral Links</span></a></li>
            <li <?php echo ($active == 'pub' || $active == 'dom') ? 'class="treeview active"' : 'class="treeview"' ;?>>
              <a href="#"><i class="fa fa-link"></i> <span>Publisher</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li <?php echo ($active == 'pub') ? 'class="active"' : '' ;?>><a href="<?php echo base_url();?>admin/pub">List of Publisher</a></li>
                <li <?php echo ($active == 'dom') ? 'class="active"' : '' ;?>><a href="<?php echo base_url();?>admin/dom/all">List of Domains</a></li>
               
              </ul>
               <li   <?php echo ($active == 'checkout') ? 'class="active"' : '' ;?>><a href="<?php echo base_url();?>admin/checkout"><i class="fa fa-link"></i> <span>Payment Log</span></a></li>
                <li   <?php echo ($active == 'earning_history') ? 'class="active"' : '' ;?>><a href="<?php echo base_url();?>admin/earning_history"><i class="fa fa-link"></i> <span>Earning history</span></a></li>
            </li>
          </ul><!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Admin <small> Panel </small>
         
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
           Welcome to Admin Panel
           
           </h3>
           <div class ="row">
               <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

                    <div class="info-box-content">
                    <span class="info-box-text">New Members</span>
                    <span class="info-box-number"><?=is_null($notification_links) ? '0' : $notification_links ?></span>
                </div>
            <!-- /.info-box-content -->
                 </div>
          </div>
          <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="ion ion-ios-gear-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Services</span>
              <span>
                 <div style="padding-bottom: 4px;">
              <a href="<?php echo base_url();?>analyticsservice" target="blank">
                 <button type="button" class="btn btn-danger btn-block btn-sm btn-flat">Analytic</button>
                 </a>
                 </div>
               <a href="<?php echo base_url();?>influencer/rss_done" target="blank">
                 <button type="button" class="btn btn-danger btn-block btn-sm btn-flat">RSS FEED</button>
                 </a>
                 </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
          </div>
          
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
          Anything you want
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; 2015 <a href="#">Company</a>.</strong> All rights reserved.
      </footer>

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Create the tabs -->
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
          <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
          <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
          <!-- Home tab content -->
          <div class="tab-pane active" id="control-sidebar-home-tab">
            <h3 class="control-sidebar-heading">Recent Activity</h3>
            <ul class="control-sidebar-menu">
              <li>
                <a href="javascript::;">
                  <i class="menu-icon fa fa-birthday-cake bg-red"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>
                    <p>Will be 23 on April 24th</p>
                  </div>
                </a>
              </li>
            </ul><!-- /.control-sidebar-menu -->

            <h3 class="control-sidebar-heading">Tasks Progress</h3>
            <ul class="control-sidebar-menu">
              <li>
                <a href="javascript::;">
                  <h4 class="control-sidebar-subheading">
                    Custom Template Design
                    <span class="label label-danger pull-right">70%</span>
                  </h4>
                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                  </div>
                </a>
              </li>
            </ul><!-- /.control-sidebar-menu -->

          </div><!-- /.tab-pane -->
          <!-- Stats tab content -->
          <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div><!-- /.tab-pane -->
          <!-- Settings tab content -->
          <div class="tab-pane" id="control-sidebar-settings-tab">
            <form method="post">
              <h3 class="control-sidebar-heading">General Settings</h3>
              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Report panel usage
                  <input type="checkbox" class="pull-right" checked>
                </label>
                <p>
                  Some information about this general settings option
                </p>
              </div><!-- /.form-group -->
            </form>
          </div><!-- /.tab-pane -->
        </div>
      </aside><!-- /.control-sidebar -->
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->

    <!-- REQUIRED JS SCRIPTS -->

    <!-- jQuery 2.1.4 -->
        <script src="<?=base_url()?>/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script src="<?=base_url()?>/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<!-- Bootstrap 3.3.5 -->
<script src="<?=base_url()?>/bootstrap/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="<?=base_url()?>/dist/js/app.min.js"></script>
<script src="<?=base_url()?>/plugins/fastclick/fastclick.min.js"></script>
  <script src="<?=base_url()?>/plugins/timepicker/bootstrap-timepicker.min.js"></script>
<script src="<?=base_url()?>/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?=base_url()?>/plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- Select2 -->
<script src="<?=base_url()?>/plugins/select2/select2.full.min.js"></script>
<!-- InputMask -->
<script src="<?=base_url()?>/plugins/input-mask/jquery.inputmask.js"></script>
<script src="<?=base_url()?>/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="<?=base_url()?>/plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- date-range-picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
<script src="<?=base_url()?>/plugins/daterangepicker/daterangepicker.js"></script>
    <script>
      $(function () {
        $("#domain").DataTable();
         $("#viral").DataTable();
         $("#example1").DataTable();
        $('#links').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": true
        });
        
         $('#daterange-btn').daterangepicker(
            {
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                //startDate: moment().subtract(29, 'days'),
                //endDate: moment()
            },
            function (start, end) {
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                window.location = '<?=base_url().'admin/checkout/'?>'  + start.format('YYYY-MM-DD') + '/' + end.format('YYYY-MM-DD');
            }
        );
        
          $('#daterange-btnearning').daterangepicker(
            {
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                //startDate: moment().subtract(29, 'days'),
                //endDate: moment()
            },
            function (start, end) {
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                window.location = '<?=base_url().'admin/earning_history/'?>'  + start.format('YYYY-MM-DD') + '/' + end.format('YYYY-MM-DD');
            }
        );

        
        
      });
    </script>
    <script>
      $( document ).ready(function() {
        <?php if ($this->session->flashdata('message')){
          echo 'alert("' . $this->session->flashdata('message') . '");';
        }?>
      });
    </script>
    <script src="//fast.eager.io/PeeUftGO2K.js"></script>
    <!-- Optionally, you can add Slimscroll and FastClick plugins.
         Both of these plugins are recommended to enhance the
         user experience. Slimscroll is required when using the
         fixed layout. -->
  </body>
</html>
