function createVehicleTable (){
    if($('#vehicleCollapse').hasClass('drawTable')==false){
        $('#vehicleTable').DataTable({
        ajax:{
            type:'POST',
            url: owner_vehicle_table_ajax_url,
            data: {'id':user_id},
            dataSrc: 'vehicles'
        },
        columns: [
            {
                title:'Araç Adı',
                data:'get_info.name'
            },
            {
                title:'Marka',
                data: 'model',
            },
            {
                title:'Detay',
                data:'get_info.detail',
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
                title:'Zimmet Tarihi',
                data:null,
                render:function(row){
                    var html='';
                    if(row.role){
                        html += '<span class="d-inline-block mr-2" tabindex="-1" data-toggle="tooltip" data-placement="bottom" title="Zimmet Tarihini Değiştir">'
                        +'<a data-toggle="modal" data-target="#changeIssueTimeModal" '
                        +'onclick="changeIssueTime(\'vehicle\',\''+row.get_info.id+'\',\''+row.issue_input+'\')"'
                        +' class="text-decoration-none"><i class="fas fa-clock table-icon text-success"></i></a></span>';
                    }
                    html+=row.issue_time;
                    return html;
                }
            },
            {
                title:'İşlemler',
                data:null,
                class: 'text-center',
                render:function(row){
                    if(row.role){
                        if(row.get_info.detail){
                            var detail = row.get_info.detail.replaceAll('\\n', '</br>');
                        }
                        else{
                            var detail = '';
                        }
                        var html='<span class="d-inline-block mr-2" tabindex="-1" data-toggle="tooltip" data-placement="bottom" title="Geçerli Aracı Teslim Al">'
                        +'<a data-toggle="modal" data-target="#vehicleDropModal" '
                        +'onclick="vehicleDrop(\''+row.get_info.id+'\',\''+row.get_info.name+'\',\''+row.model+'\',\''+detail+'\')"'
                        +' class="text-decoration-none"><i class="fas fa-eraser table-icon text-danger"></i></a></span>';
                    }
                    else{
                        var html='<span class="d-inline-block mr-2" tabindex="-1" data-toggle="tooltip" data-placement="bottom" title="Yetkiniz Yok!">'
                        +'<a href="#" class="disabled"  role="button" aria-disabled="true" style="pointer-events: none;">'
                        +'<i class="fas fa-eraser table-icon-disabled"></i></a></span>';
                    }
                    return html;
                }
            },
            {
                title: 'Detay',
                data: 'get_info.detail',
                visible: false,
                render: function(data){
                    if(data){
                        var html = data.replaceAll('\\n','  ');
                        return html;
                    }
                    else{
                        return " ";
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
                title: $('#userName').data('name')+' Araç Raporu',
                filename: $('#userName').data('name')+' Araç Raporu',
                customize: function(doc) {
                    doc.pageMargins = [ 60, 20, 60, 20 ];
                    doc.defaultStyle.fontSize = 14;
                    doc.styles.tableHeader.fontSize = 14;
                },
                exportOptions:{
                    columns:[0,1,2,3,5]
                }
            },
            {
                extend: 'excel',
                className:"btn-sm btn-danger",
                title: $('#userName').data('name')+' Araç Raporu',
                filename: $('#userName').data('name')+' Araç Raporu',
                footer: false,
                exportOptions:{
                    columns:[0,1,2,3,5],
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
        $('#vehicleCollapse').addClass('drawTable');
    }
}
