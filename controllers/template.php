<?php
echo
"	
<!DOCTYPE html>
<html>
    <head>
";

echo $data['app']->render("views/".$data['header']['file'], $data['header']['params']);

echo
"
    <!-- Latest compiled and minified CSS -->
    <link rel='stylesheet' href='".$data['domain'].$data['baseUrl']."public/vendor/bootstrap.min.css'>

    <!-- Optional theme -->
    <link rel='stylesheet' href='".$data['domain'].$data['baseUrl']."public/vendor/bootstrap-theme.min.css'>
    
    <link rel='stylesheet' href='".$data['domain'].$data['baseUrl']."public/css/style.css'>
    </head>
    <body>
    
    <nav class='navbar navbar-inverse navbar-fixed-top'>
      <div class='container'>
        <div class='navbar-header'>
          <button type='button' class='navbar-toggle collapsed' data-toggle='collapse' data-target='#navbar' aria-expanded='false' aria-controls='navbar'>
            <span class='sr-only'>Toggle navigation</span>
            <span class='icon-bar'></span>
            <span class='icon-bar'></span>
            <span class='icon-bar'></span>
          </button>
          <a class='navbar-brand' href='/'>!Bangs Everywhere</a>
        </div>
        <div id='navbar' class='collapse navbar-collapse'>
          <ul class='nav navbar-nav'>
            <li".($data['content']['nav'] == "home" ? " class='active' " : "")."><a href='/'>Home</a></li>
            <li".($data['content']['nav'] == "about" ? " class='active' " : "")."><a href='/about'>About</a></li>
            <li".($data['content']['nav'] == "demo" ? " class='active' " : "")."><a href='/demo'>Demonstration</a></li>
            <li><a href='http://nicolas.bonduel.net'>Contact</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class='container'>

      <div class='content'>
";

echo $data['app']->render("views/".$data['content']['file'], $data['content']['params']);

echo
"
     </div>
    <a href='http://nicolas.bonduel.net/'>Nicolas Bonduel</a> - 2015
    </div><!-- /.container -->
    <!-- Piwik -->
    <script type='text/javascript'>
      var _paq = _paq || [];
      _paq.push(['trackPageView']);
      _paq.push(['enableLinkTracking']);
      (function() {
        var u='https://bangs.bonduel.net/piwik/';
        _paq.push(['setTrackerUrl', u+'piwik.php']);
        _paq.push(['setSiteId', 3]);
        var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
        g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
      })();
    </script>
    <noscript><p><img src='https://bangs.bonduel.net/piwik/piwik.php?idsite=3' style='border:0;' alt='' /></p></noscript>
    <!-- End Piwik Code -->

    <script src='".$data['domain'].$data['baseUrl']."public/vendor/jquery-2.1.4.min.js'></script>
    <script src='".$data['domain'].$data['baseUrl']."public/vendor/bootstrap.min.js'></script>
    ".($data['content']['nav'] == "home" ? " <script src='".$data['domain'].$data['baseUrl']."public/javascript/script.js'></script> " : "")."
    </body>
</html>
";