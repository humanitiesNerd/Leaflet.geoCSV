<?php
/**
* Convert the shop spreadsheet into a GeoJSON object.
*/
function retrieve_remote_file_size($url){
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, TRUE);
curl_setopt($ch, CURLOPT_NOBODY, TRUE);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
$data = curl_exec($ch);
$size = curl_getinfo($ch, CURLINFO_CONTENT_LENGTH_DOWNLOAD);
curl_close($ch);
return $size;
}


$file_size = retrieve_remote_file_size( "https://docs.google.com/spreadsheets/d/1PDLJ5HRewXC9sUYgFqb2TR7H5G7V6KjfD_NCkhBgaSg/export?format=csv" );


//echo $file_size."<br />";
$localfile= filesize("mar.csv");


//echo $localfile;
if ($localfile != $file_size){
$url = 'https://docs.google.com/spreadsheets/d/1PDLJ5HRewXC9sUYgFqb2TR7H5G7V6KjfD_NCkhBgaSg/export?format=csv';
$file_originale = "marescotti0.csv";
$file_processato = "marescotti.csv";

$src = fopen($url, 'r');
$dest = fopen($file_originale, 'w');
stream_copy_to_stream($src, $dest);

$search2="""d+\,d+""";
$replace2="d+\.d+";
$output2 = passthru("sed -e 's/$search2/$replace2/g' $file_originale > $file_processato");




?>

