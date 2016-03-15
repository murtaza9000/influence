 

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
    padding-left: 10px;
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
   $data['full_name']=  $this->user->add_user_data('influencer');
   
 foreach($data as $temp){
     $name=$temp['full_name'];
    }
  
     $name=str_replace(" ", "",$name );
  $name=  strtolower($name);
  $id=$this->session->userdata('user_id');
  ?>
   <div class="viral">
<?php
foreach ($rss as $inf){?>
      
     <div <?php  echo ( $inf['copied'] == "copied") ? "" : "class=viralcopy" ?> >  
      
       
<div class ="row" id="latest">
        <div class ="col-md-8">   
        <?php if( $inf['copied'] == "copied"){ ?>
            <form action="docopy" method="post">
                <input type="hidden" name="link" value="<?=$inf['links']?>">
                <input type="hidden" name="flag" value="1">
                <span class="label label-success"><b>Click-Rate</b>: $<?=$inf['click_rate']?></span>
                <span class="label label-warning"><b>Click-Rate(Premium-Rate)</b>: $<?=$inf['click_ratepre']?></span>
                <button class="copyit btn  btn-primary btn-sm"   data-clipboard-action="copy" data-clipboard-text="<?=$inf['links']?>?utm_source=Social&utm_medium=AS&utm_campaign=<?=$name.$id?>" > Copy Link</button>
            </form>
          <?php } else{ ?>
                
                
                 <span class="label label-success"><b>Click-Rate</b>: $<?=$inf['click_rate']?></span>
                  <span class="label label-warning"><b>Click-Rate(Premium-Rate)</b>: $<?=$inf['click_ratepre']?></span>
                   
                    <button class="copyit btn  btn-info btn-sm disabled">Link is copied</button>
                   
            <?php } ?>  
       
</div>
</div>
            <div class ="row">
                <div class ="col-md-8"> 
                    <div class="attachment-block clearfix  image_latest">
                        
                        <?=$inf['description']?>
                         <h4 class="attachment-heading">
                        <a class="latest" href="<?=$inf['links']?>?utm_source=Social&utm_medium=AS&utm_campaign=<?=$name.$id?>" target="blank" ><?=$inf['links']?></a>
                        </h4>
            </div>
                
                </div>
                </div>
                </div>
    <?php  $index++;}  }
   
   ?>
   </div>
            
        
      
            
 
 
 
 
 
 
 
 
 
 
 
 
 
 