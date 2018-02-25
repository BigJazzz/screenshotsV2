<?php
$dir_full = scandir(__DIR__);
$exclude_full = array_diff($dir_full, array('..','.'));
$full_image = preg_grep('/^([\w,\.]+\.php)|([\w,\.]+\.css)|([\w,\.]+\.txt)|([\w,\.]+\.mov)|([\w,\.]+\.zip)|clipboard|css|js|lightbox/',$exclude_full,PREG_GREP_INVERT);
$dir_thumbnail = scandir('thumbnail');
$exclude_thumbnail = array_diff($dir_thumbnail, array('..','.'));
$full_thumbnail = preg_grep('/^([\w,\.]+\.php)|([\w,\.]+\.css)|([\w,\.]+\.txt)|([\w,\.]+\.mov)|([\w,\.]+\.zip)|clipboard|css|js|lightbox/',$exclude_thumbnail,PREG_GREP_INVERT);

$diff = array_diff($full_image,$full_thumbnail);
foreach( $diff as $i ) {
	exec('/usr/bin/convert '.__DIR__.'/'.$i.' -resize 64x64 '.__DIR__.'/thumbnail/'.$i);
}
?>
