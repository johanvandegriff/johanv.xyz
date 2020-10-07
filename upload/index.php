<?php $pageName = "upload"; include $_SERVER['DOCUMENT_ROOT'].'/header.php';

$galleries = '/f/galleries';
$galleriesPath = $_SERVER['DOCUMENT_ROOT'].$galleries;

$thumbnailSize = 600;

$from = "/f/galleries";
$to = "/thumbs/galleries";

?>

<h1 style="text-align: center">Upload</h1>

<form action="." method="POST" enctype="multipart/form-data">
    <input type="file" name="upload"/>
    <input type="submit"/><br/>
    New Name (optional): <input type="text" name="filename"/><br/>
    <select name="location">
      <option>johanv.xyz/f</option>
      <?php
      $dir = new DirectoryIterator($galleriesPath);
      foreach ($dir as $fileinfo) {
        if ($fileinfo->isDir() && !$fileinfo->isDot()) {
          echo "<option>".($fileinfo->getFilename())."</option>";
        }
      }
      ?>
    </select>
    <input type="checkbox" name="replace" value="yes"/> Replace Existing?
</form>

<?php
    $upload_path = '/f';
    $loc = '';
    if (isset($_POST['location'])) {
        $loc = $_POST['location'];
        if ($loc != "johanv.xyz/f") {
            $upload_path = "/f/galleries/$loc";
        }
    }
    if(isset($_FILES['upload'])){
        $file_name = $_FILES['upload']['name'];
        $file_tmp =$_FILES['upload']['tmp_name'];

        if(isset($_POST['filename']) && $_POST['filename'] != ""){
            $file_name = $_POST['filename'];
        }
        if ($file_name == "index.php") {
            echo "Cannot name file index.php, that filename is reserved.";
        } else {
            $target_path = $upload_path.'/'.$file_name;
            $target_file = $_SERVER['DOCUMENT_ROOT'].$target_path;
            if (file_exists($target_file) && !(isset($_POST['replace']) && $_POST['replace'] == "yes")) {
                echo 'File <a target="_blank" href="'.$target_path.'">already exists</a>!';
            } else {
                $parent_dir = dirname($target_file);
                if (!is_dir($parent_dir)) {
                    if(mkdir($parent_dir , 0777, true)) {
                        echo 'Created dir: '.$parent_dir."<br/>\n";
                    }
                }
                if(move_uploaded_file($file_tmp, $target_file)) {
                    if ($upload_path != '/f') {
                      $thumb_path = "/thumbs/galleries/$loc/$file_name.jpg";
                      $thumb_file = $_SERVER['DOCUMENT_ROOT'].$thumb_path;
                      shell_exec('convert "'.$target_file.'" -thumbnail "'.$thumbnailSize.'x'.$thumbnailSize.'>" "'.$thumb_file.'"');
                      echo 'Thumbnail generated <a target="_blank" href="'.$thumb_path.'">here</a>.<br/>';
                      echo 'See entire gallery <a target="_blank" href="/gallery/?g='.$loc.'">here</a>.<br/>';
                    }
                    echo 'Success! File uploaded <a target="_blank" href="'.$target_path.'">here</a>.';
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }
        }
    }
?>

<h2 style="text-align: center">Debug</h2>

<?php
    echo '<p>file_uploads (File Uploads Enabled): '.ini_get("file_uploads").'</p>';
    echo '<p>upload_max_filesize: '.ini_get("upload_max_filesize").'</p>';
    echo '<p>post_max_size: '.ini_get("post_max_size").'</p>';
    echo '<p>whoami: '.exec('whoami').'</p>';
?>
<p>More debug info: <a href="phpinfo.php">phpinfo.php</a></p>

<?php include $_SERVER['DOCUMENT_ROOT'].'/footer.php'; ?>
