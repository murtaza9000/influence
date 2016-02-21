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

<div class ="row">
        <div class ="col-md-8">   
        
<?php //echo $index.".   ";?>
     <textarea class="js-copytextarea" rows="2" cols="100"><?php echo $inf['links'] ?></textarea>

        
    </div>
        <div class ="col-md-2">
            
            <button class="js-textareacopybtn btn btn-block btn-primary btn-xs">Copy Link!</button>
            
        </div>
 </div>
        <div class="box">
            
                <div class="image_latest  img-responsive ">
                <?php      echo $inf['description'];

                ?>
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