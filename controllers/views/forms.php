<?php

echo "
    <h1>Create a <a href='https://duckduckgo.com/'>DuckDuckGo</a>'s <a href='https://duckduckgo.com/bang'>!Bangs</a> compatible search box from any search engine!</h1>
    <p>
        Now compatible with the <a href='https://www.qwant.com/qwick'>&Qwicks</a> from <a href='https://www.qwant.com/'>Qwant</a>!
    </p>
    <a href='https://duckduckgo.com/'><img class='logo' alt='duckduckgo-logo' src='".$data['domain'].$data['baseUrl']."public/img/duckduckgo.png'/></a>
    <a href='https://www.qwant.com/'><img class='logo' alt='qwant-logo' src='".$data['domain'].$data['baseUrl']."public/img/qwant.png'/></a>
";


if(isset($data["url"])) {
    echo "
        <div class='alert alert-warning alert-dismissible' role='alert'>
          <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
          <span class='bold'>Be careful:</span> it seems that you came here from a custom URL. Be sure you came from a trustful source otherwise validating this form may betray your privacy.
        </div>
";
}

echo
"
    <div class='well'>
        <form method='post' action='/'>
          <div class='form-group'>
            <label for='inputUrl'>Search URL:</label>
            <input type='url' name='content' class='form-control' id='inputUrl' placeholder='https://www.google.com/search?q={SearchTerms}'";
if(isset($data["url"])) {echo " value='".$data["url"]."'";}
echo "/>
            <input type='hidden' name='type' value='url'/>
          </div>
          <div id='formButton'>
            <div class='checkbox'>
                  <label><input type='checkbox' name='ddgSuggestions' checked='checked'> Use DuckDuckGo's suggestions if none found</label>
            </div>
            <button type='submit' class='btn btn-default'>Submit</button>
          </div>
          <div id='permalink'><span class='bold'>Permalink for this URL:</span><br/><input class='form-control'/></div>
        </form>
        <div class='clearfix'>
            <span class='bold'>Examples:</span>
            <img class='example' src='https://www.google.com/s2/favicons?domain=https://duckduckgo.com' alt='DuckDuckGo-example' data-example='https://duckduckgo.com/?q={SearchTerms}'/>
            <img class='example' src='https://www.google.com/s2/favicons?domain=https://startpage.com' alt='Startpage-example' data-example='https://startpage.com/do/metasearch.pl?query={SearchTerms}'/>
            <img class='example' src='https://www.google.com/s2/favicons?domain=https://www.google.com' alt='Google-example' data-example='https://www.google.com/search?q={SearchTerms}'/>
            <img class='example' src='https://www.google.com/s2/favicons?domain=http://search.yahoo.com' alt='Yahoo-example' data-example='http://search.yahoo.com/search?p={SearchTerms}'/>
            <img class='example' src='https://www.google.com/s2/favicons?domain=https://www.bing.com/' alt='Bing-example' data-example='https://www.bing.com/search?q={SearchTerms}'/>
            <img class='example' src='https://www.google.com/s2/favicons?domain=https://searx.me/' alt='Searx-example' data-example='https://searx.me/?q={SearchTerms}'/>
            <img class='example' src='https://www.google.com/s2/favicons?domain=https://www.qwant.com/' alt='Qwant-example' data-example='https://www.qwant.com/?q={SearchTerms}'/>
            <br/>
            <span class='small'>For your security, privacy and respect, all logs have been deactivated.</span><br/>
            <span class='small right'><a href='/about'>What is this about?</a></span>
        </div>
     </div>
     <button type='submit' class='btn btn-info' id='buttonMoreForm' data-text='more' >More options</button>
";

echo
"
    <div class='well' id='moreForm'>
        <form method='post' action='/'>
          <div class='form-group'>
            <label for='inputOpenSearchUrl'>OpenSearch URL:</label>
            <input type='url' name='content' class='form-control' id='inputOpenSearchUrl' placeholder='https://search.yahoo.com/opensearch.xml'>
            <input type='hidden' name='type' value='XMLurl'/>
          </div>
          <button type='submit' class='btn btn-default'>Submit</button>
        </form>
        <hr/>
        <form method='post' action='/'>
          <div class='form-group'>
            <label for='textareaOpenSearch'>OpenSearch file:</label>
            <textarea class='form-control' id='textareaOpenSearch' name='content'>Paste an OpenSearch XML file here</textarea>
            <input type='hidden' name='type' value='xml'/>
          </div>
          <button type='submit' class='btn btn-default'>Submit</button>
        </form>
     </div>
";