<?php
echo "<b>Attempting to pull from git repo...</b> <br>";
exec('cd ~/public_html/jobs/ && git pull origin dev', $output);
foreach ($output as $o) {
    echo $o . '<br>';
}
