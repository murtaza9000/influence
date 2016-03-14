

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
 
 <?php   
  
        $index = 1;
            $this->breadcrumbs->push('<i class="fa fa-dashboard"></i>Home', 'influencer');
            $this->breadcrumbs->push('Latest links', 'influencer/inf');
            $_POST['breadcrumb']= $this->breadcrumbs->show();
           
           
if((empty($rss)))

echo "<div><h2> No result </h2><div>";

else
{
   
foreach ($rss as $inf){?>
<div>
<div class ="row" id="latest">
        <div class ="col-md-8">   
        

     <textarea class="js-copytextarea" id="<?php echo $index;?>"  rows="1" cols="100"><?php echo $inf['links'] ?></textarea>
<?php    echo "<p><b>Click-Rate</b>: $".$inf['click_rate']."   <b>Click-Rate(Premium-Rate)</b>: $".$inf['click_ratepre']."</p>";  ?>

        
    </div>
        <div class ="col-md-2"> 
            
            <?php if( $inf['copied'] == "copied"){ ?>
            <form action="docopy" method="post">
                <input type="hidden" name="link" value="<?php echo $inf['links'] ?>">
               
                <input type="hidden" name="flag" value="1">
                
            <button type="submit" id="<?php echo $index;?>" class="js-textareacopybtn btn btn-block btn-primary btn-xs">Copy Link!</button>
            </form>
            <?php } else{ ?>
                
                 <button id="copy-button" data-clipboard-text="Copy Me!" >Link is copied</button>
                
            <?php } ?>
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
    <?php  $index++;}  }
  
  
  
 
  
  
  
   ?>
    
            
            
            
 
 
 
 
 
 
 
 
 
 
 
 
 
 
<SCRIPT LANGUAGE="javascript">
 var copyTextareaBtn = document.querySelector('button.js-textareacopybtn')

copyTextareaBtn.addEventListener('click', function(event) {
  var copyTextarea = document.querySelector('textarea.js-copytextarea');
  copyTextarea.select();

 try {
   var successful = document.execCommand('copy');
  var msg = successful ? 'successful' : 'unsuccessful';
   console.log('Copying text command was ' + msg);
} catch (err) {
   console.log('Oops, unable to copy');
 }
});


var client = new ZeroClipboard( document.getElementById("copy-button") );

client.on( "ready", function( readyEvent ) {
  // alert( "ZeroClipboard SWF is ready!" );

  client.on( "aftercopy", function( event ) {
    // `this` === `client`
    // `event.target` === the element that was clicked
    event.target.style.display = "none";
    alert("Copied text to clipboard: " + event.data["text/plain"] );
  } );
} );

</SCRIPT >