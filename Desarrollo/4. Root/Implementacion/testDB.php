<?php
// Get a connection for the database
require_once('./coneccion.php');

// Create a query for the database
$query = "SELECT email, password FROM users";

// Get a response from the database by sending the connection
// and the query
$response = @mysqli_query($dbc, $query);

// If the query executed properly proceed
if($response){

echo '<table align="left"
cellspacing="5" cellpadding="8">

<tr><td align="left"><b>email</b></td>
<td align="left"><b>password</b></td></tr>';

// mysqli_fetch_array will return a row of data from the query
// until no further data is available
while($row = mysqli_fetch_array($response)){
//3
echo '<tr><td align="left">' . 
$row['email'] . '</td><td align="left">' . 
$row['password'] . '</td><td align="left">';

echo '</tr>';
}

echo '</table>';

} else {

echo "Couldn't issue database query<br />";

echo mysqli_error($dbc);

}

// Close connection to the database
mysqli_close($dbc);
