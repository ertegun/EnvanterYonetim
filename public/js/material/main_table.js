$(document).ready( function () {
    setTimeout(createHardwareTable,300);
    function createHardwareTable (){
        $('#materialTable').DataTable({
        ajax:{
            type:'POST',
            url: material_table_ajax_url,
            dataSrc: 'material'
        },
        columns: [
            {
                title:'Türü',
                data: 'type',
            },
            {
                title:'Toplam Kullanım',
                data: 'using_item',
                class:'text-center'
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
                    if(detail_row.length >70){
                        html+=detail_row.slice(0,68)
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
                    if(row.using_item >0 ){
                        html+='<span class="d-inline-block mr-1" tabindex="-1" data-toggle="tooltip" data-html="true" data-placement="bottom" title="Öncelikle Geçerli Tüm </br> Malzemeleri Kullanıcı</br> Sayfasından İade Alınız!">'
                        +'<a href="#" class="disabled"  role="button" aria-disabled="true" style="pointer-events: none;">'
                        +'<i class="fas fa-edit table-icon-disabled"></i></a></span>'
                        +'<span class="d-inline-block" tabindex="-1" data-toggle="tooltip" data-html="true" data-placement="bottom" title="Öncelikle Geçerli Tüm </br> Malzemeleri Kullanıcı</br> Sayfasından İade Alınız!">'
                        +'<a href="#" class="disabled"  role="button" aria-disabled="true" style="pointer-events: none;">'
                        +'<i class="fas fa-trash-alt table-icon-disabled"></i></a></span>';
                    }
                    else{
                        html+='<span class="d-inline-block mr-1" tabindex="-1" data-toggle="tooltip" data-placement="bottom" title="Geçerli Malzemeyi Düzenle">'
                        +'<a onclick="materialUpdate(\''+row.id+'\',\''+row.type_id+'\',\''+detail_text+'\')" data-toggle="modal" data-target="#materialUpdateModal">'
                        +'<i class="fas fa-edit table-icon text-primary"></i></a></span>'
                        +'<span class="d-inline-block" tabindex="-1" data-toggle="tooltip" data-placement="bottom" title="Geçerli Malzemeyi Siler!">'
                        +'<a onclick="materialDelete(\''+row.id+'\',\''+row.type+'\',\''+detail+'\')" data-toggle="modal" data-target="#materialDeleteModal">'
                        +'<i class="fas fa-trash-alt table-icon text-danger"></i></a></span>';
                    }
                    return html;
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
                title: 'Malzeme Raporu',
                filename: 'Malzeme Raporu',
                customize: function(doc) {
                    doc.pageMargins = [ 60, 20, 60, 20 ];
                    doc.defaultStyle.fontSize = 14;
                    doc.styles.tableHeader.fontSize = 14;
                },
                exportOptions:{
                    columns:[0,1,2]
                }
            },
            {
                extend: 'excel',
                className:"btn-sm btn-danger",
                title: 'Malzeme Raporu',
                filename: 'Malzeme Raporu',
                footer: false,
                exportOptions:{
                    columns:[0,1,2],
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
