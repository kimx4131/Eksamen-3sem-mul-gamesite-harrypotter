let canvas = document.querySelector('#canvas');
let canvasContext = canvas.getContext('2d'); //Fortæller at det er et 2d element

let x;
let y;

let playerPostion;

//  - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

//mazes
// -1 = player, 0 = maze, 1 = wall, 2 = goal, 3 = deatheaters, 4 = gelleons, 5 = dobby
let maze =
[
    [-1,1,4,0,0,1,2,0,1,4],
    [0,0,0,1,0,0,1,0,0,0],
    [1,1,0,3,1,4,0,3,1,0],
    [3,0,0,1,0,1,0,1,0,0],
    [0,0,3,1,0,4,1,0,0,1],
    [0,1,1,0,0,1,1,0,1,4],
    [0,3,4,0,1,0,0,0,0,0],
    [0,1,1,0,0,0,1,4,1,0],
    [0,1,0,0,1,3,1,1,0,0],
    [4,0,0,0,0,0,4,1,5,3]
];

let maze2 =
[
    [4,0,3,0,2,1,-1,0,0,4],
    [1,0,0,0,1,5,1,3,0,0],
    [0,0,1,3,0,0,0,0,1,0],
    [0,1,0,0,0,1,0,1,0,0],
    [0,1,3,0,1,4,0,1,4,0],
    [0,0,1,0,0,1,0,1,0,0],
    [3,0,1,0,1,0,0,0,1,0],
    [0,0,1,0,1,0,1,0,0,0],
    [0,1,0,0,1,0,3,1,1,1],
    [0,0,0,1,4,0,0,0,0,4]
];

let maze3 = 
[
    [4,3,0,0,-1,1,4,0,1,4],
    [0,0,0,1,1,0,0,0,1,0],
    [1,0,1,4,0,0,1,0,0,0],
    [0,0,0,0,0,1,4,1,0,0],
    [1,1,1,3,0,0,0,1,3,0],
    [0,4,1,0,0,3,0,4,1,0],
    [0,1,0,0,1,1,1,1,0,0],
    [0,1,3,0,0,0,4,1,0,3],
    [0,0,1,1,1,0,1,0,0,0],
    [5,0,0,0,0,0,4,3,0,2]
];

//  - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

//Timer
let seconds = 60;
document.querySelector('#time-display').innerText = seconds;
let time;


//  - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
//Spillet vises ikke
canvas.style.display = "none";

//Print the theme name of the maze
let mazeName = document.querySelector('#mazename');
mazename.innerHTML ="The Harry Potter Game";

//Henter start knappen
let startgame = document.querySelector('#startgame');

let footer = document.querySelector('#footer');

//Starter spillet
startgame.addEventListener('click', playgame);
function playgame(){
    //viser spillet
    canvas.style.display = "block";
    grid();

    //Fjerner knappen
    startgame.style.display ="none";

    //Fjerner footer for bedre udsyn
    footer.style.display = "none";

    //Ændre overskriften
    mazeName.innerHTML = "The Dark Forrest";

    //Starter timeren
    time = setInterval(function () {
        seconds -= 1;
        document.querySelector('#time-display').innerText = seconds;
        
        //Time up - død
        if(seconds == 0){
            gameover();
        };
    
    }, 1000);
};

//  - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

//Tile size
let tileSize = 50;

//colors
let mazeColor = "#091A2F";

//Images
let harry=new Image();
harry.src='img/harry.png';

let hogwarts=new Image();
hogwarts.src='img/hogwarts.png';

let galleon=new Image();
galleon.src='img/galleon.svg';

let deatheater=new Image();
deatheater.src='img/darkmark.svg';

let dobby=new Image();
dobby.src='img/dobby.png';

let imgwall=new Image();
imgwall.src='img/forrestwall.svg';

let imgwall2=new Image();
imgwall2.src='img/greenwall.jpg';

let imgwall3=new Image();
imgwall3.src='img/stonewall.jpg';

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

//Henter omårdet med spillesresultater og viser dem ikke
let gameresult = document.querySelector('#gameresult');
gameresult.style.display = "none";

//Til en ny bane
function toNewMaze(){
    //Fra bane 1 til bane 2
    if(helped ==1){
        maze = maze2;
        mazeName.innerHTML="Ministry of Magic";

        mazeColor = "#1C3126";    
        imgwall= imgwall2;
    }; 

    //Fra bane 2 til bane 3
    if(helped ==2){
        maze = maze3;
        mazeName.innerHTML="Hogwarts";

        mazeColor = "#C9A78B";
        imgwall = imgwall3;
    }; 
    
    //Fra bane 3 til at vinde
    if (helped ==3){
        canvas.style.display = "none";
        mazeName.innerHTML="You won";

        gameresult.style.display ="block";
        footer.style.display = "block";

        document.querySelector('#finalscore').innerHTML = score;
        document.querySelector('#finallives').innerHTML = lives;
        document.querySelector('#helpeddobby').innerHTML = helped;
        document.querySelector('#timeleft').innerHTML = seconds;
        document.querySelector('#totalscore').innerHTML = score+lives+helped+seconds;

        clearInterval(time);

        document.querySelector('#finalscore-db').value = score;
        document.querySelector('#finallives-db').value = lives;
        document.querySelector('#helpeddobby-db').value = helped;
        document.querySelector('#timeleft-db').value = seconds;
        document.querySelector('#totalscore-db').value = score+lives+helped+seconds;
    };
};

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

