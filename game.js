// Variables to manage the game state
const teamA = document.querySelector('#team1Name');
const teamB = document.querySelector('#team2Name');

let team1Score = 0;
let team2Score = 0;
let currentTeam = 1; // Start with Team 1
let team1AnswerPoints = 0;
let team2AnswerPoints = 0;
let answersAttempted = 0; // Track the number of answers attempted in the round
let interval;
let lives = 3;
let guessedAnswers = [];

// Sample questions with answers and points
let questions = [
    {
        question: "Name a fruit",
        answers: {
            "apple": 50, 
            "banana": 25, 
            "orange": 10, 
            "grapes": 10, 
            "strawberry": 5
        }
    },
    {
        question: "Name a car brand",
        answers: {
            "toyota": 40, 
            "honda": 30, 
            "ford": 20, 
            "bmw": 15, 
            "mercedes": 10
        }
    },
    {
        question: "Name something you can see in school",
        answers: {
            "pencil": 40, 
            "pen": 30, 
            "notebook": 20, 
            "lunchbox": 15, 
            "teacher": 10
        }
    },
    {
        question: "Name a pet",
        answers: {
            "dog": 40, 
            "cat": 30, 
            "butiki": 20, 
            "dino": 15, 
            "laol": 10
        }
    }
];
let currentRound =  Math.round(Math.random() * questions.length);
// Start the game logic
function startGame() {
    document.querySelector('#game-container').style.display = 'block';
    document.getElementById('start-game').style.display = 'none';
    document.querySelector('.lead').style.display = 'none';
    alert(`Welcome to Family Feud!`);
    document.querySelector('#playerss').style.display = 'none';
    loadQuestion();
}

// Load the current question
function loadQuestion() {
    clearInterval(interval)
    let currentQuestion = questions[currentRound];
    document.querySelector('#game-container h2').textContent = currentQuestion.question;

    let answerList = document.getElementById('answer-list');
    answerList.innerHTML = ''; // Clear previous answers

    // Populate the hidden answer board
    for (let answer in currentQuestion.answers) {
        let li = document.createElement('li');
        li.textContent = answer;
        li.style.visibility = 'hidden'; // Initially hidden
        answerList.appendChild(li);
    }

    document.getElementById('answer-board').style.display = 'block'; // Show answer board
}

function startTimer() {
    let countdown = 11;
    clearInterval(interval)
    const timer = document.getElementById('countdown-timer');
    timer.hidden = false;
    timer.style.display = "block";
    timer.style.visibility = "visible";
    timer.textContent = countdown;

    interval = setInterval(() => {
        countdown--;
        timer.textContent = countdown;
        if (countdown <= 0) {
            clearInterval(interval);
            alert('Time is up!');
            let userAnswer = document.querySelector('[name="userAnswer"]').value.toLowerCase();
            checkAnswer(userAnswer)
        }
    }, 1000);
}


// Handle buzzer press
document.getElementById('buzzer').addEventListener('click', function() {
    document.getElementById('buzzer-section').style.display = 'none';
    document.getElementById('team-select').style.display = 'block'; // Show team selection
});

// Handle team selection
document.getElementById('team1-buzzer').addEventListener('click', function() {
    currentTeam = 1;
    startRound();
    startTimer();
});

document.getElementById('team2-buzzer').addEventListener('click', function() {
    currentTeam = 2;
    startRound();
    startTimer();
});


// Handle the form submission to check the answer
document.getElementById('answer-form').addEventListener('submit', function (event) {
    event.preventDefault();
    let userAnswer = document.querySelector('[name="userAnswer"]').value.toLowerCase();
    let answerListItems = document.querySelectorAll('#answer-list li');

    // Uncover the correct answer on the board
    answerListItems.forEach(item => {
        if (item.textContent === userAnswer) {
            item.style.visibility = 'visible';
        }
    });
    guessedAnswers.push(guessedAnswers)
    checkAnswer(userAnswer);
});

document.getElementById('team-answer-form').addEventListener('submit', function (event) {
    event.preventDefault();
});
// Handle the form submission to check the answer
document.getElementById('btnTeam').addEventListener('click', function (event) {
    let userAnswer = document.querySelector('[name="team-userAnswer"]').value.toLowerCase();
    let answerListItems = document.querySelectorAll('#answer-list li');

    // Uncover the correct answer on the board
    answerListItems.forEach(item => {
        if (item.textContent === userAnswer) {
            item.style.visibility = 'visible';
        }
    });
    checkTeamAnswer(userAnswer);
});

