<?php
include_once("../api/api-call.php");
$id = htmlspecialchars($_GET['id']);
$data = getApiMovie($id);

/* $checkIfExist = [];
foreach($data as $movie) {
    array_push($checkIfExist, $movie['api_id']);
}
if(!in_array($_GET['api_id'], $checkIfExist)) {
    header("location:index.php");
    exit;
} 
 */


include_once("header.php");

?>


<?php foreach ($data['data'] as $movie): ?>
    <?php if (isset($movie)): ?>
        <div class="container mt-5">
            <p class="mb-4 p-3 fw-bold" style="background-color: #fff; color:#6E4F7D; font-size:35px;"><?php echo htmlspecialchars($movie['title']); ?></p>
            <div class="row">
                <!-- Image Section -->
                <div class="col-md-5">
                    <img src="<?php echo htmlspecialchars($movie['image']); ?>" class="img-fluid" alt="<?php echo htmlspecialchars($movie['title']); ?> Poster">
                </div>
                <!-- Content Section -->
                <div class="col-md-7">
                    <div class="card" style="border-radius: 0;">
                        <div class="card-body">
                            <!-- Rating and Icons -->
                            <div class="d-flex flex-column align-items-start mb-3">
                                <div class="w-100">
                                    <span style="color: #6E4F7D; font-size:60px"><?php echo htmlspecialchars($movie['rating']); ?> Stars</span>
                                </div>
                                <div class="w-100 mt-2">
                                    <!-- Age and Icons -->
                                    <img src="../assets/kijkwijzers/kijkwijzer-12.png" alt="Age Rating" class="me-1" style="height: 40px;">
                                    <img src="../assets/kijkwijzers/kijkwijzer-eng.png" alt="Icon 1" class="me-1" style="height: 40px;">
                                    <img src="../assets/kijkwijzers/kijkwijzer-geweld.png" alt="Icon 2" style="height: 40px;">
                                </div>
                            </div>

                            <!-- Release Date -->
                            <p class="fs-4"><strong>Release: <?php echo htmlspecialchars($movie['release_date']); ?></strong></p>

                            <!-- Movie Description -->
                            <p style="font-size: 17px;">
                                <?php echo htmlspecialchars($movie['description']); ?>
                            </p>

                            <!-- Additional Info -->
                            <ul class="list-unstyled">
                                <li><strong>Genre:</strong></li>
                                <li><strong>Filmlengte:</strong><?= $movie['length']?></li>
                                <li><strong>Land:</strong> USA</li>
                                <li><strong>IMDb score:</strong> 8.3/10</li>
                                <li><strong>Regisseur:</strong> Juan Antonio</li>
                            </ul>
                            <div class="row mt-4 text-center">
                                <div class="col-6 col-md-2 mb-3">
                                    <img src="<?= $movie["actors"]['image']?>" alt="Bryce Dallas Howard" class="img-fluid mb-2" style="object-fit: contain; height:150px; width:100%; border-radius:0;">
                                    <p class="mb-0"><?= $movie["actors"]['name']?></p>
                                </div>
                                <div class="col-6 col-md-2 mb-3">
                                    <img src="<?= $movie["actors"]['image']?>" alt="Chris Pratt" class="img-fluid mb-2" style="object-fit: contain; height:150px; width:100%; border-radius:0;">
                                    <p class="mb-0"><?= $movie["actors"]['name']?></p>
                                </div>
                                <div class="col-6 col-md-2 mb-3">
                                    <img src="<?= $movie["actors"]['image']?>" alt="Rafe Spall" class="img-fluid mb-2" style="object-fit: contain; height:150px; width:100%; border-radius:0;">
                                    <p class="mb-0"><?= $movie["actors"]['name']?></p>
                                </div>
                                <div class="col-6 col-md-2 mb-3">
                                    <img src=".<?= $movie["actors"]['image']?> alt="Toby Jones" class="img-fluid mb-2" style="object-fit: contain; height:150px; width:100%; border-radius:0;">
                                    <p class="mb-0"><?= $movie["actors"]['name']?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <a href="buyticket.php?id=<?= $movie['api_id']?>" style="text-decoration: none;">
                <p class=" text-center mb-2 p-3 fw-bold mt-3" style="background-color: #6E4F7D; color:#fff; font-size:35px; ">KOOP JE TICKETS</p>
            </a>
            <div class="row mt-3 mx-0" style="border: 6px solid #6E4F7D; margin-bottom:10%;">
                <div class=" text-center p-0">
                    <div class="ratio ratio-16x9">
                        <iframe width="800" height="450" src="<?php echo $movie['trailer_link']?> title="Jurassic World: Fallen Kingdom - Official Trailer [HD]" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    <?php else: ?>
        <p>Movie details not found.</p>
        <a class="btn btn-primary text-uppercase" style="background-color: #6E4F7D; border:none">Back To Home</a>
    <?php endif; ?>
<?php endforeach; ?>


<?php
include_once("footer.php");
?>
