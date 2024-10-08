<?php
// Include database configuration
include("data/config_file.php" );
include("data/query.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Family Feud Game</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="game.js" defer></script>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="https://1000logos.net/wp-content/uploads/2023/07/Family-Feud-Logo.png" width="50" height="30" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Rules</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" id="pop-up-leaderboard">Leaderboard</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Header -->
    <header class="bg-light py-5 text-center">
        <div class="container">
            <h1 class="display-4">Family Feud Game</h1>
        </div>
    </header>

    <!-- Game Section -->
    <section>
        <div class="container text-center mt-4">
            <p class="lead">Family Feud is a fun, team-based game where two families compete to guess the most popular answers to survey questions posed to 100 people. Each team takes turns answering the question, with points awarded for correct responses displayed on a virtual game board.</p>

            <!-- Start Game Button -->
            <button id="start-game" class="btn btn-primary my-4" onclick="startGame()">Start Game</button>

            <!-- Game Container -->
            <div id="game-container" style="display: none;">

                <!-- Countdown Timer -->
                <div id="countdown-timer" hidden>30</div>
                <h2>Question</h2>
                
                <!-- Answer List -->
                <ul id="answer-list" class="list-unstyled my-4">
                    <li class="answer list-group-item"></li>
                    <li class="answer list-group-item"></li>
                    <li class="answer list-group-item"></li>
                    <li class="answer list-group-item"></li>
                </ul>

                <!-- Answer Form -->
                <form id="answer-form" class="mb-4">
                    <input type="text" name="userAnswer" class="form-control" placeholder="Type your answer">
                    <input type="submit" value="Submit" class="btn btn-primary">
                </form>

                <!-- Team Answer Form -->
                <form id="team-answer-form" class="mb-4">
                    <input type="text" name="team-userAnswer" class="form-control" placeholder="Type your answer">
                    <input type="submit" value="team-submit" class="btn btn-secondary">
                </form>

                <!-- Team Score Table -->
                <table class="score-table table table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">Team 1</th>
                            <th scope="col">Team 2</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>0</td> <!-- Team 1 Score -->
                            <td>0</td> <!-- Team 2 Score -->
                        </tr>
                    </tbody>
                </table>

                <!-- Pass or Play Controls -->
                <div class="team-controls" style="display: none;">
                    <button id="passBtn" class="btn btn-warning">Pass</button>
                    <button id="playBtn" class="btn btn-success">Play</button>
                </div>


            </div>


        </div>
    </section>

    <!-- Results -->
    <div id="results">
      <table class="score-table table table-striped">
          <thead class="table-dark">
              <tr>
                  <th scope="col">Team</th>
                  <th scope="col">Score</th>
                  <th scope="col">Finished</th>
              </tr>
          </thead>
          <tbody>
              



            <?php
              $score = getScores();
              foreach ($score as $key => $value) {
                echo "<tr>";
                echo '<td>'. $value['team'].'</td>';
                echo '<td>'. $value['score'].'</td>';
                echo '<td>'. $value['time_finished'].'</td>';
                echo "</tr>";
              

              }
          

            ?>
            </tbody>
      </table>
    </div>


    <!-- Footer -->
    <footer class="text-center my-4">
        <h3>Game Over!</h3>
    </footer>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
