<?php
/**
 * Created by PhpStorm.
 * User: barrett
 * Date: 5/15/16
 * Time: 3:22 PM
 */

function parseTitle($title) {

  echo $title . "\n";

  // Split the string by the hyphen delimiter.
  $titleElements = array_map('trim', explode(' -', $title));

  // Check the elements to make sure we set the right values (position in title
  // cannot be trusted).
  $identifierElement = preg_grep('/^SA-./', $titleElements);
  $identifierPosition = array_keys($identifierElement)[0];
  echo "identifier position = $identifierPosition \n";
//    $this->saIdentifier = $identifierElement[$identifierPosition];

  $severityElement = preg_grep('/.*[cC]ritical$/', $titleElements);
  $severityPosition = array_keys($severityElement)[0];
  echo "severity postion = $severityPosition \n";
//    $this->severity = $severityElement[$severityPosition];

  // If the identifier is not the last element in the titleElements array,
  // the additional elements are notes.
  // @todo: fetch the notes element

  // If the severity is not the element immediately preceeding the identifier
  // then the vulnerabilityType is in that position.
  if ($identifierPosition - $severityPosition > 1 ) {
    $vulnerabilityTypePosition = $severityPosition + 1;
  }
  else {
    $vulnerabilityTypePosition = $severityPosition - 1;
  }
//    $this->vulnerabilityType = $titleElements[$vulnerabilityTypePosition];

  // If the second element is not either the vulnerabilityType or severity then
  // the second element is part of the module title.
  if ($vulnerabilityTypePosition !== 1 && $severityPosition !== 1) {
    //     $this->moduleName = $titleElements[0] + $titleElements[1];
  }
  else {
    //     $this->moduleName = $titleElements[0];
  }
}

parseTitle("User Dashboard - SQL Injection - Critical - SA-CONTRIB-2015-152");
parseTitle("Taxonomy Find - Unsupported - SA-CONTRIB-2015-153");
parseTitle("FileField - Denial of Service - SA-CONTRIB-2016-008");
parseTitle("Hubspot CTA - Moderately Critical - Cross Site Scripting (XSS) - SA-CONTRIB-2016-012 - Unsupported");
parseTitle("EPSA Crop - Image Cropping - Critical -XSS - SA-CONTRIB-2016-024 - Unsupported");
