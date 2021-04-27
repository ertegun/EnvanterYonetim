$(document).ready( function () {
    $('#fixtureTable').DataTable({
    ajax:{
        type:'POST',
        url: fixture_table_ajax_url,
        dataSrc: 'fixture'
    },
    columns: [
        {
            title:'Adı',
            data: 'name',
        },
        {
            title:'Tür',
            data: 'get_type.name',
        },
        {
            title:'Marka',
            data:'get_brand.name'
        },
        {
            title:'Barkod No',
            orderable:false,
            data: null,
            render: function (row) {
                var html = '';
                if(row.serial_number){
                    html +='<span class="d-inline-block" tabindex="-1" data-toggle="tooltip" data-placement="bottom" title="Seri No : '
                    +row.serial_number+'"><i class="fas fa-info-circle"></i></span>'
                    +row.get_department.prefix+'-'+row.get_section.prefix+'-'+row.get_type.prefix+'-'+row.barcode_number;
                }
                else{
                    html += row.get_department.prefix+'-'+row.get_section.prefix+'-'+row.get_type.prefix+'-'+row.barcode_number;
                }
                return html;
            }
        },
        {
            title:'Tutar',
            data:'price',
            render:function(data){
                return data+' <i class="fas fa-lira-sign"></i>';
            }
        },
        {
            title:'Adet',
            data:'count',
            render:function(data){
                return data+' Adet';
            }
        },
        {
            title:'Garanti',
            data:'warranty',
            render:function(data){
                return data+' Yıl';
            }
        },
        {
            title:'Ömür',
            data:'duration',
            render:function(data){
                return data+' Yıl';
            }
        },
        {
            title:'Tedarikçi',
            data: null,
            render:function (row) {
                var html = '';
                if(row.get_supplier){
                    html +='<span class="d-inline-block" tabindex="-1" data-toggle="tooltip" data-placement="bottom" title="Tel : '
                    +row.get_supplier.telephone+'"><i class="fas fa-info-circle"></i></span>'
                    +row.get_supplier.name;
                }
                else{
                    html += '-';
                }
                return html;
            }
        },
        {
            title:'Açıklama',
            data:'explanation',
            render:function(data){
                return ellipsis(data);
            }
        },
        {
            title:'Detay Bilgi',
            data:'detail',
            render:function(data){
                return ellipsis(data);
            }
        },
        {
            title:'Sahibi',
            data: null,
            render:function(row){
                if(!row.get_owner){
                    return "Sahipsiz";
                }
                else{
                    return row.get_owner.name;
                }
            }
        },
        {
            title:'İşlemler',
            data: null,
            class: 'text-center',
            orderable:false,
            render:function(row){
                var html ='<span class="d-inline-block mr-1" tabindex="-1" data-toggle="tooltip" data-placement="bottom" title="Geçerli Demirbaşı Düzenle">'
                +'<a onclick="fixtureUpdate(\''+row.id+'\')" data-toggle="modal" data-target="#fixtureUpdateModal">'
                +'<i class="fas fa-edit table-icon text-primary"></i></a></span>';
                if(!row.get_owner){
                    html+='<span class="d-inline-block" tabindex="-1" data-toggle="tooltip" data-placement="bottom" title="Geçerli Demirbaşı Siler!">'
                    +'<a onclick="fixtureDelete(\''+row.id+'\')" data-toggle="modal" data-target="#fixtureDeleteModal">'
                    +'<i class="fas fa-trash-alt table-icon text-danger"></i></a></span>';
                }
                else{
                    html+='<span class="d-inline-block" tabindex="-1" data-toggle="tooltip" data-html="true" data-placement="bottom" title="Öncelikle Geçerli Demirbaşı </br> Kullanıcı Sayfasından </br> İade Alınız!">'
                    +'<a href="#" class="disabled"  role="button" aria-disabled="true" style="pointer-events: none;">'
                    +'<i class="fas fa-trash-alt table-icon-disabled"></i></a></span>';
                }
                return html;
            }
        },
        {
            title: 'Seri No',
            data:'serial_number',
            visible: false
        },
        {
            title:'Açıklama',
            data:'explanation',
            visible:false,
        },
        {
            title:'Detay',
            data:'detail',
            visible:false,
        }
    ],
    scrollX:true,
    scrollY: "300px",
    lengthMenu: [ [10, 25, 50, -1], ["10 Adet", "25 Adet", "50 Adet", "Tümü"] ],
    dom: '<"top"Bf>t<"bottom"lp><"clear">',
    buttons:[
        {
            extend: 'pdf',
            footer: false,
            className:"btn-sm btn-danger",
            pageSize: 'A4',
            title: 'Demirbaş Raporu',
            filename: 'Demirbaş Raporu',
            customize: function(doc) {
                doc.pageMargins = [ 60, 20, 60, 20 ];
                doc.defaultStyle.fontSize = 14;
                doc.styles.tableHeader.fontSize = 14;
            },
            exportOptions:{
                columns:[0,1,2,7,3,8,5]
            }
        },
        {
            extend: 'excel',
            className:"btn-sm btn-danger",
            title: 'Demirbaş Raporu',
            filename: 'Demirbaş Raporu',
            footer: false,
            exportOptions:{
                columns:[0,1,2,7,3,8,5],
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
