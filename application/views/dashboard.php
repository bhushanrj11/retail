<div class="col-md-12">
    <div class="card">
        <!-- <div class="header">
            <h5 class="title">User Details</h5>
            <p class="category">Here is a subtitle for this table</p>
        </div> -->
        <div class="content table-responsive table-full-width">
            <table id="dataTable" class="table table-hover table-striped">
                <thead>
                    <!-- <?php foreach ($tableHeading as $key => $value): 
                        echo "<th>$value</th>";
                    endforeach ?> -->
                </thead>
                <tbody>
                   <!--  <?php foreach ($allUsers as $key => $value): ?>
                    <tr id="<?php echo "table-Row-".$value['id'] ?>">
                        <td>
                            <?php echo $key+1; ?>
                        </td>
                        <td>
                            <?php echo $value["first_name"]." ".$value["last_name"]; ?>
                        </td>
                        <td>
                            <?php echo $value["company_name"]; ?>
                        </td>
                        <td>
                            <?php echo $value['mobile']; ?>
                        </td>
                        <td>
                            <?php echo $value['email'] ?>
                        </td>
                        <td>
                            <?php echo $value['country'] ?>
                        </td>
                        <td class="status">
                            <?php echo $value['status'] ?>
                        </td>
                        <td class="action">
                            <?php if($value['is_approve'] == 0){ ?>
                                <a href='#' onclick='Dashboard.openModal(<?php echo json_encode($value); ?>, "A")'><i class='fa fa-check' aria-hidden='true' title="Approve"></i></a>
                                <a href='#' onclick='Dashboard.openModal(<?php echo json_encode($value); ?>, "R")'><i class='fa fa-ban' aria-hidden='true' title="Reject"></i></a>
                            <?php } else { ?>
                                <a href='#' onclick='Dashboard.openModal(<?php echo json_encode($value); ?>, "D")'><i class='fa fa-trash' aria-hidden='true' title="Delete"></i></a>
                            <?php } ?>
                        </td>
                    </tr>
                    <?php endforeach ?> -->
                </tbody>
            </table>
        </div>
    </div>
</div>