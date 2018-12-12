<?php

namespace App\Utilities\HttpClient\Contracts;

interface HttpClient
{
    /**
     * @param string $url
     * @return string
     */
    public function receiveData(string $url): string;
}
