<div class="col-md-12">
    <div class="card">
        <div class="header">
            
            <select class="form-control" onchange="Dashboard.setOrderView(this)" autofocus>
                <option value="pending">Pending Orders</option>
                <option value="complete">Complete Orders</option>
            </select>
           
        </div>
        <div class="row">
            <div class="col-md-12">
                <a href="<?php echo base_url('site/add_purchase_order') ?>" class="btn btn-default btn-md pull-right add-btn" >Add Purchase Order</a>
            </div>
        </div> 
        <div class="content table-responsive table-full-width" id="pending">
            
            <table id="dataTable" class="table table-hover table-striped">
                <thead>
                    <?php foreach ($tableHeading as $key => $value): 
                        echo "<th>$value</th>";
                    endforeach ?> 
                </thead>
                <tbody>
                    <?php foreach ($orders as $key => $value): ?>
                    <tr id="<?php echo "table-Row-".$value['sales_header_id'] ?>">
                        <td>
                            <?php echo $key+1; ?>
                        </td>
                        <td class="name">
                            <?php echo $value["compony_name"]; ?>
                        </td>
                        <td>
                            <?php echo $value["cutomer_name"]; ?>
                        </td>
                        <td class="">
                            <?php echo $value["sales_header_id"]; ?>
                        </td>
                        <td>
                            <?php echo $value["total_amount"]; ?>
                        </td>
                        <td>
                            <?php echo $value["order_date"]; ?>
                        </td>
                        <td class="action">
                            <a href='<?php echo base_url('site/add_purchase_order/').$value['sales_header_id'] ?>'><i class='fa fa-edit' aria-hidden='true' title="Edit"></i></a>
                            <a href='#' class="<?= $value['is_order_complete'] == 'YES' ? 'not-allowed' : '' ?>" onclick='Dashboard.openModal(this,<?php echo json_encode($value); ?>, "purchase_orders")' ><i class='fa fa-trash-o' aria-hidden='true' title="Delete"></i></a>
                        </td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>

        <div class="content table-responsive table-full-width" id="complete" style="display:none">
            
            <table id="dataTable" class="table table-hover table-striped">
                <thead>
                    <?php foreach ($tableHeading as $key => $value): 
                        echo "<th>$value</th>";
                    endforeach ?> 
                </thead>
                <tbody>
                    <?php foreach ($completeOrders as $key => $value): ?>
                    <tr id="<?php echo "table-Row-".$value['sales_header_id'] ?>">
                        <td>
                            <?php echo $key+1; ?>
                        </td>
                        <td class="name">
                            <?php echo $value["compony_name"]; ?>
                        </td>
                        <td>
                            <?php echo $value["cutomer_name"]; ?>
                        </td>
                        <td class="">
                            <?php echo $value["sales_header_id"]; ?>
                        </td>
                        <td>
                            <?php echo $value["total_amount"]; ?>
                        </td>
                        <td>
                            <?php echo $value["order_date"]; ?>
                        </td>
                        <td class="action">
                            <a href='<?php echo base_url('site/add_purchase_order/').$value['sales_header_id'] ?>'><i class='fa fa-edit' aria-hidden='true' title="Edit"></i></a>
                            <a href='#' class="<?= $value['is_order_complete'] == 'YES' ? 'not-allowed' : '' ?>" onclick='Dashboard.openModal(this,<?php echo json_encode($value); ?>, "orders")' ><i class='fa fa-trash-o' aria-hidden='true' title="Delete"></i></a>
                        </td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>