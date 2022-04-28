<?php

if (isset($_POST['field_submit'])) {

    require_once("conn.php");

    $query = "SELECT TEAM_NICKNAME, ABBREVIATION, Number_of_games_played, Number_of_winning_games, Number_of_Loosing_games, Win_Percent, HOME_RECORD, ROAD_RECORD FROM WADE2017";

    try
    {
      $prepared_stmt = $dbo->prepare($query);
      $result = $prepared_stmt->execute();
      $result = $prepared_stmt->fetchAll();

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
              <li><a href="views.php">DWade 2010</a></li>
							<li><a href="viewAnother.php">DWade 2017</a></li>
						</ul>
              
					</div>
		  </div>

    <h1> Guess D Wade's Better Team in 2017</h1>
    <form method="post">
      <input type="submit" name="field_submit" value="Submit">
    </form>

    <?php
      if (isset($_POST['field_submit'])) {
        // If the query executed (result is true) and the row count returned from the query is greater than 0 then...
        if ($result) { ?>

              <table bordercolor="white" cellspacing="10" border="5">
                <!-- Create the first row of table as table head (thead). -->
                <thead>
                   <!-- The top row is table head with four columns named -- ID, Title ... -->
                  <tr>
                    <th style="width:30px">Team Name</th>    
                    <th style="width:30px">Abbreviation</th> 
                    <th style="width:30px">GP</th>  
                    <th style="width:30px">W</th>    
                    <th style="width:30px">L</th> 
                    <th style="width:30px">Win Percentage</th>          
                    <th style="width:30px">Home Record</th>  
                    <th style="width:30px">Road Record</th>           
                  </tr>
                </thead>
                 <!-- Create rest of the the body of the table -->
                <tbody>
                   <!-- For each row saved in the $result variable ... -->
                  <?php foreach ($result as $row) { ?>
                    <tr>
                      <td><?php echo $row["TEAM_NICKNAME"]; ?></td>
                      <td><?php echo $row["ABBREVIATION"]; ?></td>
                      <td><?php echo $row["Number_of_games_played"]; ?></td>
                      <td><?php echo $row["Number_of_winning_games"]; ?></td>
                      <td><?php echo $row["Number_of_Loosing_games"]; ?></td>
                      <td><?php echo $row["Win_Percent"]; ?></td>
                      <td><?php echo $row["HOME_RECORD"]; ?></td>
                      <td><?php echo $row["ROAD_RECORD"]; ?></td>      
                    </tr>
                  <?php } ?>
                  <!-- End table body -->
                </tbody>
                <!-- End table -->
            </table>
  
        <?php } else { ?>
          <!-- IF query execution resulted in error display the following message-->
          <h3>Sorry, no results found. </h3>
        <?php }
    } ?>


    
  </body>
</html>






