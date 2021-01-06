$(document).ready( function () {
    setTimeout(createUserTable,250);
    function createUserTable (){
        $('#userTable').DataTable({
        ajax:{
            type:'POST',
            url: user_table_ajax_url,
            dataSrc: 'users'
        },
        columns: [
            {
                title:'Ad Soyad',
                data: 'name',
                render: function (data,type,row) {
                    var html ='<span class="d-inline-block" tabindex="-1" data-toggle="tooltip" data-placement="top" title="'
                    +row.email+'"><i class="fas fa-envelope"></i></span> '+row.name;
                    return html;
                }
            },
            {
                title:'Departman',
                data: 'department'
            },
            {
                title:'Donanım',
                data:'hardware_count',
                class: 'text-center'
            },
            {
                title:'Yazılım',
                data:'software_count',
                class: 'text-center'
            },
            {
                title:'Ortak Kullanım',
                data:'common_count',
                class: 'text-center'
            },
            {
                title:'Malzeme',
                data:'material_count',
                class: 'text-center'
            },
            {
                title:'İşlemler',
                data:'all_equipment',
                class: 'text-center',
                render:function(data,type,row){
                    var email = row.email;
                    email = email.split('@')[0];
                    var html ='<span class="d-inline-block mr-2" tabindex="-1" data-toggle="tooltip" data-placement="bottom" title="Geçerli Kullanıcı Üzerinde Zimmet İşlemleri">'
                    +'<a href="zimmet/'+row.id+'" class="text-decoration-none">'
                    +'<i class="fas fa-street-view table-icon text-success"></i></a></span>'
                    +'<span class="d-inline-block mr-2" tabindex="-1" data-toggle="tooltip" data-placement="bottom" title="Geçerli Kullanıcıya Zimmet Ata">'
                    +'<a href="zimmet/yeni/'+row.id+'" class="text-decoration-none">'
                    +'<i class="fas fa-truck-loading table-icon text-dark"></i></a></span>'
                    +'<span class="d-inline-block mr-2" tabindex="-1" data-toggle="tooltip" data-placement="bottom" title="Geçerli Kullanıcıyı Düzenle">'
                    +'<a data-toggle="modal" data-target="#userUpdateModal" onclick="userUpdate(\''+row.department_id+'\',\''+row.name+'\',\''+email+'\',\''+row.id+'\')" class="text-decoration-none">'
                    +'<i class="fas fa-edit table-icon text-primary"></i></a></span>';
                    if(row.all_equipment == 0){
                        html+='<span class="d-inline-block mr-2" tabindex="-1" data-toggle="tooltip" data-placement="bottom" title="Geçerli Kullanıcıyı Siler">'
                        +'<a data-toggle="modal" data-target="#userDeleteModal" onclick="userDelete(\''+row.id+'\',\''+row.name+'\',\''+row.department+'\')" class="text-decoration-none">'
                        +'<i class="fas fa-trash-alt table-icon text-danger"></i></a></span>';
                    }
                    else{
                        html+='<span class="d-inline-block mr-2" tabindex="-1" data-toggle="tooltip" data-placement="bottom" title="Öncelikle kullanıcı üzerindeki ekipmanları iade alınız!">'
                        +'<a href="#" class="disabled"  role="button" aria-disabled="true" style="pointer-events: none;">'
                        +'<i class="fas fa-trash-alt table-icon-disabled"></i></a></span>';
                    }
                    html+='<span class="d-inline-block" tabindex="-1" data-toggle="tooltip" data-placement="bottom" title="İşlemlerini Görüntüle">'
                    +'<a href="kullanici/islemler/'+row.id+'" class="text-decoration-none">'
                    +'<i class="fas fa-history table-icon text-warning"></i></a></span>'
                    //console.log(row.all_equipment);
                    return html;
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
                title: 'Kullanıcı Raporu',
                filename: 'Kullanıcı Raporu',
                customize: function(doc) {
                    doc.pageMargins = [ 60, 20, 60, 20 ];
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
                title: 'Kullanıcı Raporu',
                filename: 'Kullanıcı Raporu',
                footer: false,
                exportOptions:{
                    columns:[0,1,2,3,4,5],
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
