<?php
/**
 * Created by PhpStorm.
 * User: barrett
 * Date: 5/15/16
 * Time: 8:52 AM
 */

require 'DrupalSANotice.php';
require 'vendor/autoload.php';

define('CONTRIB', 'contrib/rss.xml');
define('CORE', 'rss.xml');

use GuzzleHttp\Client;

$client = new Client([
  // Base URI is used with relative requests
  'base_uri' => 'https://www.drupal.org/security/',
  // You can set any number of default request options.
  'timeout'  => 2.0,
]);

$response = $client->request('GET', CONTRIB);

$xml=simplexml_load_string((string) $response->getBody());

foreach($xml->channel->item as $notice) {
  echo $notice->title . "\n";
  $noticeObject = new DrupalSANotice($notice);
//  echo $noticeObject->moduleName . '::' . $noticeObject->severity . '::' . $noticeObject->vulnerabilityType . "\n";
}
