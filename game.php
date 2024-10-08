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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">


    <script src="game.js" defer></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <a class="navbar-brand" href="#">
            <img src="https://1000logos.net/wp-content/uploads/2023/07/Family-Feud-Logo.png" width="50" height="30" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav">
            <a class="nav-item nav-link active" href="#">Home <span class="sr-only">(current)</span></a>
            <a class="nav-item nav-link" href="#">Rules</a>
            <a class="nav-item nav-link" href="#">Leaderboard</a>
          </div>
        </div>
      </nav>

    <header>
        <div class="container">
            <div class="row">
                <div class="col">
                </div>
                <div class="col-6">
                  <h1>Family Feud Game</h1>
                </div>
                <div class="col">
                </div>
            
        </div>  
    </header>

    <section>
        <div class="container text-center">
            <p>There are two families, each with five family members on their team. They have to guess the answers to a survey question asked to 100 people to win points for their team. The answers are seen on a huge survey board.</p>
            
            <!-- Start Game Button -->
            <button id="start-game" class="btn btn-primary my-4" onclick="startGame()">Start Game</button>

            <!-- Game Container -->
            <div id="game-container" style="display: none;">
                <h2>Question</h2>

                <!-- Answer List -->
                <ul id="answer-list" class="list-unstyled my-4">
                    <li class="answer"></li>
                    <li class="answer"></li>
                    <li class="answer"></li>
                    <li class="answer"></li>
                </ul>

                <!-- Answer Form -->
                <form id="answer-form" class="mb-4">
                    <input type="text" name="userAnswer" class="form-control" placeholder="Type your answer">
                    <input type="submit" value="Submit" class="btn btn-primary mt-3">
                </form>

                <!-- Team Score Table -->
                <table class="score-table table table-striped">
                    <thead class="thead-dark">
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

                <!-- Results -->
                <div id="results"></div>
            </div>

            <!-- Countdown Timer -->
            <div id="countdown-timer" hidden>30</div>
        </div>
    </section>

    <footer class="text-center my-4">
      <h3>Game Over!</h3>
    </footer>
    
   

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>