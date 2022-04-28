<?php

if (isset($_POST['f_submit'])) {

    require_once("conn.php");

    $var_PLAYER_NAME = $_POST['PLAYER_NAME'];
    $var_TEAM_ID = $_POST['TEAM_ID'];
    $var_SEASON = $_POST['SEASON'];

    $query = "INSERT INTO players (PLAYER_NAME, TEAM_ID, PLAYER_SEASON) "
            . "VALUES (:PLAYER_NAME, :TEAM_ID, :SEASON)";

    try
    {
      $prepared_stmt = $dbo->prepare($query);
      $prepared_stmt->bindValue(':PLAYER_NAME', $var_PLAYER_NAME, PDO::PARAM_STR);
      $prepared_stmt->bindValue(':TEAM_ID', $var_TEAM_ID, PDO::PARAM_STR);
      $prepared_stmt->bindValue(':SEASON', $var_SEASON, PDO::PARAM_STR);
      $result = $prepared_stmt->execute();

    }
    catch (PDOException $ex)
    { // Error in database processing.
      echo $sql . "<br>" . $error->getMessage(); // HTTP 500 - Internal Server Error
    }
}

?>

<html>
  <!-- Any thing inside the HEAD tags are not visible on page.-->
  <head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<title>NBA STATS</title>
		<link href="http://fonts.googleapis.com/css?family=Ubuntu+Condensed" rel="stylesheet" type="text/css" />
		<link href="http://fonts.googleapis.com/css?family=Kreon" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" type="text/css" href="style.css" />
	</head>

	<body>
		<div id="wrapper">
			<div id="header">
				<div id="logo">
					<h1><a href="#">NBA STATS</a></h1>
				</div>
				<div id="menu">
					<ul>
						<li class=""><a href="index2.html">Home</a></li>
						<li><a href="searchTeam.php">Teams</a></li>
						<li><a href="players.php">Players</a></li>
						<li><a href="views.php">Fun Facts</a></li>
					</ul>
					<br class="clearfix" />
				</div>
			</div>

			<div id="sidebar2">
					<div class="box">
						<h2>Options</h2>
				<ul class="list">
              <li><a href="players.php">Career Stats</a></li>
              <li><a href="searchPlayers.php">Search</a></li>
			<li><a href="insertPlayers.php">Insert</a></li>
			<li><a href="deletePlayers.php">Delete</a></li>
              <li><a href="trackPlayers.php">Track Changes</a></li>

						</ul>
					</div>
		  </div>
	
	
	<h1> Insert Player</h1>

    <form method="post">
    	<label for="name">Player Name</label>
    	<input type="text" name="PLAYER_NAME" id="name"> 

    	<label for="team">Team ID</label>
    	<input type="text" name="TEAM_ID" id="team">

    	<label for="season">Season</label>
    	<input type="text" name="SEASON" id="season">
    	
    	<input type="submit" name="f_submit" value="Submit">
    </form>
    <?php
      if (isset($_POST['f_submit'])) {
        if ($result) { 
    ?>
          Player was inserted successfully.
    <?php 
        } else { 
    ?>
          <h3> Sorry, there was an error. Player was not inserted. </h3>
    <?php 
        }
      } 
    ?>
  </body>
</html>






