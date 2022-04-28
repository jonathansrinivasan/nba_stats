<?php

if (isset($_POST['field_submit'])) {

    require_once("conn.php");

    $var_team_name = $_POST['team_name'];
    $var_team_year = $_POST['team_year'];

    $query = "CALL get_teams_stats(:team_year, :team_name)";

    try
    {
      $prepared_stmt = $dbo->prepare($query);
      $prepared_stmt->bindValue(':team_name', $var_team_name, PDO::PARAM_STR);
      $prepared_stmt->bindValue(':team_year', $var_team_year, PDO::PARAM_STR);
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
						<li><a href="searchPlayers.php">Players</a></li>
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

    <h1> Search Team Stats by Year</h1>
    <form method="post">

    <label for="team_id">Name of Team</label>
      <input type="text" name="team_name" id="team_id">

      <label for="team_id">Year</label>
      <select name="team_year" id="team_id">  
          <option value="22021">2021</option>  
          <option value="22020">2020</option>  
          <option value="22019">2019</option>  
          <option value="22018">2018</option>  
          <option value="22017">2017</option>  
          <option value="22016">2016</option>  
          <option value="22015">2015</option>  
          <option value="22014">2014</option>  
          <option value="22013">2013</option>  
          <option value="22012">2012</option>  
          <option value="22011">2011</option>  
          <option value="22010">2010</option>  
          <option value="22009">2009</option>  
          <option value="22008">2008</option>  
          <option value="22007">2007</option>  
          <option value="22006">2006</option>  
          <option value="22005">2005</option>  
          <option value="22004">2004</option>  
          <option value="22003">2003</option>  
          <option value="22002">2002</option>  
      </select> 

      <input type="submit" name="field_submit" value="Submit">
    </form>
  

    <?php
      if (isset($_POST['field_submit'])) {
        // If the query executed (result is true) and the row count returned from the query is greater than 0 then...
        if ($result) { ?>

              <h1>Team Stats For <?php echo $_POST['team_year']; ?> <?php echo $_POST['team_name']; ?> </h1>

              <table bordercolor="white" cellspacing="10" border="5">
                <!-- Create the first row of table as table head (thead). -->
                <thead>
                   <!-- The top row is table head with four columns named -- ID, Title ... -->
                  <tr>
                    <th style="width:50px">Season</th>    
                    <th style="width:20px">GP</th> 
                    <th style="width:20px">W</th>  
                    <th style="width:20px">L</th>    
                    <th style="width:20px">Win Percentage</th> 
                    <th style="width:50px">Home Record</th>          
                    <th style="width:50px">Road Record</th>                    
                  </tr>
                </thead>
                 <!-- Create rest of the the body of the table -->
                <tbody>
                   <!-- For each row saved in the $result variable ... -->
                  <?php foreach ($result as $row) { ?>
                    <tr>
                      <td><?php echo $row["SEASON"]; ?></td>
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
          <h3>Sorry, no results found for  <?php echo $_POST['team_year']; ?> <?php echo $_POST['team_name']; ?>. </h3>
        <?php }
    } ?>


    
  </body>
</html>






