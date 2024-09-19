<?php
include_once("../api/api-call.php");
$id = htmlspecialchars($_GET['id']);
$Detail = getApiMovie($id);

include_once("header.php");

?>


<?php foreach ($Detail['data'] as $movie): ?>
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
                            <div class="w-100 mt-2">
                                <!-- Age and Icons -->                                    
                                <?php foreach ($movie['viewing_guides']['symbols'] as $symbol): ?>
                                    <img src="<?= $symbol['image'] ?>" alt="<?= $symbol['name'] ?>" class="me-1" style="height: 40px;">
                                <?php endforeach; ?>
                            </div>

                            <!-- Release Date -->
                            <p class="fs-4"><strong>Release: <?php echo htmlspecialchars($movie['release_date']); ?></strong></p>

                            <!-- Movie Description -->
                            <p style="font-size: 17px;">
                                <?php echo htmlspecialchars($movie['description']); ?>
                            </p>

                            <!-- Additional Info -->
                            <ul class="list-unstyled">
                            <li><strong>Genre:</strong> <?= implode(', ', array_column($movie['genres'], 'name')) ?></li>
                                <li><strong>Filmlengte:</strong><?= $movie['length']?> minutes</li>
                                <li><strong>Land:</strong> USA</li>
                                <li><strong>IMDb score:</strong> <?=$movie['rating']?>/10 </li>
                                <li><strong>Regisseur:</strong><?php 
                                    if (!empty($movie['directors'])) {
                                        echo htmlspecialchars($movie['directors'][0]['name']);
                                    } else {
                                        echo 'Niet beschikbaar';
                                    }
                                ?>
                                </li>
                            </ul>
                            <div class="row mt-4 text-center">
                                <?php 
                                $i = 0;
                                foreach($movie["actors"] as $actor): ?>
                                <div class="col-6 col-md-2 mb-3">
                                    <img src="<?= $actor['image'] === null ? 'https://placehold.co/400x600' : $actor['image'] ?>" alt="Bryce Dallas Howard" class="img-fluid mb-2" style="object-fit: contain; height:150px; width:100%; border-radius:0;">
                                    <p class="mb-0"><?= $actor['name']?></p>
                                </div>
                                <?php if(++$i > 5) break; ?>
                                <?php endforeach; ?>
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
                        <iframe width="800" height="450" src="<?php echo $movie['embedded_trailer_link']?>" title="<?php $movie['title']?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
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
