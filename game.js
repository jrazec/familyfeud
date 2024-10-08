// Variables to manage the game state
let currentRound = 0;
let team1Score = 0;
let team2Score = 0;
let currentTeam = 1; // Start with Team 1
let team1AnswerPoints = 0;
let team2AnswerPoints = 0;
let answersAttempted = 0; // Track the number of answers attempted in the round

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
    }
];

// Start the game logic
function startGame() {
    document.querySelector('#game-container').style.display = 'block';
    document.getElementById('start-game').style.display = 'none';
    alert(`Team 1 starts the game!`);
    loadQuestion();
}

// Load the current question
function loadQuestion() {
    let currentQuestion = questions[currentRound];
    document.querySelector('#game-container h2').textContent = currentQuestion.question;
}

// Handle the form submission to check the answer
document.getElementById('answer-form').addEventListener('submit', function (event) {
    event.preventDefault();
    let userAnswer = document.querySelector('[name="userAnswer"]').value.toLowerCase();
    checkAnswer(userAnswer);
});

// Check if the submitted answer is correct
function checkAnswer(userAnswer) {
    let currentAnswers = questions[currentRound].answers;

    if (userAnswer in currentAnswers) {
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
    } else {
        switchTeam();
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
        alert('Team 1 got the highest answer!');
    } else if (team2AnswerPoints > team1AnswerPoints) {
        currentTeam = 2; // Team 2 will get the choice
        alert('Team 2 got the highest answer!');
    } else {
        alert('It\'s a tie! Team 1 goes first.');
        currentTeam = 1;
    }
    displayPassOrPlay();
}

// Display "Pass or Play" options
function displayPassOrPlay() {
    document.querySelector('.team-controls').style.display = 'block';
    document.getElementById('passBtn').addEventListener('click', function () {
        currentTeam = currentTeam === 1 ? 2 : 1; // Switch to the other team
        alert(`Team ${currentTeam} will play!`);
        document.querySelector('.team-controls').style.display = 'none';
        playRound();
    });

    document.getElementById('playBtn').addEventListener('click', function () {
        alert(`Team ${currentTeam} has chosen to play!`);
        document.querySelector('.team-controls').style.display = 'none';
        playRound();
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
    currentRound++;
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
    alert(`Game Over! Team 1: ${team1Score} points, Team 2: ${team2Score} points.`);
    document.querySelector('#game-container').style.display = 'none';
}