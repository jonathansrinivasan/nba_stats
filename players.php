<?php
// If the all the variables are set when the Submit button is clicked...
if (isset($_POST['field_submit'])) {
    require_once("conn.php");

    $name = $_POST['name'];
    $query = "CALL player_ave_stats(:pname)";
    
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
    <!-- See the project.css file to note h1 (Heading 1) is stylized.-->

    <h1>Search Player's Career Stats</h1>
    
    <form method="post">

      <label for="id_director">Name</label>
      <!-- The input type is a text field. Note the name and id. The name attribute
        is referred above on line 7. $var_director = $_POST['field_director']; id attribute is referred in label tag above on line 52-->
      <input type="text" name="name" id = "id_director">
      <!-- The input type is a submit button. Note the name and value. The value attribute decides what will be dispalyed on Button. In this case the button shows Submit.
      The name attribute is referred  on line 3 and line 61. -->
      <input type="submit" name="field_submit" value="Submit">
    </form>
    
    <?php
      if (isset($_POST['field_submit'])) {
        // If the query executed (result is true) and the row count returned from the query is greater than 0 then...
        if ($result && $prepared_stmt->rowCount() > 0) { ?>
              <!-- first show the header RESULT -->
              <!-- THen create a table like structure. See the project.css how table is stylized. -->
              
              <h1> Career Stats for <?php echo $_POST['name']; ?> </h1>

              <table bordercolor="white" cellspacing="10" border="5">
                <!-- Create the first row of table as table head (thead). -->
                <thead>
                   <!-- The top row is table head with four columns named -- ID, Title ... -->
                  <tr>
                    <th style="width:50px" style="text-align:center">Season</th>
                    <th style="width:50px" style="text-align:center">Team</th>
                    <th style="width:20px" style="text-align:center">MP</th>
                    <th style="width:20px" style="text-align:center">FGM</th>
                    <th style="width:20px" style="text-align:center">FGA</th>
                    <th style="width:20px" style="text-align:center">FG%</th>
                    <th style="width:20px" style="text-align:center">3PM</th>
                    <th style="width:20px" style="text-align:center">3PA</th>
                    <th style="width:20px" style="text-align:center">3P%</th>
                    <th style="width:20px" style="text-align:center">FTM</th>
                    <th style="width:20px" style="text-align:center">FTA</th>
                    <th style="width:20px" style="text-align:center">FT%</th>
                    <th style="width:20px" style="text-align:center">AST</th>
                    <th style="width:20px" style="text-align:center">STL</th>
                    <th style="width:20px" style="text-align:center">BLK</th>
                    <th style="width:20px" style="text-align:center">OT</th>
                    <th style="width:20px" style="text-align:center">PTS</th>
                    <th style="width:20px" style="text-align:center">+/-</th>

                  
                  </tr>
                </thead>
                 <!-- Create rest of the the body of the table -->
                <tbody>
                   <!-- For each row saved in the $result variable ... -->
                  <?php foreach ($result as $row) { ?>
                    <tr>
                       <!-- Print (echo) the value of mID in first column of table -->
                      <td style="width:50px" style="text-align:center"><?php echo $row["SEASON"]; ?></td>
                      <td style="width:50px" style="text-align:center"><?php echo $row["ABBREVIATION"]; ?></td>
                      <td style="width:20px" style="text-align:center"><?php echo $row["Minutes_played"]; ?></td>
                      <td style="width:20px" style="text-align:center"><?php echo $row["Field_Goals_Made"]; ?></td>
                      <td><?php echo $row["Field_Goal_Attempted"]; ?></td>
                      <td><?php echo $row["Field_Goal_Percentage"]; ?></td>
                      <td><?php echo $row["Three_Pointers_Made"]; ?></td>
                      <td><?php echo $row["Three_Pointers_Attempted"]; ?></td>
                      <td><?php echo $row["Three_Pointers_Percentage"]; ?></td>
                      <td><?php echo $row["Free_Throws_Made"]; ?></td>
                      <td><?php echo $row["Free_Throws_Attempted"]; ?></td>
                      <td><?php echo $row["Free_Throw_Percentage"]; ?></td>
                      <td><?php echo $row["Assists"]; ?></td>
                      <td><?php echo $row["Steals"]; ?></td>
                      <td><?php echo $row["Blocked_shots"]; ?></td>
                      <td><?php echo $row["Turnovers"]; ?></td>
                      <td><?php echo $row["points_scored"]; ?></td>
                      <td><?php echo $row["plus_minus"]; ?></td>
                      <!-- Print (echo) the value of title in second column of table -->
                    <!-- End first row. Note this will repeat for each row in the $result variable-->
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






