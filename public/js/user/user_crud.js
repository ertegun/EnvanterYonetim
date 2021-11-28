function CreateNewDepartment(){
    var select    =   $('.create_department_select');
    var department       =   $('#create_new_department');
    select.prop('required',false);
    select.prop('disabled',true);
    select.select2('destroy');
    select.hide();
    department.prop('required',true);
    department.prop('disabled',false);
    department.show();
}
function CreateShowDepartment(){
    var select    =   $('.create_department_select');
    var department       =   $('#create_new_department');
    department.val('');
    department.prop('required',false);
    department.prop('disabled',true);
    department.hide();
    select.select2({
        dropdownParent: $('#userCreateModal')
    });
    select.prop('required',true);
    select.prop('disabled',false);
    select.show();
}
function UpdateNewDepartment(){
    var select    =   $('.update_department_select');
    var department       =   $('#update_new_department');
    select.prop('required',false);
    select.prop('disabled',true);
    select.select2('destroy');
    select.hide();
    department.prop('required',true);
    department.prop('disabled',false);
    department.show();
}
function UpdateShowDepartment(){
    var select    =   $('.update_department_select');
    var department       =   $('#update_new_department');
    department.val('');
    department.prop('required',false);
    department.prop('disabled',true);
    department.hide();
    select.select2({
        dropdownParent: $('#userCreateModal')
    });
    select.prop('required',true);
    select.prop('disabled',false);
    select.show();
}
NgApp.controller('userController',function($http,$scope){
    $http.post(getDepartments_url).then(function(response){
        $scope.departments    =   response.data.departments;
    });
});
$(document).ready(function(){
    $('.update_department_select').select2({
        dropdownParent: $('#userUpdateModal'),
    });
    $('.create_department_select').select2({
        dropdownParent: $('#userCreateModal'),
    });
});
/*$('#userCreateForm').on('submit',function(e){
    e.preventDefault();
    $.ajax({
        type:'POST',
        url: user_create_ajax_url,
        data: $('#userCreateForm').serialize(),
        success:function(response){
            if(response.id){
                $('#userCreateModal').modal('toggle');
                $('#routingModal').modal('toggle');
                routeOwnerPageUrl(response.id);
            }
            else{
                $('#userErrorMessage').text(response.error);
            }
        }
    });
});*/

