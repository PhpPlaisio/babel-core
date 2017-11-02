<?php
//----------------------------------------------------------------------------------------------------------------------
namespace SetBased\Abc\Babel\Test;

use PHPUnit\Framework\TestCase;
use SetBased\Abc\Abc;
use SetBased\Abc\C;

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
   * Test cases for method Babel:getHtmlTextReplaced.
   */
  public function testGetHtmlTextReplaced1()
  {
    $text = Abc::$babel->getHtmlTextReplaced(C::TXT_ID_REPLACED1, true, true, ['@TEXT@' => 'Hello<br/>World']);
    self::assertSame('<a href="/">Hello<br/>World</a>', $text, 'TXT_ID_REPLACED1 true true');

    $text = Abc::$babel->getHtmlTextReplaced(C::TXT_ID_REPLACED1, true, false, ['@TEXT@' => 'Hello<br/>World']);
    self::assertSame('<a href="/">Hello&lt;br/&gt;World</a>', $text, 'TXT_ID_REPLACED1 true false');

    $text = Abc::$babel->getHtmlTextReplaced(C::TXT_ID_REPLACED1, false, false, ['@TEXT@' => 'Hello<br/>World']);
    self::assertSame('&lt;a href=&quot;/&quot;&gt;Hello&lt;br/&gt;World&lt;/a&gt;', $text, 'TXT_ID_REPLACED1 false false');

    $text = Abc::$babel->getHtmlTextReplaced(C::TXT_ID_REPLACED1, false, true, ['@TEXT@' => 'Hello<br/>World']);
    self::assertSame('&lt;a href=&quot;/&quot;&gt;Hello<br/>World&lt;/a&gt;', $text, 'TXT_ID_REPLACED1 false true');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test cases for method Babel:getHtmlTextFormatted.
   */
  public function testGetHtmlTextFormatted1()
  {
    $text = Abc::$babel->getHtmlTextFormatted(C::TXT_ID_FORMATTED1, true, true, ['Hello<br/>World']);
    self::assertSame('<a href="/">Hello<br/>World</a>', $text, 'TXT_ID_FORMATTED1 true true');

    $text = Abc::$babel->getHtmlTextFormatted(C::TXT_ID_FORMATTED1, true, false, ['Hello<br/>World']);
    self::assertSame('<a href="/">Hello&lt;br/&gt;World</a>', $text, 'TXT_ID_FORMATTED1 true false');

    $text = Abc::$babel->getHtmlTextFormatted(C::TXT_ID_FORMATTED1, false, false, ['Hello<br/>World']);
    self::assertSame('&lt;a href=&quot;/&quot;&gt;Hello&lt;br/&gt;World&lt;/a&gt;', $text, 'TXT_ID_FORMATTED1 false false');

    $text = Abc::$babel->getHtmlTextFormatted(C::TXT_ID_FORMATTED1, false, true, ['Hello<br/>World']);
    self::assertSame('&lt;a href=&quot;/&quot;&gt;Hello<br/>World&lt;/a&gt;', $text, 'TXT_ID_FORMATTED1 false true');
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
    self::assertEquals(C::LAN_ID_EN, Abc::$babel->getLanId());
    self::assertEquals('ltr', Abc::$babel->getDir());
    self::assertEquals('en', Abc::$babel->getCode());

    Abc::$babel->pushLanguage(C::LAN_ID_EN);
    self::assertEquals(C::LAN_ID_EN, Abc::$babel->getLanId(), 'Push 1');

    Abc::$babel->pushLanguage(C::LAN_ID_RU);
    self::assertEquals(C::LAN_ID_RU, Abc::$babel->getLanId(), 'Push 2');

    Abc::$babel->pushLanguage(C::LAN_ID_NL);
    self::assertEquals(C::LAN_ID_NL, Abc::$babel->getLanId(), 'Push 3');

    Abc::$babel->popLanguage();
    self::assertEquals(C::LAN_ID_RU, Abc::$babel->getLanId(), 'Pop 3');
    self::assertEquals('ltr', Abc::$babel->getDir());
    self::assertEquals('ru', Abc::$babel->getCode());

    Abc::$babel->popLanguage();
    self::assertEquals(C::LAN_ID_EN, Abc::$babel->getLanId(), 'Pop 2');
    self::assertEquals('ltr', Abc::$babel->getDir());
    self::assertEquals('en', Abc::$babel->getCode());

    Abc::$babel->popLanguage();
    self::assertEquals(C::LAN_ID_EN, Abc::$babel->getLanId(), 'Pop 1');
    self::assertEquals('ltr', Abc::$babel->getDir());
    self::assertEquals('en', Abc::$babel->getCode());
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Connects to the MySQL server and cleans the BLOB tables.
   */
  protected function setUp()
  {
    Abc::$DL->connect('localhost', 'test', 'test', 'test');
    Abc::$DL->begin();
    Abc::$babel->setLanguage(C::LAN_ID_EN);
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Disconnects from the MySQL server.
   */
  protected function tearDown()
  {
    Abc::$DL->commit();
    Abc::$DL->disconnect();
  }

  //--------------------------------------------------------------------------------------------------------------------
}

//----------------------------------------------------------------------------------------------------------------------
