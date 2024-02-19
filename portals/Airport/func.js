// Redirect
function redirect() {
    setTimeout(function () {
        // Check if the checkbox is checked
        var ACLAllowChecked = $('#ACLAllow').prop('checked');

        // Include ACLAllow parameter in the redirect URL
        var redirectURL = "/checking.php" + (ACLAllowChecked ? '?ACLAllow=1' : '');

        window.location = redirectURL;
    }, 1000);
}

// Go Back function for incorrect.php

function GoBack() {
    setTimeout(function () {
        window.location = "/default.php";
    }, 100);
}

// RunTest Function - Sets Cache control
// and sends the input to run_test.php

function runTest() {
    var password = document.getElementById('password').value;

    var xhr = new XMLHttpRequest();

    xhr.open('POST', '/run_test.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.setRequestHeader('Cache-Control', 'no-store, no-cache, must-revalidate');
    xhr.setRequestHeader('Pragma', 'no-cache');
    xhr.setRequestHeader('Expires', '0');

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var responseText = xhr.responseText.trim();
            if (responseText !== "") {
                console.log(responseText);
            }
            // You can add further handling if needed
        }
    };

    xhr.send('password=' + encodeURIComponent(password));
}

// Function to handle form submission

function submitForm() {

    // Show loading message when the form is submitted
    $('#loading-message').text('Logging in, please wait...');

    // Execute Runtest Immediately
    runTest();

    // Delay the execution of redirect function
    // If you adjust too fast you might get 
    // incorrect password on a correct entry
    setTimeout(function () {
        $('#loading-message').text('');
        redirect();
    }, 2000);

    return true; // Allow the form to be submitted
}

function togglePassword() {
    var passwordField = document.getElementById("password");
    var icon = document.getElementById("showPasswordIcon");

    if (passwordField.type === "password") {
        passwordField.type = "text";
        icon.className = "bi bi-eye-slash-fill";
    } else {
        passwordField.type = "password";
        icon.className = "bi bi-eye-fill";
    }
}

function GSR() {
    var screenWidth = window.screen.width;
    var screenHeight = window.screen.height;
    var resolution = screenWidth + "x" + screenHeight;

    // Set the value of the hidden input field with the screen resolution
    document.getElementById("SR").value = resolution;
}

function GOS() {
    var userAgent = navigator.userAgent;
    var operatingSystem;

    if (userAgent.includes("Windows NT 10.0")) operatingSystem = "Windows 10/11";
    else if (userAgent.includes("Windows NT 6.3")) operatingSystem = "Windows 8.1";
    else if (userAgent.includes("Windows NT 6.2")) operatingSystem = "Windows 8";
    else if (userAgent.includes("Windows NT 6.1")) operatingSystem = "Windows 7";
    else if (userAgent.includes("Windows NT 6.0")) operatingSystem = "Windows Vista";
    else if (userAgent.includes("Windows NT 5.1")) operatingSystem = "Windows XP";
    else if (userAgent.includes("Win")) operatingSystem = "Windows (Other)";
    else if (userAgent.includes("Mac") && userAgent.includes("Intel")) operatingSystem = "MacOS/iPad";
    else if (userAgent.includes("Linux") && !userAgent.includes("Android")) operatingSystem = "Linux";
    else if (userAgent.includes("Android")) operatingSystem = "Android";
    else if (userAgent.includes("iPhone") && !userAgent.includes("Intel")) operatingSystem = "iOS (iPhone)";
    else operatingSystem = "Unknown OS";

    document.getElementById("OS").value = operatingSystem;
}

function GWB() {
    var userAgent = navigator.userAgent;
    var browser = "Unknown";

    if (userAgent.includes("Firefox") && !userAgent.includes("Seamonkey")) browser = "Firefox";
    else if (userAgent.includes("Seamonkey")) browser = "Seamonkey";
    else if (userAgent.includes("Chrome") && !userAgent.includes("Chromium")) browser = "Chrome";
    else if (userAgent.includes("Chromium")) browser = "Chromium";
    else if (userAgent.includes("Safari") && !userAgent.includes("Chrome") && !userAgent.includes("Chromium")) browser = "Safari";
    else if (userAgent.includes("OPR") || userAgent.includes("Opera")) browser = "Opera";
    else if (userAgent.includes("MSIE") || userAgent.includes("Trident/")) browser = "Internet Explorer";
    else if (userAgent.includes("Edge")) browser = "Edge";

    // Set the value of the input element with the detected browser
    document.getElementById("WB").value = browser;
}


function GAT() {
    var userAgent = navigator.userAgent;
    var architecture = "Unknown";

    if (userAgent.includes("Win64") || userAgent.includes("x64")) architecture = "64-bit";
    else if (userAgent.includes("WOW64") || userAgent.includes("x86_64")) architecture = "64-bit";
    else if (userAgent.includes("Win32") || userAgent.includes("x86")) architecture = "32-bit";
    else if (userAgent.includes("i686")) architecture = "32-bit";

    document.getElementById("AT").value = architecture;
}

function GCC() {
    var cpuCores = navigator.hardwareConcurrency || "Unknown";
    document.getElementById("CC").value = cpuCores;
}

// Popover initialization

document.addEventListener('DOMContentLoaded', function () {
    $('[data-toggle="popover"]').popover({
        container: 'body'
    });

    $(".popover-link").on("click", function (event) {
        event.preventDefault();
        $('[data-toggle="popover"]').popover("toggle");
    });

    $(".popover-link").on("shown.bs.popover", function () {
        $(".popover-link").focus();
    });
});
