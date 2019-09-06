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
    $upload_dir = '/f';
    if(isset($_FILES['upload'])){
        $file_name = $_FILES['upload']['name'];
        $file_tmp =$_FILES['upload']['tmp_name'];

        if(isset($_POST['filename']) && $_POST['filename'] != ""){
            $file_name = $_POST['filename'];
        }
        if ($file_name == "index.php") {
            echo "Cannot name file index.php, that filename is reserved.";
        } else {
            $target_file = $upload_dir.'/'.$file_name;
            if (file_exists($_SERVER['DOCUMENT_ROOT'].$target_file) && !(isset($_POST['replace']) && $_POST['replace'] == "yes")) {
                echo 'File <a target="_blank" href="'.$target_file.'">already esists</a>!';
            } else {
                if(move_uploaded_file($file_tmp, $_SERVER['DOCUMENT_ROOT'].$target_file)) {
                    echo 'Success! File uploaded <a target="_blank" href="'.$target_file.'">here</a>.';
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
