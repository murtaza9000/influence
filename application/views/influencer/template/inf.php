
<?php foreach ($influencer as $inf){?>

    <div class ="row">
     <div class ="col-md-4">   
    <ol>
<?php if ( $inf['ban'] == "1") 
        {
            echo"<li style=\"text-decoration: line-through;\">". $inf['name']."</li>";
?>
        </ol>
          </div>
             <div class ="col-md-4">
                 <a href="<?php echo base_url();?>admin/ban/<?php echo $inf['id']?>/unban">
                 <button type="button" class="btn btn-info">unban</button>
                 </a>
        
              </div>  
            
            
            
            
<?php    }
       else
       {
        echo"<li>". $inf['name']."</li>"; 
 ?>
   
   </ol>
          </div>
             <div class ="col-md-4">
                 <a href="<?php echo base_url();?>admin/ban/<?php echo $inf['id']?>">
                 <button type="button" class="btn btn-info">ban</button>
                 </a>
        
              </div> 
   
 

<?php }
echo "</div>";
} ?>

