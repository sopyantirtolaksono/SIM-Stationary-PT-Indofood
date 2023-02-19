$(document).ready(function() {

    let Toast = Swal.mixin({
      toast: true,
      position: 'top-center',
      showConfirmButton: false,
      timer: 3000
    });

    $("form#formsettingsPassword").on("submit", function(e) {
      e.preventDefault();

      let formData = new FormData(this);

      $.ajax({
        type: $(this).attr("method"),
        url: $(this).attr("action"),
        data: formData,
        processData: false,
        contentType: false,
        success: function(data) {

          if(data == "update password sukses") {
            Toast.fire({
              icon: "success",
              title: "Update password sukses."
            })

            resetForm();
          }
          else if(data == "update password gagal") {
            Toast.fire({
              icon: "error",
              title: "Update password gagal."
            })
          }
          else if(data == "password anda tidak cocok") {
            Toast.fire({
              icon: "error",
              title: "Password lama anda tidak cocok."
            })
          }
          else if(data == "minimal harus 8 karakter") {
            Toast.fire({
              icon: "error",
              title: "Password baru anda harus memiliki minimal 8 karakter."
            })
          }
          else {
            Toast.fire({
              icon: "error",
              title: "Ada kesalahan saat mengupdate password. Anda bisa mengulanginya nanti."
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

    $("form#formSettingsAkun").on("submit", function(e) {
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
	         	else if(data == "format gambar salah") {
		            Toast.fire({
		              	icon: 'error',
		              	title: 'Maaf, format gambar salah! Coba periksa kembali format gambar anda.'
		            })
		        }
		        else if(data == "sukses mengupdate data") {
		            Toast.fire({
		              	icon: 'success',
		              	title: 'Sukses! Data telah diupdate.'
		            })

		            loadData();
		        }
		        else {
		            Toast.fire({
		              	icon: 'error',
		              	title: 'Maaf, ada kesalahan saat mengupdate data.'
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

function showHide() {
    
    let type = $("input#passwordLama,input#passwordBaru").attr("type");
    if(type == "password") {
      $("input#passwordLama,input#passwordBaru").attr("type", "text");
    }
    else {
      $("input#passwordLama,input#passwordBaru").attr("type", "password");
    }

}

function resetForm() {

    $("input#passwordLama,input#passwordBaru").val("");

}