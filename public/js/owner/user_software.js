function createSoftwareTable (){
    if($('#softwareCollapse').hasClass('drawTable')==false){
        $('#softwareTable').DataTable({
        ajax:{
            type:'POST',
            url: owner_software_table_ajax_url,
            data: {'id':user_id},
            dataSrc: 'softwares'
        },
        columns: [
            {
                title:'Adı',
                data:'get_info.name'
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
                data:'get_info.license_time',
                class: 'text-center',
                render:function(data){
                    if(data){
                        return data;
                    }
                    else{
                        return "Süresiz";
                    }
                }
            },
            {
                title:'Zimmet Tarihi',
                data:null,
                render:function(row){
                    var html = '';
                    if(row.role){
                        html += '<span class="d-inline-block mr-2" tabindex="-1" data-toggle="tooltip" data-placement="bottom" title="Zimmet Tarihini Değiştir">'
                        +'<a data-toggle="modal" data-target="#changeIssueTimeModal" '
                        +'onclick="changeIssueTime(\'software\',\''+row.get_info.id+'\',\''+row.issue_input+'\')"'
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
                        var html='<span class="d-inline-block mr-2" tabindex="-1" data-toggle="tooltip" data-placement="bottom" title="Geçerli Yazılımı İade Al">'
                        +'<a data-toggle="modal" data-target="#softwareDropModal" '
                        +'onclick="softwareDrop(\''+row.get_info.id+'\')"'
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
                title: $('#userName').data('name')+' Yazılım Raporu',
                filename: $('#userName').data('name')+' Yazılım Raporu',
                customize: function(doc) {
                    doc.pageMargins = [ 60, 20, 60, 20 ];
                    doc.defaultStyle.fontSize = 14;
                    doc.styles.tableHeader.fontSize = 14;
                },
                exportOptions:{
                    columns:[0,1,2,3,4,6]
                }
            },
            {
                extend: 'excel',
                className:"btn-sm btn-danger",
                title: $('#userName').data('name')+' Yazılım Raporu',
                filename: $('#userName').data('name')+' Yazılım Raporu',
                footer: false,
                exportOptions:{
                    columns:[0,1,2,3,4,6],
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
        $('#softwareCollapse').addClass('drawTable');
    }
}
