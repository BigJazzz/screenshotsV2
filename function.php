<?php
function image_height($image) {
	list($width, $height, $type, $attr) = getimagesize($image);
	return $height;
}
?>
