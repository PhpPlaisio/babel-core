<?php
declare(strict_types=1);

namespace Plaisio\Babel\Test;

use Plaisio\Babel\CoreBabel;
use Plaisio\Kernel\Nub;

/**
 * Mock framework for testing purposes.
 */
class Framework extends Nub
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
