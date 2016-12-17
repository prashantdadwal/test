<?php
$con = mysqli_connect("localhost", "root","","team");
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$sql = "SELECT users.id, concat(users.first_name, ' ', users.last_name) Name, GROUP_CONCAT(teams.name SEPARATOR ', ') Teams FROM teams_users left join teams on teams.id=teams_users.team_id left join users on users.id=teams_users.user_id GROUP by users.id";
$result = mysqli_query($con,$sql);
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
 <head>
  <title> Test </title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
  </title>
 </head>
 <body>
 <div class="container"> 

<?php
// Fetch all
//mysqli_fetch_all($result,MYSQLI_ASSOC);
echo '<table class="table">';
echo '<thead> <tr> <th>id</th> <th>Name</th> <th>Teams</th> </tr> </thead>';
echo '<tbody>';

while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

 echo '<tr> 
	<td scope="row">'.$row['id'].'</td> 
	<td>'.$row['Name'].'</td> 
	<td>'.$row['Teams'].'</td>
	</tr>';

}

echo '</tbody>';
echo '</table>';

mysqli_free_result($result);
mysqli_close($con);
?>
</div>
</body>
</html>