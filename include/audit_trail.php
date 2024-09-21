<?php
session_start();

require_once "../connect/dbcon.php";

try {
    $pdoConnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdoQuery = "SELECT * FROM `audit_trail` ORDER BY `timestamp` DESC";
    $pdoResult = $pdoConnect->query($pdoQuery);
    $audittrailData = $pdoResult->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $error) {
    $message = $error->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trail</title>
    <link rel="stylesheet" type="text/css" href="../style/audits.css">
    
</head>

<body>
    <div class="container">
        <h1>Welcome to PRJ</h1>
        <p>Audit customize</p>

        <br />

    </div>

    <?php
    if (isset($_SESSION['$UserName'])) {
        $UserName = $_SESSION['UserName'];
        echo '<h3 align = "center">Welcome,' . $UserName . '!</h3>';
    }
    ?>
    <!-- <div>
        <p>User information:</p>
        <ul>
     <li><strong>Username:</strong><?php echo $user['UserName']; ?>
    <li><strong>FullName:</strong><?php echo $user['FullName']; ?>
</ul>
</div -->
    <br>
    <a href="../crud/read.php">Add user</a> <br>
    <a href="../include/dropdown.php">Drop down</a> <br>
    <a href="../include/audit_trail.php">Audit trail</a> <br>
    <a href="logout.php">Logout</a> <br>

    <div class="container">
        <h2>Trail Data</h2>
        <?php if (isset($audittrailData) && !empty($audittrailData)): ?>
            <table border="1">
                <tr>
                    <?php foreach ($audittrailData as $log): ?>
                        <td>
                            <?= $log['action'] ?>
                        </td>
                        <td>
                            <?= $log['email'] ?> 
                        </td>
                        <td>
                            <?= $log['timestamp'] ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php else: ?>
            <p>no Audit Available</p>
        <?php endif; ?>

    </div>
</body>

</html>