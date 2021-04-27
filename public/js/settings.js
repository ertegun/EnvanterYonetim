$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    dataType: 'json',
});
var NgApp = angular.module("NgApp",[]);
$.fn.select2.defaults.set( "theme", "bootstrap" );

$(document).ready(function () {
    $(":file").filestyle({
        htmlIcon: '<i class="fas fa-folder-open"></i>',
        text: "Dosya Seç",
        btnClass: "btn-primary",
        placeholder: "Dosya Seçilmedi"
    });
    setTimeout(function(){
        $('.alert-success').hide();
        $('.alert-error').hide();
    },5000);
});
