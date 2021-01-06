$(document).ready( function () {
    var table = $('#table').DataTable({
        processing:true,
        serverSide:true,
        ajax:{
            url: transaction_ajax_url,
            type:'POST',
        },
        columns: [
            {
                data:'type',
                name:'transaction_type.name'
            },
            {
                data:'issue_time',
                name:'transaction.created_at'
            },
            {
                data: 'trans_info',
                name:'trans_info'
            },
            {
                data: 'trans_details',
                name:'trans_details'
            },
            {
                data: 'user_name',
                name:'user_name'
            },
            {
                data: 'admin_name',
                name:'admin_name'
            }
        ],
        createdRow:function(row,data,index){
            if(data.type_id %2 ==1){
                $(row).addClass('table-success');
            }
            else{
                $(row).addClass('table-danger');
            }
        },
        columnDefs:[
            {
                targets:["nosort"],
                orderable:false
            },
        ],
        order:[
            [1,"desc"]
        ],
        scrollY: "300px",
        lengthMenu: [ [10, 25, 50, -1], ["10 Adet", "25 Adet", "50 Adet", "Tümü"] ],
        dom: '<"top"Bf>t<"bottom"lp><"clear">',
        buttons:[
            {
                extend: 'pdf',
                footer: false,
                className:"btn-sm btn-danger",
                pageSize: 'A4',
                title: "İşlem Geçmişi Raporu",
                filename: "İşlem Geçmişi Raporu",
                customize: function(doc) {
                    doc.pageMargins = [ 80, 20, 80, 20 ];
                    doc.defaultStyle.fontSize = 14;
                    doc.styles.tableHeader.fontSize = 14;
                },
                exportOptions:{
                    columns:[0,1,2,3,4,5]
                }
            },
            {
                extend: 'excel',
                className:"btn-sm btn-danger",
                title: "İşlem Geçmişi Raporu",
                filename: "İşlem Geçmişi Raporu",
                footer: false,
                exportOptions:{
                    columns:[0,1,2,3,4,5]
                }
            }
        ],
        language:{
            "sDecimal":        ",",
            "sEmptyTable":     "Kayıt Bulunmamaktadır",
            "sInfo":           "_TOTAL_ kayıttan _START_ - _END_ arasındaki kayıtlar gösteriliyor",
            "sInfoEmpty":      "Kayıt yok",
            "sInfoFiltered":   "(_MAX_ kayıt içerisinden bulunan)",
            "sInfoPostFix":    "",
            "sInfoThousands":  ".",
            "sLengthMenu":     " _MENU_ göster",
            "sLoadingRecords": "Yükleniyor...",
            "sProcessing":     "İşleniyor...",
            "sSearch":         "Ara:",
            "sZeroRecords":    "Eşleşen kayıt bulunamadı",
            "oPaginate": {
                "sFirst":    "İlk",
                "sLast":     "Son",
                "sNext":     "Sonraki",
                "sPrevious": "Önceki"
            },
            "oAria": {
                "sSortAscending":  ": artan sütun sıralamasını aktifleştir",
                "sSortDescending": ": azalan sütun sıralamasını aktifleştir"
            },
            "select": {
                "rows": {
                    "_": "%d kayıt seçildi",
                    "0": "",
                    "1": "1 kayıt seçildi"
                }
            }
        },
        drawCallback: function() {
            $('[data-toggle="tooltip"]').tooltip();
        }
    });
});
