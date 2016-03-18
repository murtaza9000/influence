
<?php 
$this->breadcrumbs->push('<i class="fa fa-dashboard"></i>Home', 'admin');
$this->breadcrumbs->push('Influencer List', 'admin/inf');

      $_POST['breadcrumb']=   $this->breadcrumbs->show();


$index = 1;
foreach ($influencer as $inf){?>

    <div class ="row">
     <div class ="col-md-4">   
    
<?php if ( $inf['ban'] == "1") 
        { 
            echo " <h4> ".$index.". <strike>". $inf['name']."</strike></h4>"; 
?>
       
          </div>
             <div class ="col-md-1">
                 <a href="<?php echo base_url();?>admin/ban/<?php echo $inf['id']?>/unban">
                 <button type="button" class="btn btn-warning btn-flat">unban</button>
                 </a>
        </div>
               
            
            
            
            
<?php    }
       else
       {
        echo " <h4> ".$index.". ". $inf['name']."</h4>"; 
 ?>
   
   
          </div>
             <div class ="col-md-1"> <!-- start of button div -->
                 <a href="<?php echo base_url();?>admin/ban/<?php echo $inf['id']?>">
                 <button type="button" class="btn btn-info btn-flat">&nbsp&nbspban&nbsp&nbsp&nbsp</button>
                 </a>
        </div>
              
   
 

<?php } ?>
     <div class ="col-md-2">
    <a href="<?php echo base_url();?>admin/inf_detail/<?php echo $inf['id']?>">
                 <button type="button" class="btn btn-info btn-flat">Details</button>
                 </a>
      
    <?php
   // echo "Payment Dues: ".$inf['payment']; 
    if ($inf['payment']!= 0)
    echo "         <i class=\"fa fa-fw fa-warning\"></i>";
    if ($inf['ban']!= 0)
    echo "<i class=\"fa fa-fw fa-ban\"></i>";
    ?>
    
    </div> 
    
    <div class ="col-md-4">   
    <a href="<?php echo base_url();?>admin/del_inf/<?php echo $inf['id']?>">
                 <button type="button" class="btn btn-danger btn-flat">Delete</button>
                 </a>
       </div>      <!-- end of button div -->     
    </div>  <!-- end of row div -->
    </br>
                        
<?php $index++; 
} ?>

