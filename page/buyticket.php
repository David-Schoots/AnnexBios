<?php
include_once("header.php");
include "../modules/core/db_connect.php"; // Ensure database connection is included

include_once("../api/api-call.php"); // Ensure api call connection is included


$id = htmlspecialchars($_GET['id']);
$data = getApiMovie($id); // Get the data from the api that is linked to a specific movie

// Initialize variables
$editable_chairs = [];
$total_rows = 10;
$chair_reserved = [];
$delete_chair = [];
$selected_chair = [];

// Get selected chairs from session 
if (isset($_SESSION['temp_reserved_chair'])) {
    foreach ($_SESSION['temp_reserved_chair'] as $key => $value) {
        $selected_chair[] = [
            "row" => $value['row'],
            "num" => $value['num'],
            "type" => $value['type']
        ];
    }
}

// Query database for reserved chairs
$query = "SELECT id, chair_number, chair_row, date_chair_reserved FROM temporary_reserved_chairs";
$sqli_prepare = $con->prepare($query);
$sqli_prepare->bind_result($id, $chair_number, $chair_row, $date_chair_reserved);

if (!$sqli_prepare) {
    echo mysqli_error($con);
} else { 
    if ($sqli_prepare->execute()) {
        while ($sqli_prepare->fetch()) {
            $current_time = new DateTime();
            $start_date = new DateTime($date_chair_reserved);
            $since_start = $start_date->diff($current_time);

            // Check if reservation is expired (1 hour and 10 minutes)
            if ($since_start->h >= 1 || ($since_start->h == 0 && $since_start->i >= 10)) {
                $delete_chair[] = $id;
                unset($_SESSION['temp_reserved_chair'][$id]);
            } else {
                // Chair is still reserved
                $chair_reserved[] = [
                    "row" => $chair_row,
                    "num" => $chair_number,
                    "id" => $id
                ];

                // If chair is in session, it's editable
                if (isset($_SESSION['temp_reserved_chair'][$id])) {
                    $editable_chairs[] = [
                        "row" => $chair_row,
                        "num" => $chair_number
                    ];
                }
            }
        }
    }

    // Delete expired chairs from the database
    if (count($delete_chair) > 0) {
        foreach ($delete_chair as $delete) {
            $delete_prepare = $con->prepare("DELETE FROM `temporary_reserved_chairs` WHERE id = ?");
            $delete_prepare->bind_param("i", $delete);
            if (!$delete_prepare) {
                echo mysqli_error($con); 
            } else {
                $delete_prepare->execute();
                $delete_prepare->close();
            }
        }
    }
    $sqli_prepare->close();
}
?>

<!-- HTML Code for Ticket Selection -->
<div class="container col-12 text-uppercase bg-white d-flex align-items-center p-3" style="height: 75px;">
    <h2 class="text-left m-0 fs-1" style="color: #6E4F7D;">TICKETS BESTELLEN</h2>
</div>

<!-- Dropdown for Movie Selection, Datepicker, and Timepicker -->
<div class="container col-12 text-uppercase d-flex align-items-center p-0 my-4">
    <div class="col-12 d-flex flex-column flex-sm-row gap-3">
        <p class="d-flex justify-content-center align-items-center p-2 mb-0 bg-white"><?= $movie['title'] ?></p>

        <!-- Datepicker Dropdown -->
        <div class="dropdown">
            <button class="btn btn-light dropdown-toggle" style="color: #6E4F7D; border-radius: 0;" type="button"
                id="dropdownDateButton" data-bs-toggle="dropdown" aria-expanded="false">
                Datum
            </button>
            <ul class="dropdown-menu p-3" aria-labelledby="dropdownDateButton">
                <li><input type="date" class="form-control" placeholder="Kies een datum"></li>
            </ul>
        </div>

        <!-- Time Dropdown -->
        <div class="dropdown">
            <button class="btn btn-light dropdown-toggle" style="color: #6E4F7D; border-radius: 0;" type="button"
                id="dropdownTimeButton" data-bs-toggle="dropdown" aria-expanded="false">
                Tijdstip
            </button>
            <ul class="dropdown-menu p-3" aria-labelledby="dropdownTimeButton">
                <li>
                    <!-- Use HTML5 time input -->
                    <input type="time" class="form-control" placeholder="Kies een tijdstip">
                </li>
            </ul>
        </div>
    </div>
</div>

