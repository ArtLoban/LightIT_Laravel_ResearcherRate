<?php

namespace App\Utilities\HttpClient;

use App\Utilities\HttpClient\Contracts\HttpClient;

class CurlClient implements HttpClient
{
    /**
     * @param string $url
     * @return string
     */
    public function receiveData(string $url): string
    {
        return $data = $this->executeRequest($url);
    }

    /**
     * @param string $url
     * @return string
     */
    private function executeRequest(string $url): string
    {
        $headers = $this->getHeaders();
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        return $page = curl_exec($curl);
    }

    /**
     * @return array
     */
    private function getHeaders(): array
    {
        return [
            'Content-Type: application/x-www-form-urlencoded; charset=utf-8',
            'User-Agent: Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36',
            'Referer: http://www.google.com'
        ];
    }
}
