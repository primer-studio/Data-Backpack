<?php
$backup_dir = '/home/USER/domains/DOMAIN.TLD';
$dest = 'private_html';
$prefix = 'PREFIX';
$dbhost = 'localhost';
$dbuser = 'USER';
$dbpass = 'PASSWORD';
$dbname = 'DATABASE';
$mysqldump = exec('which mysqldump');
$date = Date("Ymd");
$aws_endpoint_url = "https://AWS-ENDPOINT-URL";
$aws_bucket_address = "s3://BUCKET-NAME";

