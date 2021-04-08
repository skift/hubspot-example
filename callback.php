<?php
require 'vendor/autoload.php';
require 'utils/HubspotClientHelper.php';
require 'utils/OAuth2Helper.php';

use HubspotClientHelper;
use OAuth2Helper;

$tokens = HubspotClientHelper::getOAuth2Resource()->getTokensByCode(
    OAuth2Helper::CLIENT_ID,
    OAuth2Helper::CLIENT_SECRET,
    OAuth2Helper::get_redirect_uri(),
    $_GET['code']
)->toArray();

OAuth2Helper::save_tokens($tokens);

$location = dirname($_SERVER['PHP_SELF']) . '/index.php';
header('Location: ' . $location);