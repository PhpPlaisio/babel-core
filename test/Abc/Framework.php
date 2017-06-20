<?php
//----------------------------------------------------------------------------------------------------------------------
namespace SetBased\Abc\Babel\Test\Abc;

use SetBased\Abc\Abc;
use SetBased\Abc\Babel;
use SetBased\Exception\RuntimeException;

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

    self::$babel = new Babel\CoreBabel(C::LAN_ID_EN);
    self::$DL    = new DataLayer();
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * {@inheritdoc}
   */
  public function createMailMessage()
  {
    throw new RuntimeException('Not implemented');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * {@inheritdoc}
   */
  public function getBlobStore()
  {
    throw new RuntimeException('Not implemented');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * {@inheritdoc}
   */
  protected function getLoginUrl($url)
  {
    throw new RuntimeException('Not implemented');
  }

  //--------------------------------------------------------------------------------------------------------------------
}

//----------------------------------------------------------------------------------------------------------------------
