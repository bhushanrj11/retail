
<div class="col-md-12">
    <div class="card">
        <!-- <div class="header">
            <h4 class="title"> Add Unit Measure </h4>
        </div> -->
        <div class="content">
            <form method="post" action="<?php echo base_url('site/add_unit_measure') ?>" enctype="multipart/form-data">
                <input type="hidden" value="<?= @$info['id'] ?>" name="id"></input>
                <div class="row">
                <div class="col-md-12 padding-6">
                    <div class="form-group">
                        <label>Type</label> <small class="required">*</small>
                        <input type="text" class="form-control" name="type" placeholder="Please enter type" value="<?= @$info['type'] ?>" required>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Quantity</label> <small class="required">*</small>
                        <input type="number" class="form-control" name="qty" placeholder="Please enter quantity" value="<?= @$info['qty'] ?>" min="1" required>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Description </label> <small class="required">*</small>
                        <input type="text" class="form-control" name="description" placeholder="Please enter description" value="<?= @$info['description'] ?>" required>
                    </div>
                </div>
                <div class="col-md-12">
                    <small class="pull-left required" >* </small><small>Required Fileds</small>
                    <button type="submit" class="btn btn-info btn-fill pull-right">Add Item.</button>
                </div>
                <div class="clearfix"></div>
            </form>
        </div>
    </div>
</div>