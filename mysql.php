<?php
$command = "$mysqldump --opt -h $dbhost -u $dbuser --password=$dbpass $dbname > $prefix-$dbname-$date.sql";
$start = microtime(true);
$result = '';
$code = '';
echo "creating databse backup file: $prefix-$dbname-$date.sql ..." . PHP_EOL;
exec($command, $result, $code);
echo "sending file to amazon s3 servers ..." . PHP_EOL;
exec("aws s3 --endpoint-url=$aws_endpoint_url cp $prefix-$dbname-$date.sql $aws_bucket_address");
$end = microtime(true);
$status = ([
	'msg' => "proccess takes " . ($end-$start)/60 . "min to execute.",
	'result' => $result,
	'code' => $code
]);
$log = date("Y-m-d H:i:s") . '-' . __FILE__ . ': ' . $status['msg'];
file_put_contents('logs.txt', $log.PHP_EOL , FILE_APPEND | LOCK_EX);
?>
