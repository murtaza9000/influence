
<style>
      textarea {
                background-color: #fff;
                 opacity: .50; /* Standard opacity property */
                filter: progid:DXImageTransform.Microsoft.Alpha(opacity=50); /* IE opacity property */
                /* reducing the opacity will also make the textarea text become transparent */
            }
            
       .label {
           font-size: 96%;
       }
      .attachment-block 
       {
           margin-top: 10px;
               padding-bottom: 20px;
       }
       .viral{
               padding-left: 150px;
                
       }
       .viralcopy{
              
                opacity: .70;
       }
       a   .latest{
          font-size: 12px;
       }
       
       
.btn-sm {
    padding: 1px 12px;
    float:right;
}       
            </style>

<?php $index = 1;
        
          $this->breadcrumbs->push('<i class="fa fa-dashboard"></i>Home', 'influencer');
            $this->breadcrumbs->push('Viral links', 'influencer/viral');
            $_POST['breadcrumb']= $this->breadcrumbs->show();
        
if((empty($viral)))

echo "<div><h2> No result </h2><div>";
else
{ 
   
    $name=str_replace(" ", "", $influencer['0']['utm']);
  $name=  strtolower($utm);
  $id=$influencer['0']['id'];
  ?>
   <div class = "viral ">
<?php foreach ($viral as $vir){?>
<tr>   
    <div <?php  echo ( $vir['copied'] == "copied") ? "" : "class=viralcopy" ?> > 
              
     
        <div class = "row">
            
            <div class ="col-md-8">  
<?php if( $vir['copied'] == "copied"){ ?>
            
              
                 
     <form action="docopy/viral" method="post">
            <span class="label label-success"><b>Click-Rate</b>: $<?=$vir['click_rate']?></span>
            <span class="label label-warning"><b>Click-Rate(Premium-Rate)</b>: $<?=$vir['click_ratepre']?></span>
            <input type="hidden" name="id" value="<?=$vir['id']?>">
            <input type="hidden" name="flag" value="1">
            <button class="copyit btn  btn-primary btn-sm"   data-clipboard-action="copy" data-clipboard-text="<?=$vir['url']?>?utm_source=Social&utm_medium=AS&utm_campaign=<?=$name?>" > Copy Link</button>
    </form>
<?php }  else  { ?>
                <span class="label label-success"><b>Click-Rate</b>: $<?=$vir['click_rate']?></span>
                <span class="label label-warning"><b>Click-Rate(Premium-Rate)</b>: $<?=$vir['click_ratepre']?></span>
                <button class="copyit btn  btn-info btn-sm disabled"   data-clipboard-action="copy" data-clipboard-target="#utm<?php echo $index;?>" > Link is copied</button>
        
    <?php }?>
                      </div>
            </div>
               
            <div class = "row">
                
                <div class ="col-md-8">
            
                <div class="attachment-block clearfix ">
                    
              
                    <img class="attachment-img" src="<?=$vir['image']?>" alt="attachment image">
                    <div class="attachment-pushed">
                       
                      <h4 class="attachment-heading">
                         
                       <b>   <?=$vir['title']?> </b></br>
                         <a class="latest" href="<?=$vir['url']?>?utm_source=Social&utm_medium=AS&utm_campaign=<?=$name?>" target="blank" ><?=$vir['url']?></a>
                         
                         </h4>
                      <div class="attachment-text">
                        <?=$vir['description']?>
                      </div><!-- /.attachment-text -->
                    </div><!-- /.attachment-pushed -->
                    
                </div>
                 </div>
                     
             </div>     
             </div>           
               </br></br>      
<?php $index++;
} }
?>
 </div>

   <script>
      
          
       //   function K(copyit){
   //  $(copyit).button();
    //  $(copyit).unbind("click").click(function() {

    var clipboard = new Clipboard('.copyit');

    clipboard.on('success', function(e) {
        console.log(e);
       
     
    });

    clipboard.on('error', function(e) {
        console.log(e);
      
    });
                 
        
       
  //    }  
         
    </script>    
    