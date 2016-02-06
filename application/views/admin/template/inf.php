
<?php foreach ($influencer as $inf){?>

    <div class ="row">
     <div class ="col-md-4">   
    <ol>
 <?php  echo"<li>". $inf['name']; ?>
   </li>
   </ol>
   </div>
   
   <div class ="col-md-4">
   <button type="button" class="btn btn-info">Domains</button>
   </br>
   </div>
   
</div>

<?php } ?>

