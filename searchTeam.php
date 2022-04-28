<?php

if (isset($_POST['field_submit'])) {

    require_once("conn.php");

    $var_team_name = $_POST['team_name'];

    $query = "SELECT TEAM_ID, ABBREVIATION, CITY, `OWNER`, GENERALMANAGER, HEADCOACH, DLEAGUEAFFILIATION FROM teams_main WHERE TEAM_NICKNAME = :team_name";

    try
    {
      $prepared_stmt = $dbo->prepare($query);
      $prepared_stmt->bindValue(':team_name', $var_team_name, PDO::PARAM_STR);
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


    <h1> Search Team Information</h1>
    <form method="post">

    <label for="team_id">Name of Team</label>
      <input type="text" name="team_name" id="team_id"> 

      <!-- input type="text" name="field_director" id = "id_director" -->
      <!-- The input type is a submit button. Note the name and value. The value attribute decides what will be dispalyed on Button. In this case the button shows Submit.
      The name attribute is referred  on line 3 and line 61. -->
      <input type="submit" name="field_submit" value="Submit">
    </form>
    
    

    <?php
      if (isset($_POST['field_submit'])) {
        // If the query executed (result is true) and the row count returned from the query is greater than 0 then...
        if ($result && $prepared_stmt->rowCount() > 0) { ?>
              
              <h1> Team Information for the <?php echo $_POST['team_name']; ?> </h1>
              <table bordercolor="white" cellspacing="10" border="5">
                <!-- Create the first row of table as table head (thead). -->
                <thead>
                   <!-- The top row is table head with four columns named -- ID, Title ... -->
                  <tr>
                    <th style="width:100px">Team ID</th>     
                    <th style="width:100px">Abbreviation</th>     
                    <th style="width:500px">City</th>  
                    <th style="width:500px">Owner</th>          
                    <th style="width:500px">General Manager</th>    
                    <th style="width:500px">Head Coach</th> 
                    <th style="width:500px">DLeague Team</th>    
                  </tr>
                </thead>
                 <!-- Create rest of the the body of the table -->
                <tbody>
                   <!-- For each row saved in the $result variable ... -->
                  <?php foreach ($result as $row) { ?>
                    <tr>
                      <td><?php echo $row["TEAM_ID"]; ?></td>
                      <td><?php echo $row["ABBREVIATION"]; ?></td>
                      <td><?php echo $row["CITY"]; ?></td>
                      <td><?php echo $row["OWNER"]; ?></td>
                      <td><?php echo $row["GENERALMANAGER"]; ?></td>
                      <td><?php echo $row["HEADCOACH"]; ?></td>
                      <td><?php echo $row["DLEAGUEAFFILIATION"]; ?></td>
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







