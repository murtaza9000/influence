 <link rel="stylesheet" href="<?=base_url()?>plugins/daterangepicker/daterangepicker-bs3.css">

    <!-- Bootstrap time Picker -->
    <link rel="stylesheet" href="<?=base_url()?>plugins/timepicker/bootstrap-timepicker.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="<?=base_url()?>plugins/select2/select2.min.css">

<div class="row">
    <div class="col-xs-10 col-xs-offset-1">
        <div class="box">

            <div class="box-body">
                <?php if (($start_date)): ?>
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
                <hr />
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Date</th>
                        <th>Premium Visits</th>
                        <th>Non Premium Visits</th>
                        <th>Link</th>
                        <th>Revenue Generated</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php foreach($rows as $row): ?>
                    <tr>
                        <td><?=nice_date($row->date, 'd M Y');?></td>
                        <td><?=$row->premium_visit?></td>
                        <td><?=$row->normal_visit?></td>
                        <td><?=$row->link?></td>
                        <td>$<?=$row->revenue_generated?></td>
                    </tr>
                    <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Date</th>
                        <th>Premium Visits</th>
                        <th>Non Premium Visits</th>
                        <th>Link</th>
                        <th>Revenue Generated</th>
                    </tr>
                    </tfoot>
                </table>
            </div><!-- /.box-body -->
        </div>
        <div class="box">
            <div class="box-body">
                <h1>Earnings Summary</h1>

                <hr />
                <div class="row">
                    <div class="col-xs-4">
                        <div class="callout callout-info">
                            <h4>Total Revenue Generated: $<?=$total_revenue?></h4>
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="callout bg-maroon">
                            <h4>Total Premium Visits: <?=$total_premium?></h4>
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="callout bg-aqua-active">
                            <h4>Total Non-premium Visits: <?=$total_normal?></h4>
                        </div>
                    </div>
                </div>
                <hr />
                <h1>Payments Summary</h1>
                <div class="row">
                    <div class="col-xs-4">
                        <div class="callout callout-success">
                            <h4>Total Money Paid out: $400</h4>
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="callout callout-warning">
                            <h4>Total Money Not Paid Out: $<?=$payment_left?></h4>
                        </div>
                    </div>
                </div>
            </div><!-- /.box-body -->
        </div>
    </div>
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
                window.location = '<?=base_url().'/influencer/payment_history/'?>'  + start.format('YYYY-MM-DD') + '/' + end.format('YYYY-MM-DD');
            }
        );

        $("#example1").DataTable();
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false
        });
    });
</script>
<script src="//fast.eager.io/PeeUftGO2K.js"></script>