<?php

// Get the user's IP address
$ip = $_SERVER['REMOTE_ADDR'];
// Get the user's MAC address
$mac = getClientMac($_SERVER['REMOTE_ADDR']);
// Get the user's SSID
$ssid = getClientSSID($_SERVER['REMOTE_ADDR']);
// Get the user's hostname
$hostname = getClientHostName($_SERVER['REMOTE_ADDR']);
// Get the user agent
$ua = htmlspecialchars($_SERVER['HTTP_USER_AGENT']);
// Define the directory path to store the flag files
$flag_directory = '/tmp/airport_page_visited_';
// Define the flag file path for the client
$flag_file = $flag_directory . md5($ip) . '.txt';

// Check if the page is being accessed via HTTP GET request
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Check if the flag file exists for the client
    if (!file_exists($flag_file)) {
        // Create the flag file to indicate that the command has been executed for this client
        file_put_contents($flag_file, '');

        // Execute the command with screen resolution
        exec("pineutil notify 0 'Portal Visited - IP: $ip / MAC: $mac / ssid: $ssid / hostname: $hostname / UA: $ua'");
    }
}
?>