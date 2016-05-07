 

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
 
       .viral{
             
                
       }
       .viralcopy{
              
                opacity: .70;
       }
       a .latest{
          font-size: 8px;
       }
       
       



    p{
          
             text-overflow: ellipsis;
    }
    
     
    
    .bordered  {
     
         border: 1px solid grey;
          background: transparent;
}

            </style>


<?php
   $serial=rand();
    $index = 1;
    $this->breadcrumbs->push('<i class="fa fa-dashboard"></i>Home', 'influencer');
    $this->breadcrumbs->push('Latest links', 'influencer/inf');
    $_POST['breadcrumb'] = $this->breadcrumbs->show();


    if ((empty($rss))):
        echo "<div><h2> No result </h2><div>";
    else:
        $data['utm'] = $this->user->add_user_data('influencer');

        foreach ($data as $temp):
            $name = $temp['utm'];
        endforeach;

        $name = str_replace(" ", "", $name);
        $name = strtolower($name);
        $id = $this->session->userdata('user_id');
        endif;
?>
   <div class="viral">
       <div class="row">                    <!-- Master row-->
    

      <div class="col-sm-12" >
            <div class="row" >
<?php

 //
 // var_dump($rss);
 //      die();


foreach ($rss as $inf):
?>

      
  <?php   // if(isset($inf['description'])) { ?>


  <div id="latest">                               
  <div <?php echo ($inf['copied'] != "copied") ? "" : "class=\"viralcopy\"" ?> >
        <div class="col-sm-4">

            <div class="thumbnail">
            <?= $inf['description'] ?>     

                <div class="caption">

                <p><a class="latest" href="<?= $inf['links'] ?>?utm_source=Social&utm_medium=AS&utm_campaign=<?= $name?>"
                target="blank"><?php echo substr($inf['title'],0,40); ?> </a></p>
                
                <?php if ($inf['copied'] != "copied"): ?>
                    <div class="<?=$serial?>" >  
                    <form>              
                    <input type="hidden" name="link" id="link<?=$serial?>" value="<?= $inf['links'] ?>" >
                    <input type="hidden" name="id"   id="id<?=$serial?>" value="<?= $inf['id'] ?>">
                    <input type="hidden" name="flag" id="flag<?=$serial?>" value="1">
                    <input type="button" id="<?=$serial?>" class="copyit btn btn-sm btn-danger copyentry" data-clipboard-action="copy"
                    data-clipboard-text="<?= $inf['links'] ?>?utm_source=Social&utm_medium=AS&utm_campaign=<?=$name?>" value="Copy Link" />
                    </br></br>
                    </form>          
                    <?php $serial=rand();?>
                    <span  class="label label-danger"><b>Premium Rate</b>: $<?= $inf['click_ratepre'] ?></span>
                <span class="label label-danger"><b>Non-Premium Rate</b>: $<?= $inf['click_rate'] ?></span>
                    </div>
                <?php else: ?>
                
                    <input type="button" id="<?=$serial?>" class="copyit btn btn-sm btn-danger" data-clipboard-action="copy"
                    data-clipboard-text="<?= $inf['links'] ?>?utm_source=Social&utm_medium=AS&utm_campaign=<?=$name?>" value="Link Copied" />
                    </br></br>
                    <span  class="label label-danger"><b>Premium Rate</b>: $<?= $inf['click_ratepre'] ?></span>
                <span class="label label-danger"><b>Non-Premium Rate</b>: $<?= $inf['click_rate'] ?></span>
                <?php endif; ?>  
                
                

                </div>
            </div>
    </div>
    </div>
</div>
										  
               
        
    <?php
            $index++;
     // } 
      
     
   endforeach;
    

    ?>
            </div>  
         </div>
    </div>     <!-- Master row end-->
   </div>
            
         <script src="<?=base_url()?>/plugins/jQuery/jQuery-2.1.4.min.js"></script>
      <script type="text/javascript" src="<?=base_url()?>dist/js/jquery-2.1.4.min.js"></script>
       <script type="text/javascript" src="<?=base_url()?>dist/js/jquery.ui.min.js"></script>
        
       <script type="text/javascript">
               $(document).ready(function(){
                    $(".copyentry").click(function(){
                            $(this).val("Link Copied");
                           
                            var serial = $(this).attr('id');
                          var divid="div." + serial;
                          var link=$("#link" + serial).val();
                          var id=$("#id" + serial).val();
                          var flag=$("#flag" + serial).val();
                          
                          var  url= '<?=base_url()?>' + "influencer/docopy" ;
                          var posts=  "link="+link+"&id="+id+"&flag="+flag ;
                              
                            $.post(url, posts, function(data){
                                if( data == "done"){
                     $( divid ).toggleClass( "viralcopy",true )
                                                    }else{
                                                        alert("copy again");
                                                    }   
                 
                            });
                          
 
                    });
               });
       </script> 
            
 
 
 
 
 
 
 
 
 
 
 
 
 
