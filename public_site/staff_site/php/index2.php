<?php
/** 
 * Audrey Borges
 * WEBD-325-45
 * Week 4 Project: Content Management of Subjects
 * April 17, 2022
 *
 * Read subjects
 */

require_once 'db_connection.php';
 
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>Read Records</title>
</head>
<body>
    <div class="container">
 
        <div class="page-header">
            <h1>Read Subjects</h1>
        </div>
<?php
$action = isset($_GET['action']) ? $_GET['action'] : "";
 
// If redirected from delete.php
if ($action == 'deleted') {
    echo "<div>Record was deleted.</div>";
} 

// Select all data
$query = "SELECT id, name, ref_name, position, visible, content FROM subjects ORDER BY id DESC";
$stmt = $con->prepare($query);
$stmt->execute();

$num = $stmt->rowCount();
 
// Create record form
echo "<a href='create.php'>Create New Subject</a>";
 
if ($num > 0) {
 
    echo "<table>";
 
    // Table heading
    echo "<tr>
        <th>ID</th>
        <th>Name</th>
        <th>Reference Name</th>
        <th>Position</th>
        <th>Visible</th>
        <th>Content</th>
    </tr>";
 
// Retrieve table contents
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    extract($row);
 
    echo "<tr>
        <td>{$id}</td>
        <td>{$name}</td>
        <td>{$ref_name}</td>
        <td>${$position}</td>
        <td>${$visible}</td>
        <td>${$content}</td>
        <td>";
            // read one record
            echo "<a href='read_one.php?id={$id}'>Read</a>";
 
            echo "<a href='update.php?id={$id}'>Edit</a>";
            
            echo "<a href='#' onclick='delete_user({$id});'>Delete</a>";
        echo "</td>";
    echo "</tr>";
}
 
echo "</table>";
 
}
else {
    echo "<div>No records found.</div>";
}
?>
 
</div>

<script type='text/javascript'>

// Record deletion
function delete_user(id) {
 
    var answer = confirm('Are you sure?');
    if (answer){
        // If user clicked ok, pass the id to delete.php and execute the delete query
        window.location = 'delete.php?id=' + id;
    }
}
</script> 
</body>
</html>