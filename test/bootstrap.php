<?php
declare(strict_types=1);

use SetBased\ErrorHandler\ErrorHandler;

mb_internal_encoding('UTF-8');

require_once(__DIR__.'/../vendor/autoload.php');

$errorHandler = new ErrorHandler();
$errorHandler->registerErrorHandler();

date_default_timezone_set('Europe/Amsterdam');
