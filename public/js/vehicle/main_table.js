$(document).ready( function () {
    setTimeout(createVehicleTable,300);
    function createVehicleTable (){
        $('#vehicleTable').DataTable({
        ajax:{
            type:'POST',
            url: vehicle_table_ajax_url,
            dataSrc: 'vehicle'
        },
        columns: [
            {
                title:'Araç Adı',
                data: 'name',
            },
            {
                title:'Marka',
                data:'model'
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
                    if(row.detail){
                        var detail = row.detail.replaceAll('\\n', '</br>');
                        var detail_text = row.detail;
                    }
                    else{
                        var detail = '';
                        var detail_text = '';
                    }
                    var html ='<span class="d-inline-block mr-1" tabindex="-1" data-toggle="tooltip" data-placement="bottom" title="Geçerli Ekipmanı Düzenle">'
                    +'<a onclick="vehicleUpdate(\''+detail_text+'\',\''+row.model_id+'\',\''+row.name+'\',\''+row.id+'\')" data-toggle="modal" data-target="#vehicleUpdateModal">'
                    +'<i class="fas fa-edit table-icon text-primary"></i></a></span>';
                    if(!row.owner){
                        html+='<span class="d-inline-block" tabindex="-1" data-toggle="tooltip" data-placement="bottom" title="Geçerli Ekipmanı Siler!">'
                        +'<a onclick="vehicleDelete(\''+detail+'\',\''+row.model+'\',\''+row.name+'\',\''+row.id+'\')" data-toggle="modal" data-target="#vehicleDeleteModal">'
                        +'<i class="fas fa-trash-alt table-icon text-danger"></i></a></span>';
                    }
                    else{
                        html+='<span class="d-inline-block" tabindex="-1" data-toggle="tooltip" data-html="true" data-placement="bottom" title="Öncelikle Geçerli Aracı </br> Kullanıcı Sayfasından </br> İade Alınız!">'
                        +'<a href="#" class="disabled"  role="button" aria-disabled="true" style="pointer-events: none;">'
                        +'<i class="fas fa-trash-alt table-icon-disabled"></i></a></span>';
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
                title: 'Araç Raporu',
                filename: 'Araç Raporu',
                customize: function(doc) {
                    doc.pageMargins = [ 60, 20, 60, 20 ];
                    doc.defaultStyle.fontSize = 14;
                    doc.styles.tableHeader.fontSize = 14;
                },
                exportOptions:{
                    columns:[0,1,3,5]
                }
            },
            {
                extend: 'excel',
                className:"btn-sm btn-danger",
                title: 'Araç Raporu',
                filename: 'Araç Raporu',
                footer: false,
                exportOptions:{
                    columns:[0,1,3,5],
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
