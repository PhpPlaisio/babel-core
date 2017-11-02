<?php
//----------------------------------------------------------------------------------------------------------------------
namespace SetBased\Abc\Babel\Test;

use SetBased\Abc\Abc;
use SetBased\Abc\Babel\CoreBabel;

/**
 * Mock framework for testing purposes.
 */
class Framework extends Abc
{
  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Object constructor.
   */
  public function __construct()
  {
    parent::__construct();

    self::$babel = new CoreBabel();
    self::$DL    = new TestDataLayer();
  }

  //--------------------------------------------------------------------------------------------------------------------
}

//----------------------------------------------------------------------------------------------------------------------
