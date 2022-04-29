<?php
/** 
 * Audrey Borges
 * WEBD-325-45
 * Week 5 Project: Content Management of Pages
 * April 24, 2022
 *
 * Update/edit page
 */

require_once 'db_connection.php';

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
          <form class="page-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id}");?>" method="post">

            <h2>Edit Page</h2>
            <div>
              <label for="name">Page name: </label>
                <input required type="text" id="page_name" name="page_name" value="<?php echo htmlspecialchars($name, ENT_QUOTES);  ?>" required><br></br>
            </div>
            <div>
              <label for="name">Reference name for URL: </label>
                <input required type="text" id="ref_name" name="ref_name" value="<?php echo htmlspecialchars($ref_name, ENT_QUOTES);  ?>" required><br></br>
            </div>
            <div>
            <label for="dropdown">Position: </label>
            <td><input type='text' name='position' value="<?php echo htmlspecialchars($position, ENT_QUOTES);  ?>" class='form-control' /></td>
            <select type="dropdown" id="dropdown" name="dropdown">
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
            </select><br></br>
          </div>
          <div>
          <label>Visible: </label>
            <input type="radio" id="yes" name="visible" value="yes" value="<?php echo htmlspecialchars($visible, ENT_QUOTES);  ?>">
            <label for="yes">Yes</label>
            <input type="radio" id="no" name="visible" value="no">
            <label for="no">No</label><br></br>
          </div>
          <div>
            <label for="text"value="<?php echo htmlspecialchars($content, ENT_QUOTES);  ?>">Content: </label>
            <textarea id="text" name="text" rows="4" cols="50"></textarea>
          </div><br></br>
          <button href="update-page.php" class="update">Update Page</button>
          <a href="delete-page.php">Delete Page</a>
          </form>
    </div>
</body>
</html>