
<div class ="box box-solid">
      <div class ="box-body">
         
<?php 
$this->breadcrumbs->push('Influencer List', 'admin/inf');
$this->breadcrumbs->push('Influencer Detail', 'admin/inf_detail');
        $_POST['breadcrumb']=  $this->breadcrumbs->show();
        // echo site_url('/inf');
foreach ($influencer as $inf){

echo "Name: ".$inf['name'];
echo "<br>";
echo "Display Name: ".$inf['display_name'];
echo "<br>";
echo "Email: ".$inf['email'];
echo "<br>";
echo "Account#: ".$inf['account_no'];
echo "<br>";
echo "Login Provider: ".$inf['login_provider'];
echo "<br>";
echo "Country: ".$inf['country'];
echo "<br>";

if ($inf['ban']!= 0){
    echo "Ban Status: Yes";
   
echo "<i class=\"fa fa-fw fa-ban\"></i>";
                     }
else
echo "Ban Status: No";
echo "<br>";

echo "Payment: ".$inf['payment']; 
if ($inf['payment']!= 0)
    {
echo "<i class=\"fa fa-fw fa-warning\"></i>"; ?>
 <a href="<?php echo site_url('admin/payment_clear/'.$inf['id']);?>">
                 <button type="button" class="btn btn-danger btn-sm">Clear</button>
  </a>  
  
<?php

    }

}
echo "<br>";
?>

 <a href="<?php echo base_url();?>admin/inf">
                 <button type="button" class="btn btn-info">Back</button>
   </a>              
    </div>
</div>