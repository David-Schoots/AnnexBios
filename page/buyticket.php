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
          <!-- Time dropdown -->
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


<div class="container my-5" style="color:#6E4F7D; background-color:white">
  <div class="row col-12">
    <h4 class="p-4" style="font-size: 30px;">STAP 1: Kies je Ticket</h4>
  </div>
  
    <table class="table table-hover bg-light">
    <thead>
      <tr>
        <th scope="col">TYPE</th>
        <th scope="col" class="text-end">PRIJS</th>
        <th scope="col" class="text-end">AANTAL</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th scope="row">Normaal</th>
        <td class="text-end">€9,00</td>
        <td class="text-end">
          <div class="dropdown">
            <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
              0
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <li><a class="dropdown-item" href="#" data-value="1">1</a></li>
              <li><a class="dropdown-item" href="#" data-value="2">2</a></li>
              <li><a class="dropdown-item" href="#" data-value="3">3</a></li>
              <li><a class="dropdown-item" href="#" data-value="4">4</a></li>
              <li><a class="dropdown-item" href="#" data-value="5">5</a></li>
            </ul>
          </div>
        </td>
      </tr>

      <tr>
        <th scope="row">Kind t/m 11 jaar</th>
        <td class="text-end">€5,00</td>
        <td class="text-end"><div class="dropdown">
            <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
              0
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <li><a class="dropdown-item" href="#" data-value="1">1</a></li>
              <li><a class="dropdown-item" href="#" data-value="2">2</a></li>
              <li><a class="dropdown-item" href="#" data-value="3">3</a></li>
              <li><a class="dropdown-item" href="#" data-value="4">4</a></li>
              <li><a class="dropdown-item" href="#" data-value="5">5</a></li>
            </ul>
          </div>
        </td>
      </tr>
      
      <tr>
        <th scope="row">65 +</th>
        <td class="text-end">€7,00</td>
        <td class="text-end"><div class="dropdown">
            <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
              0
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <li><a class="dropdown-item" href="#" data-value="1">1</a></li>
              <li><a class="dropdown-item" href="#" data-value="2">2</a></li>
              <li><a class="dropdown-item" href="#" data-value="3">3</a></li>
              <li><a class="dropdown-item" href="#" data-value="4">4</a></li>
              <li><a class="dropdown-item" href="#" data-value="5">5</a></li>
            </ul>
          </div>
        </td>
      </tr>
      <tr>
        <th scope="row">VOUCHERCODE </th>
        <td><input type="text" class="form-control" placeholder="code"></td>
        <td><button type="button" class="btn text-white form-control" style="background-color: #6E4F7D;">TOEVOEGEN</button></td>
      </tr>
    </tbody>
    </table>  

    <!-- step 2 -->
    <div class="row col-12">
      <h4 class="p-4" style="font-size: 30px;">STAP 2: KIES JE STOEL</h4>
   </div>

   <!-- Here comes the resevation system -->


   <!-- Here comes the resevation system -->

   <div class="row col-12">
      <h4 class="p-4" style="font-size: 30px;">STAP 3: CONTROLEER JE BESTELLING</h4>
   </div>

   <div class="container">
    <div class="card mb-3" style="width: 100%; border: 2px solid #6E4F7D">
      <div class="row g-0">
        <div class="col-md-4">
        <img src="../<?php echo htmlspecialchars($movie['photo']['photo1']); ?>" class="img-fluid" alt="<?php echo htmlspecialchars($movie['title']); ?> Poster">
        </div>
        <div class="col-md-8">
          <div class="card-body">
            <h5 class="card-title"><?= $movie['title']?></h5>
             <!-- Age and Icons -->
            <img src="../assets/kijkwijzers/kijkwijzer-12.png" alt="Age Rating" class="me-1" style="height: 40px;">
            <img src="../assets/kijkwijzers/kijkwijzer-eng.png" alt="Icon 1" class="me-1" style="height: 40px;">
            <img src="../assets/kijkwijzers/kijkwijzer-geweld.png" alt="Icon 2" style="height: 40px;">
            
            <div style="font-size: 20px;">
              <p class="card-text mt-2 mb-0">Bioscoop: Hellevoetsluit (Zaal 3)</small></p>
              <p class="card-text mb-0">Waarneer: </small></p>
              <p class="card-text mb-0">Stoelen: </small></p>
              <p class="card-text mb-0">Tickets: </small></p>
              <p class="card-text mb-0">Totaal: </small></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div><!-- end of step 3 -->

  <div class="container my-5">
    <div class="row col-12">
        <h4 class="p-4" style="font-size: 30px;">STAP 4: VUL JE GEGEVENS IN</h4>
    </div>
    <form>
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="voornaam" class="form-label">Voornaam</label>
                <input type="text" class="form-control" id="voornaam" placeholder="Voornaam">
            </div>
            <div class="col-md-6">
                <label for="achternaam" class="form-label">Achternaam</label>
                <input type="text" class="form-control" id="achternaam" placeholder="Achternaam">
            </div>
        </div>
        <div class="mb-3">
            <label for="email1" class="form-label">E-mail Adres 1</label>
            <input type="email" class="form-control" id="email1" placeholder="E-mail Adres 1">
        </div>
        <div class="mb-3">
            <label for="email2" class="form-label">E-mail Adres 2</label>
            <input type="email" class="form-control" id="email2" placeholder="E-mail Adres 2">
        </div>
        <button type="submit" class="btn btn-primary">Verzenden</button>
        </form>

  </div>

  
</div><!-- end of -->

<?php include_once("footer.php"); ?>