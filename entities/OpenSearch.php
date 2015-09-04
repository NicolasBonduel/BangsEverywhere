<?php

class OpenSearch {

    private $url;
    private $xml;
    private $title;
    private $description;
    private $osSuggestions;

    function __construct($data) {

        if (isset($data['title'])) {
            $this->title = $data['title'];
        }
        if (isset($data['osSuggestions'])) {
            $this->osSuggestions = $data['osSuggestions'];
        }

        switch ($data['type']) {
            case 'url' :
                $this->url = $data['content'];
                if ($this->url !== null) {
                    $this->xml = simplexml_load_file($this->url);
                }
                break;
            case 'XMLurl' :
                $this->xml = simplexml_load_file($data['content']);
                break;
            case 'xml' :
                $this->xml = simplexml_load_string($data['content']);
                break;
            default :
                $this->xml = simplexml_load_string($data['content']);
                break;
        }

        $this->parseXml($data['type']);
    }

    private function parseXml($type) {
        if (isset($this->xml)) {
            foreach ($this->xml->Url as $urltag) {
                if ($urltag['type'] == "application/x-suggestions+json") {
                    $this->osSuggestions = $urltag['template'][0];
                    break;
                }
            }
            if ($type != "url") {
                if (isset($this->xml->Url->Param[0])) {
                    $this->url = $this->xml->Url['template'];
                    $separator = "?";
                    foreach ($this->xml->Url->Param as $param) {
                        $this->url .= $separator . $param['name'] . "=" . $param['value'];
                        $separator = "&";
                    }
                } elseif (strpos($this->xml->Url['template'], "{searchTerms}") !== false) {
                    $this->url = $this->xml->Url['template'];
                } else {
                    $this->url = $this->xml->Url;
                }
            }

            $this->title = $this->xml->ShortName;
            $this->description = $this->xml->Description;
            $this->favicon = $this->xml->Image;
        }
    }

    public function getUrl() {
        return $this->url;
    }

    public function getXml() {
        return $this->xml;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getUrlEncodedTitle() {
        return urlencode($this->title);
    }

    public function getDescription() {
        return $this->description;
    }

    public function getUrlEncodedDescription() {
        return urlencode($this->description);
    }

    public function getFavicon() {
        return $this->favicon;
    }

    public function getUrlEncodedFavicon() {
        return urlencode($this->favicon);
    }

    public function getOsSuggestions() {
        return $this->osSuggestions;
    }

    public function getUrlEncodedOsSuggestions() {
        return urlencode($this->osSuggestions);
    }

    public function getUrlEncodedUrl() {
        return urlencode($this->url);
    }

}