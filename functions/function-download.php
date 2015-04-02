<?php

# Gets the file name.
$zipname = $_GET['card_name'].'.zip';

# Creates New Zip File
$zip = new ZipArchive;

# Opens the File to add to it
$zip->open($zipname, ZipArchive::CREATE);

# Loops through each of the files selected in the form and adds them to zip file.
foreach ($_GET['file_url'] as $key => $val) {

    # download file
    $download_file = file_get_contents($val);

    #add it to the zip
    $zip->addFromString(basename($val),$download_file);

}

# Closes teh Zip File that was created
$zip->close();

# Then download the zipped file.
header('Content-Type: application/zip');
header('Content-disposition: attachment; filename='.$zipname);
header('Content-Length: ' . filesize($zipname));
readfile($zipname);

# Delete the Zip file when down.
unlink($zipname);
exit;
?>