
<div class="col-md-12">
    <div class="card">
        <!-- <div class="header">
            <h4 class="title"> Add Items </h4>
        </div> -->
        <div class="content">
            <form method="post" action="<?php echo base_url('site/add_item') ?>" enctype="multipart/form-data">
                <input type="hidden" value="<?= @$info['id'] ?>" name="id"></input>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Name</label> <small class="required">*</small>
                            <input type="text" class="form-control" name="name" placeholder="Please enter name" value="<?= @$info['name'] ?>" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Company Name</label> <small class="required">*</small>
                            <select class="form-control" name="compony_info_id" required="">
                                <option value="">Please Select </option>
                                <?php foreach ($companyInfoDropdown as $key => $value) {
                                        $name = $companyInfoDropdown[$key]['name'];
                                        $id = $companyInfoDropdown[$key]['id'];
                                    ?>
                                        <option value="<?= $id ?>" <?= @$info['compony_info_id'] == $id ? "selected" : "" ?> > <?= $name ?></option>
                                    <?php
                                } ?><!-- 
                                <option value="KG" <?= @$info['unit_measure'] == 'KG' ? "selected" : "" ?> >KG</option>
                                <option value="PIECES" <?=  @$info['unit_measure'] == 'PIECES' ? "selected" : "" ?> >Pieces</option> -->
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Item Number</label> <small class="required">*</small>
                            <input type="text" class="form-control" name="number" data-target="item" placeholder="Please enter item number" value="<?= @$info['number'] ?>" onfocusout="Dashboard.validationOfDuplicateNumber(this)" min="1" required>
                        </div>
                    </div>
                   <div class="col-md-4">
                        <div class="form-group">
                            <label>Inventory</label> <small class="required">*</small>
                            <input type="number" class="form-control" name="qty"  placeholder="Please enter inventory" value="<?= @$info['qty'] ?>" min="1" required>
                        </div>
                    </div>
                     <div class="col-md-4">
                        <div class="form-group">
                            <label>Purchase Price</label> <small class="required">*</small>
                            <input type="number" class="form-control" name="purchase_price"  placeholder="Please enter purchase price" value="<?= @$info['purchase_price'] ?>" min="1" required>
                        </div>
                    </div> 
                     <div class="col-md-4">
                        <div class="form-group">
                            <label>Sell Price</label> <small class="required">*</small>
                            <input type="number" class="form-control" name="sell_price"  placeholder="Please enter sell price" value="<?= @$info['sell_price'] ?>" min="1" required>
                        </div>
                    </div>
                   
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Unit Measure</label> <small class="required">*</small>
                            <select class="form-control" name="unit_measure" required="">
                                <option value="">Please Select</option>
                                <?php foreach ($unitMeasure as $key => $value) {
                                        $type = $unitMeasure[$key]['type'];
                                    ?>
                                        <option value="<?= $type ?>" <?= @$info['unit_measure'] == $type ? "selected" : "" ?> > <?= $type ?></option>
                                    <?php
                                } ?><!-- 
                                <option value="KG" <?= @$info['unit_measure'] == 'KG' ? "selected" : "" ?> >KG</option>
                                <option value="PIECES" <?=  @$info['unit_measure'] == 'PIECES' ? "selected" : "" ?> >Pieces</option> -->
                            </select>
                        </div>
                    </div> 
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Barcode Number</label> 
                            <input type="text" class="form-control" name="barcode"  placeholder="Please enter barcode number" value="<?= @$info['barcode'] ?>" >
                        </div>
                    </div>   
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Discount Percentage</label> 
                            <input type="number" class="form-control" name="discount_perc"  placeholder="Please enter discount percentage" value="<?= @$info['discount_perc'] ?>" >
                        </div>
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