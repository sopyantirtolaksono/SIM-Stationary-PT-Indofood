$(document).ready(function() {

    let Toast = Swal.mixin({
      toast: true,
      position: 'top-center',
      showConfirmButton: false,
      timer: 3000
    });

    $("a#btnKonfirmasi").on("click", function(e) {
      e.preventDefault();

      Toast.fire({

        icon: "question",
        title: "Konfirmasi pesanan ini",
        showConfirmButton: true

      }).then((response) => {

        if(response.value) {

          $.ajax({
            type: "GET",
            url: $(this).attr("href"),
            success: function(data) {
              
              if(data == "terkonfirmasi") {
                Toast.fire({
                  icon: 'success',
                  title: 'Sukses! Pesanan terkonfirmasi.'
                })

                loadData();
              }
              else if(data == "pesanan terkonfirmasi, tapi ada kegagalan saat menghapus data pesanan") {
                Toast.fire({
                  icon: 'success',
                  title: 'Sukses! Pesanan terkonfirmasi. Tapi ada kegagalan saat menghapus data pesanan.'
                })

                loadData();
              }
              else if(data == "barang kosong") {
                Toast.fire({
                  icon: 'warning',
                  title: 'Maaf, stok barang kosong. Pesanan belum bisa dikonfirmasi.'
                })
              }
              else if(data == "stok barang tidak cukup") {
                Toast.fire({
                  icon: 'warning',
                  title: 'Maaf, stok barang tidak cukup. Mohon lakukan ReStok terlebih dahulu.'
                })
              }
              else {
                Toast.fire({
                  icon: 'error',
                  title: 'Maaf, ada kesalahan saat mengkonfirmasi pesanan.'
                })
              }
            },
            error: function(data) {
              Toast.fire({
                icon: 'error',
                title: data
              })
            }
          });

        }
        
      })
      
    });

});

// script dataTable
$(function () {
    $("#example1").DataTable({
      	"responsive": true,
      	"autoWidth": false,
    });
    $('#example2').DataTable({
      	"paging": true,
      	"lengthChange": false,
      	"searching": false,
      	"ordering": true,
      	"info": true,
      	"autoWidth": false,
      	"responsive": true,
    });
});