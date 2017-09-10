
<html>
 
    <head>
    <title>Print Invoice</title>
        <style type="text/css">
        body {      
            font-family: Verdana;
        }
         
        div.invoice {
        border:1px solid #ccc;
        padding:10px;
        height:740pt;
        width:570pt;
        }
 
        div.company-address {
            border:1px solid #ccc;
            float:left;
            width:280pt;
        }
         
        div.invoice-details {
            border:1px solid #ccc;
            float:right;
            width:200pt;
        }
         
        div.customer-address {
            border:1px solid #ccc;
            float:left;
            margin-bottom:50px;
            margin-left: 7pt;
            width: 280pt;
        }
         
        div.clear-fix {
            clear:both;
            float:none;
        }
         
        table {
            width:100%;
        }
         
        th {
            text-align: left;
        }
         
        td {
        }
         
        .text-left {
            text-align:left;
        }
         
        .text-center {
            text-align:center;
        }
         
        .text-right {
            text-align:right;
        }

        body{
            width: 100%;
        }
        .logo{
            width: 12%;
        } 
        .invoice-no{
            float: left;
            width: 300pt;
        }
        .invoice-date{
            float: right;
        }
        </style>
    </head>
 
    <body>
    <div class="invoice">
        <div class="text-center">
            <div>
                <img class="logo" src="<?= base_url('assets/img/tmp.svg.png'); ?>">
            </div>    
            <div>
                <h3>Bill Invoice</h3>
            </div>
        </div>
        <div class="invoice-no">
            Invoice No: <strong><?= $printInfo['formDetails']['lineData'][0]['sales_header_id']; ?></strong>
        </div>
        <div class="invoice-date">
            <?php 
                $myDateTime = DateTime::createFromFormat('Y-m-d', $printInfo['formDetails']['headerData']['order_date']);
                $orderDate = $myDateTime->format('d-M-Y');
            ?>
            Order Date: <?= $orderDate; ?>
        </div>
        <br>
        <div class="invoice-date">
            <?php 
                $myDeliveryDateTime = DateTime::createFromFormat('Y-m-d', $printInfo['formDetails']['headerData']['delivery_date']);
                $deliveryDate = $myDeliveryDateTime->format('d-M-Y');
            ?>

            Delivery Date: <?= $deliveryDate; ?>
        </div>
        <br> 
        <br> 
        <div class="company-address">
            Company:
            <br>
            <strong><?= $printInfo['company_info'][0]['name']; ?></strong>
            <br>
            <?= $printInfo['company_info'][0]['address']; ?>
            <br>
            <?= $printInfo['company_info'][0]['pin_code']; ?>
            <br>
            Contact: <?= $printInfo['company_info'][0]['mobile_one']; ?>
                     <?= $printInfo['company_info'][0]['email']; ?>
            <br>
            GST No: <?= $printInfo['company_info'][0]['gst_no']; ?>
            
            
        </div>
        
        <div class="customer-address">
            Buyer:
            <br />
            <strong><?= $printInfo['cust_name']; ?></strong>
            <br />
            <?= $printInfo['formDetails']['headerData']['cust_address']; ?>
            <br />
            <?= $printInfo['formDetails']['headerData']['cust_pin']; ?>
            <br>
            Contact: <?= $printInfo['formDetails']['headerData']['cust_mobile']; ?>
            <?= $printInfo['formDetails']['headerData']['cust_email']; ?>
            <br>
            GST No: <?= $printInfo['formDetails']['headerData']['cust_gst_no']; ?>
        </div>
         
        <div class="clear-fix"></div>
            <table border='1' cellspacing='0'>
                <tr>
                    <th width=150>Item Name</th>
                    <th width=100>Qty.</th>
                    <th width=100>Vender Price</th>
                    <!-- <th width=80>Sale Price</th> -->
                    <th width=100>Amount</th>
                </tr>
 
            <?php
            
            $lineData = $printInfo['formDetails']['lineData'];
            $lineDataLength = count($printInfo['formDetails']['lineData']);
             
             
            for($i=0;$i<$lineDataLength;$i++) { ?>
                <tr>
                    <td>
                        <?= $lineData[$i]['item_name']; ?>
                    </td>
                    
                    <td>
                        <?= $lineData[$i]['item_qty']; ?>
                    </td>
                    <td>
                        <?= $lineData[$i]['item_vender_price']; ?>
                    </td>
                    <!-- <td>
                        <?= $lineData[$i]['item_sales_price']; ?>
                    </td> -->
                   
                    <td>
                        <?= $lineData[$i]['item_line_amount']; ?>
                    </td>
                </tr>

            <?php } ?>
           <?php  
            echo("<tr>");
            echo("<td colspan='3' class='text-right'>Excluding GST:</td>");
            echo("<td class='text-right'>" . $printInfo['formDetails']['headerData']['amount_exlcuding_gst'] . "</td>");
            echo("</tr>");
            echo("<tr>");
            echo("</tr>");
            ?>
            <?php  
            echo("<tr>");
            echo("<td colspan='3' class='text-right'>SGST : </td>");
            echo("<td class='text-right'>" . $printInfo['formDetails']['headerData']['sgst'] . "</td>");
            echo("</tr>");
            echo("<tr>");
            echo("<td colspan='3' class='text-right'>CGST :</td>");
            echo("<td class='text-right'>" . $printInfo['formDetails']['headerData']['cgst'] . "</td>");
            echo("</tr>");
            echo("<tr>");
            echo("<td colspan='3' class='text-right'><b>TOTAL AMOUNT</b></td>");
            echo("<td class='text-right'><b>" . $printInfo['formDetails']['headerData']['total_amount'] . "</b></td>");
            echo("</tr>");
            ?>
            </table>
        </div>
        <script type="text/javascript">
            window.print();
        </script>
    </body>
 
</html>