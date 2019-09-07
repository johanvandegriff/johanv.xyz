<?php
if (!isset($url)) {
    $url = "https://johanv.xyz/";
}
echo '<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8">';
echo '<script>window.location="'.$url.'"</script>';
echo '<title>Redirect to '.$url.'</title>';
echo '</head><body>';
echo '<h1>Redirecting...</h1>';
echo '<p>If you are not redirected, click the link directly:</p>';
echo '<p><a href="'.$url.'">'.$url.'</a>';
echo '</body></html>';
?>
