document.addEventListener("keydown", e => {
  if (e.key === "w") player.y--;
  if (e.key === "s") player.y++;
  if (e.key === "a") player.x--;
  if (e.key === "d") player.x++;
});

document.addEventListener("click", e => {
  const x = Math.floor(e.clientX / 40);
  const y = Math.floor(e.clientY / 40);

  if (world[y] && world[y][x] !== undefined) {
    world[y][x] = world[y][x] === 1 ? 0 : 1;
  }
});
