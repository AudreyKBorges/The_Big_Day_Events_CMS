<?php
/** 
 * Audrey Borges
 * WEBD-325-45
 * Week 4 Project: Content Management of Subjects
 * April 17, 2022
 *
 * Update the subjects
 */

require_once 'db_connection.php';
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>Update a Record</title>
</head>
<body>
    <div class="container">
 
        <div class="page-header">
            <h1>Update Subject</h1>
        </div>
 
<?php
// Get the record ID
$id=isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');
 
// Read the current record
try {
    // Prepare select query
    $query = "SELECT id, name, ref_name, position, visible, content FROM subjects WHERE id = ? LIMIT 0,1";
    $stmt = $con->prepare($query);
 
    $stmt->bindParam(1, $id);
 
    $stmt->execute();
 
    // Store retrieved row to a variable
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
    // Form values
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

// Check if form was submitted
if ($_POST) {
 
    try {
        // Update query
        $query = "UPDATE subjects
                    SET name=:name, ref_name=:ref_name, position=:position, visible=:visible, content=:content
                    WHERE id = :id";
 
        // Prepare query for excecution
        $stmt = $con->prepare($query);
 
        // Posted values
        $name=htmlspecialchars(strip_tags($_POST['name']));
        $ref_name=htmlspecialchars(strip_tags($_POST['ref_name']));
        $position=htmlspecialchars(strip_tags($_POST['position']));
        $visible=htmlspecialchars(strip_tags($_POST['visible']));
        $content=htmlspecialchars(strip_tags($_POST['content']));
 
        // Bind the parameters
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':ref_name', $ref_name);
        $stmt->bindParam(':position', $position);
        $stmt->bindParam(':visible', $visible);
        $stmt->bindParam(':content', $content);
[
            // Execute the query
            if ($stmt->execute()) {
                echo "<div>Record was updated.</div>";
            } else {
                echo "<div>Unable to update record. Please try again.</div>";
            }
        
        }
        
        // show errors
        catch (PDOException $exception) {
            die('ERROR: ' . $exception->getMessage());
        }
    }]
?>
 
 <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id}");?>" method="post">
    <table>
        <tr>
            <td>Name</td>
            <td><input type='text' name='name' value="<?php echo htmlspecialchars($name, ENT_QUOTES);  ?>" class='form-control' /></td>
        </tr>
        <tr>
            <td>Reference Name</td>
            <td><input type='text' name='ref_name' class='form-control' value="<?php echo htmlspecialchars($ref_name, ENT_QUOTES);  ?>"/></td>
        </tr>
        <tr>
            <td>Position</td>
            <td><input type='text' name='position' value="<?php echo htmlspecialchars($position, ENT_QUOTES);  ?>" class='form-control' /></td>
        </tr>
        <tr>
            <td>Visible</td>
            <td><input type='text' name='visible' value="<?php echo htmlspecialchars($visible, ENT_QUOTES);  ?>" class='form-control' /></td>
        </tr>
        <tr>
            <td>Content</td>
            <td><textarea type='text' name='content' value="<?php echo htmlspecialchars($content, ENT_QUOTES);  ?>" class='form-control'></textarea></td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type='submit' value='Save Changes'/>
                <a href='index2.php'>Back to read subjects</a>
            </td>
        </tr>
    </table>
</form> 
    </div>
</body>
</html>
