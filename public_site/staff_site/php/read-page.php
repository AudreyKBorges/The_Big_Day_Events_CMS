<?php
/** 
 * Audrey Borges
 * WEBD-325-45
 * Week 5 Project: Content Management of Pages
 * April 24, 2022
 *
 * Read page
 */

require_once 'db_connection.php';

// Get the record ID
$id=isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');
 
// Read the record data
try {
    // Prepare select query
    $query = "SELECT id, name, ref_name, position, visible, content FROM subjects WHERE id = ? LIMIT 0,1"; 
    $stmt = $con->prepare($query);
 
    $stmt->bindParam(1, $id);
 
    $stmt->execute();
 
    // Store retrieved row to a variable
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $name = $row['name'];
        $ref_name = $row['ref_name'];
        $position = $row['position'];
        $visible = $row['visible'];
        $content = $row['content'];
}
    
// Show error
catch (PDOException $exception) {
    die('ERROR: ' . $exception->getMessage());
}
?>
 
 <!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="Content-Style-Type" content="text/css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Big Day Events</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Barlow&display=swap" rel="stylesheet">
</head>

<body>
        <div class="grid-container">
          <nav class="backend-nav">
            <ul>
              <h3>The Big Day Events Website Builder</h3>
              <li><a href="menu.php">Menu</a></li>   
              <li><a href="">Log Out</a></li>   
            </ul>
          </nav>  
          <h2>Read Page</h2>
<!--This is where the record will be displayed-->
<table>
    <tr>
        <td>Name</td>
        <td><?php echo htmlspecialchars($name, ENT_QUOTES);  ?></td>
    </tr>
    <tr>
        <td>Reference Name</td>
        <td><?php echo htmlspecialchars($ref_name, ENT_QUOTES);  ?></td>
    </tr>
    <tr>
        <td>Position</td>
        <td><?php echo htmlspecialchars($position, ENT_QUOTES);  ?></td>
    </tr>
    <tr>
        <td>Visible</td>
        <td><?php echo htmlspecialchars($visible, ENT_QUOTES);  ?></td>
    </tr>
    <tr>
        <td>Content</td>
        <td><?php echo htmlspecialchars($content, ENT_QUOTES);  ?></td>
    </tr>
    <tr>
        <td></td>
        <td>
            <a href='manage_pages.php'>Back to manage pages</a>
        </td>
    </tr>
</table> 
        </div> 
 </body>
 </html>