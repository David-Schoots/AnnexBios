<?php 
  include_once("header.php");
?>

<div class="container my-5 text-uppercase" style="font-size: 45px;">
  <div class="row">
    <div class="col-6 bg-white">
      <h2 class="text-left" style="color: #6E4F7D;">TICKETS BESTELLEN</h2>
    </div>
  </div>
</div>

<div class="container my-5 d-flex">
    <div class="col-12 d-flex flex-row gap-3">
        <p class="p-1" style="background-color: white;"><?= $movie['title'] ?></p>

        <!-- Datepicker Dropdown -->
        <div class="dropdown">
          <button class="btn btn-light dropdown-toggle" style="color: #6E4F7D;" type="button" id="dropdownDateButton" data-bs-toggle="dropdown" aria-expanded="false">
            Datum
          </button>
          <ul class="dropdown-menu" aria-labelledby="dropdownDateButton">
            <li>
              <input type="text" class="form-control datepicker" placeholder="Kies een datum">
            </li>
          </ul>
        </div>

          <div class="dropdown">
            <button class="btn btn-light dropdown-toggle" style="color: #6E4F7D;" type="button" id="dropdownTimeButton" data-bs-toggle="dropdown" aria-expanded="false">
              Tijdstip
            </button>
            <div class="dropdown-menu p-3" aria-labelledby="dropdownTimeButton">
              <input type="text" class="form-control test">
            </div>
          </div>
    </div>
</div>

<?php include_once("footer.php"); ?>