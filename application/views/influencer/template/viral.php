
<style>
     
   .thumbnail  img{
         width:334px;
         height:174px;
     }
            
       .label {
           font-size: 96%;
       }
     }
      
       .viralcopy{
              
                opacity: .70;
       }
       a   .latest{
          font-size: 12px;
       }
       
       
   
            </style>

<?php $index = 1;
         $serial=rand();
          $this->breadcrumbs->push('<i class="fa fa-dashboard"></i>Home', 'influencer');
            $this->breadcrumbs->push('Viral links', 'influencer/viral');
            $_POST['breadcrumb']= $this->breadcrumbs->show();
        
if((empty($viral)))

echo "<div><h2> No result </h2><div>";
else
{ 
   
    $name=str_replace(" ", "", $influencer['0']['utm']);
  $name=  strtolower($name);
  $id=$influencer['0']['id'];
  ?>
   <div class = "viral ">
        <div class="row">
        <div class="col-sm-12" >
            <div class="row" >
<?php foreach ($viral as $vir){?>
<tr>   
    
              
     
       

          <div <?php echo ($vir['copied'] != "copied") ? "" : "class=\"viralcopy\"" ?> >
        <div class="col-sm-4">

            <div class="thumbnail">
                 <img src="<?=$vir['image']?>" alt="attachment image">
                <h3><a href="<?=$vir['url']?>?utm_source=Social&utm_medium=AS&utm_campaign=<?=$name?>" traget="blank" ><?php echo substr($vir['title'],0,40); ?></a></h3>
              
                
                <div class="caption">
                
                
                
                <?php if ($vir['copied'] != "copied"): ?>
                    <div class="<?=$serial?>" >
                    <form>              
                    <input type="hidden" id="id<?=$serial?>" name="id" value="<?=$vir['id']?>">
                    <input type="hidden" id="flag<?=$serial?>" name="flag" value="1">
                    
                    <input type="button" id="<?=$serial?>" class="copyit btn btn-sm btn-danger copyentry" data-clipboard-action="copy" data-clipboard-text="<?=$vir['url']?>?utm_source=Social&utm_medium=AS&utm_campaign=<?=$name?>" value="Copy Link"  />
                    </br></br>
                    </form>          
                    <?php $serial=rand();?>
                     <span class="label label-danger"><b>Premium Rate</b>: $<?=$vir['click_ratepre']?></span>
                    <span class="label label-danger"><b>Non-Premium Rate</b>: $<?=$vir['click_rate']?></span>
                    </div>
                <?php else: ?>
                
                      <input type="button" id="<?=$serial?>" class="copyit btn btn-sm btn-danger" data-clipboard-action="copy" data-clipboard-text="<?=$vir['url']?>?utm_source=Social&utm_medium=AS&utm_campaign=<?=$name?>" value="Link Copied"  />
                      </br></br>
                       <span class="label label-danger"><b>Premium Rate</b>: $<?=$vir['click_ratepre']?></span>
                     <span class="label label-danger"><b>Non-Premium Rate</b>: $<?=$vir['click_rate']?></span>
                    
                <?php endif; ?>  
                 

                </div>
            </div>
    </div>
    </div>
          
          
<?php $index++;
} }
?>
</div>
    </div>
    </div>
    </div>

   <script>
      
          
   
    var clipboard = new Clipboard('.copyit');

    clipboard.on('success', function(e) {
        console.log(e);
       
     
    });

    clipboard.on('error', function(e) {
        console.log(e);
      
    });
                 
        
     
       </script> 