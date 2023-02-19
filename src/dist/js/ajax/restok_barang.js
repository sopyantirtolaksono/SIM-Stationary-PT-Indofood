$(document).ready(function() {

    let Toast = Swal.mixin({
      toast: true,
      position: 'top-center',
      showConfirmButton: false,
      timer: 3000
    });

    $("form#formReStok").on("submit", function(e) {
      e.preventDefault();
      let formData = new FormData(this);
      $.ajax({
        type: $(this).attr("method"),
        url: $(this).attr("action"),
        data: formData,
        processData: false,
        contentType: false,
        success: function(data) {
          
          if(data == "sukses restok") {
            Toast.fire({
              icon: 'success',
              title: 'Sukses ReStok barang'
            })

            resetForm();
            loadStok();
          }
          else if(data == "gagal restok") {
            Toast.fire({
              icon: 'error',
              title: 'Maaf, ada kesalahan saat mengupdate data barang'
            })
          }
          else if(data == "barang tidak ada") {
            Toast.fire({
              icon: 'error',
              title: 'Maaf, barang tidak ditemukan'
            })
          }
          else {
            Toast.fire({
              icon: 'error',
              title: 'Maaf, ada kesalahan saat mengupdate data barang'
            })
          }

        },
        error: function(data){
          Toast.fire({
            icon: 'error',
            title: data
          })
        }
      });
    });

});

function resetForm() {
    $("input[name=barang_datang]").val("");
    $("input[name=barang_datang]").focus();
}