let correct = 1;
// Check if the submitted answer is correct
function checkTeamAnswer(userAnswer) {
    clearInterval(interval);
    let currentAnswers = questions[currentRound].answers;
    
    if(correct === Object.keys(questions[currentRound].answers).length){
        endGame()
    }

    if (userAnswer in currentAnswers && !guessedAnswers.includes(userAnswer)) {
        let points = currentAnswers[userAnswer];
        alert(`Correct answer! You've earned ${points} points.`);
        guessedAnswers.push(userAnswer); // Add correct answer to guessed list
        correct++;
        // Update team score
        if (currentTeam === 1) {
            updateScore(1, points);
        } else {
            updateScore(2, points);
        }
    } else {
        lives--;
        alert(`Wrong answer! ${lives} lives left.`);
    }

    // Check if game round is over
    if (lives === 0) {
        alert(`Team ${currentTeam} has 3 wrong answers! Opponent's chance to steal.`);
        stealTeam();
    } else if (Object.keys(currentAnswers).length === correct) {
        alert(`Team ${currentTeam} got all the answers! They win this round!`);
        endGame();
    } else {
        startTimer(); // Restart timer for next answer
    }
    document.getElementById('countdown-timer').style.visibility = "visible";
    document.querySelector('[name="userAnswer"]').value = ''; // Reset the input field
}

// Update the team's score
function updateScore(team, points) {
    if (team === 1) {
        team1Score += points;
        document.querySelector('.score-table tbody tr:nth-child(1) td:nth-child(1)').textContent = team1Score;
    } else {
        team2Score += points;
        document.querySelector('.score-table tbody tr:nth-child(1) td:nth-child(2)').textContent = team2Score;
    }
}

// Switch to the other team for a chance to steal
function stealTeam() {
    currentTeam = currentTeam === 1 ? 2 : 1;
    lives = 3; // Reset lives for the new team
    alert(`It's now Team ${currentTeam}'s chance to steal!`);
    let currentAnswers = questions[currentRound].answers;

    document.querySelector('#btnTeam').addEventListener('click',()=>{
        let teamUserAnswer = document.querySelector('[name="team-userAnswer"]').value.toLowerCase();
        if(teamUserAnswer in currentAnswers) {
            if (currentTeam === 1) {
                team1Score += team2Score;
                alert(`You now got their points! Your team has ${team1Score}pts`)
                document.querySelector('.score-table tbody tr:nth-child(1) td:nth-child(1)').textContent = team1Score;
            } else {
                alert(`You now got their points! Your team has ${team2Score}pts`)
                team2Score += team1Score;
                document.querySelector('.score-table tbody tr:nth-child(1) td:nth-child(2)').textContent = team2Score;
            }
            endGame()
        }else {
            alert('You fail to steal :<')
            endGame()
        }
    })
    
}

// Resetting for next round or continue
function resetForNextRound() {

    answersAttempted = 0;
    guessedAnswers = [];
    if (currentRound < questions.length) {
        loadQuestion();
    } else {
        endGame();
    }
}

// End game and declare winner
function endGame() {
 
    alert(`Game Over! ${teamA.value}: ${team1Score} points, ${teamB.value}: ${team2Score} points.`);

    // Send data to PHP via POST
    fetch('game.php', {
        method: 'POST',
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            "teamA": teamA.value || '',   // Default to empty string if undefined
            "team1Score": team1Score || 0,  // Default to 0 if undefined
            "teamB": teamB.value || '',
            "team2Score": team2Score || 0
        })  // Correctly send the JSON
    })
    .then(res => res.json())
    .then(data => {
        console.log(data);
    })
    .catch(error => {
        console.error('Error:', error);
    });
    alert(data)

    document.querySelector('#game-container').style.display = 'none';
}


// Check if the submitted answer is correct
function checkAnswer(userAnswer) {
    clearInterval(interval);

    let currentAnswers = questions[currentRound].answers;

    if (userAnswer.toLowerCase() in currentAnswers) {
        let points = currentAnswers[userAnswer];
        alert(`Correct answer! You've earned ${points} points.`);

        // Update team score and track points for comparison
        if (currentTeam === 1) {
            team1AnswerPoints = points;
            updateScore(1, points);
        } else {
            team2AnswerPoints = points;
            updateScore(2, points);
        }
    } else {
        alert('Wrong answer! No points earned.');
    }

    // Switch teams and alternate answers
    answersAttempted++;
    if (answersAttempted === 2) {
        determineHigherScore();
        startTimer();
    } else {
        switchTeam();
        startTimer();
    }

    document.querySelector('[name="userAnswer"]').value = ''; // Reset the input field
    
}

// Update the team's score
function updateScore(team, points) {
    if (team === 1) {
        team1Score += points;
        document.querySelector('.score-table tbody tr:nth-child(1) td:nth-child(1)').textContent = team1Score;
    } else {
        team2Score += points;
        document.querySelector('.score-table tbody tr:nth-child(1) td:nth-child(2)').textContent = team2Score;
    }
}

// Switch to the other team
function switchTeam() {
    currentTeam = currentTeam === 1 ? 2 : 1;
    alert(`It's now Team ${currentTeam}'s turn!`);
}

