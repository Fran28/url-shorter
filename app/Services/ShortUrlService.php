<?php
namespace App\Services;
use GuzzleHttp\Client;
use Throwable;

class ShortUrlService
{

    public const SHORT_URL_ENDPOINT = 'https://tinyurl.com';
    public const SHORT_URL_GET_ENDPOINT = '/api-create.php';


    public function generateShortUrl(string $url)
    {
        $client = new Client();
        try{
            $response = $client->request('GET', self::SHORT_URL_ENDPOINT . self::SHORT_URL_GET_ENDPOINT . "?url=$url");
        }catch(Throwable $e){
            return $this->processResponse(
                300, $e->getMessage(), true
            );
        }
        $statusCode = $response->getStatusCode();
        if($statusCode != 200){
            return $this->processResponse(
                300,
                'An unexpected error has ocurred, please try again latter',
                true
            );
        }
        $content = $response->getBody()->getContents();
        return $this->processResponse($statusCode, $content);
    }


    private function processResponse(int $status, string $response, bool $error  = false){
        return [
            'status' => $status,
            'response' => !$error?$response:'',
            'error' => $error? $response : ''
        ];
    }
}