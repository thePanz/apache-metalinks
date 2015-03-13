<?php
require_once 'vendor/autoload.php';
global $argv;

$isCLI = php_sapi_name() === 'cli' OR defined('STDIN');

$path = null;
if (true === $isCLI) {
    $path = isset($argv[1]) ? $argv[1] : null;
}
else {
    $path = isset($_GET['path']) ? $_GET['path'] : null;
}

if (empty($path))
    die('No PATH provided');

// $path = 'lucene/solr/4.10.3/solr-4.10.3.zip';
$a = new Pnz\Metalink\ApacheMetalink($path);

if (true !== $isCLI) {
    $filename = basename($path);
    header('Content-Type: application/metalink4+xml');
    header('Content-Description: File Transfer');
    header('Content-Disposition: attachment; filename="' . $filename . '.metalink"');
}

print $a->getMetalink4XML();
die();
