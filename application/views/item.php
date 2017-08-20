
<div class="col-md-12">
    <div class="card">
        <!-- <div class="header">
            <h5 class="title">Item</h5>
           
        </div> -->
        <div class="row">
            <div class="col-md-12">
                <a href="<?php echo base_url('site/add_item') ?>" class="btn btn-default btn-md pull-right add-btn" >Add Item</a>
            </div>
        </div>
        <div class="content table-responsive table-full-width">
            
            <table id="dataTable" class="table table-hover table-striped">
                <thead>
                    <?php foreach ($tableHeading as $key => $value): 
                        echo "<th>$value</th>";
                    endforeach ?> 
                </thead>
                <tbody>
                    <?php foreach ($info as $key => $value): ?>
                    <tr id="<?php echo "table-Row-".$value['id'] ?>">
                        <td>
                            <?php echo $key+1; ?>
                        </td>
                        <td class="name">
                            <?php echo $value["name"]; ?>
                        </td>

                        <td>
                            <?php echo $value['number']; ?>
                        </td>
                        <td>
                            <?php echo $value['qty'] ?>
                        </td>
                        <td>
                            <?php echo $value['unit_measure'] ?>
                        </td>
                        <td>
                            <?php echo $value['sell_price'] ?>
                        </td>
                        
                        <td>
                            <?php echo $value['company_name']; ?>
                        </td>
                        <td class="action">
                            <a href='<?php echo base_url('site/add_item/').$value['id'] ?>'><i class='fa fa-edit' aria-hidden='true' title="Edit"></i></a>
                            <a href='#' onclick='Dashboard.openModal(this,<?php echo json_encode($value); ?>, "item")'><i class='fa fa-trash-o' aria-hidden='true' title="Delete"></i></a>
                        </td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>