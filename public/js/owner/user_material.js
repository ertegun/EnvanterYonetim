function createMaterialTable (){
    if($('#materialCollapse').hasClass('drawTable')==false){
        $('#materialTable').DataTable({
        ajax:{
            type:'POST',
            url: owner_material_table_ajax_url,
            data: {'id':user_id},
            dataSrc: 'materials',
            complete: function(response){
                showMaterialWidgets(response.responseJSON.html);
            }
        },
        columns: [
            {
                title:'Türü',
                data: 'type',
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
                title:'Önceki Veriliş Tarihi',
                data: 'prev_issue_time'
            },
            {
                title:'Veriliş Tarihi',
                data:null,
                render:function(row){
                    var html='';
                    if(row.role){
                        html += '<span class="d-inline-block mr-2" tabindex="-1" data-toggle="tooltip" data-placement="bottom" title="Zimmet Tarihini Değiştir">'
                        +'<a data-toggle="modal" data-target="#changeIssueTimeModal" '
                        +'onclick="changeIssueTime(\'material\',\''+row.id+'\',\''+row.issue_input+'\')"'
                        +' class="text-decoration-none"><i class="fas fa-clock table-icon text-success"></i></a></span>'
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
                        var html='<span class="d-inline-block mr-2" tabindex="-1" data-toggle="tooltip" data-placement="bottom" title="Geçerli Malzemeyi İade Al">'
                        +'<a data-toggle="modal" data-target="#materialDropModal" '
                        +'onclick="materialDrop(\''+row.id+'\',\''+row.get_info.id+'\')"'
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
                title: $('#userName').data('name')+' Malzeme Raporu',
                filename: $('#userName').data('name')+' Malzeme Raporu',
                customize: function(doc) {
                    doc.pageMargins = [ 60, 20, 60, 20 ];
                    doc.defaultStyle.fontSize = 14;
                    doc.styles.tableHeader.fontSize = 14;
                },
                exportOptions:{
                    columns:[0,5,2,3]
                }
            },
            {
                extend: 'excel',
                className:"btn-sm btn-danger",
                title: $('#userName').data('name')+' Malzeme Raporu',
                filename: $('#userName').data('name')+' Malzeme Raporu',
                footer: false,
                exportOptions:{
                    columns:[0,5,2,3],
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
        $('#materialCollapse').addClass('drawTable');
    }
}
function showMaterialWidgets(html){
    let full_html='';
    if(html){
        if(html.length > 0){
            html.forEach(function(element){
                full_html+=element;
            });
        }
    }
    $('#materialWidget').html(full_html);
}

