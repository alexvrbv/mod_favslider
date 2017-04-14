<?php 
/**
* @file
* @brief    Responsive Slideshow Module based on FlexSlider 2, the best responsive jQuery slide around.
* @author   FavThemes
* @version  1.2
* @remarks  Copyright (C) 2013 FavThemes (WooThemes for the original script)
* @remarks  Licensed under GNU/GPLv3, see http://www.gnu.org/licenses/gpl-3.0.html
* @see      http://www.favthemes.com/
*/

// no direct access

defined('_JEXEC') or die;

$slidertype = $params->get('slidertype');
$animation = $params->get('animation');
$slideshow = ($params->get('slideshow') == 1) ? 'true' : 'false';
$slideshowspeed = $params->get('slideshowSpeed');
$arrownav = ($params->get('arrowNav') == 1) ? 'true' : 'false';
$controlnav = ($params->get('controlNav') == 1) ? 'true' : 'false';
$keyboardnav = ($params->get('keyboardNav') == 1) ? 'true' : 'false';
$mousewheel = ($params->get('mousewheel') == 1) ? 'true' : 'false';
$randomize = ($params->get('randomize') == 1) ? 'true' : 'false';
$animationloop = ($params->get('animationLoop') == 1) ? 'true' : 'false';
$pauseonhover = ($params->get('pauseOnHover') == 1) ? 'true' : 'false';
$target = $params->get('target');
$jquery = $params->get('jquery');

if ($jquery != 0) {JHTML::script('https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js');}
JHTML::script('modules/mod_favslider/js/jquery.flexslider.js');
JHTML::script('modules/mod_favslider/js/jquery.mousewheel.js');
JHTML::stylesheet('modules/mod_favslider/theme/favslider.css');

if ($jquery == 1 || $jquery == 0) { $noconflict = ''; $varj = '$';}

if ($jquery == "noconflict") {$noconflict = 'jQuery.noConflict();'; $varj = 'jQuery';}

for ($i=1;$i<=200;$i++) {

${'file'.$i} = $params->get('file'.$i);
${'file'.$i.'active'} = $params->get('file'.$i.'active');
${'file'.$i.'link'} = $params->get('file'.$i.'link');
${'file'.$i.'caption'} = $params->get('file'.$i.'caption');

}

?>

<?php 

if ($slidertype == "basic" || $slidertype == "thumbnav") {

echo '<!--[if (IE 7)|(IE 8)]><style type= text/css>.fav-control-thumbs li {width: 24.99%!important;}</style><![endif]-->

<script type="text/javascript">
'.$noconflict.'
'.$varj.'(window).load(function(){
      '.$varj.'(\'.favslider\').favslider({
	animation: "'.$animation.'",
	directionNav: '.$arrownav.',
	keyboardNav: '.$keyboardnav.',
	mousewheel: '.$mousewheel.',
	slideshow: '.$slideshow.',
	slideshowSpeed: '.$slideshowspeed.',
	randomize: '.$randomize.',
	animationLoop: '.$animationloop.',
	pauseOnHover: '.$pauseonhover.',

';

if ($slidertype == "basic") { echo 'controlNav: '.$controlnav.','; } elseif ($slidertype == "thumbnav") { echo 'controlNav: "thumbnails",'; }

echo'  start: function(slider){
       '.$varj.'(\'body\').removeClass(\'loading\');
        }
      });
    });

</script> '; } 

if ($slidertype == "slidernav") {

echo '<style type= text/css>#carousel {margin-top: 3px;}</style><script type="text/javascript">
'.$noconflict.'
    '.$varj.'(window).load(function(){
      '.$varj.'(\'#carousel\').favslider({
        animation: "slide",
        controlNav: false,
	directionNav: '.$arrownav.',
	mousewheel: '.$mousewheel.',
        animationLoop: false,
        slideshow: false,
        itemWidth: 180,
	minItems: 6,
	maxItems: 6,
        asNavFor: \'#slider\'
      });
      
      '.$varj.'(\'#slider\').favslider({
	animation: "'.$animation.'",
	directionNav: '.$arrownav.',
	mousewheel: '.$mousewheel.',
	slideshow: '.$slideshow.',
	slideshowSpeed: '.$slideshowspeed.',
	randomize: '.$randomize.',
	animationLoop: '.$animationloop.',
	pauseOnHover: '.$pauseonhover.',
        controlNav: false,
        sync: "#carousel",
        start: function(slider){
        '.$varj.'(\'body\').removeClass(\'loading\');
        }
      });
    });

</script>'; } 

