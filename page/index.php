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
    <div class="row text-dark align-items-stretch">
        <div class="col-md-6 d-flex flex-column">
            <div class="info-block mt-3 flex-grow-1">
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

        <div class="col-md-6 d-flex align-items-stretch">
            <div class="theater-image d-flex align-items-center justify-content-center" style="padding: 15px;">
                <img src="../assets/maps/Hellevoetssluis.png" alt="Tivoli Theater" class="img-fluid" style="max-height: 100%; object-fit: cover;">
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

<!-- movie posters -->
<div class="container my-5">
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-6 g-3">
        <?php foreach ($array as $movie): ?>
            <?php
            // Encode movie data
            $encodedMovie = base64_encode(json_encode($movie));
            ?>
            <div class="col">
                <div class="card d-flex flex-column justify-content-between h-100" style="border: none;">
                    <img src="../<?php echo $movie['photo']['photo1']; ?>" class="card-img-top img-fluid" style="min-height: 350px; object-fit: cover; width: 100%;"
                        alt="<?php echo $movie['title']; ?>" />
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title text-uppercase"><?php echo $movie['title']; ?></h5>
                        <span style="color: #6E4F7D; font-size: 1.5rem;"><?php echo $movie['stars']; ?></span>
                        <p class="card-text">Release: <?php echo $movie['release']; ?></p>
                        <p class="card-text"><?php echo $movie['description']; ?></p>
                        <div class="mt-auto">
                            <a href="detail.php?id=<?= $movie['id'] ?>" class="btn btn-primary text-uppercase" style="background-color: #6E4F7D; border:none">Meer Info & Tickets</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- button to the all movie page -->
<div class="container my-5">
    <a href="#" class="btn btn-primary text-uppercase" style="background-color: #6E4F7D;border:none; min-width:15%">Bekijk Alle Films</a>
</div>




<?php
include_once("footer.php");
?>