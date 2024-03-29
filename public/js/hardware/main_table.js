$(document).ready(function () {
  setTimeout(createHardwareTable, 300);
  function createHardwareTable() {
    $('#hardwareTable').DataTable({
      ajax: {
        type: 'POST',
        url: hardware_table_ajax_url,
        dataSrc: 'hardware'
      },
      columns: [
        {
          title: 'Tip',
          data: 'type',
        },
        {
          title: 'Marka',
          data: 'model'
        },
        {
          title: 'Barkod No',
          orderable: false,
          data: null,
          render: function (row) {
            var html = '';
            if (row.serial_number) {
              html += '<span class="d-inline-block" tabindex="-1" data-toggle="tooltip" data-placement="bottom" title="Seri No : '
                + row.serial_number + '"><i class="fas fa-info-circle"></i></span>'
                + row.barcode_number;
            }
            else {
              html += row.barcode_number;
            }
            return html;
          }
        },
        {
          title: 'Ömür',
          data: 'duration',
          render: function (data, row) {
            return data + ' Yıl';
          }
        },
        {
          title: 'Detay',
          data: 'detail',
          render: function (data) {
            var html = '';
            if (data) {
              var detail_row = data.replaceAll('\\n', ' ');
              var detail = data.replaceAll('\\n', '</br>');
            }
            else {
              var detail_row = 'Yok';
              var detail = '';
            }
            if (detail_row.length > 20) {
              html += detail_row.slice(0, 18)
                + '<span class="d-inline-block" tabindex="-1" data-toggle="tooltip" data-html="true" data-placement="bottom" title="'
                + detail + '"><i class="fas fa-ellipsis-h" style="vertical-align: bottom;"></i></span>';

            }
            else {
              html += detail_row;
            }
            return html;
          }
        },
        {
          title: 'Sahibi',
          data: 'owner',
          render: function (data) {
            if (!data) {
              return "Yok";
            }
            else {
              return data;
            }
          }
        },
        {
          title: 'İşlemler',
          data: null,
          class: 'text-center',
          orderable: false,
          render: function (row) {
            var html = `<span class="d-inline-block mr-1" tabindex="-1" data-toggle="tooltip" data-placement="bottom" title="Geçerli Ekipmanı Düzenle">
            <a onclick="hardwareUpdate('${row.id}')" data-toggle="modal" data-target="#hardwareUpdateModal">
            <i class="fas fa-edit table-icon text-primary"></i></a></span>`;
            if (!row.owner) {
              html += `<span class="d-inline-block" tabindex="-1" data-toggle="tooltip" data-placement="bottom" title="Geçerli Ekipmanı Siler!">
                <a onclick="hardwareDelete('${row.id}')" data-toggle="modal" data-target="#hardwareDeleteModal">
                <i class="fas fa-trash-alt table-icon text-danger"></i></a></span>`;
            }
            else {
              html += `<span class="d-inline-block" tabindex="-1" data-toggle="tooltip" data-html="true" data-placement="bottom" title="Öncelikle Geçerli Ekipmanı </br> Kullanıcı Sayfasından </br> İade Alınız!">
                <a href="#" class="disabled"  role="button" aria-disabled="true" style="pointer-events: none;">
                <i class="fas fa-trash-alt table-icon-disabled"></i></a></span>`;
            }
            return html;
          }
        },
        {
          title: 'Seri No',
          data: 'serial_number',
          visible: false
        },
        {
          title: 'Detay',
          data: 'detail',
          visible: false
        }
      ],
      lengthMenu: [[10, 25, 50, -1], ["10 Adet", "25 Adet", "50 Adet", "Tümü"]],
      dom: '<"top"Bf>t<"bottom"lp><"clear">',
      buttons: [
        {
          extend: 'pdf',
          footer: false,
          className: "btn-sm btn-danger",
          pageSize: 'A4',
          title: 'Donanım Raporu',
          filename: 'Donanım Raporu',
          customize: function (doc) {
            doc.pageMargins = [60, 20, 60, 20];
            doc.defaultStyle.fontSize = 14;
            doc.styles.tableHeader.fontSize = 14;
          },
          exportOptions: {
            columns: [0, 1, 2, 7, 3, 8, 5]
          }
        },
        {
          extend: 'excel',
          className: "btn-sm btn-danger",
          title: 'Donanım Raporu',
          filename: 'Donanım Raporu',
          footer: false,
          exportOptions: {
            columns: [0, 1, 2, 7, 3, 8, 5],
            trim: false
          }
        }
      ],
      language: {
        "sDecimal": ",",
        "sEmptyTable": "Kayıt Bulunmamaktadır",
        "sInfo": "_TOTAL_ kayıttan _START_ - _END_ arasındaki kayıtlar gösteriliyor",
        "sInfoEmpty": "Kayıt yok",
        "sInfoFiltered": "(_MAX_ kayıt içerisinden bulunan)",
        "sInfoPostFix": "",
        "sInfoThousands": ".",
        "sLengthMenu": " _MENU_ göster",
        "sLoadingRecords": "Yükleniyor...",
        "sProcessing": "İşleniyor...",
        "sSearch": "Ara:",
        "sZeroRecords": "Eşleşen kayıt bulunamadı",
        "oPaginate": {
          "sFirst": "İlk",
          "sLast": "Son",
          "sNext": "Sonraki",
          "sPrevious": "Önceki"
        },
        "oAria": {
          "sSortAscending": ": artan sütun sıralamasını aktifleştir",
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
      drawCallback: function () {
        $('[data-toggle="tooltip"]').tooltip();
      }
    });
  }
});
