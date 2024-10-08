<?php
function saveScore($team, $points) {
    global $conn;

    $stmt = $conn->prepare("INSERT INTO scores VALUES (?, ?, CURRENT_TIMESTAMP)");
    $stmt->bind_param("si", $team, $points);
    $stmt->execute();
    $stmt->close();
}

function getScores() {
    global $conn;

    $sql = "SELECT * FROM scores";
    $result = $conn->query($sql);

    $scores = array();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $scores[] = $row;
        }
    }

    return $scores;
}
?>