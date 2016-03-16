

<div class="row">
    <div class="col-xs-10 col-xs-offset-1">
        <div class="box">

            <div class="box-body">
                <?php if (isset($start_date)): ?>
                    <h2>Summary from: <?=nice_date($start_date, 'd M Y');?> to <?=nice_date($end_date, 'd M Y');?></h2>
                <?php else: ?>
                    <h2>Summary from all time</h2>
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
                        </div><!-- /.form group -->
                    </div>
                </div>
               
                 <table id="example1" class="table table-bordered table-striped dataTable">
                    <thead>
                    <tr>
                        <th>Date</th>
                        <th>Name</th>
                        <th>Payment</th>
                        
                        
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
                       
                    </tr>
                    </tfoot>
                </table>
            </div><!-- /.box-body -->
        </div>
      

 
<script>


    $(function () {
        //Date range as a button
        $('#daterange-btn').daterangepicker(
            {
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                //startDate: moment().subtract(29, 'days'),
                //endDate: moment()
            },
            function (start, end) {
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                window.location = '<?=base_url().'/influencer/checkout/'?>'  + start.format('YYYY-MM-DD') + '/' + end.format('YYYY-MM-DD');
            }
        );

      
    });
   
</script>
