<?php
/**
 * @version    CVS: 1.0.6
 * @package    Com_Sbm_careers
 * @author     John Komu <maurice.cheruiyot@wpp-scangroup.com>
 * @copyright  Copyright (C) 2014. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */
// No direct access
defined( '_JEXEC' ) or die;

$categoryid = $this->category->id; ?>
<?php
  // Accessing the params object
$params = $this->category->params;

// Converting the params object to an associative array
$paramsArray = json_decode(json_encode($params), true);

// Getting the image path
$imagePath = isset($paramsArray['image']) ? $paramsArray['image'] : '';

$title = $this->category->title;

$description = $this->category->description;

$cat_logo = $imagePath;

?>

<div id="podcasts-page" class="web-wrapper">
<?php
	$db    = JFactory::getDbo();
	$query = $db->getQuery( true );
	$query->select( '*' );
	$query->from( $db->quoteName( '#__content' ) );
	$query->where( $db->quoteName( 'catid' ) . "=" . $db->quote( (int) $this->category->id ) );
	$query->where( $db->quoteName( 'state' ) . " = " . $db->quote( (int) 1 ) );
	$db->setQuery( $query );
	$db->execute();
	$num_rows   = $db->getNumRows();
	$podcasts = $db->loadObjectList();
	foreach($podcasts as $podcast){
      $imageObject = $podcast->images;
      $images = json_decode($imageObject);
      $image_intro = $images->image_intro;
      $title = $podcast->title;
      $introtext = $podcast->introtext;
      $allurls = $podcast->urls;
      $urls = json_decode($allurls);
      $link = $urls->urlatext;
    }
?>
  <style>
  .child_four{
 /* display:flex;*/
  width: 100%;
  height: 580px;
  display: flex;
  justify-content:left;
  /*align-items: center;*/
  overflow:hidden;
  position:relative;
  scroll-behavior: smooth;
}
.wrapper{
      padding: 0 90px;
}
.wrapper h3{
     font-style: normal;
    font-weight: 700;
    font-size: 32px;
    line-height: 39px;
    color: #032F6F;
    margin: 30px 12px;
  border-bottom:2px solid green;
  padding-bottom:10px;
}
.child_four .item {
    min-width: 275px;
    height: 100%;
    margin: 2px 15px 2px 0px;
    cursor: pointer;
    overflow: hidden;
   /* background: linear-gradient(180deg, rgba(0, 0, 0, 0) 28.65%, rgba(0, 0, 0, 0.67) 100%);*/
    border-radius: 10px;
    color: black;
   /* padding-top: 15px;*/
    width: 300px;
    background-size: 100% 100%;
}
.item .img_container {
   min-width: 275px;
   min-height: 200px;
}
.item .img_container .img_container_image{
  min-width: 275px;
   height: 200px !important;
   object-fit: cover;
}
.img_container_title{
  font-weight:600;
  color: #032F6F;
  padding:10px 0;
  height: 70px;
}
.img_container_content{
  color:#1DB2E4;
}
.img_conatiner_button{
  padding:10px 20px;
  background-color:#ffa500; 
  color:white; 
  font-weight:600; 
  border:none; 
  border-radius:6px;
}

.icon{
    color: #032F6F;
    background-color: white;
    font-size: 30px;
    outline: none;
    border: none;
    padding: 0px 10.5px;
    cursor: pointer;
    border-radius: 50%;
    box-shadow: 2px 2px 8px .5px #888888;
}
.cover{
    position: relative;
}

 .child_four .left{
  position:absolute;
  top:50%;
  left:70px;
}
 .child_four .right{
  position:absolute;
  top:50%;
  right:70px;
}
/*...................child_five...................*/
.child_five{
  /* display:flex;*/
  width: 100%;
  height: 580px;
  display: flex;
  justify-content:left;
  /*align-items: center;*/
  overflow:hidden;
  position:relative;
  scroll-behavior: smooth;
}
.child_five .item {
    min-width: 275px;
    height: 100%;
    margin: 2px 15px 2px 0px;
    cursor: pointer;
    overflow: hidden;
   /* background: linear-gradient(180deg, rgba(0, 0, 0, 0) 28.65%, rgba(0, 0, 0, 0.67) 100%);*/
    border-radius: 10px;
    color: black;
   /* padding-top: 15px;*/
    width: 300px;
    background-size: 100% 100%;
}



