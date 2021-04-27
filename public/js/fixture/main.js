var prefix_start    =   '';
var prefix_middle   =   '';
var prefix_end      =   '';
var sections;
// Yeni Ekipman Ögeleri
    var c_department_select             =   $('#c_department_select');//Departman
    var c_section_select                =   $('#c_section_select');//Bölüm
    var c_type_select                   =   $('#c_type_select');//Tür
    var c_brand_select                  =   $('#c_brand_select');//Marka
    var c_supplier_select               =   $('#c_supplier_select');//Tedarikçi
    var c_status_select                 =   $('#c_status_select');//Statü
    var c_exhange_select                =   $('#c_exhange_select');//Döviz
    var c_barcode_number_prepend        =   $('#c_barcode_number_prepend');//Barkod Ön Eki
    var c_barcode_number_append         =   $('#c_barcode_number_append');//Barkod No
    var c_type_select                   =   $('#c_type_select');
    var c_new_prefix                    =   $('#c_new_type_prefix');
    var c_new_type                      =   $('#c_new_type');
    var c_new_brand                     =   $('#c_new_brand');
    var c_new_supplier_name             =   $('#c_new_supplier_name');
    var c_new_supplier_telephone        =   $('#c_new_supplier_telephone');
    var c_barcode_message               =   $('.c_barcode_message');
    var c_submit_button                 =   $('#c_submit_button');
    var c_bill_select                   =   $('#c_bill_select');
    var c_bill_no                       =   $('#c_bill_no');
    var c_bill_image                    =   $('#c_bill_image');

    var c_type_name_message             =   false;
    var c_type_prefix_message           =   false;
    var c_brand_message                 =   false;
    var c_supplier_name_message         =   false;
    var c_supplier_telephone_message    =   false;
    var c_barcode_message               =   false;
    var c_bill_message                  =   false;


    c_department_select.on('select2:select',function(e){
        clearPrefix(c_barcode_number_prepend);
        prefix_start = $(this).find(':selected').data('prefix');
        changePrefix(prefix_start,prefix_middle,prefix_end,c_barcode_number_prepend);
        var dep_id = $(this).val();

        emptySelect(c_section_select);
        $.ajax({
            type: 'POST',
            url: get_sections_url,
            async: false,
            data: {'dep_id':dep_id},
            success: function (response) {
                c_section_select.append(new Option());//Placeholder çalışması için boş <option> gerekli
                c_section_select.select2({
                    placeholder: "Seçim Yapınız",
                    dropdownParent: $('#c_section'),
                    data:response,
                });
                $('#c_section').removeClass('d-none');
            }
        });
    });

    c_section_select.on('select2:select',function (e) {
        var section_id = $(this).val();
        console.log(section_id);
        prefix_middle = $(this).select2('data')[0].prefix;
        changePrefix(prefix_start,prefix_middle,prefix_end,c_barcode_number_prepend);
        $('#c_type').removeClass('d-none');
    });

    c_type_select.on('select2:select',function (e) {
        prefix_end = $(this).find(':selected').data('prefix');
        changePrefix(prefix_start,prefix_middle,prefix_end,c_barcode_number_prepend);
        $('#c_brand').removeClass('d-none');
    });

    c_new_type.on('keypress',function () {
        $('#c_brand').removeClass('d-none');
    });

    c_new_prefix.on('keypress',function () {
        $('#c_brand').removeClass('d-none');
    });

    c_brand_select.on('select2:select',function (e) {
        $('#c_supplier').removeClass('d-none');
    });

    c_new_brand.on('keypress',function () {
        $('#c_supplier').removeClass('d-none');
    });

    c_supplier_select.on('select2:select',function (e) {
        $('#c_status').removeClass('d-none');
    });

    c_new_supplier_name.on('keypress',function () {
        $('#c_status').removeClass('d-none');
    });

    c_new_supplier_telephone.on('keypress',function () {
        $('#c_status').removeClass('d-none');
    });

    c_status_select.on('select2:select',function (e) {
        $('#c_other').removeClass('d-none');
    });

    c_exhange_select.on('select2:select',function(e){
        $('#c_exchange_icon').removeClass();
        $('#c_exchange_icon').addClass($(this).find(':selected').data('icon'));
    });

    function cExchangeToggle() {
        if($('#c_exchange').hasClass('d-none')){
            $('#c_exchange').removeClass('d-none');
            exchangeDisableToggle(c_exhange_select,$('#c_exchange_rate'),false);
        }
        else{
            $('#c_exchange').addClass('d-none');
            exchangeDisableToggle(c_exhange_select,$('#c_exchange_rate'),true);
        }
    }

    function exchangeDisableToggle(select,rate,disable) {
        select.prop('disabled',disable);
        rate.prop('disabled',disable);
        select.prop('required',!disable);
        rate.prop('required',!disable);
    }

    function exchangeIcon(item) {
        if(!item.id){
            return item.text;
        }
        var $html = $("<span><i class='"+$(item.element).data('icon')+"'></i> "+item.text+"</span>");
        return $html;
    }

    function cBarcodeCheck() {
        var data = {
            department_id: c_department_select.val(),
            section_id: c_section_select.val(),
            brand_id: c_brand_select.val(),
            barcode_number : c_barcode_number_append.val(),
            update: false
        }
        $.ajax({
            type: 'POST',
            url: check_barcode_url,
            data: data,
            success: function (response) {
                if(response){
                    c_submit_button.prop('disabled',true);
                    c_barcode_number_append.addClass('border-danger text-danger');
                    c_barcode_message.removeClass('d-none');
                }
                else{
                    c_submit_button.prop('disabled',false);
                    c_barcode_number_append.removeClass('border-danger text-danger');
                    c_barcode_message.addClass('d-none');
                }
            }
        })
    }
