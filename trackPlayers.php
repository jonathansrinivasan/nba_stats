<?php

if (isset($_POST['field_submit'])) {

    require_once("conn.php");
    $query = "SELECT * FROM players_changes";

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
              <li><a href="players.php">Career Stats</a></li>
              <li><a href="searchPlayers.php">Search</a></li>
							<li><a href="insertPlayers.php">Insert</a></li>
							<li><a href="deletePlayers.php">Delete</a></li>
              <li><a href="trackPlayers.php">Track Changes</a></li>

						</ul>
					</div>
		  </div>
    


    <h1>Track Changes</h1>
    <form method="post">

    <label for="field_submit">Show Changes</label>

      <!-- input type="text" name="field_director" id = "id_director" -->
      <!-- The input type is a submit button. Note the name and value. The value attribute decides what will be dispalyed on Button. In this case the button shows Submit.
      The name attribute is referred  on line 3 and line 61. -->
      <input type="submit" name="field_submit" value="Submit">
    </form>
    
    

    <?php
      if (isset($_POST['field_submit'])) {
        // If the query executed (result is true) and the row count returned from the query is greater than 0 then...
        if ($result && $prepared_stmt->rowCount() > 0) { ?>
              
              <table bordercolor="white" cellspacing="10" border="5">
                <!-- Create the first row of table as table head (thead). -->
                <thead>
                   <!-- The top row is table head with four columns named -- ID, Title ... -->
                  <tr>
                    <th style="width:100px">Record Code</th>     
                    <th style="width:100px">Player Inserted</th>     
                    <th style="width:500px">Player Deleted</th>  
                    <th style="width:500px">Player Updated</th>          
                    <th style="width:500px">Date</th>    
                    <th style="width:500px">Manipulation Type</th> 
                  </tr>
                </thead>
                 <!-- Create rest of the the body of the table -->
                <tbody>
                   <!-- For each row saved in the $result variable ... -->
                  <?php foreach ($result as $row) { ?>
                    <tr>
                      <td><?php echo $row["record_code"]; ?></td>
                      <td><?php echo $row["player_inserted"]; ?></td>
                      <td><?php echo $row["player_deleted"]; ?></td>
                      <td><?php echo $row["player_updated"]; ?></td>
                      <td><?php echo $row["date_insert"]; ?></td>
                      <td><?php echo $row["revision_type"]; ?></td>
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







