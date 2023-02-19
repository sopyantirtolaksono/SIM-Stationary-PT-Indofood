<?php

	// cek siapa yang login
	if(!isset($_SESSION["member"])) {
	    if(isset($_SESSION["admin"])) {
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
    $.get("src/components/ajax/profil.php", function(data) {
      $("#loadData").html(data);
    });
  }

  loadData();
  
</script>

</div>