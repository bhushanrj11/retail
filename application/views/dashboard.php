<input type="hidden" value='<?= $loadGraphSeriesLables; ?>' id="loadGraphSeriesLables">


<div class="col-md-12">
    <div class="card">
        <div class="row">
          <div class="col-md-12 text-center">

            <form class="form-inline date-form" method="post" action="<?= base_url('site/dashbord') ?>">
              <div class="form-group">
                <label for="email">Type:</label>
                <select class="form-control">
                  <option value="day" selected>Date</option>
                  <option value="weekly">Weekly</option>
                  <option value="monthly">Monthly</option>
                </select>
              </div>
              <div class="form-group">
                <label for="email">Start Date:</label>
                <input type="date" class="form-control" name="start_date" >
              </div>
              <div class="form-group">
                <label for="pwd">End Date:</label>
                <input type="date" class="form-control" name="end_date">
              </div>
              
              <button type="submit" class="btn btn-success btn-sm">Submit</button>
            </form>

          </div>
        </div>

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
            <div class="row">
              <div class="panel panel-primary col-md-12 panel-graph">
                <div class="panel-heading text-left">Sells</div>
                <div class="panel-body text-center">
                  <div id="chartActivity" class="ct-chart"></div>
                </div>
              </div>
            </div>
        </div>
    </div>
</div>