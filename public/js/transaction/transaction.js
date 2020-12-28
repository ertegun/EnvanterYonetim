$(document).ready( function () {
    var table = $('#table').DataTable({
        processing:true,
        serverSide:true,
        ajax:{
            url:'/islemgecmisi/ajax',
            type:'POST',
        },
        columns: [
            {data: 'trans_type'},
            {data: 'created_at',
             render:function (data,type,row) {
                var dateObj = new Date(data);
                return dateObj.toLocaleDateString();
            }},
            {data: 'hard_bn'},
            {data: 'admin_name'},
            {data: 'user_name'}
        ],
        createdRow: function (row, data, index) {
            if (data.trans_type.split(' ')[1]=="İade") {
                $(row).addClass('table-danger');
            }
            else{
                $(row).addClass('table-success');
            }
            if(data.hard_bn){
                var row = $(row)[0].children[2];
                row.setAttribute('data-search',data.hard_sn);
                row.innerHTML='Ekipman: '+data.hard_bn+
                ' <span class="d-inline-block" tabindex="-1" data-toggle="tooltip" data-placement="top" title="Tipi: '+data.hard_type+' Seri No: '+data.hard_sn+' Detay: '+data.hard_detail+'">'
                    +'<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-info-circle-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">'
                        +'<path fill-rule="evenodd" d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412l-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM8 5.5a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>'
                    +'</svg></span>';
            }
            if(data.soft_name){
                var row = $(row)[0].children[2];
                row.innerHTML='Yazılım: '+data.soft_name;
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
        lengthMenu: [ [10, 25, 50, -1], ["10 Adet", "25 Adet", "50 Adet", "Tümü"] ],
        dom: '<"top"Bf>t<"bottom"lp><"clear">',
        buttons:[
            {
                extend: 'pdf',
                footer: false,
                className:"btn-sm btn-danger",
                pageSize: 'A4',
                title: $('#report_title').data('name')+' Raporu',
                filename: $('#report_title').data('name')+' Raporu',
                customize: function(doc) {
                    doc.pageMargins = [ 80, 20, 80, 20 ];
                    doc.defaultStyle.fontSize = 14;
                    doc.styles.tableHeader.fontSize = 14;
                },
                exportOptions:{
                    columns:[0,1,2,3]
                }
            },
            {
                extend: 'excel',
                className:"btn-sm btn-danger",
                title: $('#report_title').data('name')+' Raporu',
                filename: $('#report_title').data('name')+' Raporu',
                footer: false,
                exportOptions:{
                    columns:[0,1,2,3]
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
