<?php
session_start();

if (!isset($_SESSION["player_hp"])) {
  $_SESSION["player_hp"] = 30;
  $_SESSION["enemy_hp"] = 25;
  $_SESSION["level"] = 1;
  $_SESSION["log"] = [];
}

function logmsg($m){
  $_SESSION["log"][] = $m;
  if(count($_SESSION["log"]) > 8) array_shift($_SESSION["log"]);
}

$action = $_GET["action"] ?? "none";

if ($action == "reset") {
  session_destroy();
  echo "Game reset. Refresh page.";
  exit;
}

if ($_SESSION["player_hp"] > 0 && $_SESSION["enemy_hp"] > 0) {

  if ($action == "attack") {
    $dmg = rand(3,7);
    $_SESSION["enemy_hp"] -= $dmg;
    logmsg("You attack for $dmg!");
  }

  if ($action == "heal") {
    $heal = rand(3,6);
    $_SESSION["player_hp"] += $heal;
    logmsg("You heal $heal HP.");
  }

  if ($action == "power") {
    $dmg = rand(5,12);
    $_SESSION["enemy_hp"] -= $dmg;
    $_SESSION["player_hp"] -= 3;
    logmsg("Power move hits for $dmg but costs 3 HP!");
  }

  if ($_SESSION["enemy_hp"] > 0) {
    $edmg = rand(2,6);
    $_SESSION["player_hp"] -= $edmg;
    logmsg("Enemy hits you for $edmg!");
  }

  if ($_SESSION["enemy_hp"] <= 0) {
    $_SESSION["level"]++;
    $_SESSION["enemy_hp"] = 20 + $_SESSION["level"] * 5;
    logmsg("You defeated the enemy! Level up!");
  }

}

echo "<h2>Level ".$_SESSION["level"]."</h2>";
echo "Player HP: ".$_SESSION["player_hp"]."<br>";
echo "Enemy HP: ".$_SESSION["enemy_hp"]."<hr>";

foreach($_SESSION["log"] as $l){
  echo $l."<br>";
}

if ($_SESSION["player_hp"] <= 0) {
  echo "<h3>YOU DIED</h3>";
  echo "Click reset.";
}
?>
