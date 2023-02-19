$(document).ready(function() {

    let Toast = Swal.mixin({
      toast: true,
      position: 'top-center',
      showConfirmButton: false,
      timer: 3000
    });

    $("a#btnBatal").on("click", function(e) {
      e.preventDefault();

      Toast.fire({

        icon: "question",
        title: "Batalkan pesanan ini",
        showConfirmButton: true

      }).then((response) => {

        if(response.value) {

          $.ajax({
            type: "GET",
            url: $(this).attr("href"),
            success: function(data) {
              
              if(data == "sukses membatalkan pesanan") {
                Toast.fire({
                  icon: 'success',
                  title: 'Sukses! Pesanan dibatalkan.'
                })

                loadData();
              }
              else {
                Toast.fire({
                  icon: 'error',
                  title: 'Maaf, ada kesalahan saat membatalkan pesanan.'
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

    $("form#formTerkonfirmasi").on("submit", function(e) {
      e.preventDefault();
      
      let formData = new FormData(this);
      $.ajax({
        type: $(this).attr("method"),
        url: $(this).attr("action"),
        data: formData,
        processData: false,
        contentType: false,
        success: function(data) {
          loadDataTerkonfirmasi(data);
        },
        error: function(data) {
          console.log(data)
        }
      })
    });

});


//Date range picker
$('#dateRange').daterangepicker({
	locale: {
	  format: 'YYYY/MM/DD'
	}
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

// script select2
$(function() {
	// Initialize Select2 Elements
	$('.select2').select2()

	// Initialize Select2 Elements
	$('.select2bs4').select2({
	  	theme: 'bootstrap4'
	})
});

// function load data
function loadDataTerkonfirmasi(data) {
  	$("div#loadDataTerkonfirmasi").html(data);
}