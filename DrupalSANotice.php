<?php

/**
 * Created by PhpStorm.
 * User: barrett
 * Date: 5/15/16
 * Time: 10:32 AM
 */
class DrupalSANotice {

  /**
   * These are expected to be attributes of the source object.
   */
  public $title;
  public $pubDate;
  public $link;
  public $description;

  /**
   * These are derived from the title attribute.
   */
  public $moduleName;
  public $severity;
  public $vulnerabilityType;
  public $saIdentifier;
  
  public function __construct($sourceObject) {
    // Make sure source object has expected structure.
    $this->validateSourceObject($sourceObject);

    // Set base attributes.
    $this->title       = $sourceObject->title;
    $this->pubDate     = $sourceObject->pubDate;
    $this->link        = $sourceObject->link;
    $this->description = $sourceObject->description;

 //   $this->parseTitle($this->title);
  }


  /**
   * Split the title of the SA to get criticality, module name, etc.
   *
   * The title on the Drupal SA contains the module name, severity, vulnerability type,
   * and SA identifier.  Unforuntately, the position of elements in the string is not
   * guaranteed and the string may also include hyphens in the module title or a final
   * "unsupported" note.
   */
  public static function parseTitle($title) {

    // Split the string by the hyphen delimiter.
    $titleElements = array_map('trim', explode(' -', $title));

    // Check the elements to make sure we set the right values (position in title
    // cannot be trusted).
    $identifierElement = preg_grep('/^SA-./', $titleElements);
    $identifierPosition = array_keys($identifierElement)[0];
    echo "identifier position = $identifierPosition";
//    $this->saIdentifier = $identifierElement[$identifierPosition];

    $severityElement = preg_grep('/.*[cC]ritical$/', $titleElements);
    print_r($severityElement);
    $severityPosition = array_keys($severityElement)[0];
    echo "severity postion = $severityPosition";
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
    if ($vulnerabilityTypePosition !== 1 && $severityElement[0] !== 1) {
 //     $this->moduleName = $titleElements[0] + $titleElements[1];
    }
    else {
 //     $this->moduleName = $titleElements[0];
    }
  }

  private function validateSourceObject($sourceObject) {

    return TRUE;
  }

}