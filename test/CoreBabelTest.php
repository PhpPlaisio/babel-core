<?php
//----------------------------------------------------------------------------------------------------------------------
namespace SetBased\Abc\Babel\Test;

use PHPUnit\Framework\TestCase;
use SetBased\Abc\Abc;
use SetBased\Abc\Babel\Test\Abc\C;
use SetBased\Abc\Babel\Test\Abc\Framework;

/**
 * Test cases for class CoreBabel.
 */
class CoreBabelTest extends TestCase
{
  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Our concrete instance of Abc.
   *
   * @var Abc
   */
  private static $abc;

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Creates the concrete implementation of the ABC Framework.
   */
  public static function setUpBeforeClass()
  {
    parent::setUpBeforeClass();

    self::$abc = new Framework();
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test cases for method Babel:getHtmlText.
   */
  public function testGetHtmlText1()
  {
    $text = Abc::$babel->getHtmlText(C::TXT_ID_HELLO_TEXT);
    self::assertSame('Hello Text', $text, 'TXT_ID_HELLO_TEXT');

    $text = Abc::$babel->getHtmlText(C::TXT_ID_HELLO_TEXT_SPECIAL);
    self::assertSame('&lt;Hello Text&gt;', $text, 'TXT_ID_HELLO_TEXT_SPECIAL');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test cases for method Babel:getHtmlWord.
   */
  public function testGetHtmlWord1()
  {
    $word = Abc::$babel->getHtmlWord(C::WRD_ID_HELLO_WORD);
    self::assertSame('Hello Word', $word, 'WRD_ID_HELLO_WORD');

    $word = Abc::$babel->getHtmlWord(C::WRD_ID_HELLO_WORD_SPECIAL);
    self::assertSame('&lt;Hello Word&gt;', $word, 'WRD_ID_HELLO_WORD_SPECIAL');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test cases for method Babel:getText.
   */
  public function testGetText1()
  {
    $text = Abc::$babel->getText(C::TXT_ID_HELLO_TEXT);
    self::assertSame('Hello Text', $text, 'TXT_ID_HELLO_TEXT');

    $text = Abc::$babel->getText(C::TXT_ID_HELLO_TEXT_SPECIAL);
    self::assertSame('<Hello Text>', $text, 'TXT_ID_HELLO_TEXT_SPECIAL');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test cases for method Babel:getWord.
   */
  public function testGetWord1()
  {
    $word = Abc::$babel->getWord(C::WRD_ID_HELLO_WORD);
    self::assertSame('Hello Word', $word, 'WRD_ID_HELLO_WORD');

    $word = Abc::$babel->getWord(C::WRD_ID_HELLO_WORD_SPECIAL);
    self::assertSame('<Hello Word>', $word, 'WRD_ID_HELLO_WORD_SPECIAL');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test cases for methods Babel::popLanguage and Babel::pushLanguage.
   */
  public function testLanguageStack()
  {
    self::assertSame(C::LAN_ID_EN, Abc::$babel->getLanId());

    Abc::$babel->pushLanguage(C::LAN_ID_EN);
    self::assertSame(C::LAN_ID_EN, Abc::$babel->getLanId(), 'Push 1');

    Abc::$babel->pushLanguage(C::LAN_ID_RU);
    self::assertSame(C::LAN_ID_RU, Abc::$babel->getLanId(), 'Push 2');

    Abc::$babel->pushLanguage(C::LAN_ID_NL);
    self::assertSame(C::LAN_ID_NL, Abc::$babel->getLanId(), 'Push 3');

    Abc::$babel->popLanguage();
    self::assertSame(C::LAN_ID_RU, Abc::$babel->getLanId(), 'Pop 3');

    Abc::$babel->popLanguage();
    self::assertSame(C::LAN_ID_EN, Abc::$babel->getLanId(), 'Pop 2');

    Abc::$babel->popLanguage();
    self::assertSame(C::LAN_ID_EN, Abc::$babel->getLanId(), 'Pop 1');
  }

  //--------------------------------------------------------------------------------------------------------------------
}

//----------------------------------------------------------------------------------------------------------------------
