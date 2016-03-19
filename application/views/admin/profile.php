

      <?php 
      $this->breadcrumbs->push('<i class="fa fa-dashboard"></i>Home', 'influencer');
            $this->breadcrumbs->push('Profile', 'influencer/profile');
            $_POST['breadcrumb']= $this->breadcrumbs->show();
            ?> 
       

          <div class="row">
            <div class="col-md-3">

              <!-- Profile Image -->
              
<?php foreach($profile as $inf){?>
              <!-- About Me Box -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">About Me</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <strong><i class="fa fa-envelope margin-r-5"></i>Email address</strong>
                  <p>
                    <?=$inf["email"]?>
                    
                  </p>
                  

                  <hr>

                  <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>
                  <p class="text-muted"><?=$inf["country"]?>,<?=$inf["city"]?></p>

                  <hr>

                  <strong><i class="fa fa-phone margin-r-5"></i>Contact Number</strong>
                  <p>
                    <?=$inf["contact"]?>
                    
                  </p>

                  <hr>

                 
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
            <div class="col-md-9">
              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  
                 
                  <li class="active" ><a href="#settings" data-toggle="tab">Settings</a></li>
                </ul>
                
                 <?=isset($error)?$error : ''; 
                                if(validation_errors()){?>
                                <div class="callout callout-danger" >   
                                <?php echo validation_errors(); ?>
                                </div>
                                <?php } ?>
                <div class="tab-content">
                 

                  <div class="tab-pane active" id="settings">
                    <form action="submitprofile" class="form-horizontal" method="post">
                        
                        <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" name="email" placeholder="email@xyz.com" value="<?=$inf["email"]?>">
                          <p> Will be used for logins </p>
                        </div>
                      </div>  
                        
                      <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-10">
                          <input type="Name" class="form-control" name="name" placeholder="Name" value="<?=$inf["name"]?>">
                        </div>
                      </div>
                    
                      <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Country</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="country" value="<?=$inf["country"]?>">
                        </div>
                      </div>
                       <div class="form-group">
                        <label for="City" class="col-sm-2 control-label">City</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="city" placeholder="City" value="<?=$inf["city"]?>">
                         
                        </div>
                      </div>
                        <p> To change password </p>
                       <div class="form-group">
                          
                        <label for="password" class="col-sm-2 control-label">Password</label>
                        <div class="col-sm-10">
                          <input type="password" class="form-control" name="password" placeholder="password">
                        </div>
                      </div>
                  <div class="form-group">
                        <label for="passconf" class="col-sm-2 control-label">Retype Password</label>
                        <div class="col-sm-10">
                          <input type="password" class="form-control" name="passconf" placeholder="password">
                        </div>
                      </div>      
                      
                       
                     
                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <button type="submit" class="btn btn-danger">Submit</button>
                        <?php }  ?>
                        </div>
                      </div>
                    </form>
                  </div><!-- /.tab-pane -->
                </div><!-- /.tab-content -->
              </div><!-- /.nav-tabs-custom -->
            </div><!-- /.col -->
          </div><!-- /.row -->

       
      <script>
      $( document ).ready(function() {
        <?php if ($this->session->flashdata('message')){
          echo 'alert("' . $this->session->flashdata('message') . '");';
        }?>
      });
    </script>
     
