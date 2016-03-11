


<?php $index = 1;

if((empty($viral)))

echo "<div><h2> No result </h2><div>";
else
{
    echo "<div class=\"box\">";
foreach ($viral as $vir){?>
<tr>
<?php echo "<h3>Site Name: ".$vir['site_name']."</h1>" ;
      echo "<p>Site URL: <a href=\"".$vir['url']."\" target=\"blank\">".$vir['url']."</a></p>"; 
      echo "<p><b>Click-Rate</b>: $".$vir['click_rate']."   <b>Click-Rate(Premium-Rate)</b>: $".$vir['click_ratepre']."</p>"; 
      echo "<h1>".$vir['title']."</h1>"; 
      echo "<img class=\"img-thumbnail .img-responsive\" src=\"".$vir['image']."\"/>";
      echo "<p>".$vir['description']."</p>";  
      ?>

                 
<?php $index++;
} }
?>
</div>





