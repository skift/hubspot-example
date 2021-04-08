<?php
require 'vendor/autoload.php';
require 'utils/HubspotClientHelper.php';
require 'utils/OAuth2Helper.php';

/**
 * I don't know why their namespace starts with SevenShores
 */
use SevenShores\Hubspot\Utils\OAuth2;

/** 
 * Function defition from OAuth2 docs:
 * 
 * Initiate an Integration with OAuth 2.0.
 * 
 * @param string $clientId — the Client ID of your app
 * @param string $redirectURI - The URL that you want the visitor redirected to after granting access to your app. For security reasons, this URL must use https.
 * @param array $scopesArray — a set of scopes that your app will need access to
 * @param array $optionalScopesArray - a set of optional scopes that your app will need access to
 */
$auth_url = OAuth2::getAuthUrl(
    OAuth2Helper::CLIENT_ID,
    OAuth2Helper::get_redirect_uri(),
    OAuth2Helper::APP_REQUIRED_SCOPES
);
/**
 * You can also find this within the HubSpot developer portal. Example: https://app.hubspot.com/oauth/authorize?client_id=2b9321a7-f94e-4aa8-be97-2f69900f512d&redirect_uri=http://localhost/packages/hubspot-example/callback.php&scope=contacts%20oauth%20forms
 */


/**
 * This will take you to a page in HubSpot where you can authorize access to the requested scopes
 */
header('Location: '.$auth_url);

