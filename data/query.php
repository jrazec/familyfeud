<?php
function saveScore($team, $points) {
    global $conn;

    $stmt = $conn->prepare("INSERT INTO scores (team, points) VALUES (?, ?)");
    $stmt->bind_param("si", $team, $points);
    $stmt->execute();
    $stmt->close();
}

function getScores() {
    global $conn;

    $sql = "SELECT team, points FROM scores ORDER BY points DESC";
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