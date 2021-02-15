$(document).ready( function () {
    setTimeout(createHardwareTable,300);
    function createHardwareTable (){
        $('#softwareTable').DataTable({
        ajax:{
            type:'POST',
            url: software_table_ajax_url,
            dataSrc: 'software'
        },
        columns: [
            {
                title:'Adı',
                data:'name'
            },
            {
                title:'Türü',
                data: 'type',
            },
            {
                title:'Alınış Tarihi',
                orderable:false,
                data: null,
                render: function (row) {
                    var html = '';
                    if(row.finish_time){
                        html +=row.start_time_show
                        +'<span class="d-inline-block" tabindex="-1" data-toggle="tooltip" data-placement="bottom" title="Bitiş Tarihi : '
                        +row.finish_time_show+'"><i class="fas fa-info-circle"></i></span>';
                    }
                    else{
                         html += row.start_time_show;
                    }
                    return html;
                }
            },
            {
                title:'Lisans Süresi',
                data:'license_time',
                class: 'text-center',
                render:function(data){
                    if(data){
                        return data+" Yıl";
                    }
                    else{
                        return "Süresiz";
                    }
                }
            },
            {
                title:'Sahibi',
                data: 'owner',
                render:function(data){
                    if(!data){
                        return "Yok";
                    }
                    else{
                        return data;
                    }
                }
            },
            {
                title:'İşlemler',
                data: null,
                class: 'text-center',
                orderable:false,
                render:function(row){
                    var html ='<span class="d-inline-block mr-1" tabindex="-1" data-toggle="tooltip" data-placement="bottom" title="Geçerli Yazılımı Düzenle">'
                    +'<a onclick="softwareUpdate(\''+row.id+'\',\''+row.name+'\',\''+row.type_id+'\',\''+row.license_time+'\',\''+row.update_time+'\')" data-toggle="modal" data-target="#softwareUpdateModal">'
                    +'<i class="fas fa-edit table-icon text-primary"></i></a></span>';
                    if(!row.owner){
                        html+='<span class="d-inline-block" tabindex="-1" data-toggle="tooltip" data-placement="bottom" title="Geçerli Yazılımı Siler!">'
                        +'<a onclick="softwareDelete(\''+row.id+'\',\''+row.name+'\',\''+row.type+'\')" data-toggle="modal" data-target="#softwareDeleteModal">'
                        +'<i class="fas fa-trash-alt table-icon text-danger"></i></a></span>';
                    }
                    else{
                        html+='<span class="d-inline-block" tabindex="-1" data-toggle="tooltip" data-html="true" data-placement="bottom" title="Öncelikle Geçerli Yazılımı </br> Kullanıcı Sayfasından </br> İade Alınız!">'
                        +'<a href="#" class="disabled"  role="button" aria-disabled="true" style="pointer-events: none;">'
                        +'<i class="fas fa-trash-alt table-icon-disabled"></i></a></span>';
                    }
                    return html;
                }
            },
            {
                title: 'Bitiş Tarihi',
                data: 'finish_time_show',
                visible: false
            }
        ],
        lengthMenu: [ [10, 25, 50, -1], ["10 Adet", "25 Adet", "50 Adet", "Tümü"] ],
        dom: '<"top"Bf>t<"bottom"lp><"clear">',
        buttons:[
            {
                extend: 'pdf',
                footer: false,
                className:"btn-sm btn-danger",
                pageSize: 'A4',
                title: 'Yazılım Raporu',
                filename: 'Yazılım Raporu',
                customize: function(doc) {
                    doc.pageMargins = [ 60, 20, 60, 20 ];
                    doc.defaultStyle.fontSize = 14;
                    doc.styles.tableHeader.fontSize = 14;
                },
                exportOptions:{
                    columns:[0,1,2,6,3,4]
                }
            },
            {
                extend: 'excel',
                className:"btn-sm btn-danger",
                title: 'Yazılım Raporu',
                filename: 'Yazılım Raporu',
                footer: false,
                exportOptions:{
                    columns:[0,1,2,6,3,4],
                    trim:false
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
    }
});
