$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
var NgApp = angular.module("NgApp",[]);
$.fn.select2.defaults.set( "theme", "bootstrap" );
