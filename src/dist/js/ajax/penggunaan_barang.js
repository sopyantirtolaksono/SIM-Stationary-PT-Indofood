$(document).ready(function() {

  //Date range picker
  $('#dateRange').daterangepicker({
    locale: {
      format: 'YYYY/MM/DD'
    }
  });

  // form penggunaan barang
  $("form#formPenggunaanBarang").on("submit", function(e) {
    e.preventDefault();
    
    let formData = new FormData(this);
    $.ajax({
      type: $(this).attr("method"),
      url: $(this).attr("action"),
      data: formData,
      processData: false,
      contentType: false,
      success: function(data) {
        loadData(data);
      },
      error: function(data) {
        console.log(data)
      }
    })
  });

  // export excel
  $("a#btnDownloadExcel").on("click", function(e) {
    e.preventDefault();
    let href = $(this).attr("href");
    let valDateRange = $("input#dateRange").val();
    openInNewTab(href + valDateRange.replace(/\s/g, ""));
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
function loadData(data) {
    $("div#loadData").html(data);
}

// function open in new tab
function openInNewTab(url) {
  let win = window.open(url, "_blank");
  win.focus();
}