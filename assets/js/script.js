'use strict';
var Dashboard = Dashboard || function() {
    var data = {
        urlStocks: JSON.parse($('#Urlstocks').val()),
        baseUrl: $('#baseUrl').val(),
        table:'',
        load: function() {    
            this.table = $('#dataTable').DataTable();
            var header_data = $('[name="header_data"]').val();
            var purchase_header_data = $('[name="purchase_header_data"]').val();
            var loadGraphDataValues = $('#loadGraphSeriesLables').val();
            
            if(header_data && JSON.parse(header_data)['saleHeader']){
                this.setSellOrderEdit(JSON.parse(header_data));
            }

            if(purchase_header_data && JSON.parse(purchase_header_data)['saleHeader']){
                this.setSellPurchaseOrderEdit(JSON.parse(purchase_header_data));
            }

            if(loadGraphDataValues){
                this.loadGraph();
            }

        },
        loadGraph: function(){
            var values = JSON.parse($('#loadGraphSeriesLables').val()),
                data = {
                  labels: values[0],
                  series: [
                    values[1]
                  ]
                },
                options = {
                    seriesBarDistance: 10,
                    axisX: {
                        showGrid: false
                    },
                    height: "300px"
                },
                responsiveOptions = [
                  ['screen and (max-width: 640px)', {
                    seriesBarDistance: 5,
                    axisX: {
                      labelInterpolationFnc: function (value) {
                        return value[0];
                      }
                    }
                  }]
                ];
            $('[name="start_date"]').val(values[2]);    
            $('[name="end_date"]').val(values[3]);    

            Chartist.Bar('#chartActivity', data, options, responsiveOptions);
        },
        setSellPurchaseOrderEdit: function(obj){
            var saleHeader = obj.saleHeader[0],
                saleLines = obj.saleLines,
                itemData = JSON.parse($('[name="itemData"]').val());

            $('[name="id"]').val(saleHeader.id);
            $('[name="company_info_id"]').val(saleHeader.comp_id);
            $('[name="customer_info_id"]').val(saleHeader.cust_id).trigger('change');
            
            $('input[name="address"]').val(saleHeader.cust_address);
            $('input[name="pin_code"]').val(saleHeader.cust_pin);
            $('input[name="email"]').val(saleHeader.cust_email);
            $('input[name="gst_no"]').val(saleHeader.cust_gst_no);
            $('input[name="mobile"]').val(saleHeader.cust_mobile);
            $('input[name="order_date"]').val(saleHeader.order_date);
            $('input[name="delivery_date"]').val(saleHeader.delivery_date);

            $('input[name="excluding_amount_gst"]').val(saleHeader.amount_exlcuding_gst);
            $('input[name="sgst"]').val(saleHeader.sgst);
            $('input[name="cgst"]').val(saleHeader.cgst);
            $('input[name="total_amount"]').val(saleHeader.total_amount);
            $('[name="is_complete_order"]').val(saleHeader.is_order_complete);

            /**/
            for(var prop in saleLines){
                $($('[name="item_id[]"]')[prop]).val(saleLines[prop].item_id + "-" + saleLines[prop].item_name);
                $($('[name="number[]"]')[prop]).val(saleLines[prop].item_id);
                $($('[name="sale_price[]"]')[prop]).val(saleLines[prop].item_sales_price);//.data("sale_price",salePrice);
                $($('[name="qty[]"]')[prop]).val(saleLines[prop].item_qty);
                $($('[name="vender_price[]"]')[prop]).val(saleLines[prop].item_vender_price);
                $($('[name="amount[]"]')[prop]).val(saleLines[prop].item_line_amount);

                /*for(var x in itemData){
                  if(itemData[x].id == saleLines[prop].item_id){
                    if(parseInt(saleLines[prop].item_qty) > parseInt(itemData[x].qty) ){
                        $($('[name="qty[]"]')[prop]).val(itemData[x].qty);
                    }
                  }
                }*/

                if((saleLines.length-1) != prop){
                    $($('.plus-btn')[prop]).trigger('click');
                }
            }

            /**/
            if(saleHeader.is_order_complete == 1){
                var input = document.createElement('input'),
                    customer_info_id = $('[name="customer_info_id"]');

                input.setAttribute('name','deummy');
                $('button').attr('readonly',true).hide();
                $('select').attr('readonly',true);
                $('input').attr('readonly',true);
                $('button[name="print"]').show().attr('readonly', false);
                $('[name="cust_name"]').val(customer_info_id[0].options[customer_info_id[0].options.selectedIndex].text).attr('readonly', false);
                $('[name="id"]').attr('readonly', false);
                $('input[name="company_info_id"]').val($('select[name="company_info_id"]').val()).attr('readonly',false);
            }
        },
        setSellOrderEdit: function(obj){
            var saleHeader = obj.saleHeader[0],
                saleLines = obj.saleLines,
                itemData = JSON.parse($('[name="itemData"]').val());


            $('[name="id"]').val(saleHeader.id);
            $('[name="company_info_id"]').val(saleHeader.comp_id).attr('readonly', true);
            $('[name="customer_info_id"]').val(saleHeader.cust_id).attr('readonly', true).trigger('change');
            
            $('input[name="name"]').val(saleHeader.cust_name).attr('readonly', true);
            $('input[name="address"]').val(saleHeader.cust_address);
            $('input[name="pin_code"]').val(saleHeader.cust_pin);
            $('input[name="email"]').val(saleHeader.cust_email);
            $('input[name="gst_no"]').val(saleHeader.cust_gst_no);
            $('input[name="mobile"]').val(saleHeader.cust_mobile);
            $('input[name="order_date"]').val(saleHeader.order_date);
            $('input[name="delivery_date"]').val(saleHeader.delivery_date);

            $('input[name="excluding_amount_gst"]').val(saleHeader.amount_exlcuding_gst);
            $('input[name="total_discount"]').val(saleHeader.discont);
            $('input[name="sgst"]').val(saleHeader.sgst);
            $('input[name="cgst"]').val(saleHeader.cgst);
            $('input[name="total_amount"]').val(saleHeader.total_amount);
            $('[name="is_complete_order"]').val(saleHeader.is_order_complete);

            /**/
            for(var prop in saleLines){
                $($('[name="item_id[]"]')[prop]).val(saleLines[prop].item_id + "-" + saleLines[prop].item_name);
                $($('[name="number[]"]')[prop]).val(saleLines[prop].item_id);
                $($('[name="sale_price[]"]')[prop]).val(saleLines[prop].item_sales_price);//.data("sale_price",salePrice);
                $($('[name="qty[]"]')[prop]).val(saleLines[prop].item_qty_final);
                $($('[name="discount[]"]')[prop]).val(saleLines[prop].item_disc);
                $($('[name="amount[]"]')[prop]).val(saleLines[prop].item_line_amount);

                /*for(var x in itemData){
                  if(itemData[x].id == saleLines[prop].item_id){
                    if(parseInt(saleLines[prop].item_qty) > parseInt(itemData[x].qty) ){
                        $($('[name="qty[]"]')[prop]).val(itemData[x].qty);
                    }
                  }
                }*/

                if((saleLines.length-1) != prop){
                    $($('.plus-btn')[prop]).trigger('click');
                }
            }

            /**/
            if(saleHeader.is_order_complete == 1){
                var input = document.createElement('input'),
                    customer_info_id = $('[name="customer_info_id"]');

                input.setAttribute('name','deummy');
                
                $('select').attr('readonly',true);
                $('input').attr('readonly',true);

                // } else {
                // }

                $('[name="cust_name"]').val(customer_info_id[0].options[customer_info_id[0].options.selectedIndex].text).attr('readonly', false);
                $('[name="id"]').attr('readonly', false);
                $('input[name="company_info_id"]').val($('select[name="company_info_id"]').val()).attr('readonly',false);
                $('.fa-minus').hide();
                $('.fa-plus').hide();
                $('[name="return_qty[]"]').attr('readonly', false);
                $('[name="discount[]"]').attr('readonly', false);
                if($('[name="returnOrder"]').val() == 0){
                    $('[name="discount[]"]').attr('readonly', true);
                    $('button').attr('readonly',true).hide();
                    $('button[name="print"]').show().attr('readonly', false);
                }  
            }
        },
        openModal: function(self, details, target) {
            if(details.is_order_complete == "YES"){
                return false;
            }

            var modalTitle = "Approve User",
                modalBodyText = "Are you want to delete <code>" + $(self).parent().parent().find('.name').text().trim() + "</code> ?",
                callBackFunc = this.callBackTarget.bind(this,details,target);
            
            $('.modal-title').text(modalTitle);
            $('#modal-body-text').html(modalBodyText);
            $('#modalYes').on('click', callBackFunc);
            $("#myModal").modal();
        },
        callBackTarget: function(details,target) {
            var obj = {
                url: this.baseUrl + this.urlStocks.delete,
                data: {
                    id: (target == 'orders' || target == 'purchase_orders') ? details.sales_header_id : details.id,
                    status: "D",
                    target: target
                },
                ajaxCallBackFunc: function(data, status){
                    var data = JSON.parse(data);
                    Dashboard.table.row($('#table-Row-' + data.id)).remove().draw();
                    //$('#table-Row-' + data.id).remove();
                   // $('#table-Row-' + data.id).find('.action a').attr('readonly');
                    Dashboard.showAlert(data,status);
                }
            };
            this.ajaxCall(obj);
            $('#modalYes').off('click');
        },
        validationOfDuplicateNumber: function(self){
            var number = $(self).val(),
                target = $(self).data('target');
            
            var obj = {
                url: this.baseUrl + this.urlStocks.validateItemNumber,
                data: {
                    number: number,
                    target: target
                },
                ajaxCallBackFunc: function(data, status){
                    var data = JSON.parse(data);
                    if(data.flag){
                        Dashboard.showAlert(data,data.status);
                        $('button[type="submit"]').attr('readonly',true);
                    } else {
                        $('button[type="submit"]').attr('readonly',false);
                    }
                }
            };
            this.ajaxCall(obj);
        },
        ajaxCall: function(obj){
            $.post(obj.url,obj.data, obj.ajaxCallBackFunc.bind(this));
        }, 
        showAlert: function(data, status){
            $.notify({
                icon: status == 'danger' ? 'fa fa-exclamation-triangle' : 'fa fa-check',
                message: data.msg

            }, {
                type: status,
                timer: 1000
            });
        },
        logout: function(){
            location.href = this.urlStocks.logout;
        },
        onChangeDropdown: function(self, target){
            var custData = $(self.options[self.selectedIndex]).data('companyinfo'),
                name = custData.fname + " " + custData.lname;
            
            $('.show-on-selection').show();
            if(name.trim() != "Guest"){
                $('[name="name"]').attr('readonly', true);
            } else {
                $('[name="name"]').attr('readonly', false);
            }

            $('[name="name"]').val(name);
            $('input[name="cust_name"]').val(name);
            $('input[name="address"]').val(custData.address);
            $('input[name="pin_code"]').val(custData.pin_code);
            $('input[name="email"]').val(custData.email);
            $('input[name="gst_no"]').val(custData.gst_no);
            $('input[name="mobile"]').val(custData.mobile);
            
            $('input[name="gst_percentage"]').val(custData.gst_percentage);
        },
        changedOrderDate: function(self){
            $('input[name="delivery_date"]').val(self.value);
        },
        saleOrderChangenNewLine: function(self,toDo){
            var parent = $(self).parent().parent(),                
                set = parent.clone(true,true);
                set.find('select').val('');
                set.find('input').val('');
            
            if(toDo == "minus" && Dashboard.checkFirstMinusVisibility()){
                $(parent).remove();
            } else if(toDo == "plus") {
                $(parent).after(set);    
            }            
        },
        checkFirstMinusVisibility: function(){
            return ($('.fa-minus').length > 1);
        },
        setItem: function(self, target,data){
            var itemNumber = $(self).val().split('-')[0],
                parent = $(self).parent().parent(),
                salePrice = data[itemNumber-1]['sell_price'];
            
            if(target == 'item_id[]'){
                parent.find('select[name="'+ target +'"]').val(itemNumber + "-" + data[itemNumber-1]['name']);
            } else {
                parent.find('select[name="'+ target +'"]').val(itemNumber);
            }
            parent.find('input[name="sale_price[]"]').val(salePrice).data("sale_price",salePrice);
            parent.find('input[name="qty[]"]').val('').data("qty",data[itemNumber-1]['qty']);
            parent.find('input[name="discount[]"]').val(0);
            parent.find('input[name="amount[]"]').val('');

        },
        updateAmount: function(self){
            var parent = $(self).parent().parent(),
                salePrice = parent.find('input[name="sale_price[]"]').val(),
                qty = parseInt(parent.find('input[name="qty[]"]').val()),
                discount = parseFloat(parent.find('input[name="discount[]"]').val()).toFixed(2) == 'NaN' ? 0 : parseFloat(parent.find('input[name="discount[]"]').val()).toFixed(2),
                returnQty = parseInt(parent.find('input[name="return_qty[]"]').val()),
                total = 0,
                sgst = 9,
                cgst = 9,
                totalGst = 0,
                totalDiscount = 0,
                excludingAmount = 0,
                finalAmount = 0,
                amount = parent.find('input[name="amount[]"]');

            if($(self).data('sale_price')){
                var msg = 'Sale price is you enter is less than store value!' + '\n' + 'Orignal Sale Price: ' + $(self).data('sale_price');
                salePrice < $(self).data('sale_price') ? alert(msg) : "";
            }    

            if($(self).data('qty')){
                var dataQty = parseInt($(self).data('qty'));
                var msg = 'Qty is more than available qty!' + '\n' + 'Available Qty:' + dataQty;
                if( dataQty < parseInt(qty)){
                    alert(msg);
                    $(self).val(dataQty);
                    return;
                }   

            }    
            
            if(salePrice && qty){
                if(returnQty){
                    if(qty == returnQty){
                        qty = 0;
                    } else if(qty < returnQty){
                        alert("Return Qty must be less than previous qty!");
                        return;
                    } else if(qty > returnQty) {
                        qty = parseInt(qty - returnQty);
                    }
                    //parent.find('input[name="qty[]"]').val(newQty);
                }
                total = (salePrice * qty) - discount;
                amount.val(total);
                excludingAmount = Dashboard.updateTotals('input[name="amount[]"]', '#excluding-amount-gst');
                totalDiscount = Dashboard.updateTotals('input[name="discount[]"]', '#total-discount');
                
                totalGst = Dashboard.setGst({
                    sgst: {
                        value: sgst,
                        domKey: '#sgst',
                        operator:  '%'
                    },
                    cgst: {
                        value: cgst,
                        domKey: '#cgst',
                        operator:  '%'
                    }
                },excludingAmount);

                finalAmount = parseFloat(totalGst) + parseFloat(excludingAmount);
                $('#total-amount').val(parseFloat(finalAmount).toFixed(2));
            }

        },
        updateTotals: function(name,domKey){
            var totalAmount = 0;
            $(name).each(function(k,v){
               totalAmount += parseFloat($(v).val());
            });
            $(domKey).val(totalAmount.toFixed(2));
            return totalAmount;
        },
        setGst: function(options,total){
            var totalGst = 0;
            for(var prop in options){
                var tempValue = ((options[prop].value / 100) * total).toFixed(2);
                $(options[prop].domKey).val( tempValue );
                totalGst += parseFloat(tempValue);
            }
            return totalGst;
        },
        savaeSalesOrder: function(self){
            var salesHeaderData = this.readFormData('#sale_header'),
                salesLineData = this.readFormData('#sales_line');

            var obj = {
                url: this.baseUrl + this.urlStocks.saveSalesOrder,
                data: {
                    salesHeaderData:    salesHeaderData,
                    salesLineData:      salesLineData
                },
                ajaxCallBackFunc: function(data, status){
                    var data = JSON.parse(data);
                    Dashboard.showAlert(data,status);
                }
            };
            this.ajaxCall(obj);            
        },
        readFormData: function(form){
            var tmpArray = [];
            $(form).serializeArray().map(function(v,k){
               tmpArray.push( {[v.name]: v.value} );
            });
            return JSON.stringify(tmpArray);
        },
        print: function(self){
            window.print();
        },
        getDefaultPage: function(self){
            var baseUrl = $('[name="base_path"]').val() ;
            $('form').submit();
            //window.location = baseUrl + 'site/company_info';
        },
        onLoadAddSellOrder: function(){
            //console.log(JSON.parse($('[name="header_data"]').val()));
        },
        setOrderView: function(self){
            $('.content.table-responsive.table-full-width').hide();
            $("#"+$(self).val()).show();
            $("#"+$(self).val() + '> #dataTable').DataTable();
        },
        updatePurchaseAmount: function(self){
            var parent = $(self).parent().parent(),
                salePrice = parent.find('input[name="sale_price[]"]').val(),
                venderPrice = parent.find('input[name="vender_price[]"]').val(),
                qty = parent.find('input[name="qty[]"]').val(),
                total = 0,
                gst = ( parseInt( $('[name="gst_percentage"]').val() ) ) || 0,
                sgst = gst ? (gst / 2 ) : 0,
                cgst = gst ? (gst / 2 ) : 0,
                totalGst = 0,
                excludingAmount = 0,
                finalAmount = 0,
                amount = parent.find('input[name="amount[]"]');

            $('#display_sgst').text(sgst);
            $('#display_cgst').text(cgst);
            
            if($(self).data('sale_price')){
                var msg = 'Sale price is you enter is less than store value!' + '\n' + 'Orignal Sale Price: ' + $(self).data('sale_price');
                salePrice < $(self).data('sale_price') ? alert(msg) : "";
            }    

            // if($(self).data('qty')){
            //     var dataQty = parseInt($(self).data('qty'));
            //     var msg = 'Qty is more than available qty!' + '\n' + 'Available Qty:' + dataQty;
            //     if( dataQty < parseInt(qty)){
            //         alert(msg);
            //         $(self).val(dataQty);
            //         return;
            //     }   

            // }    
            
            if(venderPrice && qty){
                total = (venderPrice * qty);
                amount.val(total);
                excludingAmount = Dashboard.updateTotals('input[name="amount[]"]', '#excluding-amount-gst');
                //totalDiscount = Dashboard.updateTotals('input[name="discount[]"]', '#total-discount');
                if(gst){

                    totalGst = Dashboard.setGst({
                        sgst: {
                            value: sgst,
                            domKey: '#sgst',
                            operator:  '%'
                        },
                        cgst: {
                            value: cgst,
                            domKey: '#cgst',
                            operator:  '%'
                        }
                    },total);
                }
                finalAmount = parseFloat(totalGst) + parseFloat(excludingAmount);
                $('#total-amount').val(parseFloat(finalAmount).toFixed(2));
            }        
        }        
    }
    return data;
}();