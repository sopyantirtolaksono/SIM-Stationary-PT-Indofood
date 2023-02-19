<?php

  // cek siapa yang login
  if(!isset($_SESSION["admin"])) {
      if(isset($_SESSION["member"])) {
          echo "<script>location ='index.php?halaman=dashboard';</script>";
          exit();
      }
      else {
          echo "<script>location ='login.php';</script>";
          exit();
      }
  }

  // ambil id barang diURL
  $idBarang = $_GET["id"];

?>

<div id="loadData">
  
<!-- JS -->
<script type="text/javascript">

  let idBarang = <?php echo json_encode($idBarang); ?>;

  function loadData() {

    $.post("src/components/ajax/restok_barang.php",
    {
      id: idBarang
    },
    function(data, status) {
      $("#loadData").html(data);
    });

  }

  loadData();
  
</script>

</div>