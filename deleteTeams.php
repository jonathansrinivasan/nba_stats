<?php
if (isset($_POST['field_submit'])) {
    require_once("conn.php");

    $name = $_POST['field_title'];
    $query = "CALL delete_team(:pname)";
    
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
    
    <h1> Delete Team </h1>
    <form method="post">

      <label for="id_title">Name of Team</label>
      <input type="text" name="field_title" id="id_title">
      
      <input type="submit" name="field_submit" value="Delete Team">
    </form>

	<?php
      if (isset($_POST['field_submit'])) {
        if ($result) { 
    ?>
          Team was deleted successfully.
    <?php 
        } else { 
    ?>
          <h3> Sorry, there was an error. Team was not deleted. </h3>
    <?php 
        }
      } 
    ?>

  </body>
</html>






