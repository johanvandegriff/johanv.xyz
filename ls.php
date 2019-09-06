<?php $pageName = "Files"; include $_SERVER['DOCUMENT_ROOT'].'/header.php'; ?>

<?php
$fileRoot = $_SERVER['DOCUMENT_ROOT'].'/f';
$path = preg_replace(",".$fileRoot."/?(.*),", "$1", getcwd());

$path = explode("/", $path);

echo '<h1 style="text-align: center">';
if ($path[0] == "") {
    echo "files";
} else {
    echo '<a href="/f">files</a>';
}

$i = 0;
$sofar = "/f";
foreach ($path as $dir) {
    $sofar = $sofar.'/'.$dir;
    if ($i == count($path) - 1) {
        echo ' / '.$dir;
    } else {
        echo ' / <a href="'.$sofar.'">'.$dir.'</a>';
    }
    $i++;
}

echo '</h1>';

if (empty($listDir)) {
    $listDir = ".";
}
$files = scandir(".");

echo "<ul>\n";
foreach($files as $file) {
    if (is_dir($file)) {
        $trailingSlash = "/";
    } else {
        $trailingSlash = "";
    }
    if ($file != "index.php" && $file != "." && $file != "..") {
        echo '  <li><a href="'.$file.'">'.$file.$trailingSlash."</a></li>\n";
    }
}
echo "</ul>\n";

?>

<?php include $_SERVER['DOCUMENT_ROOT'].'/footer.php'; ?>
