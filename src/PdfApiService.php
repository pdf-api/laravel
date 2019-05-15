<?php

namespace PdfApi;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\RequestException;

class PdfApiService
{
    private static $http;
    
    public static function html(string $html): string
    {
        $response = self::request('POST', 'pdf', [
            'html' => $html,
        ]);
        
        return $response['url'];
    }
    
    public static function url(string $url): string
    {
        $response = self::request('POST', 'pdf', [
            'url' => $url,
        ]);
        
        return $response['url'];
    }
    
    private static function getHttpClient()
    {
        if (self::$http)
            return self::$http;
        
        self::$http = new HttpClient([
            'base_uri' => 'https://api.laravelpdfapi.com/api/',
        ]);
        return self::$http;
    }
    
    private static function request(string $method, string $url, array $params)
    {
        $http = self::getHttpClient();
        $response = $http->request($method, $url, [
            'json' => $params,
        ]);
        return json_decode((string) $response->getBody(), true);
    }
}