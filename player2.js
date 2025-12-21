let player = {
  x: 5,
  y: 5
};

function drawPlayer(ctx) {
  ctx.fillStyle = "red";
  ctx.fillRect(player.x * 40, player.y * 40, 40, 40);
}