// Determine which team has the higher score for the current round
function determineHigherScore() {
    if (team1AnswerPoints > team2AnswerPoints) {
        currentTeam = 1; // Team 1 will get the choice
        alert(`${teamA.value} got the highest answer!`);
    } else if (team2AnswerPoints > team1AnswerPoints) {
        currentTeam = 2; // Team 2 will get the choice
        alert(`${teamB.value} got the highest answer!`);
    } else {
        alert(`${teamA.value} goes first.`);
        currentTeam = 1;
    }
    displayPassOrPlay();
}

// Display "Pass or Play" options
function displayPassOrPlay() {
    document.querySelector('#answer-form').style.display = 'none';
    document.querySelector('.score-table').style.display = 'none';
    document.querySelector('.team-controls').style.display = 'block';
    document.getElementById('countdown-timer').style.display = 'none';
    document.getElementById('buzzer-section').style.display = 'none';
    document.getElementById('team-select').style.display = 'none';
    document.querySelector('#game-container h2').textContent = "Choose Between:";
    document.getElementById('passBtn').addEventListener('click', function () {
        currentTeam = currentTeam === 1 ? 2 : 1; // Switch to the other team
        alert(`Team ${currentTeam} will play!`);
        document.querySelector('#team-answer-form').style.visibility = "visible";
        document.querySelector('#answer-form').style.visibility = "hidden";
        document.querySelector('.team-controls').style.display = 'none';
        startTimer();
        startRound();
    });

    document.getElementById('playBtn').addEventListener('click', function () {
        alert(`Team ${currentTeam} has chosen to play!`);
        document.querySelector('#team-answer-form').style.visibility = "visible";
        document.querySelector('#answer-form').style.visibility = "hidden";
        document.querySelector('.team-controls').style.display = 'none';
        startTimer();
        startRound();
    });
}

// Handle the play round for 4 questions
function playRound() {
    // Reset round-specific variables
    answersAttempted = 0;
    team1AnswerPoints = 0;
    team2AnswerPoints = 0;
    loadQuestion();
}

// Resetting for next round or continue
function resetForNextRound() {
    answersAttempted = 0;
    team1AnswerPoints = 0;
    team2AnswerPoints = 0;
    if (currentRound < questions.length) {
        loadQuestion();
    } else {
        endGame();
    }
}

// End game and declare winner
function endGame() {
    alert(`Game Over! ${teamA.value}: ${team1Score} points, ${teamB.value}: ${team2Score} points.`);
    document.querySelector('#game-container').style.display = 'none';
}

let leaderPop = false;
const leaderBoard = document.querySelector('#results')
document.querySelector('#pop-up-leaderboard').addEventListener('click',()=>{
    if(leaderPop===true) {
        leaderPop = false;
        leaderBoard.style.visibility = "hidden";
        return;
    }
    leaderBoard.style.visibility = "visible";
    leaderPop = true;


})

function startRound() {
    document.querySelector('#answer-form').style.display = 'block';
    document.querySelector('#game-container h2').textContent = `${questions[currentRound].question}`;
    
    document.getElementById('answer-form').addEventListener('submit', function (event) {
        event.preventDefault();
        let answer = document.querySelector('[name="userAnswer"]').value.toLowerCase();
        let totalAnswers = questions[currentRound].answers;
        
        if (totalAnswers.includes(answer)) {
            alert("Correct answer!");
            guessedAnswers.push(answer);
            score += 10; // Assign points for each correct answer
        } else {
            lives--;
            alert(`Wrong answer! ${lives} lives left.`);
        }

        document.getElementById('answerInput').value = ''; // Clear input field
        
        if (lives === 0) {
            alert(`Team ${currentTeam} has 3 wrong answers! Opponent's chance to steal.`);
            switchTurn();
        } else if (guessedAnswers.length === totalAnswers.length) {
            alert(`Team ${currentTeam} got all the answers! They win with ${score} points!`);
            resetGame();
        }
    });
}

function switchTurn() {
    currentTeam = currentTeam === 1 ? 2 : 1; // Switch to opponent team
    isOpponentTurn = true;
    document.querySelector('#answer-form').style.display = 'none';
    document.querySelector('#game-container h2').textContent = `Team ${currentTeam}, it's your chance to steal!`;

    document.getElementById('stealBtn').style.display = 'block';
    document.getElementById('stealBtn').addEventListener('click', function () {
        let stealAnswer = document.getElementById('stealInput').value.trim();
        
        if (totalAnswers.includes(stealAnswer) && !guessedAnswers.includes(stealAnswer)) {
            alert(`Team ${currentTeam} stole the points!`);
            score = 0; // Reset the original team's score
            resetGame();
        } else {
            alert(`Team ${currentTeam} failed to steal. Points remain with the original team.`);
            resetGame();
        }
    });
}

function resetGame() {
    // Reset lives, score, and the round for a new game
    lives = 3;
    score = 0;
    guessedAnswers = [];
    document.querySelector('#answer-form').style.display = 'none';
    document.querySelector('#stealBtn').style.display = 'none';
    document.querySelector('#game-container h2').textContent = `Game over!`;
    // Optionally restart the game or show final score
//     setTimeout(displayPassOrPlay, 2000); // Restart the game
 }



