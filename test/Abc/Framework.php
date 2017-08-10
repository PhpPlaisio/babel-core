<?php
//----------------------------------------------------------------------------------------------------------------------
namespace SetBased\Abc\Babel\Test\Abc;

use SetBased\Abc\Abc;
use SetBased\Abc\Babel\CoreBabel;
use SetBased\Abc\ErrorLogger\ErrorLogger;
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

    self::$babel = new CoreBabel();
    self::$DL    = new DataLayer();

    self::$babel->setLanguage(C::LAN_ID_EN);
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
   * Returns the error logger.
   *
   * @return ErrorLogger
   */
  public function getErrorLogger()
  {
    throw new RuntimeException('Not implemented');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * {@inheritdoc}
   */
  public function getLoginUrl($url)
  {
    throw new RuntimeException('Not implemented');
  }

  //--------------------------------------------------------------------------------------------------------------------
}

//----------------------------------------------------------------------------------------------------------------------
