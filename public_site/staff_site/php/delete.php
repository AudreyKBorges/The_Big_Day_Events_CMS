<?php
/** 
 * Audrey Borges
 * WEBD-325-45
 * Week 4 Project: Content Management of Subjects
 * April 17, 2022
 *
 * Delete subject
 */

require_once 'db_connection.php';
 
try {
 
    // Get record ID
    $id=isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');
 
    // Delete query
    $query = "DELETE FROM subjects WHERE id = ?";
    $stmt = $con->prepare($query);
    $stmt->bindParam(1, $id);
 
    if ($stmt->execute()) {
        // Redirect to read records page and tell the user record was deleted
        header('Location: index.php?action=deleted');
    } else {
        die('Unable to delete record.');
    }
}
 
// Show error
catch(PDOException $exception){
    die('ERROR: ' . $exception->getMessage());
}
?>