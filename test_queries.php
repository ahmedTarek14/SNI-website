<?php
chdir("/app");
require "vendor/autoload.php";
$app = require "bootstrap/app.php";
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

DB::enableQueryLog();
$t = microtime(true);

$services = DB::table("services")->get();
$qs = DB::getQueryLog();
echo "services: " . round((microtime(true)-$t)*1000) . "ms, " . count($qs) . " queries\n";
foreach($qs as $q) {
    echo "  [" . round($q["time"]) . "ms] " . substr($q["query"],0,80) . "\n";
}
