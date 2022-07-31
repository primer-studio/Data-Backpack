<?php
set_time_limit(0);

function MakeArchive($dir, $dest, $prefix, $date) {
/**
*  here we are going to make a zip archive from dir and dist.
* consider that we need linux 'zip' package installed on os.
*/
	$start = microtime(true);
	$result = '';
	$code = '';
	echo "creating backup file: $prefix-backup-$date.zip ..." . PHP_EOL;
	exec("zip -r $prefix-backup-$date.zip $dir/$dest/", $result, $code);
	echo "sending file to amazon s3 servers ..." . PHP_EOL;
	exec("aws s3 --endpoint-url=https://kise-thr-nd-1.sotoon.cloud cp $prefix-backup-$date.zip s3://cinemabartar-backup-bucket");
	$end = microtime(true);	
	$status = ([
		'msg' => "proccess takes " . ($end-$start)/60 . "min to execute.",
		'result' => $result,
		'code' => $code
	]);
	$log = date("Y-m-d H:i:s") . '-' . __FILE__ . ': ' . $status['msg'];
	file_put_contents('logs.txt', $log.PHP_EOL , FILE_APPEND | LOCK_EX);
	
	
}
MakeArchive($backup_dir, $dest, $prefix, $date);
?>

