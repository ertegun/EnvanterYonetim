$(document).ready( function () {
    $('#commonItemTable').DataTable({
    ajax:{
        type:'POST',
        url: common_item_table_ajax_url,
        dataSrc: 'common_item'
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
            title:'Detay',
            data:'detail',
            render:function(data){
                var html ='';
                if(data){
                    var detail_row = data.replaceAll('\\n', ' ');
                    var detail = data.replaceAll('\\n', '</br>');
                }
                else{
                    var detail_row = 'Yok';
                    var detail = '';
                }
                if(detail_row.length >20){
                    html+=detail_row.slice(0,18)
                    +'<span class="d-inline-block" tabindex="-1" data-toggle="tooltip" data-html="true" data-placement="bottom" title="'
                    +detail+'"><i class="fas fa-ellipsis-h" style="vertical-align: bottom;"></i></span>';

                }
                else{
                    html += detail_row;
                }
                return html;
            }
        },
        {
            title:'Kullanıcı Sayısı',
            class: 'text-center',
            data: 'owner_count'
        },
        {
            title:'Kullanıcılar',
            class: 'text-center',
            data:null,
            render:function(row){
                var html ='';
                if(row.owners.length > 0){
                    if(row.owners.length == 1){
                        return row.owners[0].name;
                    }
                    else{
                        html+=row.owners[0].name
                        +'<span class="d-inline-block" tabindex="-1" data-toggle="tooltip" data-html="true" data-placement="bottom" title="';
                        row.owners.forEach(function(data){
                            html+=data.name+'</br>';
                        })
                        html+='"><i class="fas fa-ellipsis-h" style="vertical-align: bottom;"></i></span>';
                        return html;
                    }
                }
                else{
                    return 'Yok';
                }
            }
        },
        {
            title:'İşlemler',
            data: null,
            class: 'text-center',
            orderable:false,
            render:function(row){
                var html ='';
                if(row.detail){
                    var detail = row.detail.replaceAll('\\n', '</br>');
                    var detail_text = row.detail;
                }
                else{
                    var detail_text = '';
                    var detail = '';
                }
                html+='<span class="d-inline-block mr-1" tabindex="-1" data-toggle="tooltip" data-placement="bottom" title="Geçerli Ekipmanı Düzenle">'
                +'<a onclick="commonItemUpdate(\''+row.id+'\',\''+row.type_id+'\',\''+row.name+'\',\''+detail_text+'\')" data-toggle="modal" data-target="#commonItemUpdateModal">'
                +'<i class="fas fa-edit table-icon text-primary"></i></a></span>';
                if(row.owner_count == 0){
                    html+='<span class="d-inline-block" tabindex="-1" data-toggle="tooltip" data-placement="bottom" title="Geçerli Ekipmanı Siler!">'
                    +'<a onclick="commonItemDelete(\''+row.id+'\',\''+row.type+'\',\''+row.name+'\',\''+detail+'\')" data-toggle="modal" data-target="#commonItemDeleteModal">'
                    +'<i class="fas fa-trash-alt table-icon text-danger"></i></a></span>';
                }
                else{
                    html+='<span class="d-inline-block" tabindex="-1" data-toggle="tooltip" data-html="true" data-placement="bottom" title="Öncelikle Geçerli Ekipman </br> Üzerindeki </br>Tüm Kullanıcıları Kullanıcı</br> Sayfasından Kullanım Dışı </br> Yapınız!">'
                    +'<a href="#" class="disabled"  role="button" aria-disabled="true" style="pointer-events: none;">'
                    +'<i class="fas fa-trash-alt table-icon-disabled"></i></a></span>';
                }
                return html;
            }
        },
        {
            title: 'Sahipleri',
            data:null,
            visible: false,
            render:function(row){
                var html ='';
                if(row.owner_count != 0){
                    row.owners.forEach(function(data){
                        html+=data.name+'   ';
                    })
                    return html;
                }
                else{
                    return 'Yok';
                }
            }
        },
        {
            title:'Detay',
            data:'detail',
            visible:false,
            render:function(data){
                if(data){
                    return data.replaceAll('\\n', '   ');
                }
                else{
                    return 'Yok';
                }
            }
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
            title: 'Ortak Kullanım Raporu',
            filename: 'Ortak Kullanım Raporu',
            customize: function(doc) {
                doc.pageMargins = [ 60, 20, 60, 20 ];
                doc.defaultStyle.fontSize = 14;
                doc.styles.tableHeader.fontSize = 14;
            },
            exportOptions:{
                columns:[0,1,7,3,6]
            }
        },
        {
            extend: 'excel',
            className:"btn-sm btn-danger",
            title: 'Ortak Kullanım Raporu',
            filename: 'Ortak Kullanım Raporu',
            footer: false,
            exportOptions:{
                columns:[0,1,7,3,6],
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

});
