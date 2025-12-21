const canvas = document.getElementById("game");
const ctx = canvas.getContext("2d");

canvas.width = window.innerWidth;
canvas.height = window.innerHeight;

function loop() {
  ctx.clearRect(0, 0, canvas.width, canvas.height);
  drawWorld(ctx);
  drawPlayer(ctx);
  requestAnimationFrame(loop);
}

loop();
