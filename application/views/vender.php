
<div class="col-md-12">
    <div class="card">
        <!-- <div class="header">
            <h5 class="title"><?php echo $page_title; ?> Info</h5>
            <p class="category">Here is a subtitle for this table</p>
        </div> -->
        <div class="row">
            <div class="col-md-12">
                <a href="<?php echo base_url('site/add/0/').$page_type ?>" class="btn btn-default btn-md pull-right add-btn" >Add <?= $page_title ?></a>
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
                            <?php echo $value["fname"]." ".$value["lname"]; ?>
                        </td>
                        <td>
                            <?php echo $value['address']; ?>
                        </td>
                        <td>
                            <?php echo $value['mobile'] ?>
                        </td>
                        <td>
                            <?php echo $value['email'] ?>
                        </td>
                        <td>
                            <?php echo $value['gst_no'] ?>
                        </td>
                        <td class="action">
                            <a href='<?php echo base_url('site/add/').$value['id']."/".$page_type ?>'><i class='fa fa-edit' aria-hidden='true' title="Edit"></i></a>
                            <a href='#' onclick='Dashboard.openModal(this,<?php echo json_encode($value); ?>, "vender")'><i class='fa fa-trash-o' aria-hidden='true' title="Delete"></i></a>
                        </td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>