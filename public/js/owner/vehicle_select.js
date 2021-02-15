function vehicleCreateNewModel(){
    var new_model = $('#vehicle_create_new_model');
    var model_select = $('.vehicle_create_model_select');
    model_select.prop('required',false);
    model_select.prop('disabled',true);
    model_select.select2('destroy');
    model_select.hide();
    new_model.prop('required',true);
    new_model.prop('disabled',false);
    new_model.show();
}
function vehicleCreateShowModel(){
    var new_model       =   $('#vehicle_create_new_model');
    var model_select    =   $('.vehicle_create_model_select');
    new_model.val('');
    new_model.prop('required',false);
    new_model.prop('disabled',true);
    new_model.hide();
    model_select.select2({
        dropdownParent: $('#vehicleCreateModal')
    });
    model_select.prop('required',true);
    model_select.prop('disabled',false);
    model_select.show();
}
$('#vehicleCreateForm').on('submit',function(e){
    e.preventDefault();
    $.ajax({
        type:'POST',
        url: vehicle_create_ajax_url,
        data: $('#vehicleCreateForm').serialize(),
        success:function(response){
            if(response.id){
                $('#vehicleCreateModal').modal('toggle');
                $('#vehicleErrorMessage').text('');
                $(".vehicle_select").append($('<option>', {value:response.id, text: response.text}));
                var newVal = $('.vehicle_select').val();
                newVal.push(response.id);
                $(".vehicle_select").val(newVal);
                if(response.model){
                    $(".vehicle_create_model_select").append($('<option>', {value:response.model.id, text: response.model.text}));
                    vehicleCreateShowModel();
                }
                $('#vehicle_create_detail').val('');
            }
            else{
                $('#vehicleErrorMessage').text(response.error);
            }
        }
    });
});
NgApp.controller('vehicleController',function($http,$scope){
    $http.post(getVehicleElements_url).then(function(response){
        $scope.models   =   response.data.models;
    });
});
$(document).ready(function(){
    $('.vehicle_create_model_select').select2({
        dropdownParent: $('#vehicleCreateModal')
    });
    $('.vehicle_select').select2({
        placeholder:"Araç Giriniz",
        language:"tr",
        ajax:{
            type: 'POST',
            url: get_useable_vehicle_url,
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
    })
})
