<?php
// -- Includes -- //
include('function.php');
include('pagination.class.php');

// -- Get list of files -- //
# Full size images
$dir = scandir(__DIR__);
$exclude = array_diff($dir, array('..','.'));
$image_list = preg_grep('/^([\w,\.]+\.png)/',$exclude);
$image_count = count($image_list);
$image_count_nav = $image_count / 10;
$image_count_nav = round($image_count_nav, -1);
$image_count_nav = $image_count_nav + 1;

// -- Get page number -- //
$p = 1;
if( isset($_GET['p']) ) {
	$p = $_GET['p'];
}
elseif( $p == 0 ) {
	$p = 1;
}

// -- Determine starting point -- //
$finish = $p * 10;
$start = $finish - 10;

// -- Functions -- //
# Read contents of ZIP file
/*$za = new ZipArchive();

$za->open('theZip.zip');

for( $i = 0; $i < $za->numFiles; $i++ ){
    $stat = $za->statIndex( $i );
    print_r( basename( $stat['name'] ) . PHP_EOL );
}*/
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Screenshots</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <link href="lightbox/css/lightbox.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
  <script>
	lightbox.option({
		'fitImagesInViewport': true,
	})
	// $(document).ready( function() {
	// 	var trigger_id = $(this).attr('id');
	// 	var text_file = /([\w,\.]+\.txt)/;
	// 	$(this).click(function)({
	// 		$.get(text_file, function(data) {
	// 			$('.textdisplay').html(data)
	// 		}, 'text');
	// 			$('.textdisplay').show();
	// 	})
	// });
  </script>
</head>
<body>
	<div id="container">
		<div id="left">
			<?php
			$image_list = array_slice($image_list,$start,$finish);
			$i = 1;
			foreach($image_list as $image) {
				$height = image_height($image);
				echo '<div class="left_row" style="height: '.$height.'px;"><a href="https://ss.ssby.me/'.$image.'" data-lightbox="image'.$i.'"><img src="thumbnail/'.$image.'"></a></div><div class="right_row" style="height: '.$height.'px;"	>'.$image.'</div>'."\n";
				unset($height);
				$i++;
			}
			?>
		</div>
		<div id="nav">
			<?php
			// -- Pagination -- //
			$i = 1;
			while( $i != $image_count_nav ) {
				echo '<a href="?p='.$i.'" class="nav">'.$i.'</a>&nbsp;&nbsp;&nbsp;';
				$i++;
			}
			?>
		</div>
	</div>

	<script src="lightbox/js/lightbox.js"></script>
</body>
</html>
