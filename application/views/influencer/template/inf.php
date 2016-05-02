 

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
       a .latest{
          font-size: 12px;
       }
       
       
.btn-sm {
    padding: 1px 12px;
    float:right;
}  

img{
    height: 67px;
    width: 116px;
        margin-top: 5px;
}
    p{
            margin: 4px 0px 22px;
    }
    
    .push_button{
        float: right;
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
<?php

 //
 // var_dump($rss);
 //      die();


foreach ($rss as $inf):
      if(isset($inf['description'])) { ?>

    <div <?php echo ($inf['copied'] != "copied") ? "" : "class=viralcopy" ?> >


        <div class="row" id="latest">
            <div class="col-md-8">


            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                 <?php if ($inf['copied'] != "copied"): ?>
               
               
                    <div class="<?=$serial?>" >  
                     <form>              
                    <input type="hidden" name="link" id="link<?=$serial?>" value="<?= $inf['links'] ?>" >
                    <input type="hidden" name="id"   id="id<?=$serial?>" value="<?= $inf['id'] ?>">
                    <input type="hidden" name="flag" id="flag<?=$serial?>" value="1">
                    <span
                        class="label label-danger"><b>Premium Rate</b>: $<?= $inf['click_ratepre'] ?></span>
                    <span class="label label-danger"><b>Non-Premium Rate</b>: $<?= $inf['click_rate'] ?></span>
                    
                 
                  
                                <input type="button" id="<?=$serial?>" class="copyit push_button copyentry" data-clipboard-action="copy"
                                        data-clipboard-text="<?= $inf['links'] ?>?utm_source=Social&utm_medium=AS&utm_campaign=<?=$name?>" value="Copy Link" />
                        </form>          
                    <?php $serial=rand();?>
                    </div>
                    <?php else: ?>
                    <span
        class="label label-danger"><b>Premium Rate</b>: $<?= $inf['click_ratepre'] ?></span>
                    <span class="label label-danger"><b>Non-Premium Rate</b>: $<?= $inf['click_rate'] ?></span>
                    
        
                        <button  class="copyit push_button disabled"  disabled>Link is copied</button>
                    <?php endif; ?>
                    
                       </div>
                    </div>
                    
                    <div class="attachment-block clearfix bg-grey image_latest">

                        <div class="row">
                             
                            <div class="col-md-8">
                               
                                <h3 class="attachment-heading">
                                    <a class="latest"
                                       href="<?= $inf['links'] ?>?utm_source=Social&utm_medium=AS&utm_campaign=<?= $name?>"
                                       target="blank"><?= $inf['title'] ?></a>
                                </h3>
                              
                                 <?= $inf['description'] ?>

                            </div>
                        </div>


                    </div>
                

        
    </div>
    <?php
            $index++;
      }
        endforeach;
    

    ?>
   </div>
            
         <script src="<?=base_url()?>/plugins/jQuery/jQuery-2.1.4.min.js"></script>
      <script type="text/javascript" src="<?=base_url()?>dist/js/jquery-2.1.4.min.js"></script>
       <script type="text/javascript" src="<?=base_url()?>dist/js/jquery.ui.min.js"></script>
        
       <script type="text/javascript">
               $(document).ready(function(){
                    $(".copyentry").click(function(){
                            $(this).val("Link Copied");
                           $(this).attr( "disabled", 'disabled' )
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
            
 
 
 
 
 
 
 
 
 
 
 
 
 
 