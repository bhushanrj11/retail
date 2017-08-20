
<div class="col-md-12">
    <div class="card">
        <!-- <div class="header">
            <h4 class="title"> Add Items </h4>
        </div> -->
        <div class="content">
            <form class="form-horizontal" method="post" action="<?php echo base_url('site/add_item') ?>" enctype="multipart/form-data">
                <input type="hidden" value="<?= @$info['id'] ?>" name="id"></input>
                <div class="form-group">
                   <label class="control-label col-md-1" for="email">Company:</label>
                   <div class="col-sm-11">
                        <select class="form-control" name="company_info_id" required="" autofocus>
                            <option value="">Please Select Company</option>
                            <?php foreach ($companyInfoDropdown as $key => $value) {
                                    $name = $companyInfoDropdown[$key]['name'];
                                    $id = $companyInfoDropdown[$key]['id'];
                                ?>
                                    <option value="<?= $id ?>"> 
                                            <?= $name ?>
                                    </option>
                                <?php
                            } ?>
                        </select>
                   </div>
                 </div>    

                 <div class="form-group">
                    <label class="control-label col-md-1" for="email">Customer:</label>
                    <div class="col-sm-11">
                         <select class="form-control" name="customer_info_id" required="" onchange = "Dashboard.onChangeDropdown(this,'customer_info')" autofocus>
                             <option value="">Please Select Customer</option>
                             <?php foreach ($customerInfoDropdown as $key => $value) {
                                     $name = $customerInfoDropdown[$key]['fname'] . " " . $customerInfoDropdown[$key]['lname'];
                                     $id = $customerInfoDropdown[$key]['id'];
                                 ?>
                                     <option data-companyinfo='<?= json_encode($customerInfoDropdown[$key]) ?>'
                                             value="<?= $id ?>"> 
                                             <?= $name ?>
                                     </option>
                                 <?php
                             } ?>
                         </select>
                    </div>
                  </div>    

                <div class="show-on-selection">
                    <div class="form-group">
                       <label class="control-label col-md-1" for="email">Address:</label>
                       <div class="col-sm-7">
                            <input type="text" class="form-control transpernt-form" name="address" value="">
                       </div>
                       <label class="control-label col-md-1" for="Pin Code">Pin Code:</label>
                        <div class="col-sm-3">
                            <input type="number" class="form-control transpernt-form" name="pin_code" value="">
                        </div>
                     </div>
                    
                    <div class="form-group">
                        <label class="control-label col-md-1" for="Mobile">Mobile:</label>
                        <div class="col-sm-3">
                            <input type="number" class="form-control transpernt-form" name="mobile" value="">
                        </div>
                        <label class="control-label col-md-1" for="Email">Email:</label>
                        <div class="col-sm-3">
                            <input type="email" class="form-control transpernt-form" name="email" value="">
                        </div>
                        <label class="control-label col-md-1" for="Email">GST No:</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control transpernt-form" name="gst_no" value="" disabled>
                        </div>
                    </div> 

                    <div class="form-group">
                        <label class="control-label col-md-1" for="Order Date">Order Date:</label>
                        <div class="col-sm-5">
                            <input type="date" class="form-control" name="order_date" value="<?php echo date('Y-m-d'); ?>" onchange="Dashboard.changedOrderDate(this)">
                        </div>
                        <label class="control-label col-md-1" for="Delivery Date">Delivery Date:</label>
                        <div class="col-sm-5">
                           <input type="date" class="form-control" name="delivery_date" value="<?php echo date('Y-m-d'); ?>">
                        </div>
                    </div>                    
                    <!-- <div class="col-md-12">
                        <small class="pull-left required" >* </small><small>Required Fileds</small>
                        <button type="submit" class="btn btn-info btn-fill pull-right">Add Item.</button>
                    </div> -->
                </div>    
                <div class="clearfix"></div>
                <hr class="show-on-selection" >

                <div class="container-fluid show-on-selection">
                    <!-- <h2>Basic Table</h2> -->
                    <!-- <p>Place Order:</p>  -->
                    <table class="table">
                        <thead>
                          <tr>
                            <th width="20%">Item Name</th>
                            <th width="15%">Number</th>
                            <th width="15%" class="text-right">Sale Price</th>
                            <th width="15%" class="text-right">Qty</th>
                            <th width="10%" class="text-right">Disc.</th>
                            <th width="20%" class="text-right">Amount</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>
                                <select class="form-control" name="item_id" required="" onchange='Dashboard.setItem(this,"number",<?= json_encode($info) ?>)'>
                                    <option value="">Select Item </option>
                                    <?php foreach ($info as $key => $value) {
                                            $name = $info[$key]['name'];
                                            $id = $info[$key]['id'];
                                        ?>
                                            <option value="<?= $id ?>"> <?= $name ?></option>
                                        <?php
                                    } ?>
                                </select>
                            </td>
                            <td class="item-number" > 
                                <select class="form-control" name="number" required="" onchange='Dashboard.setItem(this,"compony_info_id",<?= json_encode($info) ?>)'>
                                    <option value="">Select Number </option>
                                        <?php foreach ($info as $key => $value) {
                                            $name = $info[$key]['name'];
                                            $id = $info[$key]['id'];
                                        ?>
                                        <option value="<?= $id ?>"> 
                                            <?= $id ?>
                                        </option>
                                        <?php
                                    } ?>
                                </select>
                            </td>
                            <td><input class="form-control text-right" type="number" name="sale_price" min="0"></td>
                            <td> <input class="form-control text-right" type="number" name="qty" onchange="Dashboard.updateAmount(this)" min="0"></input> </td>
                            <td> <input class="form-control text-right" type="number" name="discount" onchange="Dashboard.updateAmount(this)" value="0" min="0"></input> </td>
                            <td> <input class="form-control text-right" type="number" name="amount" onchange="Dashboard.updateAmount(this)" disabled ></input> </td>
                            <td> <a href='#' onclick='Dashboard.saleOrderChangenNewLine(this,"minus")'><i class='fa fa-minus' aria-hidden='true' title="Edit"></i></a>
                            <a href='#' onclick='Dashboard.saleOrderChangenNewLine(this,"plus")'><i class='fa fa-plus' aria-hidden='true' title="Delete"></i></a> </td>
                          </tr>
                        </tbody>
                    </table>
                    <div class="amounts-section">   
                        <div class="row">
                            <div  class="col-md-1 final-number pull-right" id="excluding-amount-gst">0</div> <div class="col-md-2 bold text-right pull-right">Excluding GST : </div> 
                        </div>    
                        <div class="row">
                            <div  class="col-md-1 final-number pull-right" id="total-discount">0</div> <div class="col-md-2 bold text-right pull-right">Discount : </div> 
                        </div>
                        <div class="row">
                            <div  class="col-md-1 final-number pull-right" id="sgst">0</div> <div class="col-md-2 bold text-right pull-right">SGST (9%) : </div>
                        </div>
                        <div class="row">
                            <div  class="col-md-1 final-number pull-right" id="cgst">0</div><div class="col-md-2 bold text-right pull-right">CGST (9%) : </div>
                        </div>
                        <hr/>
                        <div class="row">    
                            <div  class="col-md-1 final-number pull-right" id="total-amount">0</div><div class="col-md-2 bold text-right pull-right">Total Amount : </div>
                        </div>    
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-4 pull-right">
                            <button type="button" class="btn btn-info btn-fill pull-right btn-save-print">Save & Print.</button>
                            <button type="button" class="btn btn-success btn-fill pull-right" onclick = "Dashboard.savaeSalesOrder(this)">Save.</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>