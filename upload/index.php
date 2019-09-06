<?php $pageName = "Upload"; include $_SERVER['DOCUMENT_ROOT'].'/header.php'; ?>

<h1 style="text-align: center">Upload</h1>

<form action="" method="POST" enctype="multipart/form-data">
    <input type="file" name="upload"/>
    <input type="submit"/>
    <br/>
    New Name (optional): <input type="text" name="filename"/>
    <br/>
    <input type="checkbox" name="replace" value="yes"/> Replace Existing?
</form>

<?php
    $upload_path = '/f';
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
                echo 'File <a target="_blank" href="'.$target_path.'">already esists</a>!';
            } else {
                $parent_dir = dirname($target_file);
                if (!is_dir($parent_dir)) {
                    if(mkdir($parent_dir , 0777, true)) {
                        echo 'Created dir: '.$parent_dir."<br/>\n";
                    }
                }
                if(move_uploaded_file($file_tmp, $target_file)) {
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

<?php include $_SERVER['DOCUMENT_ROOT'].'/footer.php'; ?>
