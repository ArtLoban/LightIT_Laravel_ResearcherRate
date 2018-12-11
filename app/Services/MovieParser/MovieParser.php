<?php

namespace App\Services\MovieParser;

use Carbon\Carbon;
use SimpleHtmlDom\simple_html_dom;
use App\Utilities\HttpClient\Contracts\HttpClient;
use App\Services\MovieParser\Contracts\MovieParserInterface;

class MovieParser implements MovieParserInterface
{
    const DOVZHENKO_DOMAIN = 'http://dovzhenko.zp.ua';
    const DOVZHENKO_POSTER_ENDPOINT = 'http://dovzhenko.zp.ua/kinoafisha/';

    /**
     * @var HttpClient
     */
    private $httpClient;

    /**
     * @var simple_html_dom
     */
    private $simpleHtmlDom;

    /**
     * @var Carbon
     */
    private $carbon;

    /**
     * MovieParser constructor.
     * @param HttpClient $httpClient
     * @param simple_html_dom $simple_html_dom
     * @param Carbon $carbon
     */
    public function __construct(HttpClient $httpClient, simple_html_dom $simple_html_dom, Carbon $carbon)
    {
        $this->httpClient =$httpClient;
        $this->simpleHtmlDom = $simple_html_dom;
        $this->carbon = $carbon;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        $data = $this->httpClient->receiveData(self::DOVZHENKO_POSTER_ENDPOINT);
        $htmlDom = $this->simpleHtmlDom->load($data);

        return $this->parseData($htmlDom);
    }

    /**
     * @param $htmlDom
     * @return array
     */
    private function parseData($htmlDom): array
    {
        $currentDay = $this->carbon->day;
        $currentDate = $this->carbon->now()->format('Y-m-d');
        $domElements = $htmlDom->find('.anons_one');

        $data = [];
        foreach($domElements as $key => $element) {
            $announceDate = $element->first_child()->plaintext;

            if (stristr($announceDate, "{$currentDay}")) {
                $data[] = $this->parseElement($element);
                $data[$key]['date'] = $currentDate;
            }
        }

        return $data;
    }

    /**
     * @param $element
     * @return array
     */
    private function parseElement($element): array
    {
        $parsedElement = [];
        $parsedElement['name'] = $element->find('.name')[0]->plaintext;
        $parsedElement['time'] = $element->find('.time')[0]->plaintext;
        $parsedElement['poster_path'] = $element->find('img')[0]->src;

        return $this->cleanData($parsedElement);
    }

    /**
     * @param array $parsedValues
     * @return array
     */
    private function cleanData(array $parsedValues): array
    {
        foreach ($parsedValues as &$value) {
            $value = trim($value);
            $value = strip_tags($value);
            htmlspecialchars($value);
        }

        return $parsedValues;
    }
}
