<?php

require 'vendor/autoload.php';

$app = new \Slim\Slim(array(
    'debug' => true,
    'templates.path' => './controllers',
));

$app->view->parserOptions = array(
    'charset' => 'utf-8',
    'cache' => realpath('./cache'),
    'auto_reload' => true,
    'strict_variables' => false,
    'autoescape' => true
);

$header = array('file' => 'header.php', 'params' => array("title" => "!Bangs", "description" => "Add the !Bang effect to your favourite search engine!", "content" => ""));
$favicon = '<link rel="icon" type="image/png" href="https://www.google.com/s2/favicons?domain=http://duckduckgo.com"/>';
$domain = 'https://bangs.bonduel.net/';

$app->hook('slim.before', function () use ($app, $domain) {
            $app->view()->appendData(array('baseUrl' => ''));
            $app->view()->appendData(array('domain' => $domain));
        });

$app->post('/', function () use ($app, $header) {
            $ddgSuggestion = $app->request->post('ddgSuggestions') == "on" ? true : false;
            $app->render('generate.php', array('app' => $app, 'type' => $app->request->post('type'), 'ddgSuggestion' => $ddgSuggestion, 'content' => $app->request->post('content'), 'header' => $header));
       });

$app->get('/', function () use ($app, $header, $favicon, $domain) {

            if(!isset($_SERVER['HTTPS']) || (empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'off')) {
                header("HTTP/1.1 301 Moved Permanently"); 
                header("Location: ".$domain); 
                die();
            }
            
            $header['params']['content'] .= $favicon;
            $app->render('template.php', array('app' => $app, 'content' => array('nav' => 'home', 'file' => 'forms.php', 'params' => array()), 'header' => $header));
        });

$app->get('/su/:url', function ($url) use ($app, $header, $favicon) {            
            $header['params']['content'] .= $favicon;
            $app->render('template.php', array('app' => $app, 'content' => array('nav' => 'home', 'file' => 'forms.php', 'params' => array('url' => htmlspecialchars($url, ENT_QUOTES, 'UTF-8'))), 'header' => $header));
        });

$app->get('/about', function () use ($app, $header, $favicon) {
            $header['params']['content'] .= $favicon;
            $app->render('template.php', array('app' => $app, 'content' => array('nav' => 'about', 'file' => 'about.php', 'params' => array()), 'header' => $header));
        });
        
$app->get('/demo', function () use ($app, $header, $favicon) {
            $header['params']['content'] .= $favicon;
            $app->render('template.php', array('app' => $app, 'content' => array('nav' => 'demo', 'file' => 'demo.php', 'params' => array()), 'header' => $header));
        });

$app->get('/search/:e/:q', function ($e, $q) use ($app) {
            $app->render('search.php', array('searchEngine' => $e, 'query' => $q));
        });

$app->get('/opensearch.xml/:engine(/:title(/:description(/:osSuggestions)))', function ($engine, $title = null, $description = null, $osSuggestions = null) use ($app) {
            $app->response->headers['Content-Type'] = 'text/xml';
            $title = $title == "null" ? null : $title;
            $description = $description == "null" ? null : $description;
            $osSuggestions = $osSuggestions == "null" ? null : $osSuggestions;
            $app->render('search.xml.php', array("engine" => $engine, "title" => $title, "description" => $description, "osSuggestions" => $osSuggestions));
        });

$app->run();