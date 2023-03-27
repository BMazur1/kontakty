const svgns = "http://www.w3.org/2000/svg";
const gameArea = document.getElementById("game-area");
const addBallButton = document.getElementById("add-ball");
const startStopButton = document.getElementById("start-stop");

let balls = [];
let isRunning = false;


class Ball {
  constructor(x, y, vx, vy) {
    this.x = x;
    this.y = y;
    this.vx = vx;
    this.vy = vy;
    this.circle = document.createElementNS(svgns, "circle");
    this.circle.setAttributeNS(null, "cx", x);
    this.circle.setAttributeNS(null, "cy", y);
    this.circle.setAttributeNS(null, "r", 20);
    this.circle.setAttributeNS(null, "fill", "red");
    gameArea.appendChild(this.circle);
  }

  update() {
    this.x += this.vx
    this.y += this.vy
    this.vy += 0.1
    
    if (this.x < 20){
      this.vx = -this.vx
      this.x = 20
    }
    if (this.x > 480){
      this.vx = -this.vx
      this.x = 480
    }
    if (this.y < 20){
      this.vy = -this.vy
      this.y = 20
    }
    if (this.y > 480){
      this.vy = -this.vy
      this.y = 480

    }
    for (let i = 0; i < balls.length; i++) {
      if (balls[i] !== this) {
        const dx = this.x - balls[i].x
        const dy = this.y - balls[i].y
        const distance = Math.sqrt(dx * dx + dy * dy)
        if (distance < 40 && this.vx * dx + this.vy * dy < 0) {
          if (dx < 40){
            this.vy = -(this.vy - 0.1) 
          }
          if (dy < 40){
            this.vx = - (this.vx - 0.1)
          }

        }
        
      }
    }
    this.circle.setAttributeNS(null, "cx", this.x)
    this.circle.setAttributeNS(null, "cy", this.y)  
  };
}

function addBall() {
  const ball = new Ball(Math.random() * 460 + 20, Math.random() * 460 + 20, Math.random() * 5 - 2.5, Math.random() * 5 - 2.5);
  balls.push(ball);
}

function startGame() {
  isRunning = true;
  startStopButton.textContent = "Stop";
  gameLoop();
}

function stopGame() {
  isRunning = false;
  startStopButton.textContent = "Start";
}

function gameLoop() {
  if (!isRunning) {
    return;
  }
  for (let i = 0; i < balls.length; i++) {
    balls[i].update();
  }
  requestAnimationFrame(gameLoop);
}

addBallButton.addEventListener("click", addBall);
startStopButton.addEventListener("click", function () {
  if (isRunning) {
    stopGame();
  } else {
    startGame();
  }
});