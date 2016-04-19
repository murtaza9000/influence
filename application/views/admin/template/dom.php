
<?php if($all=='no')
        {   $this->breadcrumbs->push('<i class="fa fa-dashboard"></i>Home', 'admin');
            $this->breadcrumbs->push('Publishers List', 'admin/pub');
            $this->breadcrumbs->push('Publisher\'s Domains', 'admin/dom/no/'.$publisher[0]['id']);
            if(isset($editmode))
             $this->breadcrumbs->push('Edit', 'admin/domainedit');
           $_POST['breadcrumb']= $this->breadcrumbs->show();
             
        }
       else
        {
            $this->breadcrumbs->push('Domains List', 'admin/dom/all');
             if(isset($editmode))
             $this->breadcrumbs->push('Edit', 'admin/domainedit');
             $_POST['breadcrumb']= $this->breadcrumbs->show();
        }
   ?>     

 <?php         
if(validation_errors()) { ?>
           
           
            <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-ban"></i> Error!</h4>
                    <?php echo validation_errors(); ?>
              </div>

<?php } if ($all=='all')
                    { ?>



<div class="row">
     <div class="col-md-12"> 
<?php if (!(isset($editmode))) 
          {
    
            echo form_open('admin/domainformsubit/add');

                echo form_label("Url: ","url");
                echo form_input("url","","class = form-control required");

                echo form_label("Non-Premium Rate: ","click_rate");
                // echo form_input("click_rate","","class = form-control required");
                ?>
              
                <!--input type="hidden" name="publisher_id" value="<?php echo (isset($domain[0])) ? $domain[0]['publisher_id'] : '' ;?>" class = "form-control required"  /-->
                <input type="number" step="any" name="click_rate" value="$" class = "form-control required" />
                
                     <?php echo form_label("Publisher: ","Publisher");?>      
                   <select class="form-control" name="publisher_id">     
                         <?php 
                  
                    foreach($publisher as $pub)
                        { 
                        echo '<option value="'.$pub['id'].'">'.$pub['name'].'</option>';
                    
                        }
                    ?>
                </select>
                <?php echo form_label("Priority: ","Priority");?>
                    <input type="number" name="priority" value="<?php echo (isset($domain[0])) ? $domain[0]['priority'] : '' ;?>" class = "form-control required"/>
            
                        <?php         echo form_label("Premium Rate: ","click_ratepre");?>
                <input type="number" step="any" name="click_ratepre" value="0"
                class = "form-control required" />
                <input type="hidden" name="all" value="all" />
                 <br>

                <button type="submit" class="btn btn-danger" onsubmit="return validateForm()">Add domain Link</button>
            </form>
             <br>
 <?php     }
 else { 
        
        echo form_open('admin/domainformsubit/edit');

                echo form_label("Url: ","url");
                echo form_input("url",$editdomain[0]['url'],"class = form-control required");

                echo form_label("Non-Premium Rate ","click_rate");
                // echo form_input("click_rate","","class = form-control required");
                ?>      
                <input type="hidden" name="id" value="<?php echo $editdomain[0]['id'];?>" />
                <input type="hidden" name="publisher_id" value="<?php echo $editdomain[0]['publisher_id'];?>" />
                <input type="number" step="any" name="click_rate" value="<?php echo $editdomain[0]['click_rate'];?>"
                class = "form-control required" />

                <label for="Publisher">Publisher: </label>
                <input type="noinput" name="publisher_name" value="<?php echo $publisher[0]['name'];?>" readonly="readonly" class = "form-control"/>
                <input type="hidden" name="all" value="all" />
                <br>
                <?php echo form_label("Priority: ","Priority");?>
                <input type="number"  name="priority" value="<?php echo $editdomain[0]['priority'];?>" class = "form-control required" />
               
                        <?php         echo form_label("Premium Rate: ","click_ratepre");?>
                <input type="number" step="any" name="click_ratepre" value="<?php echo $editdomain[0]['click_ratepre'];?>"
                class = "form-control required" />
                 <br>
                <button type="submit" class="btn btn-danger" onsubmit="return validateForm()">Edit domain Link</button>
                 <br>
                  <br>
                <a href="<?php echo site_url('admin/dom/all');?>" >
                
                <button type="button" class="btn btn-danger">Cancel</button>
                </a>
        </form>
         <br>
</div>
</div>
<?php } ?>
    <div class="row">
        <div class="col-md-12"> 
          <div class="box">
          
            <!-- /.box-header -->
            <div class="box-body">
              <table id="domain" class="table table-bordered table-hover dataTable">
                <thead><tr>
                  <th>ID</th>
                  <th>Link</th>
                  <th>Priority</th>
                  <th>Non-Premium Rate</th>
                  <th>Premium Rate</th>
                  <th>Delete</th>
                  <th>Edit</th>
                </tr></thead>
                
                    
<?php $index = 1;
      
       
foreach ($domain as $dom){?>
<tr>
<?php echo "<td>".$index."</td>"; 
      echo "<td>".$dom['url']."</td>" ;
      echo "<td>".$dom['priority']."</td>"; 
      echo "<td>".$dom['click_rate']."</td>";
      echo "<td>".$dom['click_ratepre']."</td>"; ?>


                      <td>
                       <a href="<?php echo site_url('admin/deldomain/all/'.$dom['id']);?>" onclick="return confirm('Are you sure?');">
                      <button type="button" class="btn btn-danger btn-xs">Delete</button>
                      </td>
                      
                      <td>
                       <a href="<?php echo site_url('admin/domainedit/all/'.$dom['id'].'/'.$dom['publisher_id']."/e");?>" >
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
    
  


<?php }else {
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// ?>

    
<div class="row">
     <div class="col-md-12"> 

<?php if (!(isset($editmode))) 
        {
           
        echo form_open('admin/domainformsubit/add');

            echo form_label("Url: ","url");
            echo form_input("url","","class = form-control required");

            echo form_label("Non-Premium Rate ","click_rate");

            // echo form_input("click_rate","","class = form-control required");
            ?>
          
          
          
            <input type="number" step="any" name="click_rate" value="0" class = "form-control required" />
            <?php echo form_label("Publisher: ","Publisher");?>
            <select class="form-control" name="publisher_id">
                    <?php 
                    $index = 0;
                    foreach($publisher as $pub)
                        { 
                        echo '<option value="'.$pub['id'].'">'.$pub['name'].'</option>';
                        $index++;
                        }
                    ?>
            </select>

            <?php echo form_label("Priority: ","Priority");?>
             <input type="number" name="priority" value="<?php echo (isset($domain[0])) ? $domain[0]['priority'] : '' ;?>" class = "form-control required"  />
            
            <input type="hidden" name="all" value="no" />

             <?php         echo form_label("Premium Rate: ","click_ratepre");?>
        <input type="number" step="any" name="click_ratepre" value="0"
        class = "form-control required" />
         <br>
            <button type="submit" class="btn btn-danger" onsubmit="return validateForm()">Add domain Link</button>
        </form>
         <br>
 <?php }else { 
        
             echo form_open('admin/domainformsubit/edit');

       echo form_label("Url: ","url");
       echo form_input("url",$editdomain[0]['url'],"class = form-control required");
       
       echo form_label("Non-Premium Rate: ","click_rate");
        // echo form_input("click_rate","","class = form-control required");
?>      
        <input type="hidden" name="id" value="<?php echo $editdomain[0]['id'];?>" />
        <input type="hidden" name="publisher_id" value="<?php echo $editdomain[0]['publisher_id'];?>" />
        <input type="hidden" name="all" value="no" />
       <input type="number" step="any" name="click_rate" value="<?php echo $editdomain[0]['click_rate'];?>"
        class = "form-control required" />
  <label for="Publisher">Publisher: </label>
        <input type="noinput" name="id" value="<?php echo $publisher[0]['name'];?>" readonly="readonly" class = "form-control"/>
        <br>
          <?php echo form_label("Priority: ","Priority");?>
           <input type="number"  name="priority" value="<?php echo $editdomain[0]['priority'];?>" class = "form-control required" />
             <?php         echo form_label("Premium Rate: ","click_ratepre");?>
        <input type="number" step="any" name="click_ratepre" value="<?php echo $editdomain[0]['click_ratepre'];?>"
        class = "form-control required" />
       <br>
 <button type="submit" class="btn btn-danger" onsubmit="return validateForm()">Edit domain Link</button>
  <br> <br>
 <a href="<?php echo base_url();?>admin/dom/no/<?php echo $editdomain[0]['publisher_id']?>" >

 <button type="button" class="btn btn-danger">Cancel</button>
 </a>
 </form>
  <br>
</div>
</div>
<?php } ?>
 <div class="row">
        <div class="col-md-12"> 
          <div class="box">
            
          
            <div class="box-body ">
             <table id="domain" class="table table-bordered table-hover dataTable">
                <thead><tr>
                  <th>ID</th>
                  <th>Link</th>
                  <th>Priority</th>
                  <th>Non-Premium Rate</th>
                  <th>Premium Rate</th>
                  <th>Delete</th>
                  <th>Edit</th>
                </tr></thead>
                
                    
<?php $index = 1;
foreach ($domain as $dom){?>
<tr>
<?php echo "<td>".$index."</td>"; 
      echo "<td>".$dom['url']."</td>" ;
      echo "<td>".$dom['priority']."</td>"; 
      echo "<td>".$dom['click_rate']."</td>";
      echo "<td>".$dom['click_ratepre']."</td>";?> 
      
      
                      <td>
                       <a href="<?php echo site_url('admin/deldomain/no/'.$dom['id'].'/'.$dom['publisher_id']);?>" onclick="return confirm('Are you sure?');">
                      <button type="button" class="btn btn-danger btn-xs">Delete</button>
                      </td>
                      
                      <td>
                       <a href="<?php echo site_url('admin/domainedit/no/'.$dom['id'].'/'.$dom['publisher_id']);?>" >
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
    
    
<?php       } ?>




