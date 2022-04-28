<?php
// If the all the variables are set when the Submit button is clicked...
if (isset($_POST['f_submit'])) {
    require_once("conn.php");

    $name = $_POST['name'];
    $query = "SELECT p.PLAYER_SEASON, t.ABBREVIATION FROM players p, teams_main t WHERE p.PLAYER_NAME = :pname AND p.TEAM_ID = t.TEAM_ID";
    
    try
    {
      $prepared_stmt = $dbo->prepare($query);
      $prepared_stmt->bindValue(':pname', $name, PDO::PARAM_STR);
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
    <!-- See the project.css file to note h1 (Heading 1) is stylized.-->


      <div id="sidebar2">
					<div class="box">
						<h2>Options</h2>
						<p>
						</p>
						<ul class="list">
              <li><a href="players.php">Career Stats</a></li>
              <li><a href="searchPlayers.php">Search</a></li>
							<li><a href="insertPlayers.php">Insert</a></li>
							<li><a href="deletePlayers.php">Delete</a></li>
              <li><a href="trackPlayers.php">Track Changes</a></li>

						</ul>
					</div>
		  </div>
    
    
    <h1>Search Player</h1>
    
    <form method="post">
    	<label for="pname">Player Name</label>
    	<input type="text" name="name" id="pname"> 
    	
    	<input type="submit" name="f_submit" value="Submit">
    </form>
    
    <?php
      if (isset($_POST['f_submit'])) {
        // If the query executed (result is true) and the row count returned from the query is greater than 0 then...
        if ($result) { ?>
            
              <h1> <?php echo $_POST['name']; ?>'s Career </h1>

              <table bordercolor="white" cellspacing="10" border="5">
                <thead>
                  <tr>
                    <th style="width:50px" style="text-align:center">Team</th>
                    <th style="width:50px" style="text-align:center">Season</th>
                  </tr>
                </thead>
                 <!-- Create rest of the the body of the table -->
                <tbody>
                   <!-- For each row saved in the $result variable ... -->
                  <?php foreach ($result as $row) { ?>
                    <tr>
                      <td style="width:50px" style="text-align:center"><?php echo $row["ABBREVIATION"]; ?></td>
                      <td style="width:50px" style="text-align:center"><?php echo $row["PLAYER_SEASON"]; ?></td>
                    </tr>
                  <?php } ?>
                  <!-- End table body -->
                </tbody>
                <!-- End table -->
            </table>
  
        <?php } else { ?>
          <!-- IF query execution resulted in error display the following message-->
          <h3>Sorry, no results found for <?php echo $_POST['name']; ?> </h3>
        <?php }
    } ?>




    
  </body>
</html>






