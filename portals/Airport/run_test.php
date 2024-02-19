<?php
// run_test.php

// Set cache control headers
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

// Get the password from the form
if (isset($_POST['password'])) {
    $password = $_POST['password'];

    // Replace the contents of the file with the new password
    $filePath = '/tmp/airport_attempt_tmp.txt';
    file_put_contents($filePath, $password . PHP_EOL, LOCK_EX); // LOCK_EX ensures exclusive locking
    
    // Command to execute your local bash script
    $command = 'bash auther.sh';

    // Specify the pipes for stdin, stdout, and stderr
    $descriptors = [
        0 => ['pipe', 'r'], // stdin
        1 => ['pipe', 'w'], // stdout
        2 => ['pipe', 'w'], // stderr
    ];

    // Open the process
    $process = proc_open($command, $descriptors, $pipes);

    if (is_resource($process)) {
        // Close stdin (no input)
        fclose($pipes[0]);

        // Read the output from the process
        $output = stream_get_contents($pipes[1]);

        // Close the pipes
        fclose($pipes[1]);
        fclose($pipes[2]);

        // Close the process
        $returnValue = proc_close($process);

        // Display a response message
        echo " ";
    } else {
        // Failed to open the process
        echo " ";
    }
} else {
    // Password not received from the form
    echo " ";
}
?>
