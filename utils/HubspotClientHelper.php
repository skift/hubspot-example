<?php
/**
 * I honestly don't know anything about factories; I never use them in my code
 * So I haven't rewritten much here -- this is more or less what's in their boilerplate
 * 
 */
use SevenShores\Hubspot\Factory;
use SevenShores\Hubspot\Http\Response;
use SevenShores\Hubspot\Resources\OAuth2;


class HubspotClientHelper
{
    const HTTP_OK = 200;
    const HTTP_OK_EMPTY = 204;

    public static function createFactory(): Factory
    {
        $useOauth = OAuth2Helper::is_authenticated();
        $key = OAuth2Helper::refresh_and_get_access_token();
        if (empty($key)) {
            throw new \Exception('Please specify API key or authorize via OAuth');
        }

        return static::create([
            'key' => $key,
            'oauth2' => $useOauth,
        ]);
    }

    public static function getOAuth2Resource(): OAuth2
    {
        return static::create()->oAuth2();
    }

    public static function isResponseSuccessful(Response $response): bool
    {
        return $response->getStatusCode() === static::HTTP_OK;
    }

    public static function isResponseSuccessfulButEmpty(Response $response): bool
    {
        return $response->getStatusCode() === static::HTTP_OK_EMPTY;
    }

    protected static function create($factoryConfig = []): Factory
    {
        return new Factory(
            $factoryConfig,
            null,
            [
                'http_errors' => false, // pass any Guzzle related option to any request, e.g. throw no exceptions
            ],
            true
        );
    }
}
