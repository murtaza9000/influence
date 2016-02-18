

 <?php $index = 1;
foreach ($rss as $inf){?>

<div class ="row">
    <ol>
    <div class ="col-md-8">   
        
<?php echo $index.".   ";?>
      &nbsp;&nbsp;  <textarea class="js-copytextarea" rows="2" cols="100"><?php echo $inf['links'] ?></textarea>

        
    </div>
        <div class ="col-md-2">
            
            <button class="js-textareacopybtn btn btn-block btn-primary btn-xs">Copy Link!</button>
            
        </div>
        </ol>
</div>
         
    <?php  $index++;}  ?>
    
            
            
            
 
 
 
 
 
 
 
 
 
 
 
 
 
 
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