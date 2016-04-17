

<div class="row">
    <div class="col-xs-10 col-xs-offset-1">
        <div class="box box-danger">

            <div class="box-body">
                <div class="box-header">
                <?php if (isset($start_date)): ?>
                    <h2  >Summary from: <?=nice_date($start_date, 'd M Y');?> to <?=nice_date($end_date, 'd M Y');?></h2>
                <?php else: ?>
                    <h2  >Summary from all time</h2>
                <?php endif; ?>
                <div class="row">
                    <div class="col-xs-3">
                        <!-- Date and time range -->
                           <div class="form-group">
                            <div class="input-group">
                           
                                <button class="btn btn-default pull-right" id="daterange-btn">
                                    <i class="fa fa-calendar"></i> Select Date Range
                                    <i class="fa fa-caret-down"></i>
                                </button>
                           </div> 
                      </div>   
                    </div>
                </div>
                
                <table id="example1" class="table table-bordered table-hover dataTable">
                    <thead>
                    <tr>
                        <th>Date</th>
                        <th>Name</th>
                        <th>Payment</th>
                        <th>id</th>
                        
                    </tr>
                    </thead>
                    <tbody>

                    <?php foreach($rows as $row): ?>
                    <tr>
                        <td><?=nice_date($row->timestamp_checkout, 'd M Y');?></td>
                        <td><?=$row->name?></td>
                        <td>$<?=$row->payment_checkout?></td>
                        <td><?=$row->inf_id?></td>
                       
                    </tr>
                    <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Date</th>
                        <th>Name</th>
                        <th>Payment</th>
                        <th>id</th>
                    </tr>
                    </tfoot>
                </table>
            </div><!-- /.box-body -->
        </div>
        </div>
      
      


<script>


   
</script>
