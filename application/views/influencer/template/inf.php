 

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
    
}
            </style>


<?php

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
                <form action="docopy" method="post">
                    <input type="hidden" name="link" value="<?= $inf['links'] ?>">
                    <input type="hidden" name="id" value="<?= $inf['id'] ?>">
                    <input type="hidden" name="flag" value="1">
                    <span class="label label-success"><b>Click-Rate</b>: $<?= $inf['click_rate'] ?></span>
                    <span
                        class="label label-warning"><b>Click-Rate(Premium-Rate)</b>: $<?= $inf['click_ratepre'] ?></span>
                   
                  
                                        <button class="copyit push_button" data-clipboard-action="copy"
                                                data-clipboard-text="<?= $inf['links'] ?>?utm_source=Social&utm_medium=AS&utm_campaign=<?=$name?>">
                                            Copy Link
                                        </button>
                    </form>
                                    <?php else: ?>
                                    <span class="label label-success"><b>Click-Rate</b>: $<?= $inf['click_rate'] ?></span>
                    <span
                        class="label label-warning"><b>Click-Rate(Premium-Rate)</b>: $<?= $inf['click_ratepre'] ?></span>
                   
                                        <button  class="copyit push_button disabled"  disabled>Link is copied</button>
                                    <?php endif; ?>
                    
                       </div>
                    </div>
                    
                    <div class="attachment-block clearfix bg-grey image_latest">

                        <div class="row">
                             
                            <div class="col-md-8">
                                 <?= $inf['description'] ?>
                                <h3 class="attachment-heading">
                                    <a class="latest"
                                       href="<?= $inf['links'] ?>?utm_source=Social&utm_medium=AS&utm_campaign=<?= $name?>"
                                       target="blank"><?= $inf['title'] ?></a>
                                </h3>
                               
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
            
        
      
            
 
 
 
 
 
 
 
 
 
 
 
 
 
 