<?php include_once("header.php");

?>

<div class="container my-5 text-uppercase" style=" font-size: 45px;">
  <div class="row">
    <div class="col-6 bg-white">
    <h2 class="text-left" style="color: #6E4F7D;">TICKETS BESTELLEN</h2>
    </div>
  </div>
</div>


<div class="container my-5 d-flex">
    <div class="col-12 d-flex flex-row gap-3">
        <p class="p-1" style="background-color: white;"><?= $movie['title'] ?></p>
        <p class="p-1" style="background-color: white;" >Datum</p>
        <p class="p-1" style="background-color: white;" >Tijdstip</p>
    </div>
</div>



<?php include_once("footer.php");?>