$(document).ready(function() {

    let Toast = Swal.mixin({
      toast: true,
      position: 'top-center',
      showConfirmButton: false,
      timer: 3000
    });

    $("form#formPesananStationary").on("submit", function(e) {
      e.preventDefault();
      let formData = new FormData(this);
      $.ajax({
        type: $(this).attr("method"),
        url: $(this).attr("action"),
        data: formData,
        processData: false,
        contentType: false,
        success: function(data) {
          
          if(data == "sukses") {
            Toast.fire({
              icon: "success",
              title: "Pesanan berhasil dibuat."
            })

            resetForm();
          }
          else if(data == "pesanan sukses, mengirim whatsapp") {
            Toast.fire({
              icon: "success",
              title: "Pesanan berhasil dibuat."
            }).then(() => {
              let namaBarang  = $("select[name=nama_barang]").val();
              let jumlah      = $("input[name=jumlah]").val();
              let keterangan  = $("input[name=keterangan]").val();

              let url = "src/components/kirim_whatsapp.php?val="+namaBarang+"_"+jumlah+"_"+keterangan;
              openInNewTab(url);
            })
          }
          else if(data == "periksa jumlah barang yang diinputkan") {
            Toast.fire({
              icon: "error",
              title: "Periksa kembali jumlah barang yang anda inputkan!"
            })
          }
          else {
            Toast.fire({
              icon: "error",
              title: "Ada kesalahan saat membuat pesanan. Silahkan coba lagi!"
            })
          }
        },
        error: function(data) {
          Toast.fire({
            icon: "error",
            title: data
          })
        }
      })
    });

});

// script select2
$(function() {
    // Initialize Select2 Elements
    $('.select2').select2()

    // Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
});

// function reset form
function resetForm() {
    $("#rowPesananStationary input.form-control").val("");
}

// function open in new tab
function openInNewTab(url) {
  let win = window.open(url, "_blank");
  win.focus();
}