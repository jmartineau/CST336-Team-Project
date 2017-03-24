<?php
    require_once('../connection.php');
    session_start();
?>

<html>
    <title>CPUs</title>
    <form name="cpuForm" metdod="GET" action="/Team Project/Component Selection Data/cpuSelectData.php">
        <table>
            <tr>
                <td>Name</td>
                <td>Base Clock</td>
                <td>#Cores</td>
                <td>Price</td>
                <td>Add</td>
            </tr>
            
            <?php
                $CPUs = getCPUs($dbConn);
                $i = 0;
                for($i; $i < count($CPUs); $i++) {
                    echo '<tr>';
                    echo '<td>'.$CPUs[$i]["cpuName"].'</td>';
                    echo '<td>'.$CPUs[$i]["cpuBaseClock"].'</td>';
                    echo '<td>'.$CPUs[$i]["cpuNumCores"].'</td>';
                    echo '<td>$'.$CPUs[$i]["cpuPrice"].'</td>';
                    echo '<td><a href="/Team Project/Component Selection Data/cpuSelectData.php?cpuId='.$CPUs[$i]["cpuId"].
                         '&remove=false">add</a></td>';
                    echo '</tr>';
                }
            ?>
        </table>
    </form>
    
</html>


<?php
    function getCPUs($dbConn) {
         // Create sql statement
        $sql = "SELECT CPU.cpuId, CPU.cpuName, CPU.cpuBaseClock, CPU.cpuNumCores, CPU.cpuPrice
                FROM CPU ORDER BY CPU.cpuName";
        
        // Prepare SQL
        $stmt = $dbConn->prepare($sql);
        
        // Execute SQL
        $stmt->execute();
        
        $componentArr = [];
        $component = [];
        $i = 0;
        
        while($row = $stmt->fetch()) { 
            $component["cpuId"] = $row["cpuId"];
            $component["cpuName"] = $row["cpuName"];
            $component["cpuBaseClock"] = $row["cpuBaseClock"];
            $component["cpuNumCores"] = $row["cpuNumCores"];
            $component["cpuPrice"] = $row["cpuPrice"];
            $componentArr[$i] = $component;
            $i++;
        }
        
        return $componentArr;
    }

?>