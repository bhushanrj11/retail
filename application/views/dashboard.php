<div class="col-md-12">
    <div class="card">
        <div class="content" style="min-height: 600px;">
            <div class="panel panel-primary col-md-4 panel-user">
              <div class="panel-heading text-center">Total Sell</div>
              <div class="panel-body text-center">
                <i class="fa fa-rupee"></i><?= $total_sell; ?>
              </div>
            </div>

            <div class="panel panel-success col-md-4 panel-user">
              <div class="panel-heading text-center">Total Orders</div>
              <div class="panel-body text-center">
                <?= $total_orders; ?>
              </div>
            </div>

            <div class="panel panel-info col-md-4 panel-user">
              <div class="panel-heading text-center">Total Customers</div>
              <div class="panel-body text-center">
                <?= $total_cust; ?>
              </div>
            </div>
            <div class="panel panel-warning col-md-4 panel-user">
              <div class="panel-heading text-center">Total Venders</div>
              <div class="panel-body text-center">
                <?= $total_vender; ?>
              </div>
            </div>
        </div>
    </div>
</div>