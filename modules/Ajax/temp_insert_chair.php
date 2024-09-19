<?php
    session_start();
    include "../core/db_connect.php";

    $chair_num = (int)$_GET['chair_num'];
    $chair_row = (int)$_GET['chair_row'];
    $type_ticket = $_GET['type_ticket'];
    $name = $_GET['name'];

    // Prevent duplicate reservations with a unique constraint in the database
    $sqli_prepare = $con->prepare("INSERT INTO `temporary_reserved_chairs` (chair_number, chair_row, type, movie_name) VALUES (?, ?, ?, ?);");
    $sqli_prepare->bind_param('iiss', $chair_num, $chair_row, $type_ticket, $name);

    if (!$sqli_prepare->execute()) {
        echo json_encode(["error" => true, "message" => "Chair already reserved"]);
    } else {
        $last_inserted_id = $sqli_prepare->insert_id;

        $_SESSION['temp_reserved_chair'][$last_inserted_id] = [
            'num' => $chair_num,
            'row' => $chair_row,
            'type' => $type_ticket,
            'name' => $name
        ];

       
        $amountOfType = 0;
        $totalPrijs = 0;
        $totalTicketDisplay = "";
        $totalNormalTickets = 0;
        $totalChildTickets = 0;
        $totalOlderTickets = 0;

        foreach ($_SESSION['temp_reserved_chair'] as $chair) {
            if ($chair['type'] == $type_ticket) {
                $amountOfType++;
            }
            if($chair['type'] == "normal") {
                $totalPrijs += 9;
                $totalNormalTickets++;
            } else if($chair['type'] == "child") {
                $totalPrijs += 5;
                $totalChildTickets++;
            } else if($chair['type'] == "older") {
                $totalPrijs += 7;
                $totalOlderTickets++;
            }
        
        }

        $totalTicketDisplay = $totalTicketDisplay . $totalNormalTickets . "x Normaal  |  " . $totalChildTickets . "x Kinderen t/m 14  |  " . $totalOlderTickets . "x 65+";
        $totalTicket = $totalNormalTickets + $totalChildTickets + $totalOlderTickets;

        $data = [
            "error" => false,
            "reserved" => true,
            "amountOfType" => $amountOfType,
            "amountTotalPrice" => $totalPrijs,
            "name" => $name,
            "totalTicketDisplay" => $totalTicketDisplay,
            "totalTickets" => $totalTicket
            
        ];

        echo json_encode($data);
    }


    $sqli_prepare->close();
    $con->close();
?>