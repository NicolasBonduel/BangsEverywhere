<?php

class Crawl {

    private $url;
    private $title;
    private $OSLink;
    private $dom;

    function __construct($url) {
        $this->url = $url;
        $this->title = null;
        $this->OSLink = null;
        $this->loadURL();
        $this->loadOSLink();
        $this->loadTitle();
    }
    
    function loadURL() {
        $domain = parse_url($this->url);
        $domain = $domain['scheme']."://".$domain['host'];
        $urlContents = file_get_contents($domain);
        $dom = new DOMDocument();
        @$dom->loadHTML($urlContents); 
        $this->dom = $dom;
    }
    
    function loadTitle() {
        $this->title = $this->dom->getElementsByTagName('title')->item(0)->nodeValue;
    }
    
    function loadOSLink() {
        foreach($this->dom->getElementsByTagName('link') as $linktag) {
            if($linktag->getAttribute('rel') == "search") {
                $this->OSLink = $linktag->getAttribute('href');
                break;
            }
        }
        
        if($this->OSLink !== null) {
            if(((strpos($this->OSLink, "http://") === false) && (strpos($this->OSLink, "https://") === false))) {
				$parseurl = parse_url($this->url);
				$this->OSLink = $parseurl['scheme']."://".$parseurl['host'].$this->OSLink;
            }
        }
        
    }
    
    public function getUrl() {
        return $this->url;
    }
    
    public function getUrlEncodedUrl() {
        return urlencode($this->url);
    }

    public function getTitle() {
        return $this->title;
    }

    public function getOSLink() {
        return $this->OSLink;
    }


    
}
    