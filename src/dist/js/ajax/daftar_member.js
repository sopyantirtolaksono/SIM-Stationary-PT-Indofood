$(document).ready(function() {

    let Toast = Swal.mixin({
      toast: true,
      position: 'top-center',
      showConfirmButton: false,
      timer: 3000
    });

    $("a#btnVerifikasi").on("click", function(e) {
      e.preventDefault();

      $.ajax({
        type: "GET",
        url: $(this).attr("href"),
        success: function(data) {

          	if(data == "terverifikasi") {
	            Toast.fire({
	              icon: "success",
	              title: "Terverifikasi."
	            })

	            loadData();
          	}
          	else {
	            Toast.fire({
	              icon: "error",
	              title: "Gagal verifikasi."
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