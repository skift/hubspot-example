<?php

class OAuth2Helper {
    const CLIENT_ID = '2b9321a7-f94e-4aa8-be97-2f69900f512d';
    const CLIENT_SECRET = 'e3b00e12-0265-4fbe-8289-ebaad4c3b005';
    const APP_ID = '36762';
    const APP_REQUIRED_SCOPES = ['contacts', 'oauth', 'forms'];
    const CALLBACK_PATH = '/oauth/callback';
    const TOKENS_KEY = 'tokens';

    /**
     * Get the redirect URI
     * This is the callback URL that you set in the developer portal
     *
     * @return string
     */
    public static function get_redirect_uri() {
        return 'http://localhost/packages/hubspot-example/callback.php';
    }

    /**
     * Save array of tokens to session
     * Dunno why they multiplied by .95
     *
     * @param array $tokens
     * @return void
     */
    public static function save_tokens($tokens) {
        if (isset($tokens['status'])) return;
        $tokens['expires_at'] = time() + $tokens['expires_in'] * 0.95;
        setcookie(static::TOKENS_KEY, json_encode($tokens));
    }

    /**
     * Check session for tokens key
     *
     * @return boolean
     */
    public static function is_authenticated() {
        return isset($_COOKIE[static::TOKENS_KEY]);
    }

    /**
     * 1. Check for empty sessions token
     * 2. Use a HubspotClient to initialize OAuth2 and refresh
     * 3. This retrieves the tokens
     * 4. The tokens are persisted in the session
     * 5. The access token is returned for use
     *
     * @return string The access token
     */
    public static function refresh_and_get_access_token() {
        $tokens = $_COOKIE[static::TOKENS_KEY] ?? false;

        if (!$tokens) return false;

        $tokens = json_decode($tokens, true);
        if (time() > $tokens['expires_at']) {
            $tokens = HubspotClientHelper::getOAuth2Resource()->getTokensByRefresh(
                self::CLIENT_ID,
                self::CLIENT_SECRET,
                $tokens['refresh_token']
            )->toArray();
            self::save_tokens($tokens);
        }

        return $tokens['access_token'];
    }
}
