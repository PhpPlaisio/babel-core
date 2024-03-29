<?php
declare(strict_types=1);

namespace Plaisio\Babel\Test;

use Plaisio\Babel\Babel;
use Plaisio\Babel\CoreBabel;
use Plaisio\PlaisioKernel;
use SetBased\Stratum\MySql\MySqlDefaultConnector;

/**
 * Kernel for testing purposes.
 */
class TestKernel extends PlaisioKernel
{
  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Returns the helper object for retrieving linguistic entities.
   *
   * @return Babel
   */
  protected function getBabel(): Babel
  {
    return new CoreBabel($this);
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Returns the data layer generated by PhpStratum.
   *
   * @return Object
   */
  protected function getDL(): Object
  {
    $connector = new MySqlDefaultConnector('127.0.0.1', 'test', 'test', 'test');

    return new TestDataLayer($connector);
  }

  //--------------------------------------------------------------------------------------------------------------------
}

//----------------------------------------------------------------------------------------------------------------------
