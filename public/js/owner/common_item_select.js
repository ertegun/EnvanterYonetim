function commonItemCreateShowType(){
    var new_type    =   $('#common_create_new_type');
    var type_select =   $('.common_create_type_select');
    new_type.val('');
    new_type.prop('required',false);
    new_type.prop('disabled',true);
    new_type.hide();
    type_select.select2({
        dropdownParent: $('#commonItemCreateModal')
    });
    type_select.prop('required',true);
    type_select.prop('disabled',false);
    type_select.show();
}
function commonItemCreateNewType(){
    var new_type    =   $('#common_create_new_type');
    var type_select =   $('.common_create_type_select');
    type_select.select2('destroy');
    type_select.prop('required',false);
    type_select.prop('disabled',true);
    type_select.hide();
    new_type.prop('required',true);
    new_type.prop('disabled',false);
    new_type.show();
}
$('#commonCreateForm').on('submit',function(e){
    e.preventDefault();
    $.ajax({
        type:'POST',
        url: common_item_create_ajax_url,
        data: $('#commonCreateForm').serialize(),
        success:function(response){
            if(response.id){
                $('#commonItemCreateModal').modal('toggle');
                $('#commonErrorMessage').text('');
                $(".common_select").append($('<option>', {value:response.id, text: response.text}));
                var newVal = $('.common_select').val();
                newVal.push(response.id);
                $(".common_select").val(newVal);
                if(response.type){
                    $(".common_create_type_select").append($('<option>', {value:response.type.id, text: response.type.text}));
                    commonItemCreateShowType();
                }
                $('#common_create_name').val('');
                $('#common_create_detail').val('');
            }
            else{
                $('#commonErrorMessage').text(response.error);
            }
        }
    });
});
NgApp.controller('commonController',function($http,$scope){
    $http.post(getCommonItemElements_url).then(function(response){
        $scope.types    =   response.data.types;
    });
});
$(document).ready(function(){
    var user_id                     =   $('#user_id').val();
    $('.common_create_type_select').select2({
        dropdownParent: $('#commonItemCreateModal')
    });
    $('.common_select').select2({
        placeholder:"Ortak Kullanım Giriniz",
        language:"tr",
        ajax:{
            type: 'POST',
            url: get_useable_common_item_url,
            dataType: 'json',
            delay:250,
            data:function(params){
                return{
                    search:params.term,
                    user_id:user_id
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
