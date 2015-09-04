<?php
        require './entities/util.php';
    
        $domain = Util::getDomain($engine);    
	$title = (empty($title) ? $domain : urldecode($title));    
	$description = (empty($description) ? htmlentities('The '.$title.' researchs with the DuckDuckGo\'s !bangs', ENT_XML1) : htmlentities(urldecode($description), ENT_XML1));
	$osSuggestions = (!empty($osSuggestions) ? '<Url type="application/x-suggestions+json" method="GET" template="'.str_replace("&","&amp;",$osSuggestions).'"/>' : '');
	$favicon = str_replace("&","&amp;","https://www.google.com/s2/favicons?domain=".$domain);
	
	echo '<?xml version="1.0" encoding="UTF-8"?>
			<OpenSearchDescription xmlns="http://a9.com/-/spec/opensearch/1.1/" xmlns:moz="http://www.mozilla.org/2006/browser/search/">
				<ShortName>!'.$title.'</ShortName>
				<Description>'.$description.'</Description>
				<InputEncoding>UTF-8</InputEncoding>
				<Image width="16" height="16">'.$favicon.'</Image> 
				'.$osSuggestions.'
                                <Url type="text/html" method="get" template="'.$data['domain'].$data['baseUrl'].'search/'.urlencode($engine).'/{searchTerms}"/>
				<moz:SearchForm>'.$domain.'</moz:SearchForm>
			</OpenSearchDescription>
	';
        
        /*

				<Url type="text/html"
					template="'.$data['domain'].$data['baseUrl'].'search/"
					method="POST"
					enctype="application/x-www-form-urlencoded">
					<Param name="q" value="{searchTerms}"/>
					<Param name="e" value="'.urlencode($engine).'"/>
				</Url>
         */