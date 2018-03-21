<?php

require __DIR__ . "/vendor/autoload.php";

use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;

use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;

$host = 'http://localhost:4444/wd/hub';

$driver = RemoteWebDriver::create($host, DesiredCapabilities::chrome());

$driver->get('https://www.seleniumhq.org/');

$link = $driver->findElement(
    WebDriverBy::id('menu_about')
);
$link->click();

// wait until the page is loaded
$driver->wait()->until(
    WebDriverExpectedCondition::titleContains('About')
);

// print the title of the current page
echo "The title is '" . $driver->getTitle() . "'\n";
// print the URI of the current page
echo "The current URI is '" . $driver->getCurrentURL() . "'\n";
// write 'php' in the search box
$driver->findElement(WebDriverBy::id('q'))
    ->sendKeys('php') // fill the search box
    ->submit(); // submit the whole form
// wait at most 10 seconds until at least one result is shown
$driver->wait(10)->until(
    WebDriverExpectedCondition::presenceOfAllElementsLocatedBy(
        WebDriverBy::className('gsc-result')
    )
);
// close the browser
$driver->quit();