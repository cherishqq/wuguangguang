<?php 
/**
Template Page for the gallery overview

Follow variables are useable :

	$gallery     : Contain all about the gallery
	$images      : Contain all images, path, title
	$pagination  : Contain the pagination content

 You can check the content when you insert the tag <?php var_dump($variable) ?>
 If you would like to show the timestamp of the image ,you can use <?php echo $exif['created_timestamp'] ?>
**/
?>
<?php if (!defined ('ABSPATH')) die ('No direct access allowed'); ?><?php if (!empty ($gallery)) : ?>

<ul class="list_img_five">
  <?php foreach ( $images as $image ) : ?>
	 <li>
	 <a href="<?php echo $image->imageURL?>" target="_blank" style="opacity: 0.65; top: 120px;"> <?php echo $image->description ?> </a>
	 <img src="<?php echo $image->imageURL?>">	 
	 </li>
  <?php endforeach; ?>
	
</ul>


<?php endif; ?>