<!-- Seat Selection UI -->
<div class="container bg-white d-flex flex-column">
    
    <div class="container my-5">
        <div class="row">
            <h4 class="p-4" style="font-size: 30px; color: #6E4F7D;">STAP 1: KIES JE STOEL</h4>
        </div>

        <!-- Render Chairs -->
        <div id="chairs" class="container px-2" style="position: relative; overflow: visible;">
            <div id="choose-chair-pop-up" class="position-absolute bg-white d-flex flex-column gap-2 rounded"
                style="z-index: 9999; pointer-events: none; opacity: 0; transition: opacity 600ms ease; min-width: 200px; border: 1px solid #6E4F7D; overflow: hidden;">
                <table class="table table-hover m-0 p-0">

                    <head>
                        <tr>
                            <th colspan="2">Kies een ticket</th>
                        </tr>
                    </head>
                    <tbody>
                        <tr class="pointer" id="chair-pop-up-normal">
                            <td>
                                Normaal
                            </td>
                        </tr>
                        <tr class="pointer" id="chair-pop-up-child">
                            <td>
                                Kind t/m 11 jaar
                            </td>
                        </tr>
                        <tr class="pointer" id="chair-pop-up-older">
                            <td>
                                65+
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- <?= $is_clickable ? 'onclick="' . $onClick . '(this);"' : '' ?> -->
            <?php
                for ($i = 1; $i <= $total_rows; $i++) {
            ?>
            <div class="d-flex">
                <?php
                    
                    // Last row has 12 chairs, others have 11
                    $num_chairs = ($i === $total_rows) ? 12 : 11;

                    for ($x = 0; $x < $num_chairs; $x++) {
                        $src = '../assets/chairs/non_reserved_chair.png';
                        $isSelected = false;
                        $is_clickable = true;

                        // Check if chair is reserved
                        foreach ($chair_reserved as $reserved) {
                            if ($i == $reserved['row'] && $x == $reserved['num']) {
                                $src = '../assets/chairs/reserved_chair.png';
                                $is_clickable = false;

                                // If chair is temp reserved, show as such
                                foreach ($selected_chair as $session_chair) {
                                    if ($i == $session_chair['row'] && $x == $session_chair['num']) {
                                        $src = '../assets/chairs/temp_reserved_chair.png';
                                        $isSelected = true;
                                        $is_clickable = true;

                                        $type = $session_chair['type'];
                                    }
                                }
                            }
                        }
                ?>
                <!-- Chair UI -->
                <img src="<?= $src ?>" style="object-fit: contain;"
                    <?= $is_clickable === true && $isSelected === false ? 'onclick="chooseChairPopUp(this);"' : '' ?>
                    <?= $isSelected === true ? 'onclick="remove_chair(this, \'' . $type . '\');"' : '' ?>
                    class="chair col mt-3 p-1 <?= $is_clickable ? 'pointer' : 'no-pointer' ?>" data-num="<?= $x ?>"
                    data-row="<?= $i ?>" data-movieName="<?=  ?>" width="15" height="75">
                <?php
                    }
                ?>
            </div>
            <?php
                }
            ?>
        </div>
    </div>
    <!-- Ticket Details -->
    <div class="container my-5" style="color: #6E4F7D;">
        <div class="row">
            <h4 class="p-4" style="font-size: 30px; color: #6E4F7D; ">STAP 2: KIES JE TICKET</h4>
        </div>
        <table class="table table-hover bg-light">
            <thead>
                <tr>
                    <th scope="col" style="width: 80%;">TICKETS</th>
                    <th scope="col" class="text-end" style="width: 10%;">PRIJS</th>
                    <th scope="col" class="text-end" style="width: 10%;">AANTAL</th>
                </tr>
            </thead>
            <tbody>    
                <tr>
                    <td>Normaal</td>
                    <td class="text-end">€9,00</td>
                    <?php
                        $normalTicketCount = 0;
                        if(isset($_SESSION['temp_reserved_chair'])) {
                            foreach($_SESSION['temp_reserved_chair'] as $chair) {
                                if ($chair['type'] === 'normal') {
                                    $normalTicketCount++;
                                }
                            }
                        }
                    ?>
                    <td class="text-end">
                        <input oninput="ticketValidator();"
                            style="width: 50px; outline: none; border: 1px solid #6E4F7D; padding: 0 5px; border-radius: 5px;"
                            class="rounded bg-light" type="text" value="<?= $normalTicketCount ?>"
                            id="normal-ticket-input">
                    </td>
                </tr>
                <tr>
                    <td>Kind t/m 11 jaar</td>
                    <td class="text-end">€5,00</td>
                    <?php
                        $childTicketCount = 0;
                        if(isset($_SESSION['temp_reserved_chair'])) {
                            foreach($_SESSION['temp_reserved_chair'] as $chair) {
                                if ($chair['type'] === 'child') {
                                    $childTicketCount++;
                                }
                            }
                        }
                    ?>
                    <td class="text-end">
                        <input oninput="ticketValidator();"
                            style="width: 50px; outline: none; border: 1px solid #6E4F7D; padding: 0 5px; border-radius: 5px;"
                            class="rounded bg-light" type="text" value="<?= $childTicketCount ?>"
                            id="child-ticket-input">
                    </td>
                </tr>
                <tr>
                    <td>65+</td>
                    <td class="text-end">€7,00</td>
                    <?php
                        $olderTicketCount = 0;
                        if(isset($_SESSION['temp_reserved_chair'])) {
                            foreach($_SESSION['temp_reserved_chair'] as $chair) {
                                if ($chair['type'] === 'older') {
                                    $olderTicketCount++;
                                }
                            }
                        }
                    ?>
                    <td class="text-end">
                        <input oninput="ticketValidator();"
                            style="width: 50px; outline: none; border: 1px solid #6E4F7D; padding: 0 5px; border-radius: 5px;"
                            class="rounded bg-light" type="text" value="<?= $olderTicketCount ?>"
                            id="older-ticket-input">
                    </td>
                </tr>
                <tr>
                    <?php
                    $normalTicketTotalPrijs = $normalTicketCount * 9;
                    $childTicketTotalPrijs = $childTicketCount * 5;
                    $olderTicketTotalPrijs = $olderTicketCount * 7;
                    $totalPrice = $normalTicketTotalPrijs + $childTicketTotalPrijs + $olderTicketTotalPrijs;
                    ?>
                    <td>Totaal Prijs</td>
                    <td class="text-end" id="total-price-ticket"><?="€" . $totalPrice . ",00"  ?></td>
                    <td class="text-end">
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<?php include_once("footer.php"); ?>