//GAME OVER!
function gameover(){
    canvas.style.display = "none";
    mazeName.innerHTML="Game Over";

    //gameover teksten vises ikke
    let gameover = document.querySelector('#gameover');

    if(seconds == 0 ){
        gameover.innerHTML = "<span>You ran out of life.</span>";
    } else if(lives == 0){
        gameover.innerHTML = "<span>You ran out of life.</span>";
    } else {
        gameover.innerHTML = "<span>You lost the game.</span>";
    };

    clearInterval(time);

    setTimeout(function(){location.href = "gamesite.php";}, 4500);
    
};

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

//Score
let score = 0;
let point = 2;
let scoreText = document.querySelector('#score');
scoreText.innerHTML = score;

function pointScore() {
    score += point;
    scoreText.innerHTML = score;
};

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

//Lives
let lives = 3;
let hurt = 1;
let livesText = document.querySelector('#lives');
livesText.innerHTML = lives;

function livesScore() {
    lives -= hurt;
    livesText.innerHTML = lives;

    if(lives == 0){
        gameover();
    };
};

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

//Dobby
let helped = 0;
let helping = 1;
let helpedText = document.querySelector('#helped');
helpedText.innerHTML = helped;

function helpedScore() {
    helped += helping;
    helpedText.innerHTML = helped;
};

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

//Drawing the grid
function grid(){
    for(y=0; y < maze.length; y++){
        for(x=0; x < maze[y].length; x++){
            if(maze[y][x] == -1){ //PLAYER/SPILLER
                playerPostion = {y,x}; //genne og kigger på hvorhenne playeren er på pladen

                canvasContext.fillStyle = mazeColor;
                canvasContext.fillRect(x*tileSize, y*tileSize, tileSize, tileSize);

                canvasContext.drawImage(harry, x*tileSize, y*tileSize, tileSize, tileSize);

            } else if(maze[y][x] == 0){ //BANE/VEJ
                canvasContext.fillStyle = mazeColor;
                canvasContext.fillRect(x*tileSize, y*tileSize, tileSize, tileSize);

            } else if(maze[y][x] == 1){ //WALL
                canvasContext.fillStyle = mazeColor;
                canvasContext.fillRect(x*tileSize, y*tileSize, tileSize, tileSize);

                canvasContext.drawImage(imgwall, x*tileSize, y*tileSize, tileSize, tileSize);

            } else if(maze[y][x] == 2){ //MÅL
                canvasContext.fillStyle = mazeColor;
                canvasContext.fillRect(x*tileSize, y*tileSize, tileSize, tileSize);

                canvasContext.drawImage(hogwarts, x*tileSize, y*tileSize, tileSize, tileSize);

            } else if(maze[y][x] == 3){ //deatheater
                canvasContext.fillStyle = mazeColor;
                canvasContext.fillRect(x*tileSize, y*tileSize, tileSize, tileSize);

                canvasContext.drawImage(deatheater, x*tileSize, y*tileSize, tileSize, tileSize);

            } else if(maze[y][x] == 4){ //galleon
                canvasContext.fillStyle = mazeColor;
                canvasContext.fillRect(x*tileSize, y*tileSize, tileSize, tileSize);

                canvasContext.drawImage(galleon, x*tileSize, y*tileSize, tileSize, tileSize);

            } else if(maze[y][x] == 5){ //dobby
                canvasContext.fillStyle = mazeColor;
                canvasContext.fillRect(x*tileSize, y*tileSize, tileSize, tileSize);

                canvasContext.drawImage(dobby, x*tileSize, y*tileSize, tileSize, tileSize);

            };
        };
    };
};
//grid();

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

