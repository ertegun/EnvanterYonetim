function hardwareCreateNewType(){
    var type_select =   $('.hardware_create_type_select');
    var new_prefix  =   $('#hardware_create_new_type_prefix');
    var new_type    =   $('#hardware_create_new_type')
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
    $('#hardware_create_barcode_number_prepend').text('');
}
function hardwareCreateShowType(){
    var new_prefix  =   $('#hardware_create_new_type_prefix');
    var new_type    =   $('#hardware_create_new_type');
    var type_select =   $('.hardware_create_type_select');
    new_prefix.val('');
    new_prefix.prop('required',false);
    new_prefix.prop('disabled',true);
    new_prefix.hide();
    new_type.val('');
    new_type.prop('required',false);
    new_type.prop('disabled',true);
    new_type.hide();
    type_select.select2({
        dropdownParent: $('#hardwareCreateModal')
    });
    type_select.prop('required',true);
    type_select.prop('disabled',false);
    type_select.show();
    var prefix = type_select[0].selectedOptions[0].dataset.prefix;
    $('#hardware_create_barcode_number_prepend').text(prefix);
}
function hardwareCreateNewModel(){
    var new_model = $('#hardware_create_new_model');
    var model_select = $('.hardware_create_model_select');
    model_select.prop('required',false);
    model_select.prop('disabled',true);
    model_select.select2('destroy');
    model_select.hide();
    new_model.prop('required',true);
    new_model.prop('disabled',false);
    new_model.show();
}
function hardwareCreateShowModel(){
    var new_model       =   $('#hardware_create_new_model');
    var model_select    =   $('.hardware_create_model_select');
    new_model.val('');
    new_model.prop('required',false);
    new_model.prop('disabled',true);
    new_model.hide();
    model_select.select2({
        dropdownParent: $('#hardwareCreateModal')
    });
    model_select.prop('required',true);
    model_select.prop('disabled',false);
    model_select.show();
}
function hardwareCreateOpenBarcodeNumber(){
    var barcode = $('#hardware_create_barcode_number_info');
    barcode.prop('required',true);
    barcode.prop('disabled',false);
    barcode.val('');
}
function hardwareCreateCloseBarcodeNumber(){
    var barcode = $('#hardware_create_barcode_number_info');
    barcode.prop('required',false);
    barcode.prop('disabled',true);
    barcode.val('Otomatik Üretilecektir');
}
$('#hardwareCreateForm').on('submit',function(e){
    e.preventDefault();
    $.ajax({
        type:'POST',
        url: hardware_create_ajax_url,
        data: $('#hardwareCreateForm').serialize(),
        success:function(response){
            if(response.id){
                $('#hardwareCreateModal').modal('toggle');
                $('#hardwareErrorMessage').text('');
                $(".hardware_select").append($('<option>', {value:response.id, text: response.text}));
                var newVal = $('.hardware_select').val();
                newVal.push(response.id);
                $(".hardware_select").val(newVal);
                if(response.type){
                    $(".hardware_create_type_select").append($('<option>', {value:response.type.id,"data-prefix":response.type.prefix, text: response.type.text}));
                    hardwareCreateShowType();
                }
                if(response.model){
                    $(".hardware_create_model_select").append($('<option>', {value:response.model.id, text: response.model.text}));
                    hardwareCreateShowModel();
                }
                hardwareCreateOpenBarcodeNumber();
                $('#hardware_create_serial_number').val('');
                $('#hardware_create_detail').val('');
            }
            else{
                $('#hardwareErrorMessage').text(response.error);
            }
        }
    });
});
$('.hardware_create_type_select').on('select2:select', function (e) {
    var prefix = e.params.data.element.dataset.prefix;
    $('#hardware_create_barcode_number_prepend').text(prefix);
});
$('#hardware_create_new_type_prefix').on('input',function(e){
    $('#hardware_create_barcode_number_prepend').text($(this).val());
});
NgApp.controller('hardwareController',function($http,$scope){
    $http.post(getHardwareElements_url).then(function(response){
        $scope.types    =   response.data.types;
        $scope.models   =   response.data.models;
    });
});
$(document).ready(function(){
    $('.hardware_create_type_select').select2({
        dropdownParent: $('#hardwareCreateModal')
    });
    $('.hardware_create_model_select').select2({
        dropdownParent: $('#hardwareCreateModal')
    });
    setTimeout(function(){
        var prefix = $('.hardware_create_type_select option:selected').data('prefix');
        $('#hardware_create_barcode_number_prepend').text(prefix);
    },1000);
    $('.hardware_select').select2({
        placeholder:"Donanım Giriniz",
        language:"tr",
        ajax:{
            type: 'POST',
            url: get_useable_hardware_url,
            dataType: 'json',
            delay:250,
            data:function(params){
                return{
                    search:params.term,
                };
            },
            processResults:function(data){
                return{
                    results:data
                };
            },
            cache:true
        },
        theme: 'classic',
        escapeMarkup: function(markup) {
            return markup;
        },
        templateResult: function(data) {
            return data.html;
        },
        templateSelection: function(data) {
            return data.text;
        }
    });
})
