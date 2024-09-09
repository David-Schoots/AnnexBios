<?php
include_once("header.php");
include_once("movieloop.php");


if (isset($_GET['data'])) {
    // Decode and deserialize the data
    $encodedMovie = $_GET['id'];
    $movie = json_decode(base64_decode($encodedMovie), true);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $movie = null;
    foreach ($array as $item) {
        if ($item['id'] == $id) {
            $movie = $item;
            break;
        }
    }
}

?>



<?php if (isset($movie)): ?>
    <div class="container mt-5">
        <p class="mb-4 p-3 fw-bold" style="background-color: #fff; color:#6E4F7D; font-size:35px;"><?php echo htmlspecialchars($movie['title']); ?></p>
        <div class="row">
            <!-- Image Section -->
            <div class="col-md-5">
                <img src="../<?php echo htmlspecialchars($movie['photo']['photo1']); ?>" class="img-fluid" alt="<?php echo htmlspecialchars($movie['title']); ?> Poster">
            </div>
            <!-- Content Section -->
            <div class="col-md-7">
                <div class="card" style="border-radius: 0;">
                    <div class="card-body">
                        <!-- Rating and Icons -->
                        <div class="d-flex flex-column align-items-start mb-3">
                            <div class="w-100">
                                <span style="color: #6E4F7D; font-size:60px"><?php echo htmlspecialchars($movie['stars']); ?></span>
                            </div>
                            <div class="w-100 mt-2">
                                <!-- Age and Icons -->
                                <img src="../assets/kijkwijzers/kijkwijzer-12.png" alt="Age Rating" class="me-1" style="height: 40px;">
                                <img src="../assets/kijkwijzers/kijkwijzer-eng.png" alt="Icon 1" class="me-1" style="height: 40px;">
                                <img src="../assets/kijkwijzers/kijkwijzer-geweld.png" alt="Icon 2" style="height: 40px;">
                            </div>
                        </div>

                        <!-- Release Date -->
                        <p class="fs-4"><strong>Release: <?php echo htmlspecialchars($movie['release']); ?></strong></p>

                        <!-- Movie Description -->
                        <p style="font-size: 17px;">
                            <?php echo htmlspecialchars($movie['description']); ?>
                        </p>

                        <!-- Additional Info -->
                        <ul class="list-unstyled">
                            <li><strong>Genre:</strong> Actie</li>
                            <li><strong>Filmlengte:</strong> 128 minutes</li>
                            <li><strong>Land:</strong> USA</li>
                            <li><strong>IMDb score:</strong> 8.3/10</li>
                            <li><strong>Regisseur:</strong> Juan Antonio</li>
                        </ul>
                        <div class="row mt-4 text-center">
                            <div class="col-6 col-md-2 mb-3">
                                <img src="../assets/acteurs/BryceDallas.jpg" alt="Bryce Dallas Howard" class="img-fluid mb-2" style="object-fit: contain; height:150px; width:100%; border-radius:0;">
                                <p class="mb-0">Bryce Dallas Howard</p>
                            </div>
                            <div class="col-6 col-md-2 mb-3">
                                <img src="../assets/acteurs/Chris_Pratt.jpg" alt="Chris Pratt" class="img-fluid mb-2" style="object-fit: contain; height:150px; width:100%; border-radius:0;">
                                <p class="mb-0">Chris Pratt</p>
                            </div>
                            <div class="col-6 col-md-2 mb-3">
                                <img src="../assets/acteurs/Rafe_Spall.jpg" alt="Rafe Spall" class="img-fluid mb-2" style="object-fit: contain; height:150px; width:100%; border-radius:0;">
                                <p class="mb-0">Rafe Spall</p>
                            </div>
                            <div class="col-6 col-md-2 mb-3">
                                <img src="../assets/acteurs/Toby_Jones.jpg" alt="Toby Jones" class="img-fluid mb-2" style="object-fit: contain; height:150px; width:100%; border-radius:0;">
                                <p class="mb-0">Toby Jones</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <p class=" text-center mb-2 p-3 fw-bold mt-3" style="background-color: #6E4F7D; color:#fff; font-size:35px; ">KOOP JE TICKETS</p>

        <div class="row mt-3 mx-0" style="border: 6px solid #6E4F7D; margin-bottom:10%;">
            <div class=" text-center p-0">
                <div class="ratio ratio-16x9">
                    <iframe width="800" height="450" src="https://www.youtube.com/embed/vn9mMeWcgoM" title="Jurassic World: Fallen Kingdom - Official Trailer [HD]" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
<?php else: ?>
    <p>Movie details not found.</p>
    <a class="btn btn-primary text-uppercase" style="background-color: #6E4F7D; border:none">Back To Home</a>
<?php endif; ?>

<?php
include_once("footer.php");
?>
