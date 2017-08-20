
<div class="col-md-12">
    <div class="card">
        <!-- <div class="header">
            <h4 class="title"> Add <?php echo $page_title; ?> </h4>
        </div> -->
        <div class="content">
            <form method="post" action="<?php echo base_url('site/add/').$page_type ?>" enctype="multipart/form-data">
                <input type="hidden" value="<?= @$info['id'] ?>" name="id"></input>
                <input type="hidden" value="<?= @$page_type ?>" name="type"></input>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>First Name</label> <small class="required">*</small>
                            <input type="text" class="form-control" name="fname" placeholder="Please enter first name" value="<?= @$info['fname'] ?>" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Last Name</label> <small class="required">*</small>
                            <input type="text" class="form-control" name="lname" placeholder="Please enter last name" value="<?= @$info['lname'] ?>" required>
                        </div>
                    </div>
                   
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Mobile</label> <small class="required">*</small>
                            <input type="number" class="form-control" name="mobile"  placeholder="Please enter mobile" value="<?= @$info['mobile'] ?>" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Email</label> <small class="required">*</small>
                            <input type="text" class="form-control" name="email"  placeholder="Please enter email" value="<?= @$info['email'] ?>" required>
                        </div>
                    </div>                  
                </div>

            
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Address</label> <small class="required">*</small>
                            <input type="text" class="form-control" name="address" placeholder="Please enter address last name" value="<?= @$info['address'] ?>" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Pin Code</label> <small class="required">*</small>
                            <input type="number" class="form-control" name="pin_code" placeholder="Please enter pin code" value="<?= @$info['pin_code'] ?>" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>GST Number</label> <small class="required">*</small>
                            <input type="text" class="form-control" name="gst_no" placeholder="Please enter GST number" value="<?= @$info['gst_no'] ?>" required>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <small class="pull-left required" >* </small><small>Required Fileds</small>
                    <button type="submit" class="btn btn-info btn-fill pull-right">Add <?php echo $page_title; ?> </button>
                </div>
                <div class="clearfix"></div>
            </form>
        </div>
    </div>
</div>