<?php

echo '
	<meta charset="utf-8">
        <title>' . $data["title"] . '</title>
        <meta name="description" content="Create a DuckDuckGo\'s !Bangs compatible search box from any search engine!">
        <meta name="keywords" content="DuckDuckGo, Bangs, Qwicks, Qwant">
        <meta name="author" content="Nicolas Bonduel">
	<meta name="description" content="' . $data["description"] . '">
	' . $data["content"] . '
';
