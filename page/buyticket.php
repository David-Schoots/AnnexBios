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

<div class="container my-5 bg-light">
    <!-- Movie Selection and Dropdowns -->
    <div class="row mb-4">
        <div class="col-12 d-flex flex-column flex-sm-row gap-3">
            <p class="p-1 mb-0 bg-white"><?= htmlspecialchars($movie['title']) ?></p>

            <!-- Datepicker Dropdown -->
            <div class="dropdown">
                <button class="btn btn-light dropdown-toggle" style="color: #6E4F7D;" type="button" id="dropdownDateButton" data-bs-toggle="dropdown" aria-expanded="false">
                    Datum
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownDateButton">
                    <li><input type="text" class="form-control datepicker" placeholder="Kies een datum"></li>
                </ul>
            </div>

            <!-- Time Dropdown -->
            <div class="dropdown">
                <button class="btn btn-light dropdown-toggle" style="color: #6E4F7D;" type="button" id="dropdownTimeButton" data-bs-toggle="dropdown" aria-expanded="false">
                    Tijdstip
                </button>
                <ul class="dropdown-menu p-3" aria-labelledby="dropdownTimeButton">
                    <li><input type="text" class="form-control test" placeholder="Kies een tijdstip"></li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Step 1: Choose Ticket -->
    <div class="container my-5" style="color: #6E4F7D; background-color: white;">
        <div class="row">
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
                            <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                0
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
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
                    <td class="text-end">
                        <div class="dropdown">
                            <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                                0
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
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
                    <td class="text-end">
                        <div class="dropdown">
                            <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton3" data-bs-toggle="dropdown" aria-expanded="false">
                                0
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton3">
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
                    <th scope="row">VOUCHERCODE</th>
                    <td><input type="text" class="form-control" placeholder="code"></td>
                    <td><button type="button" class="btn text-white form-control" style="background-color: #6E4F7D;">TOEVOEGEN</button></td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Step 2: Choose Seat -->
    <div class="container my-5">
        <div class="row">
            <h4 class="p-4" style="font-size: 30px;">STAP 2: KIES JE STOEL</h4>
        </div>
        <!-- Placeholder for reservation system -->
    </div>

    <!-- Step 3: Review Order -->
    <div class="container my-5">
        <div class="row">
            <h4 class="p-4" style="font-size: 30px;">STAP 3: CONTROLEER JE BESTELLING</h4>
        </div>
        <div class="card mb-3" style="border: 2px solid #6E4F7D;">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="../<?php echo htmlspecialchars($movie['photo']['photo1']); ?>" class="img-fluid" alt="<?php echo htmlspecialchars($movie['title']); ?> Poster">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($movie['title']) ?></h5>
                        <!-- Age and Icons -->
                        <div class="mb-2">
                            <img src="../assets/kijkwijzers/kijkwijzer-12.png" alt="Age Rating" class="me-1" style="height: 40px;">
                            <img src="../assets/kijkwijzers/kijkwijzer-eng.png" alt="Icon 1" class="me-1" style="height: 40px;">
                            <img src="../assets/kijkwijzers/kijkwijzer-geweld.png" alt="Icon 2" style="height: 40px;">
                        </div>
                        <div style="font-size: 20px;">
                            <p class="card-text mt-2 mb-0">Bioscoop: Hellevoetsluis (Zaal 3)</p>
                            <p class="card-text mb-0">Wanneer: </p>
                            <p class="card-text mb-0">Stoelen: </p>
                            <p class="card-text mb-0">Tickets: </p>
                            <p class="card-text mb-0">Totaal: </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Step 4: Fill in Your Details -->
    <div class="container my-5">
        <div class="row">
            <h4 class="p-4" style="font-size: 30px;">STAP 4: VUL JE GEGEVENS IN</h4>
        </div>
        <form>
            <div class="row mb-3">
                <div class="col-md-6">
                    <input type="text" class="form-control" style="border: 2px solid #6E4F7D;" id="voornaam" placeholder="Voornaam">
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" style="border: 2px solid #6E4F7D;" id="achternaam" placeholder="Achternaam">
                </div>
            </div>
            <div class="mb-3">
                <input type="email" class="form-control" style="border: 2px solid #6E4F7D;" id="email1" placeholder="E-mail Adres 1">
            </div>
            <div class="mb-3">
                <input type="email" class="form-control" style="border: 2px solid #6E4F7D;" id="email2" placeholder="E-mail Adres 2">
            </div>
        </form>
    </div>

    <!-- Step 5: Choose Payment Method -->
    <div class="container my-5">
        <div class="row">
            <h4 class="p-4" style="font-size: 30px;">STAP 5: KIES JE BETAALWIJZE</h4>
        </div>
        <div class="d-flex flex-column flex-sm-row gap-3">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault1">
                <label class="form-check-label" for="flexCheckDefault1">
                    <img src="../assets/icons/biosbon.png" width="50" height="50" alt="">
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault2">
                <label class="form-check-label" for="flexCheckDefault2">
                    <img src="../assets/icons/Maestro_logo.png" width="50" height="50" alt="">
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault3">
                <label class="form-check-label" for="flexCheckDefault3">
                    <img src="../assets/icons/iDEAL-logo.png" width="50" height="50" alt="">
                </label>
            </div>
        </div>
    </div>
</div>



<?php 
include_once("footer.php"); 

?>

