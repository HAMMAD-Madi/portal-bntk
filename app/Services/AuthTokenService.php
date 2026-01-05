<?php 
namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
//use Illuminate\Support\Facades\Redis;
use Carbon\Carbon; 

class AuthTokenService
{
    protected $cacheKey;
    protected $tokenEndpoint;
    protected $clientId;
    protected $clientSecret;

    public function __construct($tokenEndpoint)
    {
        $this->tokenEndpoint = $tokenEndpoint;

    }

    public function getToken($storeName)
    {
        $cacheKey = "api_auth_token_{$storeName}";

        // Attempt to get the token from the cache
        $token = Cache::get($cacheKey);
        // If token is not in the cache or is expired, retrieve a new one
        if (!$token || $this->isTokenExpired($token)) {
            // Retrieve the credentials from Cache
            $credentials = $this->getCredentials($storeName);
            $token = $this->fetchNewToken($credentials['client_id'], $credentials['client_secret'], $cacheKey);
        }

        return $token;
    }

    protected function getCredentials($storeName)
    {
        $credentialsJson = Cache::get("api_credentials_{$storeName}");
        if (!$credentialsJson) {
            Cache::forever("api_credentials_{$storeName}", ['client_id' => 'fbb501c0-d547-4410-98f2-8d77860241ec', 'client_secret' => 'j6xPV0U80ElLo3g?rD6)rcdX)zsnz4Op7qazKp@0)54htE)(QMkdqRAYPdA6UK05']);

            //throw new \Exception("Credentials for {$storeName} not found.");
        }

        return $credentialsJson;
    }


    protected function fetchNewToken($clientId, $clientSecret, $cacheKey)
    {   
        $encoded = base64_encode(trim($clientId) . ':' . trim($clientSecret));  
        $response = Http::withHeaders(['Authorization' => 'Basic ' . $encoded])->post($this->tokenEndpoint . '?grant_type=client_credentials');

        if (!$response->successful()) {
            throw new \Exception('Failed to retrieve API token');
        }

        $tokenData = $response->json();

        // Store the token in the cache, with an expiration time a bit before the actual token expiration to be safe
        $expiresIn = $tokenData['expires_in'] ?? 3600;
        Cache::put($cacheKey, $tokenData['access_token'], now()->addSeconds($expiresIn - 5));

        return $tokenData['access_token'];
    }

    protected function isTokenExpired($token)
    {
        // Decode the JWT token to check the expiration time
        $jwt = json_decode(base64_decode(str_replace('_', '/', str_replace('-','+',explode('.', $token)[1]))), true);
        $exp = Carbon::parse(intval($jwt['exp']));
        $curr = Carbon::now('UTC');
        return isset($exp) && $curr->greaterThan($exp );
    }
}