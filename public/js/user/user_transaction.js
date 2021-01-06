$(document).ready( function () {
    $('[data-toggle="tooltip"]').tooltip();
    $('#userTransactionTable').DataTable({
        columnDefs:[
            {
                targets:["nosort"],
                orderable:false
            }
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
                title: $('#userTransactionTable').data('name')+' İşlem Geçmişi',
                filename: $('#userTransactionTable').data('name')+' İşlem Geçmişi',
                customize: function(doc) {
                    doc.pageMargins = [ 100, 20, 100, 20 ];
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
                footer: false,
                title: $('#userTransactionTable').data('name')+' İşlem Geçmişi',
                filename: $('#userTransactionTable').data('name')+' İşlem Geçmişi',
                exportOptions:{
                    columns:[0,1,2,3,4,5]
                }
            }
        ],
        language:{
            "sDecimal":        ",",
            "sEmptyTable":     "Kullanıcı Üzerine İşlem Kaydı Bulunmamaktadır",
            "sInfo":           "_TOTAL_ kayıttan _START_ - _END_ arasındaki kayıtlar gösteriliyor",
            "sInfoEmpty":      "Kayıt yok",
            "sInfoFiltered":   "(_MAX_ kayıt içerisinden bulunan)",
            "sInfoPostFix":    "",
            "sInfoThousands":  ".",
            "sLengthMenu":     "_MENU_ göster",
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
        }
    });
});
