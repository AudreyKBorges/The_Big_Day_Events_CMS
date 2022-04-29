<?php
/** 
 * Audrey Borges
 * WEBD-325-45
 * Week 5 Project: Content Management of Pages
 * April 24, 2022
 *
 * Delete page
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
        // Redirect to record deleted page and tell the user record was deleted
        header('Location: record-deleted.php?action=deleted');
    } else {
        die('Unable to delete record.');
    }
}
 
// Show error
catch(PDOException $exception){
    die('ERROR: ' . $exception->getMessage());
}
?>