<?php

class Util {

    public static function Curl($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    public static function Redirect($searchEngine, $query) {
        $searchEngine = explode('{searchterms}', strtolower($searchEngine));
        $searchEngine[1] = !isset($searchEngine[1]) ? null : $searchEngine[1];
        header('Location: ' . $searchEngine[0] . urlencode($query) . $searchEngine[1], TRUE, 301);
        exit;
    }
    
    public static function getDomain($url) {
        $domain = parse_url($url);
        return $domain['scheme']."://".$domain['host'];
    }

}