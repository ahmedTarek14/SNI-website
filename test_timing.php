<?php
chdir("/app");
require "vendor/autoload.php";
$app = require "bootstrap/app.php";
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$t = microtime(true);
$services = DB::table("services")->get();
echo "services: " . round((microtime(true)-$t)*1000) . "ms (count=" . count($services) . ")\n"; $t=microtime(true);

$vendors = DB::table("vendors")->get();
echo "vendors: " . round((microtime(true)-$t)*1000) . "ms\n"; $t=microtime(true);

$contact = DB::table("contacts")->first();
echo "contact: " . round((microtime(true)-$t)*1000) . "ms\n"; $t=microtime(true);

$about = DB::table("about_us")->get();
echo "about: " . round((microtime(true)-$t)*1000) . "ms\n"; $t=microtime(true);

$why = DB::table("why_items")->get();
echo "why: " . round((microtime(true)-$t)*1000) . "ms\n"; $t=microtime(true);

$core = DB::table("core_values")->get();
echo "core_values: " . round((microtime(true)-$t)*1000) . "ms\n"; $t=microtime(true);

$team = DB::table("team_members")->get();
echo "team: " . round((microtime(true)-$t)*1000) . "ms\n";
