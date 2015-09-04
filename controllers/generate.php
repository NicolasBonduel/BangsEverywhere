<?php

require './entities/OpenSearch.php';
require './entities/Crawl.php';
require './entities/util.php';

switch ($data['type']) {
    case "xml" :
        try {
        $openSearch = new OpenSearch(array("content" => $data['content'], "type" => $data['type']));
        $url = $openSearch->getUrlEncodedUrl();
        } catch(Exception $e) {
            header("Location: /");
            exit;
        }
        break;
    case "XMLurl" :
        try {
            $openSearch = new OpenSearch(array("content" => $data['content'], "type" => $data['type']));
            $url = $openSearch->getUrlEncodedUrl();
        } catch(Exception $e) {
            header("Location: /");
            exit;
        }
        break;
    case "url" :
        try {
            $crawl = new Crawl($data['content']);
            $OpenSearchArray = array("content" => $crawl->getOSLink(), "type" => $data['type'], "title" => $crawl->getTitle());
            if($data['ddgSuggestion']) {
                $OpenSearchArray["osSuggestions"] = "https://ac.duckduckgo.com/ac/?q={searchTerms}&type=list";
            }
            $openSearch = new OpenSearch($OpenSearchArray);
            $url = $crawl->getUrlEncodedUrl();
        } catch(Exception $e) {
            header("Location: /");
            exit;
        }
        break;
}



$xmlUrl = $data['baseUrl'] . 'opensearch.xml/' . $url;
if (isset($openSearch)) {
    if (($openSearch->getTitle())) {
        $xmlUrl.='/' . $openSearch->getUrlEncodedTitle();
    } else {
        $xmlUrl.='/null';
    }

    if (($openSearch->getDescription())) {
        $xmlUrl.='/' . $openSearch->getUrlEncodedDescription();
    } else {
        $xmlUrl.='/null';
    }

    if (($openSearch->getOsSuggestions())) {
        $xmlUrl.='/' . $openSearch->getUrlEncodedOsSuggestions();
    } else {
        $xmlUrl.='/null';
    }

} elseif ($crawl->getTitle()) {
    $xmlUrl.='/' . $url;
}


$data['header']['params']['content'] = '
            <link rel="icon" type="image/png" href="'."https://www.google.com/s2/favicons?domain=".  Util::getDomain(urldecode($url)).'"/>
            <link rel="search" type="application/opensearchdescription+xml" title="!' . $openSearch->getTitle() . '" href="' . $xmlUrl . '"/>
            <script>window.external.AddSearchProvider("'.$data['domain'].$xmlUrl.'");</script>
    ';

$data['app']->render('template.php', array('app' => $data['app'], 'content' => array('nav' => 'home', 'file' => 'forms.php', 'params' => array()), 'header' => $data['header']));