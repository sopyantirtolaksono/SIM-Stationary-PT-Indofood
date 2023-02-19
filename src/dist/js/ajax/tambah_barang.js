$(document).ready(function() {

    let Toast = Swal.mixin({
      	toast: true,
      	position: 'top-center',
      	showConfirmButton: false,
      	timer: 3000
    });

    $("form#formTambahBarang").on("submit", function(e) {
      e.preventDefault();
      let formData = new FormData(this);
      $.ajax({
        type: $(this).attr("method"),
        url: $(this).attr("action"),
        data: formData,
        processData: false,
        contentType: false,
        success: function(data) {
          
          if(data == "format gambar salah") {
            Toast.fire({
              icon: 'error',
              title: 'Maaf, format gambar salah! Coba periksa kembali format gambar anda.'
            })
          }
          else if(data == "sukses menambah data baru") {
            Toast.fire({
              icon: 'success',
              title: 'Sukses! Data baru telah ditambahkan.'
            })
            resetForm();
          }
          else {
            Toast.fire({
              icon: 'error',
              title: 'Maaf, ada kesalahan saat menambahkan data baru.'
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
    $("input.form-control").val("");
    $("input[name=nama_barang]").focus();
}