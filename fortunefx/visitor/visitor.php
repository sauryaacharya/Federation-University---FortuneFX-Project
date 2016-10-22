<?php
include "../lib/BrowserDetection.php";
include "../lib/VisitorAnalytics.php";
$browser_det = new BrowserDetection();
$browser = $browser_det->getName();
$platform = $browser_det->getPlatform();
$va = new VisitorAnalytics();
$va->processVisitorAnalytics();


