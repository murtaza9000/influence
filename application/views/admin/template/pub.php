



<?php   $this->breadcrumbs->push('<i class="fa fa-dashboard"></i>Home', 'admin');    
         $this->breadcrumbs->push('Publisher Lists', 'admin/pub');
          
            $_POST['breadcrumb']=$this->breadcrumbs->show();
            
 $index =1;           
foreach ($publisher as $pub){?>
    
<div class ="row">
     <div class ="col-md-4">   
    
 <?php  echo " <h4> ".$index.". ". $pub['name']."</h4>"; ?>
   
   
   </div>
   
   <div class ="col-md-4">
       <a href="<?php echo base_url();?>admin/dom/no/<?php echo $pub['id']?>">
   <button type="button" class="btn btn-info btn-flat">Domains</button>
   </a>
   
   </div>
   
</div>
</br>
<?php $index++;} ?>