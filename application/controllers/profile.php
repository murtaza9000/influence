

      <?php 
      $this->breadcrumbs->push('<i class="fa fa-dashboard"></i>Home', 'admin');
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
                
                    
                    
                  <strong><i class="fa fa-book margin-r-5"></i>  Experience</strong>
                  <p class="text-muted">
                   <?=$inf["experience"]?>
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

                  <strong><i class="fa fa-file-text-o margin-r-5"></i> Account Number</strong>
                  <p><?=$inf["account_no"]?></p>
                  </br>
                  <strong> Payment Status</strong>
                  <p><?=$inf["payment"]?></p>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
            <div class="col-md-9">
              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  
                 
                  <li class="active" ><a href="#settings" data-toggle="tab">Settings</a></li>
                </ul>
                <div class="tab-content">
                 

                  <div class="tab-pane active" id="settings">
                    <form action="submitprofile" class="form-horizontal" method="post">
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
                      <div class="form-group">
                        <label for="inputExperience" class="col-sm-2 control-label">Experience</label>
                        <div class="col-sm-10">
                          <textarea class="form-control" name="experience" placeholder="Experience"  value="<?=$inf["experience"]?>"><?=$inf["experience"]?></textarea>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="Phone" class="col-sm-2 control-label">Contact Number</label>
                        <div class="col-sm-10">
                          <input type="tel" class="form-control" name="phone" placeholder="Contact Number" value="<?=$inf["contact"]?>">
                        </div>
                      </div>
                       <div class="form-group">
                        <label for="Account" class="col-sm-2 control-label">Account Number</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="account_no"  value="<?=$inf["account_no"]?>">
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
     
