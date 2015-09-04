<?php

echo
"
    <div class='well'>
        <h2>What is this about?</h2>
        <p>
            Do you know about the <a href='https://duckduckgo.com/bang'>!Bangs</a> from <a href='https://duckduckgo.com/'>DuckDuckGo</a>? It's a shortcut for your online searches.<br/>
            The example from DuckDuckGo is that if you search for <span class='bold'>!amazon shoes</span>, DuckDuckGo will take you right to an Amazon search for shoes on Amazon.com.<br/>
            Now, this website allows you to add this functionality to almost every search engine you want. Wouldn't that be great to have this functionnality on Google or Startpage?<br/>
        </p>
        <hr/>
        <h2>How does it work?</h2>
        <p>
            You have, in your web browser, a search box that redirects you to a search engine. Behind this search box, there is a standard called <a href='https://en.wikipedia.org/wiki/OpenSearch'>OpenSearch</a>.<br/>
            According to Wikipedia, \"OpenSearch is a collection of technologies that allow publishing of search results in a format suitable for syndication and aggregation. It is a way for websites and search engines to publish search results in a standard and accessible format.\"<br/>
            So basically, a search engine will deliver to your browser an \"OpenSearch\" file with all the information needed for your browser to accept and use it.<br/>
            This website fetches information from the given website, and then it proceeds to create a new OpenSearch file. In this OpenSearch file, I replace the website you gave to this website, and encoded in the link, information about the search engine you actually want as default.<br/>
            This way, I can easily either redirect you to the search engine you wanted, either redirect you to the !bang or &qwick you looked for:<br/>
            <span class='diagram'>
                <img alt='swquence diagram' src='https://www.websequencediagrams.com/cgi-bin/cdraw?s=magazine&m=web%20browser-%3E%2Bbangs.bonduel.net%3A%20Query%5Cn[Search%20terms%20%2B%20Search%20engine%20URL]%0A%0Aalt%20if%20!Bang%20or%20%26Qwick%20detected%20in%20the%20Search%20terms%0A%20%20%20%20note%20over%20APIs%3A%20Either%20DuckDuckGo%27s%5Cnor%20Qwant%27s%20API%0A%20%20%20%20bangs.bonduel.net-%3E%2BAPIs%3A%20API%20Call%0A%20%20%20%20APIs-%3E-bangs.bonduel.net%3A%20API%20answer%0A%20%20%20%20bangs.bonduel.net-%3Eweb%20browser%3A%20Redirect%20to%20the%20URL%20the%20API%20returned%0Aelse%20else%0A%20%20%20%20bangs.bonduel.net-%3E-web%20browser%3A%20Redirect%20to%20the%20Search%20engine%20URL%20with%5Cnthe%20search%20terms%20as%20a%20parameter%0Aend%0A' />
            </span>
            Here is a Qwant's OpenSearch file dump, if you want to take a look : <a href='http://pastebin.com/HXYvVjPn'>http://pastebin.com/HXYvVjPn</a><br/>
            Consider using directly the OpenSearch files in the \"more options\" category, you'll have better OpenSearch file and you're assured to have the suggestions for example (that is not always the case by pasting just the URL).
        </p>
        <hr/>
        <h2>How do you know where to redirect?</h2>
        <p>
            For DuckDuckGo, I'm using their official API : <a href='https://duckduckgo.com/api'>https://duckduckgo.com/api</a> <br/>
            For Qwant, I'm using their unofficial API : <a href='https://api.qwant.com/api/suggest?q=%26'>https://api.qwant.com/api/suggest?q=&</a>
        </p>
        <hr/>
        <h2>What about my privacy?</h2>
        <p>
            No worries, I do not log any search you're making.
        </p>
     </div>
";