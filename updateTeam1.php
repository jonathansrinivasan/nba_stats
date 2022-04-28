<?php

if (isset($_POST['f_submit'])) {

    require_once("conn.php");

    $var_TEAM_NICKNAME = $_POST['TEAM_NICKNAME'];
    $var_ABBREVIATION = $_POST['ABBREVIATION'];
    $var_CITY = $_POST['CITY'];
    $var_OWNER = $_POST['OWNER'];
    $var_GENERALMANAGER = $_POST['GENERALMANAGER'];
    $var_HEADCOACH = $_POST['HEADCOACH'];
    $var_DLEAGUEAFFILIATION = $_POST['DLEAGUEAFFILIATION'];

    $query = "UPDATE teams_main SET ABBREVIATION = :_ABBREVIATION, CITY = :_CITY, `OWNER` = :_OWNER, GENERALMANAGER = :_GENERALMANAGER, HEADCOACH = :_HEADCOACH, DLEAGUEAFFILIATION = :_DLEAGUEAFFILIATION WHERE TEAM_NICKNAME = :_TEAM_NICKNAME";

    try
    {
      $prepared_stmt = $dbo->prepare($query);
      $prepared_stmt->bindValue(':_TEAM_NICKNAME', $var_TEAM_NICKNAME, PDO::PARAM_STR);
      $prepared_stmt->bindValue(':_ABBREVIATION', $var_ABBREVIATION, PDO::PARAM_STR);
      $prepared_stmt->bindValue(':_CITY', $var_CITY, PDO::PARAM_STR);
      $prepared_stmt->bindValue(':_OWNER', $var_OWNER, PDO::PARAM_STR);
      $prepared_stmt->bindValue(':_GENERALMANAGER', $var_GENERALMANAGER, PDO::PARAM_STR);
      $prepared_stmt->bindValue(':_HEADCOACH', $var_HEADCOACH, PDO::PARAM_STR);
      $prepared_stmt->bindValue(':_DLEAGUEAFFILIATION', $var_DLEAGUEAFFILIATION, PDO::PARAM_STR);
      $result = $prepared_stmt->execute();

    }
    catch (PDOException $ex)
    { // Error in database processing.
      echo $sql . "<br>" . $error->getMessage(); // HTTP 500 - Internal Server Error
    }
}

?>

<html>
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
						<p>
						</p>
						<ul class="list">
              <li><a href="league.php">Record</a></li>
							<li><a href="roster.php">Roster</a></li>
              <li><a href="searchTeam.php">Search</a></li>
							<li><a href="insertTeam.php">Insert</a></li>
							<li><a href="deleteTeams.php">Delete</a></li>
              <li><a href="updateTeam1.php">Update</a></li>
              <li><a href="trackTeam.php">Track Changes</a></li>
						</ul>
              
					</div>
		  </div>



<h1>Update Team </h1>

<div class="box">
    <form style = "width" method="post">

      <label for="id_name">Team Name</label>
    	<input type="text" name="TEAM_NICKNAME" id="id_name">

    	<label for="id_abbreviation">Abbreviation</label>
    	<input type="text" name="ABBREVIATION" id="id_abbreviation">


      <label for="id_city">City</label>
    	<input type="text" name="CITY" id="id_city"> 


    	<label for="id_owner">Owner</label>
    	<input type="text" name="OWNER" id="id_owner">

      <label for="id_genman">General Manager</label>
    	<input type="text" name="GENERALMANAGER" id="id_genman">

    	<label for="id_HD">Head Coach</label>
    	<input type="text" name="HEADCOACH" id="id_HD">

      <label for="id_dl">D League Affiliation</label>
    	<input type="text" name="DLEAGUEAFFILIATION" id="id_dl">
    	
    	<input type="submit" name="f_submit" value="Submit">
    </form>
	</div>

    <?php
      if (isset($_POST['f_submit'])) {
        if ($result) { 
    ?>
          Team was updated successfully.
    <?php 
        } else { 
    ?>
          <h3> Sorry, there was an error. Update was incomplete. </h3>
    <?php 
        }
      } 
    ?>
    
  </body>
</html>