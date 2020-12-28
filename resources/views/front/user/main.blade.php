@extends('front.layouts.master')
@section('title',"Kullanıcı Yönetim")
@section('user_active',"active")
@section('content')
    @include('front.user.content.main')
@endsection
@section("script")
    <script>
        var user_table_ajax_url = "{{route('user_table_ajax')}}";
        function userUpdate(department_id,name,email,user_id){
            $('.department_select').select2("val",department_id);
            $('#user_update_name').val(name);
            $('#user_update_email').val(email);
            $('#user_update_id').val(user_id);
        }
        function userDelete(id,name,department){
            $('#user_id').val(id);
            $('#user_name').text(name);
            $('#user_department').text(department);
        }
        function NewDepartment(){
            var select    =   $('.department_select');
            var department       =   $('#new_department');
            select.prop('required',false);
            select.prop('disabled',true);
            select.select2('destroy');
            select.hide();
            department.prop('required',true);
            department.prop('disabled',false);
            department.show();
        }
        function ShowDepartment(){
            var select    =   $('.department_select');
            var department       =   $('#new_department');
            department.val('');
            department.prop('required',false);
            department.prop('disabled',true);
            department.hide();
            select.select2({
                dropdownParent: $('#userUpdateModal')
            });
            select.prop('required',true);
            select.prop('disabled',false);
            select.show();
        }
        $(document).ready(function(){
            $('.department_select').select2({
                dropdownParent: $('#userUpdateModal'),
                //selectionCssClass: 'custom-select'
            });
        });
        //Örnek Select2 Ajax
        /*$(document).ready(function(){
            $('.department_select').select2({
                placeholder:"Departman Adı Giriniz",
                minimumInputLength:2,
                maximumInputLength:5,
                language:"tr",
                ajax:{
                    type: 'POST',
                    url: "",
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
                    }
                },
                cache:true
            });
        });*/
    </script>
    <script src="{{ asset('js/user/user_table.js') }}"></script>
@endsection
