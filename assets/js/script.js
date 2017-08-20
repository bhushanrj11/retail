'use strict';
var Dashboard = Dashboard || function() {
    var data = {
        urlStocks: JSON.parse($('#Urlstocks').val()),
        baseUrl: $('#baseUrl').val(),
        table:'',
        load: function() {    
           this.table = $('#dataTable').DataTable();
        },
        openModal: function(self, details, target) {
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
                    id: details.id,
                    status: "D",
                    target: target
                },
                ajaxCallBackFunc: function(data, status){
                    var data = JSON.parse(data);
                    Dashboard.table.row($('#table-Row-' + data.id)).remove().draw();
                    //$('#table-Row-' + data.id).remove();
                   // $('#table-Row-' + data.id).find('.action a').attr('disabled');
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
                        $('button[type="submit"]').attr('disabled',true);
                    } else {
                        $('button[type="submit"]').attr('disabled',false);
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
            var companydata = $(self.options[self.selectedIndex]).data('companyinfo');
            
            $('.show-on-selection').show();
            $('input[name="address"]').val(companydata.address);
            $('input[name="pin_code"]').val(companydata.pin_code);
            $('input[name="email"]').val(companydata.email);
            $('input[name="gst_no"]').val(companydata.gst_no);
            $('input[name="mobile"]').val(companydata.mobile);
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
            var itemNumber = $(self).val(),
                parent = $(self).parent().parent(),
                salePrice = data[itemNumber-1]['sell_price'];

            parent.find('select[name="'+ target +'"]').val(itemNumber);
            parent.find('input[name="sale_price"]').val(salePrice);
            parent.find('input[name="qty"]').val('');
            parent.find('input[name="discount"]').val(0);
            parent.find('input[name="amount"]').val('');

        },updateAmount: function(self){
            var parent = $(self).parent().parent(),
                salePrice = parent.find('input[name="sale_price"]').val(),
                qty = parent.find('input[name="qty"]').val(),
                discount = parseFloat(parent.find('input[name="discount"]').val()).toFixed(2),
                total = 0,
                sgst = 9,
                cgst = 9,
                totalGst = 0,
                totalDiscount = 0,
                excludingAmount = 0,
                finalAmount = 0,
                amount = parent.find('input[name="amount"]');

            if(salePrice && qty){
                total = (salePrice * qty) - discount;
                amount.val(total);
                excludingAmount = Dashboard.updateTotals('input[name="amount"]', '#excluding-amount-gst');
                totalDiscount = Dashboard.updateTotals('input[name="discount"]', '#total-discount');
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
                finalAmount = parseFloat(totalGst) + parseFloat(excludingAmount);
                $('#total-amount').text(parseFloat(finalAmount).toFixed(2));
            }

        },updateTotals: function(name,domKey){
            var totalAmount = 0;
            $(name).each(function(k,v){
               totalAmount += parseFloat($(v).val());
            });
            $(domKey).text(totalAmount.toFixed(2));
            return totalAmount;
        },
        setGst: function(options,total){
            var totalGst = 0;
            for(var prop in options){
                var tempValue = ((options[prop].value / 100) * total ).toFixed(2);
                $(options[prop].domKey).text( tempValue );
                totalGst += parseFloat(tempValue);
            }
            return totalGst;
        },
        savaeSalesOrder: function(self){
            var obj = {
                url: this.baseUrl + this.urlStocks.saveSalesOrder,
                data: {
                    id: details.id,
                    status: "D",
                    target: target
                },
                ajaxCallBackFunc: function(data, status){
                    var data = JSON.parse(data);
                    Dashboard.table.row($('#table-Row-' + data.id)).remove().draw();
                    //$('#table-Row-' + data.id).remove();
                   // $('#table-Row-' + data.id).find('.action a').attr('disabled');
                    Dashboard.showAlert(data,status);
                }
            };
            this.ajaxCall(obj);            
        }
        /*rejectUser: function(details) {
            var obj = {
                url: this.urlStocks.userStatus,
                data: {
                    id: details.id,
                    status: "R"
                },
                ajaxCallBackFunc: function(data, status){
                    var data = JSON.parse(data);
                    $('#table-Row-' + data.id).find('.status').html("REJECTED");
                    Dashboard.showAlert(data,status);
                }
            };
            this.ajaxCall(obj);            

            $('#modalYes').off('click');
        },
        deleteUser: function(details) {
            var obj = {
                url: this.urlStocks.userStatus,
                data: {
                    id: details.id,
                    status: "D"
                },
                ajaxCallBackFunc: function(data, status){
                    var data = JSON.parse(data);
                    $('#table-Row-' + data.id).remove();
                    Dashboard.showAlert(data,status);
                }
            };
            this.ajaxCall(obj);

            $('#modalYes').off('click');     
        },*/
        
    }
    return data;
}();
