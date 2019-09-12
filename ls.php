<?php $pageName = "Files"; $description = "Directory file listing."; include $_SERVER['DOCUMENT_ROOT'].'/header.php'; ?>

<?php
$file_root = $_SERVER['DOCUMENT_ROOT'].'/f';
$loc = getcwd();
if ($loc == $_SERVER['DOCUMENT_ROOT']) {
    $loc = "";
}
$path = preg_replace(",".$file_root."/?(.*),", "$1", $loc);

$path = explode("/", $path);

echo '<h1 style="text-align: center">';
if ($path[0] == "") {
    echo "files";
} else {
    echo '<a href="/f">files</a>';
}

$i = 0;
$so_far = "/f";
foreach ($path as $dir) {
    $so_far = $so_far.'/'.$dir;
    if ($i == count($path) - 1) {
        echo ' / '.$dir;
    } else {
        echo ' / <a href="'.$so_far.'">'.$dir.'</a>';
    }
    $i++;
}

echo '</h1>';

$files = scandir(".");

echo "<ul>\n";
foreach($files as $file) {
    if (is_dir($file)) {
        $trailing_slash = "/";
        $target_blank = "";
        if (!file_exists($file.'/index.php')) {
            continue;
        }
    } else {
        $trailing_slash = "";
        $target_blank = ' target="_blank"';
    }
    if ($file != "index.php" && $file != "." && $file != "..") {
        echo '  <li><a'.$target_blank.' href="'.$file.'">'.$file.$trailing_slash."</a></li>\n";
    }
}
echo "</ul>\n";

?>

<?php include $_SERVER['DOCUMENT_ROOT'].'/footer.php'; ?>
