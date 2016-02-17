
<?php if(validation_errors()) { ?>
            <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-ban"></i> Error!</h4>
                    <?php echo validation_errors(); ?>
              </div>

<?php } if ($all=='all')
                    { ?>

<div class="col-xs-12">


<?php if (!(isset($editmode))) 
          {
    
            echo form_open('admin/domainformsubit/add');

                echo form_label("Url: ","url");
                echo form_input("url","","class = form-control required");

                echo form_label("CLick Rate: ","click_rate");
                // echo form_input("click_rate","","class = form-control required");
                ?>

                <input type="hidden" name="publisher_id" value="<?php echo $domain[0]['publisher_id'];?>" />
                <input type="number" step="any" name="click_rate" value="$" class = "form-control required" />
                <?php echo form_label("Publisher: ","Publisher");?>
                <select class="form-control" name="publisher_id">
                 <?php 
                  $index = 0;
                        foreach($publisher as $pub)
                        { 
                        echo '<option value="'.$domain[$index]['publisher_id'].'">'.$pub['name'].'</option>';
                        $index++;
                        }
                        ?>
                </select>
                <?php echo form_label("Priority: ","Priority");?>
                <input type="number"  name="priority" value="<?php echo $domain[0]['priority'];?>" class = "form-control required" />

                <input type="hidden" name="all" value="all" />


                <button type="submit" class="btn btn-primary" onsubmit="return validateForm()">Add domain Link</button>
            </form>
 <?php     }
 else { 
        
        echo form_open('admin/domainformsubit/edit');

                echo form_label("Url: ","url");
                echo form_input("url",$editdomain[0]['url'],"class = form-control required");

                echo form_label("CLick Rate: ","click_rate");
                // echo form_input("click_rate","","class = form-control required");
                ?>      
                <input type="hidden" name="id" value="<?php echo $editdomain[0]['id'];?>" />
                <input type="hidden" name="publisher_id" value="<?php echo $editdomain[0]['publisher_id'];?>" />
                <input type="number" step="any" name="click_rate" value="<?php echo $editdomain[0]['click_rate'];?>"
                class = "form-control required" />

                <label for="Publisher">Publisher: </label>
                <input type="noinput" name="id" value="<?php echo $publisher[0]['name'];?>" readonly="readonly" class = "form-control"/>
                <input type="hidden" name="all" value="all" />
                <br>
                <?php echo form_label("Priority: ","Priority");?>
                <input type="number"  name="priority" value="<?php echo $editdomain[0]['priority'];?>" class = "form-control required" />
                <select class="form-control" name="priority">
                    <?php 
                    $index = 0;
                    foreach($domain as $dom)
                    { 
                    echo '<option value="'.$dom['priority'].'">'.$dom['priority'].'</option>';
                    $index++;
                    }
                    ?>
                </select>
                <button type="submit" class="btn btn-primary" onsubmit="return validateForm()">Edit domain Link</button>
                <a href="<?php echo site_url('admin/dom/all');?>" >
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
            <div class="box-body">
              <table id="domain" class="table table-bordered table-hover dataTable">
                <thead><tr>
                  <th>ID</th>
                  <th>Link</th>
                  <th>Priority</th>
                  <th>Click Rate</th>
                  <th>Delete</th>
                  <th>Edit</th>
                </tr></thead>
                
                    
<?php $index = 1;
      
       
foreach ($domain as $dom){?>
<tr>
<?php echo "<td>".$index."</td>"; 
      echo "<td>".$dom['url']."</td>" ;
      echo "<td>".$dom['priority']."</td>"; 
      echo "<td>".$dom['click_rate']."</td>"; ?>


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



<?php }else {
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// ?>

    
    <div class="col-xs-12">


<?php if (!(isset($editmode))) 
        {

        echo form_open('admin/domainformsubit/add');

            echo form_label("Url: ","url");
            echo form_input("url","","class = form-control required");

            echo form_label("CLick Rate: ","click_rate");

            // echo form_input("click_rate","","class = form-control required");
            ?>
            <input type="hidden" name="publisher_id" value="<?php echo $domain[0]['publisher_id'];?>" />
            <input type="number" step="any" name="click_rate" value="0" class = "form-control required" />
            <?php echo form_label("Publisher: ","Publisher");?>
            <select class="form-control" name="publisher_id">
                    <?php 
                    $index = 0;
                    foreach($publisher as $pub)
                        { 
                        echo '<option value="'.$domain[$index]['publisher_id'].'">'.$pub['name'].'</option>';
                        $index++;
                        }
                    ?>
            </select>

            <?php echo form_label("Priority: ","Priority");?>
            <input type="number"  name="priority" value="<?php echo $domain[0]['priority'];?>" class = "form-control required" />

            <input type="hidden" name="all" value="no" />


            <button type="submit" class="btn btn-primary" onsubmit="return validateForm()">Add domain Link</button>
        </form>
 <?php }else { 
        
             echo form_open('admin/domainformsubit/edit');

       echo form_label("Url: ","url");
       echo form_input("url",$editdomain[0]['url'],"class = form-control required");
       
       echo form_label("CLick Rate: ","click_rate");
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
       
      
 <button type="submit" class="btn btn-primary" onsubmit="return validateForm()">Edit domain Link</button>
 <a href="<?php echo base_url();?>admin/dom/no/<?php echo $editdomain[0]['publisher_id']?>" >
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
            <div class="box-body ">
             <table id="domain" class="table table-bordered table-hover dataTable">
                <thead><tr>
                  <th>ID</th>
                  <th>Link</th>
                  <th>Priority</th>
                  <th>Click Rate</th>
                  <th>Delete</th>
                  <th>Edit</th>
                </tr></thead>
                
                    
<?php $index = 1;
foreach ($domain as $dom){?>
<tr>
<?php echo "<td>".$index."</td>"; 
      echo "<td>".$dom['url']."</td>" ;
      echo "<td>".$dom['priority']."</td>"; 
      echo "<td>".$dom['click_rate']."</td>";?> 
      
      
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
    
    
<?php       } ?>