//Funktioner til Switch angående piltaster
function keyLeft(){
    if (maze[playerPostion.y][playerPostion.x -1] == 0){ // hvis feltet i mazen er 0, så kan spiller gå på den 
        maze[playerPostion.y][playerPostion.x -1] = -1; //nye position. Ændre et 0 til -1
        maze[playerPostion.y][playerPostion.x] = 0; //gammle position. Ændre -1 til 0

    }else if (maze[playerPostion.y][playerPostion.x -1] == 2){
        toNewMaze();

    }else if (maze[playerPostion.y][playerPostion.x -1] == 3){
        livesScore();
        maze[playerPostion.y][playerPostion.x -1] = -1; 
        maze[playerPostion.y][playerPostion.x] = 0; 

    } else if (maze[playerPostion.y][playerPostion.x -1] == 4){
        pointScore();
        maze[playerPostion.y][playerPostion.x -1] = -1; 
        maze[playerPostion.y][playerPostion.x] = 0; 

    } else if (maze[playerPostion.y][playerPostion.x -1] == 5){
        helpedScore();
        maze[playerPostion.y][playerPostion.x -1] = -1; 
        maze[playerPostion.y][playerPostion.x] = 0; 

    };
};

function keyUp(){
    if (maze[playerPostion.y -1][playerPostion.x] == 0){ // hvis feltet i mazen er 0, så kan spiller gå på den 
        maze[playerPostion.y -1][playerPostion.x] = -1; //nye position. Ændre et 0 til -1
        maze[playerPostion.y][playerPostion.x] = 0; //gammle position. Ændre -1 til 0
    
    }else if (maze[playerPostion.y -1][playerPostion.x] == 2){
        toNewMaze();

    }else if (maze[playerPostion.y -1][playerPostion.x] == 3){
        livesScore();
        maze[playerPostion.y -1][playerPostion.x] = -1; 
        maze[playerPostion.y][playerPostion.x] = 0; 

    }else if (maze[playerPostion.y -1][playerPostion.x] == 4){
        pointScore();
        maze[playerPostion.y -1][playerPostion.x] = -1; 
        maze[playerPostion.y][playerPostion.x] = 0; 

    }else if (maze[playerPostion.y -1][playerPostion.x] == 5){
        helpedScore();
        maze[playerPostion.y -1][playerPostion.x] = -1; 
        maze[playerPostion.y][playerPostion.x] = 0; 
        
    };
};

function keyRight(){
    if (maze[playerPostion.y][playerPostion.x +1] == 0){ // hvis feltet i mazen er 0, så kan spiller gå på den 
        maze[playerPostion.y][playerPostion.x +1] = -1; //nye position. Ændre et 0 til -1
        maze[playerPostion.y][playerPostion.x] = 0; //gammle position. Ændre -1 til 0
    
    }else if (maze[playerPostion.y][playerPostion.x +1] == 2){
        toNewMaze();

    }else if (maze[playerPostion.y][playerPostion.x +1] == 3){
        livesScore();
        maze[playerPostion.y][playerPostion.x +1] = -1; 
        maze[playerPostion.y][playerPostion.x] = 0; 

    }else if (maze[playerPostion.y][playerPostion.x +1] == 4){
        pointScore();
        maze[playerPostion.y][playerPostion.x +1] = -1; 
        maze[playerPostion.y][playerPostion.x] = 0; 

    }else if (maze[playerPostion.y][playerPostion.x +1] == 5){
        helpedScore();
        maze[playerPostion.y][playerPostion.x +1] = -1; 
        maze[playerPostion.y][playerPostion.x] = 0; 

    };
};

function keyDown(){
    if (maze[playerPostion.y +1][playerPostion.x] == 0){ // hvis feltet i mazen er 0, så kan spiller gå på den 
        maze[playerPostion.y +1][playerPostion.x] = -1; //nye position. Ændre et 0 til -1
        maze[playerPostion.y][playerPostion.x] = 0; //gammle position. Ændre -1 til 0
    
    }else if (maze[playerPostion.y +1][playerPostion.x] == 2){
        toNewMaze();

    }else if (maze[playerPostion.y +1][playerPostion.x] == 3){
        livesScore();
        maze[playerPostion.y +1][playerPostion.x] = -1; 
        maze[playerPostion.y][playerPostion.x] = 0; 

    } else if (maze[playerPostion.y +1][playerPostion.x] == 4){
        pointScore();
        maze[playerPostion.y +1][playerPostion.x] = -1; 
        maze[playerPostion.y][playerPostion.x] = 0; 

    } else if (maze[playerPostion.y +1][playerPostion.x] == 5){
        helpedScore();
        maze[playerPostion.y +1][playerPostion.x] = -1; 
        maze[playerPostion.y][playerPostion.x] = 0; 
        
    };
};

//  - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

//Lytter på om der bliver klikket på knapper. Har en annonym funktion
window.addEventListener("keydown", function(event){
    //Switch som lytter til om der bliver klikket på piltasterne og udføre en funktion ud fra hvad der klikkes på
    switch(event.keyCode){
        case 37: //venstre
            keyLeft();
            grid();
            break;

        case 38: //up
            keyUp();
            grid();
            break;

        case 39: //højre
            keyRight();
            grid();
            break;

        case 40: //ned
            keyDown();
            grid();
            break;

        default: 
            break;
    };
});
