
<div class="col-md-12">
    <div class="card">
       <!--  <div class="header">
            <h4 class="title"> Add Company </h4>
        </div> -->
        <div class="content">
            <form method="post" action="<?php echo base_url('site/add_company_info') ?>" enctype="multipart/form-data">
                <input type="hidden" value="<?= @$companyInfo['id'] ?>" name="company_id"></input>
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label>Company Name</label> <small class="required">*</small>
                            <input type="text" class="form-control" name="c_name"  placeholder="Please enter company name" value="<?= @$companyInfo['name'] ?>" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Mobile</label> <small class="required">*</small>
                            <input type="number" class="form-control" name="mobile" placeholder="Please enter mobile number" value="<?= @$companyInfo['mobile_one'] ?>" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Mobile 2</label>
                            <input type="number" name="mobile_2" class="form-control" placeholder="Please enter mobile number" value="<?= @$companyInfo['mobile_two'] ?>">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Owner First Name</label> <small class="required">*</small>
                            <input type="text" class="form-control" name="o_fname" placeholder="Please enter owner first name" value="<?= @$companyInfo['owner_fname'] ?>" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Owner Last Name</label> <small class="required">*</small>
                            <input type="text" class="form-control" name="o_lname" placeholder="Please enter owner last name" value="<?= @$companyInfo['owner_lname'] ?>" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Address</label> <small class="required">*</small>
                            <input type="text" class="form-control" name="address" placeholder="Please enter address last name" value="<?= @$companyInfo['address'] ?>" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Pin Code</label> <small class="required">*</small>
                            <input type="number" class="form-control" name="pin_code" placeholder="Please enter pin code" value="<?= @$companyInfo['pin_code'] ?>" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" placeholder="Please enter email" value="<?= @$companyInfo['email'] ?>" >
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Website</label>
                            <input type="text" class="form-control" name="website" placeholder="Please enter website" value="<?= @$companyInfo['website'] ?>">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>GST Number</label> <small class="required">*</small>
                            <input type="text" class="form-control" name="gst_no" placeholder="Please enter GST number" value="<?= @$companyInfo['gst_no'] ?>" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Logo</label>
                            <input type="file" class="form-control" name="file" value="<?= @$companyInfo['logo'] ?>">
                        </div>
                    </div>
                <?php 
                    if(@$companyInfo['logo']){ ?>
                        <div class="col-md-2">
                            <a href="#" class="thumbnail">
                              <img src="<?= base_url('assets/uploads/').@$companyInfo['logo'] ?>" alt="logo">
                            </a>
                          </div>
                        </div>
                <?php } ?>
                <div class="col-md-12">
                    <small class="pull-left required" >* </small><small>Required Fileds</small>
                    <button type="submit" class="btn btn-info btn-fill pull-right">Add Company Detail.</button>
                </div>
                <div class="clearfix"></div>
            </form>
        </div>
    </div>
</div>