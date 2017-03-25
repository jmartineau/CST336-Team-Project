<?php 
    require_once('connection.php');
    session_start();
?>

<!DOCTYPE html>
<html>
    <link rel="stylesheet" type="text/css"  href="/Team Project/CSS/tp.css">
    <head>
        <title> Team Project</title>
    </head>
    <body>
        <table>
            <tr>
                <td><b>Component</b></t>
                <td><b>Selection</b></td>
                <td><b>Price</b></td>
                <td></td>
            </tr>
            <tr>
                <td>CPU</td>
                    <?php 
                        if ($_SESSION["cpuSelected"] == NULL) {
                            echo '<td colspan=3>';
                            echo '<a href="/Team Project/Component Selection/cpuSelect.php"> Choose A CPU </a>';
                            echo '</td>';
                        } else {
                            echo '<td>'.$_SESSION["cpuSelected"]["cpuName"].'</td>';
                            echo '<td>'.$_SESSION["cpuSelected"]["cpuPrice"].'</td>';
                            echo '<td><a href="/Team Project/Component Selection Data/cpuSelectData.php?remove=true">X</a></td>';
                        }
                    ?>
            </tr>
            <tr>
                <td>Motherboard</td>
                <td>
                    <?php 
                        if ($_SESSION["mbSelected"] == NULL) {
                            echo '<a href="/Team Project/Component Selection/motherboardSelect.php"> Choose A Motherboard </a>';
                        } else {
                            echo 'Motherboard Selected';
                        }
                    ?>
                </td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Memory</td>
                <td>
                    <?php 
                        if ($_SESSION["ramSelected"] == NULL) {
                            echo '<a href="/Team Project/Component Selection/ramSelect.php"> Choose Memory </a>';
                        } else {
                            echo 'Memory Selected';
                        }
                    ?>
                </td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Storage</td>
                    <?php 
                        if ($_SESSION["storageSelected"] == NULL) {
                            echo '<td colspan=3>';
                            echo '<a href="/Team Project/Component Selection/storageSelect.php"> Choose Storage</a>';
                            echo '</td>';
                        } else {
                            echo '<td>'.$_SESSION["storageSelected"]["storageName"].'</td>';
                            echo '<td>'.$_SESSION["storageSelected"]["storagePrice"].'</td>';
                            echo '<td><a href="/Team Project/Component Selection Data/storageSelectData.php?remove=true">X</a></td>';
                        }
                    ?>
            </tr>
            <tr>
                <td>Video Card</td>
                  <td>
                    <?php 
                        if ($_SESSION["gpuSelected"] == NULL) {
                            echo '<a href="/Team Project/Component Selection/gpuSelect.php"> Choose A Video Card</a>';
                        } else {
                            echo 'Video Card Selected';
                        }
                    ?>
                </td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Case</td>
                  <td>
                    <?php 
                        if ($_SESSION["caseSelected"] == NULL) {
                            echo '<a href="/Team Project/Component Selection/caseSelect.php"> Choose A Case</a>';
                        } else {
                            echo 'Case Selected';
                        }
                    ?>
                </td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Power Supply</td>
                  <td>
                    <?php 
                        if ($_SESSION["psuSelected"] == NULL) {
                            echo '<a href="/Team Project/Component Selection/psuSelect.php"> Choose A Power Supply</a>';
                        } else {
                            echo 'Power Supply Selected';
                        }
                    ?>
                </td>
                <td></td>
                <td></td>
            </tr>
        </table>
    </body>
</html>