$(document).ready(function() {

  let Toast = Swal.mixin({
    toast: true,
    position: 'top-center',
    showConfirmButton: false,
    timer: 3000
  });

  $("form#formUpdateBarang").on("submit", function(e) {
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
        else if(data == "sukses mengupdate data") {
          Toast.fire({
            icon: 'success',
            title: 'Sukses! Data telah diupdate.'
          }).then(() => {
              document.location.href = "index.php?halaman=data_barang";
          })
          
        }
        else {
          Toast.fire({
            icon: 'error',
            title: 'Maaf, ada kesalahan saat mengupdate data.'
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