if ($slidertype == "carousel") {

echo '<script type="text/javascript">
'.$noconflict.'
  '.$varj.'(window).load(function(){
      '.$varj.'(\'.favslider\').favslider({
        animation: "slide",
        animationLoop: false,
        itemWidth: 180,
        minItems: 6,
        maxItems: 6,
	controlNav: '.$controlnav.',
	directionNav: '.$arrownav.',
	keyboardNav: '.$keyboardnav.',
	mousewheel: '.$mousewheel.',
        start: function(carousel){
        '.$varj.'(\'body\').removeClass(\'loading\');
        }
      });
    });


</script>'; } ?>


<?php if ($slidertype == "carousel") { ?>

		<div id="carousel" class="favslider" <?php if ($controlnav == "false") {echo 'style="margin: 0!important;"';}?> >
		    <ul class="favs">
			<?php for ($i=1;$i<=200;$i++) { if (${'file'.$i} && ${'file'.$i.'active'} == 1 && ${'file'.$i} != " ") {?>
		    	<li style="margin-left: 10px;">
		    		<?php if (${'file'.$i.'link'}) { ?> <a href="<?php echo ${'file'.$i.'link'}; ?>" target="_<?php echo $target ?>"><img class="lazy" data-src="/<?php echo ${'file'.$i}; ?>" src="/images/blank.png" /></a><?php } else { ?> <img class="lazy" data-src="/<?php echo ${'file'.$i}; ?>" src="/images/blank.png" /> <?php } ?>
		    		<?php if (${'file'.$i.'caption'}) { ?> <div class="fav-caption"><?php echo ${'file'.$i.'caption'}; ?></div> <?php } ?>
		    	</li>
<?php } }?>
		    </ul>
		</div>

<?php } elseif ($slidertype == "slidernav") { ?>

		<div id="slider" class="favslider" style="">
		    <ul class="favs">
			<?php for ($i=1;$i<=200;$i++) { if (${'file'.$i} && ${'file'.$i.'active'} == 1 && ${'file'.$i} != " ") {?>
		    	<?php $next = $i+1; ?>
				<li>
					<?php if ($i==1 || ${'file'.$next.'active'} == 0) { ?>
					
						<?php if (${'file'.$i.'link'}) { ?>
							<a href="<?php echo ${'file'.$i.'link'}; ?>" target="_<?php echo $target ?>"><img src="/<?php echo ${'file'.$i}; ?>" /></a>
						<?php } else { ?>
							<img src="/<?php echo ${'file'.$i}; ?>" />
						<?php } ?>
						
		    		<?php } else { ?>

						<?php if (${'file'.$i.'link'}) { ?>
							<a href="<?php echo ${'file'.$i.'link'}; ?>" target="_<?php echo $target ?>"><img class="lazy" data-src="/<?php echo ${'file'.$i}; ?>" src="/images/blank.png" /></a>
						<?php } else { ?>
							<img class="lazy" data-src="/<?php echo ${'file'.$i}; ?>" src="/images/blank.png" />
						<?php } ?>					
						
					<?php } ?>				
					
					<?php if (${'file'.$i.'caption'}) { ?>
						<div class="fav-caption"><?php echo ${'file'.$i.'caption'}; ?></div>
					<?php } ?>
		    	</li>
<?php } }?>
		    </ul>
		</div>

		<div id="carousel" class="favslider">
		    <ul class="favs">
			<?php for ($i=1;$i<=200;$i++) { if (${'file'.$i} && ${'file'.$i.'active'} == 1 && ${'file'.$i} != " ") {?>
		    	<li <?php if ($i>1) {?>class="not-first"<?php } ?>>
		    		<img class="lazy" data-src="/<?php echo ${'file'.$i}; ?>" src="/images/blank.png" />
		 
		    	</li>
<?php } }?>
		    </ul>
		</div>

<?php } else { ?>

		<div id="slider" class="favslider basic" <?php if ($slidertype == "slidernav") { ?>style="margin: 0!important;"<?php } ?>>
		    <ul class="favs">
			<?php for ($i=1;$i<=200;$i++) { if (${'file'.$i} && ${'file'.$i.'active'} == 1 && ${'file'.$i} != " ") {?>
		    	<li <?php if ($slidertype == "thumbnav") { ?>data-thumb="<?php echo JURI::base().${'file'.$i}; ?>"<?php } if ($slidertype == "carousel" && $i>1) { ?>style="margin-left: 3px;"<?php } ?> >
		    		<?php if (${'file'.$i.'link'}) { ?> <a href="<?php echo ${'file'.$i.'link'}; ?>" target="_<?php echo $target ?>"><img class="lazy simple" data-src="/<?php echo ${'file'.$i}; ?>" src="/images/blank.png" /></a><?php } else { ?> <img class="lazy simple" data-src="/<?php echo ${'file'.$i}; ?>" src="/images/blank.png" /> <?php } ?>
		    		<?php if (${'file'.$i.'caption'}) { ?> <div class="fav-caption"><?php echo ${'file'.$i.'caption'}; ?></div> <?php } ?>
		    	</li>
<?php } }?>
		    </ul>
		</div>
<?php } ?>

</section>

