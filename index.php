<?php

if (!file_exists(__DIR__ . '/vendor/autoload.php')) {
  throw new \Exception('please run "composer require google/apiclient:~2.0" in "' . __DIR__ .'"');
}

require_once __DIR__ . '/vendor/autoload.php';


// Home Page
$htmlBody = <<<END
<div class="cover">
<div class="cover-image" style="background-image: url(../images/warm-forest.jpg);"></div>
  <div class="container" id="transbox">
    <div class="row">
      <div class="col-md-12 text-center">
      
        <h1 class="text-danger">Search Youtube</h1>
        <p style="color:ghostwhite">for some tunes.</p>
        <br>
        <form method="GET">
          <div>
            <input id="q" name="q" type="search" style="width:300px;border:3px;">
            <br>
            <input type="submit" value="Search" class="btn btn-lg btn-primary" style="margin-top:8px;margin-bottom: 10px;">
          </div>
        </form>

      </div>
    </div>
  </div>
</div>
END;

if (isset($_GET['q'])) {

  $DEVELOPER_KEY = 'AIzaSyAC_rpyXrSMyM_hZDOGggkOoBQtemVC9lY';

  $client = new Google_Client();
  $client->setDeveloperKey($DEVELOPER_KEY);

  $youtube = new Google_Service_YouTube($client);

  $htmlBody = '';
  try {

    $searchResponse = $youtube->search->listSearch('id,snippet', array(
      'type' => 'video',
      'q' => $_GET['q'],
      // TODO: Check out the relatedToVideoId for playlists or related vids
      'maxResults' => 10,
    ));

    $videos = '';

    foreach ($searchResponse['items'] as $searchResult) {
      switch ($searchResult['id']['kind']) {
        case 'youtube#video':
          $videos .= sprintf(
          '<li>
          <input type="checkbox" name="cBox" value="https://www.youtube.com/watch?v=%1$s">
          <span hidden="true">%1$s</span>
          <a href="https://www.youtube.com/watch?v=%1$s" target="_blank">%2$s</a>
          </li>',
              $searchResult['id']['videoId'], $searchResult['snippet']['title']);
          break;
      }
    }

// Results Page
    $htmlBody .= <<<END
    <div class="cover" id="resultsSection">
      <div class="cover-image" style="background-image: url(../images/utah.jpg);"></div>
      
        <div class="container" id="transbox">
          <div id="res_box" >
              <ul style="list-style: none;">$videos</ul>
          </div>

          <div id="btn_box" >
              <a id="btnReturn" class="btn btn-sm btn-primary" href="/" >New Search</a>

              <button id="btnAll" class="btn btn-sm btn-info" onclick="selectCheck('ALL')" >Select All</button>

              <button id="btnNone" class="btn btn-sm btn-danger" onclick="selectCheck('NONE')" >Select None</button>

              <button id="btnDown" class="btn btn-lg btn-success" onclick="beginDownload()" >Download</button>
          </div>
        </div>

        <div id="feedback">
        
        </div>

      </div>
    </div>
END;
  } catch (Google_Service_Exception $e) {
    $htmlBody .= sprintf('<p>A service error occurred: <code>%s</code></p>',
      htmlspecialchars($e->getMessage()));
  } catch (Google_Exception $e) {
    $htmlBody .= sprintf('<p>An client error occurred: <code>%s</code></p>',
      htmlspecialchars($e->getMessage()));
  }
}

?>

<!doctype html>
<html>
  <head>
    <title>Search YouTube</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--<script type="text/javascript" src="http://netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>-->
    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script type="text/javascript" src="js/magic.js"></script>

    <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="/css/main.css" rel="stylesheet" type="text/css">
    <link href="/css/my_bootstrap.css" rel="stylesheet" type="text/css">    
  </head>
  <body>
    <script src="js/fokus.js"></script>
    <?=$htmlBody?>
  </body>
</html>
