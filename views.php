<?php

if (isset($_POST['field_submit'])) {

    require_once("conn.php");

    $query = "SELECT * FROM WADE2010";

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
              <li><a href="views.php">DWade 2010</a></li>
							<li><a href="viewAnother.php">DWade 2017</a></li>
						</ul>
              
					</div>
		  </div>

    <h1> Guess D Wade's 2010 Season High in Points</h1>
    <form method="post">
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
                    <th style="width:30px">MIN</th>    
                    <th style="width:30px">FGM</th> 
                    <th style="width:30px">FGA</th>  
                    <th style="width:30px">FGP</th>    
                    <th style="width:30px">FG3M</th> 
                    <th style="width:30px">FG3A</th>          
                    <th style="width:30px">F3P</th>  
                    <th style="width:30px">FTM</th>  
                    <th style="width:30px">FTA</th>    
                    <th style="width:30px">FTP</th> 
                    <th style="width:30px">REB</th>          
                    <th style="width:30px">AST</th>     
                    <th style="width:30px">STL</th> 
                    <th style="width:30px">BLK</th>          
                    <th style="width:30px">TO</th>        
                    <th style="width:30px">PTS</th>          
                  </tr>
                </thead>
                 <!-- Create rest of the the body of the table -->
                <tbody>
                   <!-- For each row saved in the $result variable ... -->
                  <?php foreach ($result as $row) { ?>
                    <tr>
                      <td><?php echo $row["MIN"]; ?></td>
                      <td><?php echo $row["FGM"]; ?></td>
                      <td><?php echo $row["FGA"]; ?></td>
                      <td><?php echo $row["FGP"]; ?></td>
                      <td><?php echo $row["FG3M"]; ?></td>
                      <td><?php echo $row["FG3A"]; ?></td>
                      <td><?php echo $row["F3P"]; ?></td>
                      <td><?php echo $row["FTM"]; ?></td>
                      <td><?php echo $row["FTA"]; ?></td>
                      <td><?php echo $row["FTP"]; ?></td>
                      <td><?php echo $row["REB"]; ?></td>
                      <td><?php echo $row["AST"]; ?></td>
                      <td><?php echo $row["STL"]; ?></td>
                      <td><?php echo $row["BLK"]; ?></td>
                      <td><?php echo $row["TO"]; ?></td>
                      <td><?php echo $row["PTS"]; ?></td>
                      
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






