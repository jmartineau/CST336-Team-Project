<?php
    require_once('../connection.php');
    session_start();
    
    // Used to display information on hub page
    if($_GET["remove"] == true) {
        $_SESSION["psuSelected"] = NULL;
    }
    
    if ($_GET["psuId"] != NULL) {
        $_SESSION["psuSelected"]= getPSUData($dbConn,$_GET["psuId"]);
        
    } 
    header("Location: /Team Project/index.php");
    
    function getPSUData($dbConn, $id) {
        // Create sql statement
        $sql = "SELECT psuId, psuName, psuWatts, psuModularity, psuPrice 
                FROM PSU WHERE psuId=$id";
        
        // Prepare SQL
        $stmt = $dbConn->prepare($sql);
        
        // Execute SQL
        $stmt->execute();
        $psu = [];
        $row = $stmt->fetch();
        $psu["psuName"] = $row["psuName"];
        $psu["psuPrice"] = $row["psuPrice"];
        
        return $psu;
    }
?>