// Ekipman Güncelleme Ögeleri
// Ekipman Silme Ögeleri

function emptySelect(select){//Select Box İçini Temizler
    select.empty();
    select.val(null);
}

function destroySelect(select){//Select Box Yokeder
    select.select2('destroy');
    select.val(null);
}

function openSelect(select,dropdown) {
    select.select2({
        placeholder: "Seçim Yapınız",
        dropdownParent: dropdown
    });
}

function openExchangeSelect(select,dropdown) {
    select.select2({
        placeholder: "Seçim",
        dropdownParent: dropdown,
        templateResult: function (item) {
            return exchangeIcon(item);
        },
        templateSelection: function (item) {
            return exchangeIcon(item);
        },
    });
}

function openSection() {

}

function clearPrefix(element) {//Ön Eki Sıfırlar
    prefix_start    =   '';
    prefix_middle   =   '';
    changePrefix(prefix_start,prefix_middle,prefix_end,element);
}

function changePrefix(start,middle,end,element) {//Ön Eki Değiştirir
    var prefix = start+"-"+middle+"-"+end;
    element.html(prefix);
}

function fixtureDelete(id){
    /*$.ajax({

    });*/
    $('#d_barcode_number_info').text(barcode_number);
    $('#d_barcode_number').val(barcode_number);
    $('#d_serial_number').text(serial_number);
    $('#d_detail').html(detail);
    $('#d_type').text(type);
    $('#d_brand').text(brand);
}
function fixtureUpdate(id){
    $('#fixture_update_barcode_number').val(barcode_number);
    $('#fixture_update_barcode_number_info').val(barcode_number.slice(prefix.length));
    $('#fixture_update_barcode_number_prepend').text(prefix);
    $('#fixture_update_serial_number').val(serial_number);
    $('#fixture_update_serial_number_info').val(serial_number);
    $('.fixture_update_type_select').select2("val",type_id);
    $('.fixture_update_brand_select').select2("val",brand_id);
    $('#fixture_update_detail').val(detail);
    $('#fixture_update_duration').val(duration);
}
function fixtureUpdateNewType(){
    var type_select =   $('.fixture_update_type_select');
    var new_prefix  =   $('#fixture_update_new_type_prefix');
    var new_type    =   $('#fixture_update_new_type');
    type_select.prop('required',false);
    type_select.prop('disabled',true);
    type_select.select2('destroy');
    type_select.hide();
    new_prefix.prop('required',true);
    new_prefix.prop('disabled',false);
    new_prefix.show();
    new_type.prop('required',true);
    new_type.prop('disabled',false);
    new_type.show();
    $('#fixture_update_barcode_number_prepend').text('');
}
function fixtureUpdateShowType(){
    var new_prefix  =   $('#fixture_update_new_type_prefix');
    var new_type    =   $('#fixture_update_new_type');
    var type_select =   $('.fixture_update_type_select');
    new_prefix.val('');
    new_prefix.prop('required',false);
    new_prefix.prop('disabled',true);
    new_prefix.hide();
    new_type.val('');
    new_type.prop('required',false);
    new_type.prop('disabled',true);
    new_type.hide();
    type_select.select2({
        dropdownParent: $('#fixtureUpdateModal')
    });
    type_select.prop('required',true);
    type_select.prop('disabled',false);
    type_select.show();
    var prefix = type_select[0].selectedOptions[0].dataset.prefix;
    $('#fixture_update_barcode_number_prepend').text(prefix);
}
function fixtureUpdateNewBrand(){
    var brand_select    =   $('.fixture_update_brand_select');
    var new_brand       =   $('#fixture_update_new_brand')
    brand_select.prop('required',false);
    brand_select.prop('disabled',true);
    brand_select.select2('destroy');
    brand_select.hide();
    new_brand.prop('required',true);
    new_brand.prop('disabled',false);
    new_brand.show();
}
function fixtureUpdateShowBrand(){
    var new_brand       =   $('#fixture_update_new_brand');
    var brand_select    =   $('.fixture_update_brand_select')
    new_brand.val('');
    new_brand.prop('required',false);
    new_brand.prop('disabled',true);
    new_brand.hide();
    brand_select.select2({
        dropdownParent: $('#fixtureUpdateModal')
    });
    brand_select.prop('required',true);
    brand_select.prop('disabled',false);
    brand_select.show();
}

function openChoose(select,dropdown) {
    openSelect(select,dropdown);
    select.prop('required',true);
    select.prop('disabled',false);
    select.show();
}

