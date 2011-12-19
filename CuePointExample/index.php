<?php

//Configuration for script

$entryId = '1_2v0sdf'; // Change to your entry ID
$partnerId = 1234; // Change to your partner ID
$email = 'Yourmail@exmaple.com';  //Add your KMC login Email
$password = 'YourPass1!';  //Add your kmc login password
$baseURL = "/Entry/Full/Url"; //Change to the base url of your entry
$uiConfId = '12345'; // Add your UI conf ID here

//Configuration for script

$currentChapterNum = isset($_GET['chapter']) ? $_GET['chapter'] : 0; // 

if ($currentChapterNum != 0)
{
	$currentChapterNum = substr($currentChapterNum, 0, 1);
}

require_once('kalturaLib/KalturaClient.php');
$config = new KalturaConfiguration();
$config->serviceUrl = 'http://www.kaltura.com'; 
$config->partnerId = $partnerId;
$client = new KalturaClient($config);
$AdminKs = $client->user->loginByLoginId($email, $password, $partnerId);
$client->setKs($AdminKs);

//Get all Cue points
$filter = new KalturaCuePointFilter();
$filter->entryIdEqual = $entryId;
$pager = null;
$results = $client->cuePoint->listAction($filter, $pager);

$cuePoints = $results->objects;
usort($cuePoints, "cmp");

if(isset($cuePoints[$currentChapterNum]))
	$currentCuePoint = $cuePoints[$currentChapterNum];
else
	$currentCuePoint = reset($cuePoints);

function cmp($a, $b) {
   if ($a->startTime == $b->startTime)
       return 0;
   else
      return ($a->startTime < $b->startTime ? -1 : 1);
}

function formatTime($secs) {
   $times = array(3600, 60, 1);
   $time = '';
   $tmp = '';
   for($i = 0; $i < 3; $i++) {
      $tmp = floor($secs / $times[$i]);
      if($tmp < 1) {
         $tmp = '00';
      }
      elseif($tmp < 10) {
         $tmp = '0' . $tmp;
      }
      $time .= $tmp;
      if($i < 2) {
         $time .= ':';
      }
      $secs = $secs % $times[$i];
   }
   return $time;
}

?>
<!DOCTYPE html>
<html>
  <head>
    <title></title>
       <link href="<?php echo $baseURL;?>style.css" rel="stylesheet" type="text/css">
       <script type="text/javascript" src="http://www.kaltura.com/p/<?php echo $partnerId; ?>/sp/<?php echo $partnerId; ?>00/embedIframeJs/uiconf_id/<?php echo $uiConfId; ?>/partner_id/<?php echo $partnerId; ?>"></script>
	   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
  </head>
  <body>
	<div style="text-align:left; width:768px; padding-left: 300px;">
	   <h1> The Social Enterprise <h1>
	   <h2 id="ctitle">Chapter #<?php echo $currentChapterNum ?> : <?php echo $currentCuePoint->description; ?></h2>
	   Chapter Thumbnail <img id="cimage" src="<?php echo 'http://cdn.kaltura.com/p/'.$partnerId.'/sp/'.$partnerId.'00/thumbnail/entry_id/'.$entryId.'/version/100000/vid_sec/'.$currentCuePoint->startTime / 1000; ?>" />
	   <p id="ctags">Chapter Tags: <?php echo $currentCuePoint->tags; ?><p>
	</div>
	</br>
       <div id="wrapper" style="width:1000px;">
	   
	   <!-- Paste your player here using Embedd from KMC or change the values at top-->
              <object id="kdp" name="kdp" style="float:left;" type="application/x-shockwave-flash" allowfullscreen="true" allownetworking="all" allowscriptaccess="always" height="333" width="400" bgcolor="#000000" xmlns:dc="http://purl.org/dc/terms/"
              xmlns:media="http://search.yahoo.com/searchmonkey/media/" rel="media:video" 
			  resource="http://www.kaltura.com/index.php/kwidget/cache_st/765234/wid/<?php echo '_'.$partnerId; ?>/uiconf_id/<?php echo $uiConfId; ?>/entry_id/<?php echo $entryId;?>" 
			  data="http://www.kaltura.com/index.php/kwidget/cache_st/765234/wid/<?php echo '_'.$partnerId; ?>/uiconf_id/<?php echo $uiConfId; ?>/entry_id/<?php echo $entryId;?>">
              <param name="allowFullScreen" value="true" />
                <param name="allowNetworking" value="all" />
                <param name="allowScriptAccess" value="always" />
                <param name="bgcolor" value="#000000" />
                <param name="flashVars" value="getCuePointsData=true&externalInterfaceDisabled=false&autoPlay=false" />
                <param name="movie" value="http://www.kaltura.com/index.php/kwidget/cache_st/765234/wid/<?php echo '_'.$partnerId; ?>/uiconf_id/<?php echo $uiConfId; ?>/entry_id/<?php echo $entryId;?>" />
              </object>
              <div style="width:500px;float:left;margin-left:20px;">
                     <h1>Video Chapters</h1>
                     <ul id="chapters">
                        <?php foreach ($cuePoints as $key => $cp) : ?>
						   <li><a id="<?php echo 'cp'.$cp->id; ?>" data-chapterTitle="Chapter #<?php echo $key ?> : <?php echo $cp->description; ?>" data-chapterThumb="<?php echo 'http://cdn.kaltura.com/p/'.$partnerId.'/sp/'.$partnerId.'00/thumbnail/entry_id/'.$entryId.'/version/100000/vid_sec/'.$cp->startTime / 1000; ?>" data-chapterName="<?php echo $baseURL.'social-enterprise/'.$key.'-'.str_replace(' ', '-', $cp->description); ?>" data-chapterTags="<?php echo $cp->tags; ?>" data-chapterStartTime="<?php echo $cp->startTime;?>" href="<?php echo $baseURL.'social-enterprise/'.$key.'-'.str_replace(' ', '-', $cp->description); ?>" ><?php echo '['.formatTime($cp->startTime/1000).'] : ' . $cp->description; ?></a></li>
						<?php endforeach; ?>
                     </ul>
              </div>
       </div>
  </body>
  <script src="<?php echo $baseURL;?>cuePoint.js"></script>
</html>