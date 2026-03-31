<?php
chdir("/app");
require "vendor/autoload.php";
$app = require "bootstrap/app.php";
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$request = Illuminate\Http\Request::create("/api/sni/home", "GET", [], [], [], ["HTTP_ACCEPT"=>"application/json","HTTP_LOCALE"=>"en"]);
$start = microtime(true);
$response = $kernel->handle($request);
echo "Time: " . round((microtime(true)-$start)*1000) . "ms\n";
echo substr($response->getContent(), 0, 100) . "\n";
