<?php
include_once("header.php");
?>

<!-- Introduction Section -->
<div class="container mt-5 text-white p-4" style="background-color: #6E4F7D;">
    <h1 class="mb-4 text-uppercase" style="font-size: 60px;">welkom bij annexbios 3</h1>
    <p class="mb-4" style="font-size: 25px; max-width: 850px;">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient</p>
    <button class="px-4 py-2 fw-bold" style="color: #6E4F7D; border: none;">BEKIJK DE DRAAIENDE FILMS</button>
</div>
<!-- End of Introduction Section -->

<!-- Information Company -->
<div class="container my-5" style="background-color: white;">
    <div class="row text-dark">
        <div class="col-md-6">
            <div class="info-block mt-3">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2451.8740418078987!2d5.05273527620053!3d52.082022768564215!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c665600a203a4b%3A0x50deab8a2f8797c8!2sRijksstraatweg%2042%2C%203454%20JC%20Utrecht!5e0!3m2!1snl!2snl!4v1725526494196!5m2!1snl!2snl" width="100%" height="200px" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                <div class="px-2" style="background-color: #6E4F7D; color: white;">
                    <p class="mt-3 py-2">
                        <strong><i class="bi bi-geo-alt-fill"></i></strong> Rijksstraatweg 42, 3232 KA Hellevoetsluis<br>
                        <strong><i class="bi bi-telephone-fill"></i></strong> 020-12345678
                    </p>
                    <strong>Bereikbaarheid</strong>
                    <p style="max-width: 550px; padding-bottom: 10px;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis.</p>
                </div>
            </div>
        </div>

        <div class="col-md-6 mt-3">
            <div class="theater-image">
                <img src="../assets/maps/Hellevoetssluis.png" alt="Tivoli Theater" width="90%" height="384px">
            </div>
        </div>
    </div>
</div>


<!-- Movie Section -->
<div class="container my-5 text-uppercase" style=" font-size: 45px;">
  <div class="row">
    <div class="col-6 bg-white">
    <h2 class="text-left" style="color: #6E4F7D;">film agenda</h2>
    </div>
  </div>
    
</div>

<div class="container my-5">
    <div class="row">
        <div class="col-3 d-flex align-items-center">
            <!-- Main icon button -->
            <i id="mainButton" class="bi bi-sliders btn text-white me-3" style="font-size: 24px; cursor: pointer; background-color: #6E4F7D; border: none;"></i>

            <!-- Extra buttons (will appear next to the icon) -->
            <div id="extraButtons" class="d-none d-flex align-items-center bg-white p-2 rounded shadow-sm">
                <!-- Radio buttons -->
                <div class="form-check me-3">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="radioFilms">
                    <label class="form-check-label" for="radioFilms">
                        Films
                    </label>
                </div>
                <div class="form-check me-3">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="radioWeek">
                    <label class="form-check-label" for="radioWeek">
                        Deze Week
                    </label>
                </div>
                <div class="form-check me-3">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="radioVandaag">
                    <label class="form-check-label" for="radioVandaag">
                        Vandaag
                    </label>
                </div>

                <!-- Dropdown with radio buttons -->
                <div class="dropdown">
                    <button class="btn btn-light dropdown-toggle text-uppercase" type="button" id="categoryDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        Categorie
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="categoryDropdown">
                        <li class="form-check">
                            <input class="form-check-input" type="radio" name="categoryRadio" id="categoryAction">
                            <label class="form-check-label" for="categoryAction">
                                Action
                            </label>
                        </li>
                        <li class="form-check">
                            <input class="form-check-input" type="radio" name="categoryRadio" id="categoryAnother">
                            <label class="form-check-label" for="categoryAnother">
                                Another Action
                            </label>
                        </li>
                        <li class="form-check">
                            <input class="form-check-input" type="radio" name="categoryRadio" id="categoryElse">
                            <label class="form-check-label" for="categoryElse">
                                Something Else
                            </label>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>




<?php
include_once("footer.php");
?>