<?php

$targetFolder = __DIR__ .'/../../dashboard.infoin.org/storage/app/public';
$linkFolder = __DIR__ .'/storage';

symlink($targetFolder, $linkFolder);

?>