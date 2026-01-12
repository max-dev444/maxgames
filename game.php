<?php
session_start();

if (!isset($_SESSION["hp"])) {
  $_SESSION["hp"] = 20;
  $_SESSION["room"] = 1;
  $_SESSION["gold"] = 0;
  $_SESSION["log"] = [];
}

function logmsg($m) {
  $_SESSION["log"][] = $m;
  if (count($_SESSION["log"]) > 10) array_shift($_SESSION["log"]);
}

if (isset($_GET["reset"])) {
  session_destroy();
  header("Location: php");
  exit;
}

$action = $_GET["a"] ?? "";

if ($action == "move") {
  $_SESSION["room"]++;
  logmsg("You enter room ".$_SESSION["room"]);

  if (rand(1,3)==1) {
    $dmg = rand(1,5);
    $_SESSION["hp"] -= $dmg;
    logmsg("A monster hits you for $dmg!");
  } else {
    $gold = rand(1,4);
    $_SESSION["gold"] += $gold;
    logmsg("You find $gold gold.");
  }
}

if ($action == "heal" && $_SESSION["gold"] >= 5) {
  $_SESSION["gold"] -= 5;
  $_SESSION["hp"] += 5;
  logmsg("You healed 5 HP.");
}

if ($_SESSION["hp"] <= 0) {
  echo "<h1>You died.</h1>";
  echo "<a href='?reset=1'>Restart</a>";
  exit;
}

echo "<h1>Dungeon of Rooms</h1>";
echo "HP: ".$_SESSION["hp"]." | Gold: ".$_SESSION["gold"]." | Room ".$_SESSION["room"];

echo "<br><br>";
echo "<a href='?a=move'>➡ Explore</a> ";
echo "<a href='?a=heal'>❤️ Heal (5 gold)</a> ";
echo "<a href='?reset=1'>🔁 Reset</a>";

echo "<hr>";
foreach ($_SESSION["log"] as $l) {
  echo $l."<br>";
}
?>
