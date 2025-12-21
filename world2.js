let world = [
  [1,1,1,1,1,1],
  [1,0,0,0,0,1],
  [1,0,0,0,0,1],
  [1,1,1,1,1,1]
];

function drawWorld(ctx) {
  for (let y = 0; y < world.length; y++) {
    for (let x = 0; x < world[y].length; x++) {
      if (world[y][x] === 1) {
        ctx.fillStyle = "#5c8a3c";
        ctx.fillRect(x * 40, y * 40, 40, 40);

        // fake 3D shadow
        ctx.fillStyle = "rgba(0,0,0,0.25)";
        ctx.fillRect(x * 40, y * 40 + 30, 40, 10);
      }
    }
  }
}