function closeChoose(select) {
    select.prop('required',false);
    select.prop('disabled',true);
    select.select2('destroy');
    select.val(null);
    select.hide();
}

function openElement(element) {
    element.prop('required',true);
    element.prop('disabled',false);
    element.show();
}

function closeElement(element) {
    element.val('');
    element.prop('required',false);
    element.prop('disabled',true);
    element.hide();
}

function NewTypeToggle(type,new_type,new_prefix,dropdown,state) {
    if(state){
        closeChoose(type);
        openElement(new_prefix);
        openElement(new_type);
    }
    else{
        closeElement(new_prefix);
        closeElement(new_type);
        openChoose(type,dropdown);
    }
    prefix_end = '';
    changePrefix(prefix_start,prefix_middle,prefix_end,c_barcode_number_prepend);
}

function cNewType(){
    NewTypeToggle(c_type_select,c_new_type,c_new_prefix,$('#c_type'),true);
}
function cShowType(){
    NewTypeToggle(c_type_select,c_new_type,c_new_prefix,$('#c_type'),false);
}

function NewBrandToogle(brand,new_brand,dropdown,state) {
    if(state){
        closeChoose(brand);
        openElement(new_brand);
    }
    else{
        closeElement(new_brand);
        openChoose(brand,dropdown);
    }
}

function cNewBrand() {
    NewBrandToogle(c_brand_select,c_new_brand,$('#c_brand'),true);
}

function cShowBrand() {
    NewBrandToogle(c_brand_select,c_new_brand,$('#c_brand'),false);
}

function DefineTelephone() {
    c_new_supplier_telephone.inputmask("+\\90 (999) 999 99 99");
    //$('#u_new_supplier_telephone').inputmask("(999) 999 99 99");
}

function NewSupplierToggle(supplier,new_div,new_name,new_telephone,state) {
    if(state){
        openElement(new_name);
        new_div.removeClass('d-none');
    }
    else{
        new_div.addClass('d-none');
        closeElement(new_name);
    }
    supplier.val('').trigger('change');//Değeri sıfırlayıp değişimi tetikleyince Placeholder gözüküyor
    supplier.prop('disabled',state);
    new_telephone.prop('disabled',!state);
    new_telephone.val('');
}

function cNewSupplier() {
    NewSupplierToggle(c_supplier_select,$('#c_new_supplier'),c_new_supplier_name,c_new_supplier_telephone,true);
}

function cShowSupplier() {
    NewSupplierToggle(c_supplier_select,$('#c_new_supplier'),c_new_supplier_name,c_new_supplier_telephone,false);
}

function cNewBill() {
    NewBillToggle(c_bill_select,$('#c_new_bill'),c_bill_no,c_bill_image,true);
}

function cShowBill() {
    NewBillToggle(c_bill_select,$('#c_new_bill'),c_bill_no,c_bill_image,false);
}

function fixtureCreateNewBrand(){
    var new_brand       = $('#fixture_create_new_brand');
    var brand_select    = $('.fixture_create_brand_select');
    brand_select.prop('required',false);
    brand_select.prop('disabled',true);
    brand_select.select2('destroy');
    brand_select.hide();
    new_brand.prop('required',true);
    new_brand.prop('disabled',false);
    new_brand.show();
}
function fixtureCreateShowBrand(){
    var new_brand       =   $('#fixture_create_new_brand');
    var brand_select    =   $('.fixture_create_brand_select');
    new_brand.val('');
    new_brand.prop('required',false);
    new_brand.prop('disabled',true);
    new_brand.hide();
    brand_select.select2({
        dropdownParent: $('#fixtureCreateModal')
    });
    brand_select.prop('required',true);
    brand_select.prop('disabled',false);
    brand_select.show();
}

function fixtureCreateOpenBarcodeNumber(){
    var barcode = $('#fixture_create_barcode_number_info');
    barcode.prop('required',true);
    barcode.prop('disabled',false);
    barcode.val('');
}

function fixtureCreateCloseBarcodeNumber(){
    var barcode = $('#fixture_create_barcode_number_info');
    barcode.prop('required',false);
    barcode.prop('disabled',true);
    barcode.val('Otomatik Üretilecektir');
}

NgApp.controller('fixtureController',function($http,$scope){
    $http.post(getFixtureElements_url).then(function(response){
        $scope.departments      =   response.data.departments;
        $scope.types            =   response.data.types;
        $scope.brands           =   response.data.brands;
        $scope.suppliers        =   response.data.suppliers;
        $scope.statuses         =   response.data.statuses;
        $scope.exchanges        =   response.data.exchanges;
        $scope.bills            =   response.data.bills;
    });
});

$(document).ready(function(){

    openSelect(c_department_select,$('#c_department'));
    openSelect(c_type_select,$('#c_type'));
    openSelect(c_brand_select,$('#c_brand'));
    openSelect(c_supplier_select,$('#c_supplier'));
    openSelect(c_status_select,$('#c_status'));
    openSelect(c_bill_select,$('#c_bill'));
    openExchangeSelect(c_exhange_select,$('#c_exchange'));
    DefineTelephone();
});
