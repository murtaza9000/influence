<style>
  
  .image_latest img
  {
      height: 70px;
      width :104px;
      margin-left: 10px;
      float:left;
  }
  
  .image_latest p
  {
     
      margin-left: 10px;
   
  }
    
 </style>

 <?php $index = 1;
foreach ($rss as $inf){?>
<div>
<div class ="row">
        <div class ="col-md-8">   
        

     <textarea class="js-copytextarea" rows="1" cols="100"><?php echo $inf['links'] ?></textarea>
<?php    echo "<p><b>Click-Rate</b>: $".$inf['click_rate']."   <b>Click-Rate(Premium-Rate)</b>: $".$inf['click_ratepre']."</p>";  ?>

        
    </div>
        <div class ="col-md-2">
            
            <button class="js-textareacopybtn btn btn-block btn-primary btn-xs">Copy Link!</button>
            
        </div>
 </div>
 <div class ="row">
        <div class="box">
            <div class="box-body">
                <div class="col-md-8">
                    <div class="image_latest  img-responsive ">
                <?php      echo $inf['description'];

                ?>
                    </div>
                </div>
            </div>
        </div>  
  </div>
  
  </div>
    <?php  $index++;}  
   ?>
    
            
            
            
 
 
 
 
 
 
 
 
 
 
 
 
 
 
<SCRIPT LANGUAGE="JavaScript">
 var copyTextareaBtn = document.querySelector('.js-textareacopybtn');

copyTextareaBtn.addEventListener('click', function(event) {
  var copyTextarea = document.querySelector('.js-copytextarea');
  copyTextarea.select();

  try {
    var successful = document.execCommand('copy');
    var msg = successful ? 'successful' : 'unsuccessful';
    console.log('Copying text command was ' + msg);
  } catch (err) {
    console.log('Oops, unable to copy');
  }
});

</SCRIPT>