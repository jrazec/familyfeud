let playerScore,numberRound,currentAnswer;

const startGameBtn = document.querySelector('#start-game');

const answerForm = document.getElementById('answer-form');
const countDownTimer = document.querySelector('#countdown-timer')
const passBtn = document.getElementById('passBtn');
const playBtn = document.getElementById('playBtn');


startGameBtn.addEventListener('click',()=>{

});

passBtn.addEventListener('click',()=> {

});

playBtn.addEventListener('click',()=>{

});
//skipped num 9

function validateAnswers(answers) {

}

function displayAnswer(){

}

function startCountDown(time) {
    countDownTimer.hidden = false;
    setInterval(()=>{
        if(time===0){
            countDownTimer.hidden = true;
            return
        }
        time--;
        countDownTimer.textContent = time;
    },1000)
}

function updatePlayerScore() {
    //updates player scores in the table
}