/*.left_button{
  position:absolute;
  top:50%;
  left:70px;
}
.right_button{
  position:absolute;
  top:50%;
  right:70px;
}*/
 </style>
   
<div>
  
   <img class="img_container_image" src="<?php echo $cat_logo ?>" alt="image intro">
</div>
   <div class="wrapper">
        <h3>PREVIOUS EPISODES</h3>
  <?php //print_r($image_intro);?>
          <?php //print_r($keys); ?>
          <?php //print_r($searchnews); ?>
          <?php //print_r($year); ?>
        <div class="scroll-items">
            <div class="cover">
                <div class="child_four">
                    <?php foreach($podcasts as $podcast) : ?>
                        <?php
                      		$imageObject = $podcast->images;
                            $images = json_decode($imageObject);
                            $image_intro = $images->image_intro;
                      	?>
                         <div class="item">
                          <div class="img_container">
                          	<img class="img_container_image" src="<?php echo $image_intro ?>" alt="image intro">
                          </div>
								
  							<div>
                          	<p class="img_container_title"><?php echo $podcast->title; ?></p>
                              <div class="img_container_content"><?php echo $podcast->introtext; ?></div>
                                <a href=`<?php echo $podcast->urlatext ?>`><button class="img_conatiner_button" >PLAY EPISODE <span><i class="fa-regular fa-circle-play"></i></span></button></a>
                          	</div>
                            </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div>
                <button onclick="scrollleft4()" class="icon left"><i class="fa fa-angle-left"></i></button>
            </div>
            <div>
                <button onclick="scrollright4()" class="icon right"><i class="fa fa-angle-right"></i></button>
            </div>
      
                      
       <!--..........................Blog Post....................-->
    
        <h3>BLOG POST</h3>
  <?php //print_r($image_intro);?>
          <?php //print_r($keys); ?>
          <?php //print_r($searchnews); ?>
          <?php //print_r($year); ?>
        <div class="scroll-items">
            <div class="cover">
                <div class="child_five">
                    <?php foreach($podcasts as $podcast) : ?>
                        <?php
                      		$imageObject = $podcast->images;
                            $images = json_decode($imageObject);
                            $image_intro = $images->image_intro;
                      	?>
                         <div class="item">
                          <div class="img_container">
                          	<img class="img_container_image" src="<?php echo $image_intro ?>" alt="image intro">
                          </div>
								
  							<div>
                          	<p class="img_container_title"><?php echo $podcast->title; ?></p>
                              <div class="img_container_content"><?php echo $podcast->introtext; ?></div>
                                <button class="img_conatiner_button" >PLAY EPISODE <span><i class="fa-regular fa-circle-play"></i></span></button>
                          	</div>
                            </div>
                    <?php endforeach; ?>
                </div>
            </div>
                           <div>
                <button onclick="scrollleft5()" class="icon left_button"><i class="fa fa-angle-left"></i></button>
            </div>
            <div>
                <button onclick="scrollright5()" class="icon right_button"><i class="fa fa-angle-right"></i></button>
            </div>
        </div>
  		</div>
 <!--Instagram Feeds Starts Here-->              
<script src="https://apps.elfsight.com/p/platform.js" defer></script>
          <section class="wrapper insta-section-sbm5">
            <div class="inner-insta-container">
              <div class="elfsight-app-ca227d2a-b2e6-4a26-863a-23123ee796df"></div>
            </div>
          </section>
<!--Instagram Feeds Ends Here-->               
</div>
<script>
  setTimeout(function(){
    var link = document.querySelector('a[href*="https://elfsight.com/instagram-feed-instashow/"]');
    link.style.display = 'none';
  },3500); 
</script>
  <script type="text/javascript">
    var left_div_4 = document.querySelector(".child_four");
	var left_div_5 = document.querySelector(".child_five");
    function scrollleft4() {
        left_div_4.scrollBy(-280, 0)
    }

    function scrollright4() {
        left_div_4.scrollBy(280, 0)
    }
	function scrollleft5() {
        left_div_5.scrollBy(-280, 0)
    }

    function scrollright5() {
        left_div_5.scrollBy(280, 0)
    }

   
</script>

