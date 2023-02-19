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

?>

<div id="loadData">
  
  <!-- JS -->
<script type="text/javascript">

  function loadData() {
    $.get("src/components/ajax/daftar_member.php", function(data) {
      $("#loadData").html(data);
    });
  }

  loadData();
  
</script>

</div>