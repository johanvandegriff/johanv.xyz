<?php $pageName = "Gallery"; include '../header.php'; ?>

<?php
/* Credit to https://github.com/thomassss/OneFileGallery */

function showGallery(){
	if(isset($_GET['g'])){
		showDetailPage($_GET['g']);
	} else {
		createGallery();
	}
}

function showDetailPage($gal){
	$files = scandir('./galleries/'.$gal.'/');

	foreach($files as $file){
		if($file == '.') continue;
		if($file == '..') continue;
		echo <<<END
<div class="col-xs-6 col-md-4">
	<a href="galleries/$gal/$file">
		<div class="thumbnail">
			<img src="galleries/$gal/$file" alt="..." class="img-rounded">
		</div>
	</a>
</div>
END;
	}
}

function createGallery(){
	$out = "";
	$dir = new DirectoryIterator('./galleries');
	foreach ($dir as $fileinfo) {
		if ($fileinfo->isDir() && !$fileinfo->isDot()) {
			//echo $fileinfo->getFilename().'<br>';
			$gal_print_name = str_replace('_', ' ', $fileinfo->getFilename());
			$link_name = $fileinfo->getFilename();
			$thumbnail = getThumb($link_name);
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
	$files = scandir('./galleries/'.$gal);
	return('galleries/'.$gal.'/'.$files[2]);
}
?>
<link rel="stylesheet" href="gallery.css">

<?php
if(isset($_GET['g'])) {
	echo '<h4><a href=".">... back to all galleries</a></h4>';
}
?>
<div class="container">
	<?php echo showGallery(); ?>
</div>

<div id="footer">
	<div class="container">
		<h6><a rel="license" href="http://creativecommons.org/licenses/by-sa/4.0/"><img alt="Creative Commons License" style="border-width:0" src="https://i.creativecommons.org/l/by-sa/4.0/80x15.png" /></a><br />This work is licensed under a <a rel="license" href="http://creativecommons.org/licenses/by-sa/4.0/">Creative Commons Attribution-ShareAlike 4.0 International License</a>.</h6>
		<h6>Powered by <a target="_blank" href="https://github.com/thomassss/OneFileGallery">OneFileGallery</a> by Thomas Sauer</h6>
	</div>
</div>

<?php include '../footer.php'; ?>
