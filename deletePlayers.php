<?php
// If the all the variables are set when the Submit button is clicked...
if (isset($_POST['field_submit'])) {
    require_once("conn.php");

    $name = $_POST['name'];
    $query = "DELETE FROM players WHERE PLAYER_NAME = :pname";
    
    try
    {
      $prepared_stmt = $dbo->prepare($query);
      $prepared_stmt->bindValue(':pname', $name, PDO::PARAM_STR);
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

    <h1>Delete Player</h1>
    
    <form method="post">

      <label for="id_director">Name</label>
      <!-- The input type is a text field. Note the name and id. The name attribute
        is referred above on line 7. $var_director = $_POST['field_director']; id attribute is referred in label tag above on line 52-->
      <input type="text" name="name" id = "id_director">
  
      <input type="submit" name="field_submit" value="Submit">
    </form>
    
    <?php
      if (isset($_POST['field_submit'])) {
        if ($result) { 
    ?>
          Player was deleted successfully.
    <?php 
        } else { 
    ?>
          <h3> Sorry, there was an error. Player was not deleted. </h3>
    <?php 
        }
      } 
    ?>

  </body>
</html>






