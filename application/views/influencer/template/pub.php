
<?php 

foreach ($publisher as $pub){?>
    
<div class ="row">
     <div class ="col-md-4">   
    <ol>
 <?php  echo"<li>".$pub['name']; ?>
   </li>
   </ol>
   </div>
   
   <div class ="col-md-4">
       <a href="<?php echo base_url();?>admin/index/dom/<?php echo $pub['id']?>">
   <button type="button" class="btn btn-info btn-flat">Domains</button>
   </a>
   
   </div>
   </br>
   
</div>

<?php } ?>