<?php

namespace App\Utilities\PhpQueryParser;

use DOMXPath;
use DOMDocument;

class PhpQueryParser
{
    /**
     * @var
     */
    private $domDocument;

    /**
     * @var
     */
    private $xPath;

    /**
     * PhpQueryParser constructor.
     * @param DOMDocument $domDocument
     */
    public function __construct()
    {
        $this->domDocument = new DOMDocument;
    }

    /**
     * @param string $source
     */
    public function loadSource(string $source)
    {
        $internalErrors = libxml_use_internal_errors(true);
        $this->domDocument->loadHTML($source);
        libxml_use_internal_errors($internalErrors);
        $this->xPath = new DOMXPath($this->domDocument);
        //echo $this->document->saveHTML();
    }

    /**
     * @param string $source
     * @param bool $booleanRelative
     * @return string
     */
    public function jqueryToXpath(string  $source, $booleanRelative = false)
    {
        $array = [];
        $source = $this->transformToArray($source);

        foreach($source as $item) {
            $parsedItem = $this->parseItem($item);
            $result = $this->toXpath($parsedItem);
            array_push($array, $result);
        }
        $relativeString = $booleanRelative ? '' : '//' ;

        return $relativeString . implode("/", $array);
    }

    /**
     * @param string $str
     * @param null $relativeNode
     * @return mixed
     */
    public function query(string $str, $relativeNode = null)
    {
        return $relativeNode
            ? $this->xPath->query($this->jqueryToXpath($str, true), $relativeNode)
            : $this->xPath->query($this->jqueryToXpath($str));
    }

    /**
     * @param string $str
     * @param null $relative_node
     * @return mixed
     */
    public function xpath(string $str, $relative_node = null)
    {
        return $this->xPath->query($str, $relative_node);
    }

    /**
     * @param array $items
     * @return string
     */
    public function toXpath(array $items): string
    {
        $result = "{$items['tag']}";
        $result .= $this->idToXpath($items['id']);
        $result .= $this->classToXpath($items['classes']);
        $result .= $this->autotagsToXpath($items['autotags']);

        return $result;
    }

    /**
     * @param string $source
     * @return array
     */
    private function transformToArray(string  $source): array
    {
        return explode(' ', $source);
    }

    /**
     * @param string $item
     * @return array
     */
    private function parseItem(string $item): array
    {
        $result = [];
        $result['tag'] = $this->getTag($item);
        $result['id'] = $this->getId($item);
        $result['classes'] = $this->getClasses($item);
        $result['autotags'] = $this->getAutotags($item);

        return $result;
    }

    /**
     * @param string $item
     * @return string
     */
    private function getTag(string $item): string
    {
        return preg_match('/^\w+/', $item,$matches) ? $matches[0] : '*';
    }

    /**
     * @param string $item
     * @return string
     */
    private function getId(string $item): string
    {
        return preg_match('/#\w+/', $item,$matches) ? substr($matches[0],1) : '';
    }

    /**
     * @param string $item
     */
    private function getClasses(string $item)
    {
        return preg_match_all('/(?<=\.)\w+/', $item,$matches) ? $matches[0] : [];
    }

    /**
     * @param string $item
     * @return array
     */
    private function getAutotags(string $item): array
    {
        return preg_match_all('/(?<=\[)\w+=?[\"\']?\w+[\"\']?(?=\])/', $item,$matches) ? $matches[0] : [];
    }

    /**
     * @param string $id
     * @return string
     */
    private function idToXpath(string $id): string
    {
        return $id ? "[@id=\"{$id}\"]" : '';
    }

    /**
     * @param array|null $classes
     */
    private function classToXpath($classes): string
    {
        if (!$classes) return '';

        $result = [];
        foreach($classes as $class) {
            array_push($result,"contains(@class,\"{$class}\")");
        }

        return "[" . implode(" and ",$result) . "]";
    }

    /**
     * @param array|null $autotags
     * @return string
     */
    private function autotagsToXpath(?array $autotags): string
    {
        $result = '';
        foreach($autotags as $autotag) {
            $result .= "[@{$autotag}]";
        }

        return $result;
    }
}
