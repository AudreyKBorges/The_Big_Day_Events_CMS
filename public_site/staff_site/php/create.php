<?php
/** 
 * Audrey Borges
 * WEBD-325-45
 * Week 4 Project: Content Management of Subjects
 * April 17, 2022
 *
 * Create subject
 */

if ($_POST) {
 
    include_once 'db_connection.php';
 
    try {
 
        // Insert query
        $query = "INSERT INTO subjects SET name=:name, ref_name=:ref_name, position=:position, visible=:visible, content=:content, created=:created";
 
        // Prepare query for execution
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

        // Specify when this record was inserted to the database
        $created=date('Y-m-d H:i:s');
        $stmt->bindParam(':created', $created);
 
        // Execute the query
        if ($stmt->execute()) {
            echo "<div>Record was saved.</div>";
        } else {
            echo "<div>Unable to save record.</div>";
        }
 
    }
 
    // Show error
    catch(PDOException $exception){
        die('ERROR: ' . $exception->getMessage());
    }
}
?>

<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="Content-Style-Type" content="text/css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Subject</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Barlow&display=swap" rel="stylesheet">
</head>
<body>

</body>
</html>


<div class="grid-container">
          <nav class="backend-nav">
            <ul>
              <h3>The Big Day Events Website Builder</h3>
              <li><a href="menu.php">Menu</a></li>   
              <li><a href="">Log Out</a></li>   
            </ul>
          </nav>  
          <form class="page-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            <h2>Create Subject</h2>
            <div>
              <label for="name">Page name: </label>
                <input required type="text" id="page_name" name="page_name" required><br></br>
            </div>
            <div>
              <label for="name">Reference name for URL: </label>
                <input required type="text" id="ref_name" name="ref_name" required><br></br>
            </div>
            <div>
            <label for="dropdown">Position: </label>
            <select type="dropdown" id="dropdown" name="dropdown">
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
            </select><br></br>
          </div>
          <div>
          <label>Visible: </label>
            <input type="radio" id="yes" name="visible" value="yes">
            <label for="yes">Yes</label>
            <input type="radio" id="no" name="visible" value="no">
            <label for="no">No</label><br></br>
          </div>
          <div>
            <label for="text">Content: </label>
            <textarea id="text" name="text" rows="4" cols="50"></textarea>
          </div><br></br>
          <input type='submit' value='Save' />
            <a href='index2.php'>Back to read subjects</a>
</form>
</div>