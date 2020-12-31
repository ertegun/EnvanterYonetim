function softwareCreateShowType(){
    var new_type    =   $('#software_create_new_type');
    var type_select =   $('.software_create_type_select');
    new_type.val('');
    new_type.prop('required',false);
    new_type.prop('disabled',true);
    new_type.hide();
    type_select.select2({
        dropdownParent: $('#softwareCreateModal')
    });
    type_select.prop('required',true);
    type_select.prop('disabled',false);
    type_select.show();
}
function softwareCreateNewType(){
    var new_type    =   $('#software_create_new_type');
    var type_select =   $('.software_create_type_select');
    type_select.select2('destroy');
    type_select.prop('required',false);
    type_select.prop('disabled',true);
    type_select.hide();
    new_type.prop('required',true);
    new_type.prop('disabled',false);
    new_type.show();
}
function softwareCreateDisableLicenseTime(){
    var license_time = $('#software_create_license_time');
    license_time.prop('disabled',true);
    license_time.prop('required',false);
    license_time.val('');
    license_time.attr('placeholder','Süresiz Olarak Kaydedilecektir');
}
function softwareCreateEnableLicenseTime(){
    var license_time = $('#software_create_license_time');
    license_time.prop('disabled',false);
    license_time.prop('required',true);
    license_time.attr('placeholder','');
    license_time.val(1);
}
$('#softwareCreateForm').on('submit',function(e){
    e.preventDefault();
    $.ajax({
        type:'POST',
        url: software_create_ajax_url,
        data: $('#softwareCreateForm').serialize(),
        success:function(response){
            if(response.id){
                $('#softwareCreateModal').modal('toggle');
                $('#softwareErrorMessage').text('');
                $(".software_select").append($('<option>', {value:response.id, text: response.text}));
                var newVal = $('.software_select').val();
                newVal.push(response.id);
                $(".software_select").val(newVal);
                if(response.type){
                    $(".software_create_type_select").append($('<option>', {value:response.type.id, text: response.type.text}));
                    softwareCreateShowType();
                }
                softwareCreateEnableLicenseTime();
                $('#software_create_name').val('');
                var date = new Date();
                $('#software_create_start_time').val(
                    date.getFullYear().toString() + '-'
                    + (date.getMonth() + 1).toString().padStart(2, 0) +'-'
                    + date.getDate().toString().padStart(2, 0)
                );
            }
            else{
                $('#softwareErrorMessage').text(response.error);
            }
        }
    });
});
NgApp.controller('softwareController',function($http,$scope){
    $http.post(getSoftwareElements_url).then(function(response){
        $scope.types    =   response.data.types;
    });
});
$(document).ready(function(){
    $('.software_create_type_select').select2({
        dropdownParent: $('#softwareCreateModal')
    });
    $('.software_select').select2({
        placeholder:"Yazılım Giriniz",
        language:"tr",
        ajax:{
            type: 'POST',
            url: get_useable_software_url,
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
});
