<?php
/* Credit to https://github.com/thomassss/OneFileGallery */

$galleries = '/f/galleries';
$galleriesPath = $_SERVER['DOCUMENT_ROOT'].$galleries;

function filter($gal){
	return preg_replace("/[^a-zA-Z0-9_ ]+/", "", $gal);
}

function showGallery(){
	if(isset($_GET['g'])){
		showDetailPage(filter($_GET['g']));
	} else {
		createGallery();
	}
}

function showDetailPage($gal){
    GLOBAL $galleries, $galleriesPath;
	$files = scandir("$galleriesPath/$gal/");

	foreach($files as $file){
		if($file == '.') continue;
		if($file == '..') continue;
		if(pathinfo($file, PATHINFO_EXTENSION) == "mp4") {
			echo <<<END
<div class="col-xs-6 col-md-4">
	<video width="400" controls>
		<source src="$galleries/$gal/$file" type="video/mp4">
		Your browser does not support HTML video.
	</video>
</div>
END;
		} else {
			$img = getThumbIMG("$galleries/$gal/$file", 'alt="" class="img-rounded"');
			echo <<<END
<div class="col-xs-6 col-md-4">
	<div class="thumbnail">
		$img
	</div>
</div>
END;
		}
	}
}

function createGallery(){
    GLOBAL $galleries, $galleriesPath;
	$out = "";
	$dir = new DirectoryIterator($galleriesPath);
	foreach ($dir as $fileinfo) {
		if ($fileinfo->isDir() && !$fileinfo->isDot()) {
			$link_name = $fileinfo->getFilename();
			$gal_print_name = str_replace('_', ' ', $link_name);
			$thumbnail = getThumb($link_name);
			$thumbnail = getThumbURL($thumbnail);
			echo <<<END
	<div class="col-xs-6 col-md-4">
		<a href="?g=$link_name">
			<div class="thumbnail">
				<img src="$thumbnail" alt="..." class="img-rounded">
				<div class="caption">
					<h3 class="text-center">$gal_print_name</h3>
				</div>
			</div>
		</a>
	</div>
END;
		}
	}
}

function getThumb($gal){
    GLOBAL $galleries, $galleriesPath;
	$files = scandir("$galleriesPath/$gal");
	return("$galleries/$gal/$files[2]");
}
$image = "https://johanv.xyz/f/galleries/Drawings/0_2019-05-13_ErasableIncAndFriends.png";
$url = "https://johanv.xyz/gallery";
$description = "Johan Vandegriff's photo gallery with drawings and pictures from school, robotics, camping, etc.";
if(isset($_GET['g'])) {
	$pageNameExtra = str_replace('_', ' ', filter($_GET['g']));
	$pageName = "Gallery"; include $_SERVER['DOCUMENT_ROOT'].'/header.php';
	echo '<h4><a href=".">... back to all galleries</a></h4>';
} else {
	$pageName = "Gallery"; include $_SERVER['DOCUMENT_ROOT'].'/header.php';
}
?>
<link rel="stylesheet" href="gallery.css">
<div class="container">
	<?php echo showGallery(); ?>
</div>

<div id="footer">
	<div class="container">
		<h6><a rel="license" href="http://creativecommons.org/licenses/by-sa/4.0/"><img alt="Creative Commons License" style="border-width:0" src="https://i.creativecommons.org/l/by-sa/4.0/80x15.png" /></a><br />This work is licensed under a <a rel="license" href="http://creativecommons.org/licenses/by-sa/4.0/">Creative Commons Attribution-ShareAlike 4.0 International License</a>.</h6>
		<h6>Powered by <a target="_blank" href="https://github.com/thomassss/OneFileGallery">OneFileGallery</a> by Thomas Sauer</h6>
	</div>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'].'/footer.php'; ?>
