<?php
chdir("/app");
require "vendor/autoload.php";
$app = require "bootstrap/app.php";
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

DB::enableQueryLog();
$t = microtime(true);
$services = \Modules\Service\Models\Service::all();
echo "Services Eloquent: " . round((microtime(true)-$t)*1000) . "ms, " . DB::getQueryLog()[0]["time"] . "ms query\n";
DB::flushQueryLog();

$t = microtime(true);
foreach($services as $s) {
    $title = $s->translate("en")->title ?? "";
}
$qs = DB::getQueryLog();
echo "Translations: " . round((microtime(true)-$t)*1000) . "ms, " . count($qs) . " queries\n";
foreach($qs as $q) {
    echo "  [" . round($q["time"]) . "ms] " . substr($q["query"],0,80) . "\n";
}
