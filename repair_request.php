<?php include "config.php"; ?>

<!DOCTYPE html>
<html>
<head>
<title>Repair Request</title>
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<style>
.repair-header {
    text-align: center;
    margin-bottom: 30px;
}
.repair-header i {
    font-size: 3em;
    color: #007bff;
}
.device-options {
    display: flex;
    justify-content: space-around;
    margin: 20px 0;
}
.device-option {
    text-align: center;
    cursor: pointer;
    padding: 20px;
    border: 2px solid #ddd;
    border-radius: 10px;
    transition: all 0.3s;
}
.device-option:hover, .device-option.selected {
    border-color: #007bff;
    background: #f0f8ff;
}
.device-option i {
    font-size: 2em;
    display: block;
    margin-bottom: 10px;
}
.problem-textarea {
    width: 100%;
    height: 100px;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
    resize: vertical;
}
.submit-btn {
    background: #28a745;
    color: white;
    border: none;
    padding: 12px;
    border-radius: 5px;
    cursor: pointer;
    font-size: 1.1em;
}
.submit-btn:hover {
    background: #218838;
}
</style>
</head>
<body>

<nav>
<a href="index.php">Home</a>
</nav>

<div class="container">
<div class="repair-header">
    <i class="fas fa-tools"></i>
    <h2>Request Computer Repair</h2>
    <p>Describe your device and issue below</p>
</div>

<form method="POST" onsubmit="return validateRepair()">
    <label>Select Your Device:</label>
    <div class="device-options">
        <div class="device-option" onclick="selectDevice('Laptop')">
            <i class="fas fa-laptop"></i>
            <span>Laptop</span>
        </div>
        <div class="device-option" onclick="selectDevice('Desktop')">
            <i class="fas fa-desktop"></i>
            <span>Desktop</span>
        </div>
        <div class="device-option" onclick="selectDevice('Printer')">
            <i class="fas fa-print"></i>
            <span>Printer</span>
        </div>
    </div>
    <input type="hidden" name="device" id="selectedDevice" required>

    <label for="problem">Describe the Problem:</label>
    <textarea name="problem" id="problem" class="problem-textarea" placeholder="Please provide details about the issue..." required></textarea>

    <button type="submit" name="submit" class="submit-btn">
        <i class="fas fa-paper-plane"></i> Submit Request
    </button>
</form>
</div>

<script>
let selectedDevice = '';

function selectDevice(device) {
    selectedDevice = device;
    document.getElementById('selectedDevice').value = device;
    document.querySelectorAll('.device-option').forEach(opt => opt.classList.remove('selected'));
    event.currentTarget.classList.add('selected');
}

function validateRepair(){
    if (!selectedDevice) {
        alert("Please select a device.");
        return false;
    }
    let problem = document.getElementById("problem").value;
    if(problem.length < 10){
        alert("Please describe the problem in more detail (at least 10 characters).");
        return false;
    }
    return true;
}
</script>

</body>
</html>