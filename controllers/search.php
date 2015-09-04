<?php

require './entities/util.php';
if (strpos($query, "!") !== false) {
    $result = json_decode(Util::Curl("https://api.duckduckgo.com/?q=" . urlencode($query) . "&format=json"), true);
    if (!empty($result["Redirect"])) {
        header('Location: ' . $result["Redirect"], TRUE, 301);
        exit;
    } else {
        Util::Redirect($searchEngine, $query);
    }
} elseif (strpos($query, "&") !== false) {
    $re = "/(^|.*)(\\&\\w+)($|\\s(.*))/";
    if (preg_match($re, $query, $matches) == 1) {
        $result = json_decode(Util::Curl("https://api.qwant.com/api/suggest?q=" . urlencode($matches[2])));
        foreach ($result->data->items as $item) {
            if ($item->value == $matches[2]) {
                $query = (isset($matches[4]) ? $matches[1] . $matches[4] : $matches[1]);
                Util::Redirect($item->command_url, $query);
                break;
            }
        }
        Util::Redirect($searchEngine, $query);
    } else {
        Util::Redirect($searchEngine, $query);
    }
} else {
    Util::Redirect($searchEngine, $query);
}