<?php
include_once("header.php");
include_once("../api/api-call.php");
$data = getApiMovies();

?>

<!-- Movie Section -->
<div class="container my-5 text-uppercase" style="font-size: 45px;">
    <div class="row">
        <div class="col-6 bg-white">
            <h2 class="text-left" style="color: #6E4F7D;">Film Agenda</h2>
        </div>
    </div>
</div>

<!-- Main container -->
<div class="container my-5">
    <div class="row align-items-center">
        <!-- Main icon button -->
        <div class="col-auto">
            <button class="btn p-2" style="background-color: #000000; border: none;" type="button" data-bs-toggle="offcanvas" data-bs-target="#extraOptions" aria-expanded="false" aria-controls="extraOptions">
                <i class="bi bi-sliders text-white" style="font-size: 24px;"></i>
            </button>
        </div>
    </div>
</div>

<!-- Offcanvas menu for extra options -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="extraOptions" aria-labelledby="extraOptionsLabel">
    <div class="offcanvas-header">
        <h5 id="extraOptionsLabel">Filter Opties</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <!-- Radio buttons -->
        <div class="mb-3">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="filterOptions" id="radioWeek">
                <label class="form-check-label" for="radioWeek" style="color: #6E4F7D;">
                    Deze Week
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="filterOptions" id="radioVandaag">
                <label class="form-check-label" for="radioVandaag" style="color: #6E4F7D;">
                    Vandaag
                </label>
            </div>
        </div>

        <!-- Dropdown -->
        <div class="dropdown mb-3">
            <button class="btn btn-light dropdown-toggle text-uppercase w-100" type="button" id="categoryDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="color: #6E4F7D;">
                Genres
            </button>
            <ul class="dropdown-menu" aria-labelledby="categoryDropdown">
            <?php
            $genres = [];
            foreach($data['data'] as $movie) {
                foreach($movie['genres'] as $genre) {
                    if(!in_array($genre, $genres)) {
                        $genres[] = $genre;
                    }
                }
            }
            ?>

                <?php foreach($genres as $genre): ?>
                        <li>
                            <input class="form-check-input me-2" type="radio" name="categoryRadio" id="category<?php echo htmlspecialchars($genre['name']); ?>">
                            <label class="form-check-label" for="category<?php echo htmlspecialchars($genre['name']); ?>">
                                <?php echo htmlspecialchars($genre['name']); ?>
                            </label>
                        </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>

<!-- Movie Posters -->
<div class="container my-5">
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-6 g-3">
        <?php
        /* Show only the first 12 movies on screen */
        $data = array_slice($data['data'], 0, 12);

        /* Loop through each of the 12 movies */
        foreach ($data as $movie): ?>
            <div class="col">
                <div class="card d-flex flex-column justify-content-between h-100" style="border: none;">
                    <img src="<?php echo htmlspecialchars($movie['image']); ?>" class="card-img-top img-fluid" style="min-height: 350px; object-fit: cover; width: 100%;" alt="<?php echo htmlspecialchars($movie['title']); ?>" />
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title text-uppercase" style="min-height: 60px;"><?php echo htmlspecialchars($movie['title']); ?></h5>
                        <span style="color: #6E4F7D; font-size: 1.5rem;"><?php echo htmlspecialchars($movie['rating']); ?> Stars</span>
                        <p class="card-text">Release: <?php echo htmlspecialchars($movie['release_date']); ?></p>
                        <p class="card-text">
                            <?php
                            $description = htmlspecialchars($movie['description']);
                            $maxLength = 100;
                            if (strlen($description) > $maxLength) {
                                echo substr($description, 0, $maxLength) . '...';
                            } else {
                                echo $description;
                            }
                            ?>
                        </p>
                        <div class="mt-auto">
                            <a href="detail.php?id=<?= htmlspecialchars($movie['api_id']); ?>" class="btn btn-primary text-uppercase" style="background-color: #6E4F7D; border:none;">Meer Info & Tickets</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php
include_once("footer.php");
?>
