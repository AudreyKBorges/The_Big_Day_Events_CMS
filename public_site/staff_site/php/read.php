<?php
/** 
 * Audrey Borges
 * WEBD-325-45
 * Week 4 Project: Content Management of Subjects
 * April 17, 2022
 *
 * Read one subject
 */

require_once 'db_connection.php';
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Read Record</title>
</head>
<body>
 
    <div class="container">
 
        <div class="page-header">
            <h1>Read Subject</h1>
        </div>
        
<?php
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
            <a href='index2.php'>Back to read subjects</a>
        </td>
    </tr>
</table> 
        </div> 
 </body>
 </html>