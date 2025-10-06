<?php
require __DIR__ . '/vendor/autoload.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

// Create a logger channel
$log = new Logger('my_logger');

// Add a handler (logs to a file in your project folder)
$log->pushHandler(new StreamHandler(__DIR__.'/app.log', Logger::DEBUG));

// Add records to the log
$log->info('This is an info log');
$log->warning('This is a warning log');
$log->error('This is an error log');

echo "Logs written to app.log";