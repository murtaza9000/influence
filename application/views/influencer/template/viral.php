
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
<?php foreach ($viral as $vir){?>
<tr>   
    <div <?php  echo ( $vir['copied'] != "copied") ? "" : "class=viralcopy" ?> > 
              
     
        <div class = "row">
            
            <div class ="col-md-8">  
<?php if( $vir['copied'] != "copied"){ ?>
            
              
           <div class="<?=$serial?>" >         
     <form>
           
            <span class="label label-danger"><b>Premium Rate</b>: $<?=$vir['click_ratepre']?></span>
             <span class="label label-danger"><b>Non-Premium Rate</b>: $<?=$vir['click_rate']?></span>
            <input type="hidden" id="id<?=$serial?>" name="id" value="<?=$vir['id']?>">
            <input type="hidden" id="flag<?=$serial?>" name="flag" value="1">
           
             <input type="button" id="<?=$serial?>" class="copyit push_button copyentry" data-clipboard-action="copy"
                                        data-clipboard-text="<?=$vir['url']?>?utm_source=Social&utm_medium=AS&utm_campaign=<?=$name?>" value="Copy Link" />
    </form>
     <?php $serial=rand();?>
    </div>
<?php }  else  { ?>
                 <span class="label label-danger"><b>Premium Rate</b>: $<?=$vir['click_ratepre']?></span>
                <span class="label label-danger"><b>Non-Premium Rate</b>: $<?=$vir['click_rate']?></span>
               
                <button class="copyit push_button disabled"   data-clipboard-action="copy" data-clipboard-target="#utm<?php echo $index;?>" > Link is copied</button>
        
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
      
          
   
    var clipboard = new Clipboard('.copyit');

    clipboard.on('success', function(e) {
        console.log(e);
       
     
    });

    clipboard.on('error', function(e) {
        console.log(e);
      
    });
                 
        
       
  //    }  
         
    </script>    
       <!--script src="<?=base_url()?>/plugins/jQuery/jQuery-2.1.4.min.js"></script>
      <script type="text/javascript" src="<?=base_url()?>dist/js/jquery-2.1.4.min.js"></script>
       <script type="text/javascript" src="<?=base_url()?>dist/js/jquery.ui.min.js"></script>
        
       <script type="text/javascript">
               $(document).ready(function(){
                    $(".copyentry").click(function(){
                            $(this).val("Link Copied");
                           $(this).attr( "disabled", 'disabled' )
                            var serial = $(this).attr('id');
                          var divid="div." + serial;
                        //  var link=$("#link" + serial).val();
                          var id=$("#id" + serial).val();
                          var flag=$("#flag" + serial).val();
                          var  url= '<?=base_url()?>' + "influencer/docopy/viral" ;
                          var posts=  "id="+id+"&flag="+flag ;
                              
                            $.post(url, posts, function(data){
                                if( data == "done"){
                     $( divid ).toggleClass( "viralcopy",true )
                                                    }else{
                                                        alert("copy again");
                                                    }   
                 
                            });
                          
 
                    });
               });
       </script--> 