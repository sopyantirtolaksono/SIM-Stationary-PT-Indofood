$(document).ready(function() {

    let Toast = Swal.mixin({
      toast: true,
      position: 'top-center',
      showConfirmButton: false,
      timer: 3000
    });

    $("form#formRegistrasi").on("submit", function(e) {
      e.preventDefault();
      let formData = new FormData(this);

      $.ajax({
        type: $(this).attr("method"),
        url: $(this).attr("action"),
        data: formData,
        processData: false,
        contentType: false,
        success: function(data) {
          
          if(data == "karakter pertama harus @") {
            Toast.fire({
                icon: 'error',
                title: 'Username harus memiliki karakter @ diawal.'
            })
          }
          else if(data == "username sudah ada") {
            Toast.fire({
                icon: 'error',
                title: 'Username sudah ada.'
            })
          }
          else if(data == "minimal harus 8 karakter") {
            Toast.fire({
              icon: "error",
              title: "Password anda harus memiliki minimal 8 karakter."
            })
          }
          else if(data == "registrasi berhasil") {
            Toast.fire({
              icon: "success",
              title: "Registrasi berhasil."
            }).then(() => {
              document.location.href = "login.php";
            })

            resetForm();
          }
          else {
            Toast.fire({
              icon: "error",
              title: "Registrasi gagal. Silahkan coba lagi!"
            })
          }

        },
        error: function(data) {
          Toast.fire({
            icon: "error",
            title: data
          })
        }

      });
    });

});

function resetForm() {
    $("input.form-control").val("");
}

function showHide() {
    
  let type = $("input[name=password]").attr("type");
  if(type == "password") {
    $("input[name=password]").attr("type", "text");
  }
  else {
    $("input[name=password]").attr("type", "password");
  }

}