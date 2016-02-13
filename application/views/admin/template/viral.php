
<div class="col-xs-12">
</pre>
<?php print_R($_POST) ?>
</pre>
<?php echo base_url()."admin/index/viral/";?>

<?php if (!(isset($editmode))) {
    
       echo form_open('admin/addviral');

       echo form_label("Url: ","url");
       echo form_input("url","","class = form-control required");
       
       echo form_label("CLick Rate: ","click_rate");
        // echo form_input("click_rate","","class = form-control required");
?>
       <input type="number" step="any" name="click_rate" value="$" class = "form-control required" />
     
       

 <button type="submit" class="btn btn-primary" onsubmit="return validateForm()">Add Viral Link</button>
 </form>
 <?php }else { 
        
             echo form_open('admin/editviral');

       echo form_label("Url: ","url");
       echo form_input("url",$editviral[0]['url'],"class = form-control required");
       
       echo form_label("CLick Rate: ","click_rate");
        // echo form_input("click_rate","","class = form-control required");
?>      
        <input type="hidden" name="id" value="<?php echo $editviral[0]['id'];?>" />
       <input type="number" step="any" name="click_rate" value="<?php echo $editviral[0]['click_rate'];?>"
        class = "form-control required" />
     
       

 <button type="submit" class="btn btn-primary" onsubmit="return validateForm()">Edit Viral Link</button>
 <a href="<?php echo site_url('admin/viral');?>" >
 <button type="button" class="btn btn-danger">Cancel</button>
 </a>
 </form>

<?php } ?>
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Responsive Hover Table</h3>

              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tbody><tr>
                  <th>ID</th>
                  <th>Link</th>
                  <th>Click Rate</th>
                  <th>Delete</th>
                  <th>Edit</th>
                </tr>
                
                    
<?php $index = 1;
foreach ($viral as $vir){?>
<tr>
<?php echo "<td>".$index."</td>"; 
      echo "<td>".$vir['url']."</td>" ;
      echo "<td>".$vir['click_rate']."</td>"; ?>

                      <td>
                       <a href="<?php echo site_url('admin/delviral/'.$vir['id']);?>" onclick="return confirm('Are you sure?');">
                      <button type="button" class="btn btn-danger btn-xs">Delete</button>
                      </td>
                      
                      <td>
                       <a href="<?php echo site_url('admin/viraledit/'.$vir['id']);?>" >
                      <button type="button" class="btn btn-info btn-xs">Edit</button>
                      </td>
                      
                      
                       </tr>
<?php $index++;
} ?>  
                
            </tbody></table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>








