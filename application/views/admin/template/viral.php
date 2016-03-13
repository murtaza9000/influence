<?php   $this->breadcrumbs->push('<i class="fa fa-dashboard"></i>Home', 'admin');
        $this->breadcrumbs->push('Viral Lists', 'admin/viral');
        if (isset($editmode))
             $this->breadcrumbs->push('Edit Link', 'admin/edit');        
         $_POST['breadcrumb']= $this->breadcrumbs->show();
?>



<div class="row">
     <div class="col-md-12"> 
<?php if (!(isset($editmode))) {
    
       echo form_open('admin/addviral');

       echo form_label("Url: ","url");
       echo form_input("url","","class = form-control required");
       
       echo form_label("Click Rate: ","click_rate");
        // echo form_input("click_rate","","class = form-control required");
?>
       <input type="number" step="any" name="click_rate" value="$" class = "form-control required" />
       <?php         echo form_label("Click Rate(Premium-rate): ","click_ratepre");?>
        <input type="number" step="any" name="click_ratepre" value="0"
        class = "form-control required" />
     
       

 <button type="submit" class="btn btn-primary" onsubmit="return validateForm()">Add Viral Link</button>
 </form>
 <?php }else { 
        
             echo form_open('admin/editviral');

       echo form_label("Url: ","url");
       echo form_input("url",$editviral[0]['url'],"class = form-control required");
       
       echo form_label("Click Rate: ","click_rate");
        // echo form_input("click_rate","","class = form-control required");
?>      
        <input type="hidden" name="id" value="<?php echo $editviral[0]['id'];?>" />
       <input type="number" step="any" name="click_rate" value="<?php echo $editviral[0]['click_rate'];?>"
        class = "form-control required" />
<?php         echo form_label("Click Rate(Premium-rate): ","click_ratepre");?>
        <input type="number" step="any" name="click_ratepre" value="<?php echo $editviral[0]['click_ratepre'];?>"
        class = "form-control required" />
     
       

 <button type="submit" class="btn btn-primary" onsubmit="return validateForm()">Edit Viral Link</button>
 <a href="<?php echo site_url('admin/viral');?>" >
 <button type="button" class="btn btn-danger">Cancel</button>
 </a>
 </form>

<?php } ?>
</div>
</div>
  <div class="row">
        <div class="col-md-12"> 
          <div class="box">
            
            
            <!-- /.box-header -->
            <div class="box-body ">
              <table id="viral" class="table table-bordered table-hover dataTable">
                <thead><tr>
                  <th>ID</th>
                  <th>Link</th>
                  <th>Click Rate</th>
                  <th>Click Rate(Premium)</th>
                  <th>Delete</th>
                  <th>Edit</th>
                </tr></thead>
                
                    
<?php $index = 1;
foreach ($viral as $vir){?>
<tr>
<?php echo "<td>".$index."</td>"; 
      echo "<td>".$vir['url']."</td>" ;
      echo "<td>".$vir['click_rate']."</td>";
      echo "<td>".$vir['click_ratepre']."</td>"; ?>

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



</div>
       </div>




