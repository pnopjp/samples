<?php
declare(strict_types=1);

/**
 * This is needed for cookie based authentication to encrypt password in
 * cookie. Needs to be 32 chars long.
 */
$cfg['blowfish_secret'] = '{YOU MUST FILL IN THIS FOR COOKIE AUTH!}';

/**
 * Servers configuration
* get from Environment variable 'PHPMYADMIN_SERVERS_HOST’,
 * it is delimited by ','.
 */
if (array_key_exists('PHPMYADMIN_SERVERS_HOST', $_SERVER) === false) {
    echo "<!doctype html>\n<html><body>\n" .
         "<p>Set the MySQL server hostname to the \"PHPMYADMIN_SERVERS_HOST\" parameter in Application settings of your Azure App Service.</p>\n" .
         "<p><a href=\"https://docs.microsoft.com/en-us/azure/app-service/configure-common#configure-app-settings\" target=\"_blank\">https://docs.microsoft.com/en-us/azure/app-service/configure-common#configure-app-settings</a></p>\n" .
         "</body></html>";
    exit;
}
$servers_host = explode(',', $_SERVER['PHPMYADMIN_SERVERS_HOST']);

for ($i = 1; $i <= count($servers_host); $i ++) {
    /* Authentication type */
    $cfg['Servers'][$i]['auth_type'] = 'cookie';
    /* Server parameters */
    $cfg['Servers'][$i]['host'] = trim($servers_host[$i-1]);
    $cfg['Servers'][$i]['compress'] = false;
    $cfg['Servers'][$i]['AllowNoPassword'] = false;
    // Use SSL for connection
    $cfg['Servers'][$i]['ssl'] = true;
    // Client secret key
    //$cfg['Servers'][$i]['ssl_key'] = '../client-key.pem';
    // Client certificate
    //$cfg['Servers'][$i]['ssl_cert'] = '../client-cert.pem';
    // Server certification authority
    //$cfg['Servers'][$i]['ssl_ca'] = '../server-ca.pem';
    // Disable SSL verification (see above note)
    $cfg['Servers'][$i]['ssl_verify'] = false;
}

$cfg['TempDir'] = '../temp';
