function materialCreateShowType(){
    var new_type    =   $('#material_create_new_type');
    var type_select =   $('.material_create_type_select');
    new_type.val('');
    new_type.prop('required',false);
    new_type.prop('disabled',true);
    new_type.hide();
    type_select.select2({
        dropdownParent: $('#materialCreateModal')
    });
    type_select.prop('required',true);
    type_select.prop('disabled',false);
    type_select.show();
}
function materialCreateNewType(){
    var new_type    =   $('#material_create_new_type');
    var type_select =   $('.material_create_type_select');
    type_select.select2('destroy');
    type_select.prop('required',false);
    type_select.prop('disabled',true);
    type_select.hide();
    new_type.prop('required',true);
    new_type.prop('disabled',false);
    new_type.show();
}
$('#materialCreateForm').on('submit',function(e){
    e.preventDefault();
    $.ajax({
        type:'POST',
        url: material_create_ajax_url,
        data: $('#materialCreateForm').serialize(),
        success:function(response){
            if(response.id){
                $('#materialCreateModal').modal('toggle');
                $('#materialErrorMessage').text('');
                $(".material_select").append($('<option>', {value:response.id, text: response.text}));
                var newVal = $('.material_select').val();
                newVal.push(response.id);
                $(".material_select").val(newVal);
                if(response.type){
                    $(".material_create_type_select").append($('<option>', {value:response.type.id, text: response.type.text}));
                    materialCreateShowType();
                }
                $('#material_create_name').val('');
                $('#material_create_detail').val('');
            }
            else{
                $('#materialErrorMessage').text(response.error);
            }
        }
    });
});
NgApp.controller('materialController',function($http,$scope){
    $http.post(getMaterialElements_url).then(function(response){
        $scope.types    =   response.data.types;
    });
});
$(document).ready(function(){
    $('.material_create_type_select').select2({
        dropdownParent: $('#materialCreateModal')
    });
    $('.material_select').select2({
        placeholder:"Malzeme Giriniz",
        language:"tr",
        ajax:{
            type: 'POST',
            url: get_useable_material_url,
            dataType: 'json',
            delay:250,
            data:function(params){
                return{
                    search:params.term
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
