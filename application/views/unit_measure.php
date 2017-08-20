
<div class="col-md-12">
    <div class="card">
        <!-- <div class="header">
            <h5 class="title">Unit Measure</h5>
            
        </div> -->
        <div class="row">
            <div class="col-md-12">
                <a href="<?php echo base_url('site/add_unit_measure') ?>" class="btn btn-default btn-md pull-right add-btn" >Add Unit Measure</a>
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
                            <?php echo $value["type"]; ?>
                        </td>
                        <td>
                            <?php echo $value['qty'] ?>
                        </td>
                        <td>
                            <?php echo $value['description'] ?>
                        </td>
                        <td class="action">
                            <a href='<?php echo base_url('site/add_unit_measure/').$value['id'] ?>'><i class='fa fa-edit' aria-hidden='true' title="Edit"></i></a>
                            <a href='#' onclick='Dashboard.openModal(this,<?php echo json_encode($value); ?>, "unit_measure")'><i class='fa fa-trash-o' aria-hidden='true' title="Delete"></i></a>
                        </td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>