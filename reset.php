<?php
/**
 * Reset id's.
 */

// Configuration file name.
$configFile = 'config.json';

// Get config from file.
$config = json_decode(file_get_contents($configFile));

// Delete content of files.
file_put_contents($config->file->maxeid, '');
file_put_contents($config->file->maxgid, '');

// Reload files.
$maxeid = file_get_contents($config->file->maxeid);
$maxgid = file_get_contents($config->file->maxgid);

// Check if the files are empty now.
if (empty($maxeid) && empty($maxgid)) {
    echo "Die Id's wurden gelöscht!";
} else {
    echo "Fehler! Die Id's konnten nicht gelöscht werden!";
}
