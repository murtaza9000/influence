 

<style>
  
  .image_latest img
  {
      height: 70px;
      width :104px;
      margin-left: 10px;
      float:left;
          margin-right: 10px;
  }
  
  .image_latest p
  {
     
      margin-left: 10px;
   
  }
  textarea {
                background-color: #fff;
                
                
                
                
                
                opacity: .50; /* Standard opacity property */
                filter: progid:DXImageTransform.Microsoft.Alpha(opacity=50); /* IE opacity property */
                /* reducing the opacity will also make the textarea text become transparent */
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
foreach ($rss as $inf){?>
<div>
<div class ="row" id="latest">
        <div class ="col-md-8">   
        
<?php if( $inf['copied'] == "copied"){ ?>
   
     <textarea id="utm<?php echo $index;?>"  rows="1" cols="100"><?php echo $inf['links'] ?></textarea>
     
    <?php }  else  { ?>
   
   <textarea id="utm<?php echo $index;?>"  rows="1" cols="100"><?php echo $inf['links'] ?></textarea>
   
    <?php }?>
  </br><span class="label label-success"><b>Click-Rate</b>: $<?=$inf['click_rate']?></span>
            <span class="label label-warning"><b>Click-Rate(Premium-Rate)</b>: $<?=$inf['click_ratepre']?></span>

        
    </div>
        <div class ="col-md-2"> 
            
            <?php if( $inf['copied'] == "copied"){ ?>
            <form action="docopy" method="post">
                <input type="hidden" name="link" value="<?=$inf['links']?>">
               
                <input type="hidden" name="flag" value="1">
                
           <button class="copyit btn btn-block btn-primary btn-xs"   data-clipboard-action="copy" data-clipboard-target="#utm<?php echo $index;?>" > Copy Link</button>
            </form>
            <?php } else{ ?>
                
                 <!--button  class="btn btn-block btn-info btn-xs" >Link is copied</button-->
                    
                   
                    <button class=" btn btn-block btn-info btn-xs">Link is copied</button>
                   
            <?php } ?>
        </div>
 </div>
 <div class ="row">
       <div class ="col-md-12"> 
        <div class="attachment-block clearfix  image_latest">
             
               <?=$inf['description']?>
                </div>
       
  </div>
   </div>
  </div>
    <?php  $index++;}  }
  
  
  
 
  
  
  
   ?>
    
            
        
      
            
 
 
 
 
 
 
 
 
 
 
 
 
 
 