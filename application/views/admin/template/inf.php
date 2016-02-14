
<?php $index = 1;
foreach ($influencer as $inf){?>

    <div class ="row">
     <div class ="col-md-4">   
    <ol>
<?php if ( $inf['ban'] == "1") 
        {
            echo $index.". <strike>". $inf['name']."</strike>"; 
?>
        </ol>
          </div>
             <div class ="col-md-4">
                 <a href="<?php echo base_url();?>admin/ban/<?php echo $inf['id']?>/unban">
                 <button type="button" class="btn btn-info">unban</button>
                 </a>
        
               
            
            
            
            
<?php    }
       else
       {
        echo $index.". ". $inf['name']; 
 ?>
   
   </ol>
          </div>
             <div class ="col-md-4"> <!-- start of button div -->
                 <a href="<?php echo base_url();?>admin/ban/<?php echo $inf['id']?>">
                 <button type="button" class="btn btn-info">ban</button>
                 </a>
        
              
   
 

<?php } ?>
    <a href="<?php echo base_url();?>admin/inf_detail/<?php echo $inf['id']?>">
                 <button type="button" class="btn btn-info">Details</button>
                 </a>
    <?php
   // echo "Payment Dues: ".$inf['payment']; 
    if ($inf['payment']!= 0)
    echo "         <i class=\"fa fa-fw fa-warning\"></i>";
    if ($inf['ban']!= 0)
    echo "<i class=\"fa fa-fw fa-ban\"></i>";
    ?>
    </div> <!-- end of button div -->
    </div>  <!-- end of row div -->
                        
<?php $index++; 
} ?>

