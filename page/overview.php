<?php
include_once("header.php");
include_once("movieloop.php");
?>

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

<!-- Movie Posters -->
<div class="container my-5">
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-6 g-3">
        <?php
        $totalMovies = 18;  // We willen in totaal 18 films tonen
        $movieCount = count($array);  // Aantal films in je array
        for ($i = 0; $i < $totalMovies; $i++):
            // Gebruik modulo om door de array te lopen en films te herhalen
            $movie = $array[$i % $movieCount];

            // Encode movie data
            $encodedMovie = base64_encode(json_encode($movie));
        ?>
            <div class="col">
                <div class="card d-flex flex-column justify-content-between h-100" style="border: none;">
                    <img src="../<?php echo $movie['photo']['photo1']; ?>" class="card-img-top img-fluid" style="min-height: 350px; object-fit: cover; width: 100%;" alt="<?php echo $movie['title']; ?>" />
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
        <?php endfor; ?>
    </div>
</div>




<!-- button to the all movie page -->
<div class="container my-5">
    <a href="#" class="btn btn-primary text-uppercase" style="background-color: #6E4F7D;border:none; min-width:15%">Bekijk Alle Films</a>
</div>

<?php
include_once("footer.php");
?>