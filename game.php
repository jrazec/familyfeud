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
                        <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#rulesModal">Rules</a>
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
                    <button id="btnTeam" class="btn btn-secondary">Submit</button>
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

    <div class="modal fade" id="alertModal" tabindex="-1" aria-labelledby="alertModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="alertModalLabel">Family Feud Game Rules</h5>
                </div>
                <div class="modal-body" id="alertModalBody">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Ok</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Rules Modal -->
    <div class="modal fade" id="rulesModal" tabindex="-1" aria-labelledby="rulesModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="rulesModalLabel">Family Feud Game Rules</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <h3>Overview</h3>
                            <p>Family Feud is an exciting team-based game where two families compete to guess the most popular answers to survey questions. The game is played in rounds, and the family with the highest score at the end wins!</p>

                            <h3>Game Setup</h3>
                            <ol>
                                <li><strong>Teams</strong>: The game consists of two families, each with five members. Players can choose their family roles or teams before starting.</li>
                                <li><strong>Game Board</strong>: A virtual game board displays the questions and answers as they are revealed. Each question has multiple potential answers based on survey responses.</li>
                            </ol>

                            <h3>Game Flow</h3>
                            <ol>
                                <li><strong>Starting the Game</strong>: 
                                    <ul>
                                        <li>Click the <strong>"Start Game"</strong> button to begin. A random survey question will be displayed on the screen.</li>
                                    </ul>
                                </li>
                                <li><strong>Asking Questions</strong>: 
                                    <ul>
                                        <li>The host reads a survey question (e.g., “Name something you associate with the beach”).</li>
                                        <li>Each family takes turns providing answers to the question.</li>
                                    </ul>
                                </li>
                                <li><strong>Answering</strong>: 
                                    <ul>
                                        <li>Players can type their answers into the provided input box and hit the <strong>"Submit"</strong> button.</li>
                                        <li>If the answer is correct (i.e., it appears on the board), it will be revealed along with the number of points associated with it.</li>
                                        <li>If the answer is incorrect (not on the board), the other family gets a chance to answer.</li>
                                    </ul>
                                </li>
                                <li><strong>Scoring</strong>: 
                                    <ul>
                                        <li>Teams earn points for every correct answer they provide, based on how many survey respondents gave that answer.</li>
                                        <li>The current scores for both teams are displayed on the scoreboard.</li>
                                    </ul>
                                </li>
                                <li><strong>Pass or Play</strong>: 
                                    <ul>
                                        <li>After each turn, the team can choose to <strong>"Pass"</strong> (give the other team a chance to answer) or <strong>"Play"</strong> (continue answering).</li>
                                        <li>If a team chooses to play, they keep answering until they either provide three incorrect answers or decide to pass.</li>
                                    </ul>
                                </li>
                                <li><strong>Winning the Round</strong>: 
                                    <ul>
                                        <li>The round ends when all the answers have been revealed or when one team accumulates enough points.</li>
                                        <li>The team with the highest score at the end of the round wins.</li>
                                    </ul>
                                </li>
                            </ol>

                            <h3>Game End</h3>
                            <ul>
                                <li>Once all rounds are completed, the team with the highest overall score is declared the winner!</li>
                                <li>A <strong>"Game Over!"</strong> message will display, along with the final scores and any special notes.</li>
                            </ul>

                            <h3>Additional Features</h3>
                            <ul>
                                <li><strong>Countdown Timer</strong>: A timer counts down during each round, adding excitement and urgency.</li>
                                <li><strong>Results Display</strong>: After each round, the results will be shown, summarizing each team's performance.</li>
                            </ul>

                            <h3>Tips for Success</h3>
                            <ul>
                                <li>Think quickly and creatively! Popular answers might not always be the first that come to mind.</li>
                                <li>Communication within the team is key—discuss potential answers before submitting.</li>
                                <li>Keep track of the points and the answers already provided to strategize effectively.</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
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
