


<?php $index = 1;
        
          $this->breadcrumbs->push('<i class="fa fa-dashboard"></i>Home', 'influencer');
            $this->breadcrumbs->push('Viral links', 'influencer/viral');
            $_POST['breadcrumb']= $this->breadcrumbs->show();
        
if((empty($viral)))

echo "<div><h2> No result </h2><div>";
else
{
   
    $name=str_replace(" ", "", $influencer['0']['name']);
  $name=  strtolower($name);
  $id=$influencer['0']['id'];
foreach ($viral as $vir){?>
<tr>            
    </br><span class="label label-success"><b>Click-Rate</b>: $<?=$vir['click_rate']?></span>
            <span class="label label-warning"><b>Click-Rate(Premium-Rate)</b>: $<?=$vir['click_ratepre']?></span>
               
                <div class="attachment-block clearfix">
                    <img class="attachment-img" src="<?=$vir['image']?>" alt="attachment image">
                    <div class="attachment-pushed">
                       
                      <h4 class="attachment-heading">
                         
                       <b>   <?=$vir['title']?> </b></br>
                         <a href="<?=$vir['url']?>?utm_source=Social&utm_medium=AS&utm_campaign=<?=$name.$id?>" target="blank" style="font-size: 15px;"><?=$vir['url']?></a>
                         
                         </h4>
                      <div class="attachment-text">
                        <?=$vir['description']?>
                      </div><!-- /.attachment-text -->
                    </div><!-- /.attachment-pushed -->
                </div>

                 
<?php $index++;
} }
?>


