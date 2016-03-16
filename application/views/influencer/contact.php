

      <?php 
      $this->breadcrumbs->push('<i class="fa fa-dashboard"></i>Home', 'influencer');
            $this->breadcrumbs->push('Contaact us', 'influencer/contact');
            $_POST['breadcrumb']= $this->breadcrumbs->show();
            ?> 
       

 <div class="row">
            <!-- left column -->
            <div class="col-md-6 col-md-offset-3">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title"><?=$title?></h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" action='sendcontact' method='post'>
                  <div class="box-body">
                    <div class="form-group">
                      <label for="subject">Subject</label>
                      <input type="text" class="form-control" name="subject" placeholder="Subject">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Message</label>
                      <textarea class="form-control" rows="3" placeholder="Enter ..."></textarea>
                    </div>
                   
                    
                  </div><!-- /.box-body -->
                    <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </form>
              </div><!-- /.box -->
       
      <script>
      $( document ).ready(function() {
        <?php if ($this->session->flashdata('message')){
          echo 'alert("' . $this->session->flashdata('message') . '");';
        }?>
      });
    </script>
     
