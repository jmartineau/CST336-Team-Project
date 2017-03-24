<?php
    require_once('../connection.php');
    session_start();
    
    if($_GET["remove"] == true) {
        $_SESSION["cpuSelected"] = NULL;
    }
    
    if ($_GET["cpuId"] != NULL) {
        $_SESSION["cpuSelected"]= getCPUData($dbConn,$_GET["cpuId"]);
        
    } 
    header("Location: /Team Project/index.php");
    
    function getCPUData($dbConn, $id) {
        // Create sql statement
        $sql = "SELECT CPU.cpuId, CPU.cpuName, CPU.cpuPrice
                FROM CPU WHERE CPU.cpuId=$id";
        
        // prepare SQL
        $stmt = $dbConn->prepare($sql);
        
        // Execute SQL
        $stmt->execute();
        $cpu = [];
        $row = $stmt->fetch();
        $cpu["cpuName"] = $row["cpuName"];
        $cpu["cpuPrice"] = $row["cpuPrice"];
        
        return $cpu;
    }
?>