<?php
declare(strict_types=1);

namespace Plaisio\Babel\Test;

use PHPUnit\Framework\TestCase;
use Plaisio\Babel\CoreBabel;
use Plaisio\C;
use Plaisio\Kernel\Nub;

/**
 * Test cases for class CoreBabel.
 */
class CoreBabelTest extends TestCase
{
  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Our concrete instance of Kernel.
   *
   * @var Nub
   */
  private static $nub;

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Creates the concrete implementation of the ABC Framework.
   */
  public static function setUpBeforeClass(): void
  {
    parent::setUpBeforeClass();

    self::$nub = new Framework();
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test cases for method getFormattedDate with language en-US and date given as a string.
   */
  public function testGetFormattedDate1a(): void
  {
    $formatted = Nub::$babel->getFormattedDate(CoreBabel::FORMAT_FULL, '1966-04-10');
    self::assertSame('Sunday, April 10, 1966', $formatted, 'full');

    $formatted = Nub::$babel->getFormattedDate(CoreBabel::FORMAT_LONG, '1966-04-10');
    self::assertSame('April 10, 1966', $formatted, 'long');

    $formatted = Nub::$babel->getFormattedDate(CoreBabel::FORMAT_MEDIUM, '1966-04-10');
    self::assertSame('Apr 10, 1966', $formatted, 'medium');

    $formatted = Nub::$babel->getFormattedDate(CoreBabel::FORMAT_SHORT, '1966-04-10');
    self::assertSame('04/10/1966', $formatted, 'short');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test cases for method getFormattedDate with language en-US and date given as a DateTime object.
   */
  public function testGetFormattedDate1b(): void
  {
    $formatted = Nub::$babel->getFormattedDate(CoreBabel::FORMAT_FULL, new \DateTime('1966-04-10'));
    self::assertSame('Sunday, April 10, 1966', $formatted, 'full');

    $formatted = Nub::$babel->getFormattedDate(CoreBabel::FORMAT_LONG, new \DateTimeImmutable('1966-04-10'));
    self::assertSame('April 10, 1966', $formatted, 'long');

    $formatted = Nub::$babel->getFormattedDate(CoreBabel::FORMAT_MEDIUM, new \DateTime('1966-04-10'));
    self::assertSame('Apr 10, 1966', $formatted, 'medium');

    $formatted = Nub::$babel->getFormattedDate(CoreBabel::FORMAT_SHORT, new \DateTimeImmutable('1966-04-10'));
    self::assertSame('04/10/1966', $formatted, 'short');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test cases for method getFormattedDate with language en-US and date given as an int.
   */
  public function testGetFormattedDate1c(): void
  {
    $formatted = Nub::$babel->getFormattedDate(CoreBabel::FORMAT_FULL, 19660410);
    self::assertSame('Sunday, April 10, 1966', $formatted, 'full');

    $formatted = Nub::$babel->getFormattedDate(CoreBabel::FORMAT_LONG, 19660410);
    self::assertSame('April 10, 1966', $formatted, 'long');

    $formatted = Nub::$babel->getFormattedDate(CoreBabel::FORMAT_MEDIUM, 19660410);
    self::assertSame('Apr 10, 1966', $formatted, 'medium');

    $formatted = Nub::$babel->getFormattedDate(CoreBabel::FORMAT_SHORT, 19660410);
    self::assertSame('04/10/1966', $formatted, 'short');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test cases for method getFormattedDate with language en-US and empty dates.
   */
  public function testGetFormattedDate1d(): void
  {
    $formatted = Nub::$babel->getFormattedDate(CoreBabel::FORMAT_FULL, '');
    self::assertSame('', $formatted, 'empty');

    $formatted = Nub::$babel->getFormattedDate(CoreBabel::FORMAT_FULL, null);
    self::assertSame('', $formatted, 'null');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test cases for method getFormattedDate with language nl-NL and date given as a string..
   */
  public function testGetFormattedDate2a(): void
  {
    Nub::$babel->pushLanguage(C::LAN_ID_NL);

    $formatted = Nub::$babel->getFormattedDate(CoreBabel::FORMAT_FULL, '1966-04-10');
    self::assertSame('zondag 10 april 1966', $formatted, 'full');

    $formatted = Nub::$babel->getFormattedDate(CoreBabel::FORMAT_LONG, '1966-04-10');
    self::assertSame('10 april 1966', $formatted, 'long');

    $formatted = Nub::$babel->getFormattedDate(CoreBabel::FORMAT_MEDIUM, '1966-04-10');
    self::assertSame('10 apr 1966', $formatted, 'medium');

    $formatted = Nub::$babel->getFormattedDate(CoreBabel::FORMAT_SHORT, '1966-04-10');
    self::assertSame('10-04-1966', $formatted, 'short');

    Nub::$babel->popLanguage();
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test cases for method getFormattedDate with language nl-NL and date given as an object.
   */
  public function testGetFormattedDate2b(): void
  {
    Nub::$babel->pushLanguage(C::LAN_ID_NL);

    $formatted = Nub::$babel->getFormattedDate(CoreBabel::FORMAT_FULL, new \DateTimeImmutable('1966-04-10'));
    self::assertSame('zondag 10 april 1966', $formatted, 'full');

    $formatted = Nub::$babel->getFormattedDate(CoreBabel::FORMAT_LONG, new \DateTime('1966-04-10'));
    self::assertSame('10 april 1966', $formatted, 'long');

    $formatted = Nub::$babel->getFormattedDate(CoreBabel::FORMAT_MEDIUM, new \DateTimeImmutable('1966-04-10'));
    self::assertSame('10 apr 1966', $formatted, 'medium');

    $formatted = Nub::$babel->getFormattedDate(CoreBabel::FORMAT_SHORT, new \DateTime('1966-04-10'));
    self::assertSame('10-04-1966', $formatted, 'short');

    Nub::$babel->popLanguage();
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test cases for method getFormattedDate with language nl-NL and date given as an int.
   */
  public function testGetFormattedDate2c(): void
  {
    Nub::$babel->pushLanguage(C::LAN_ID_NL);

    $formatted = Nub::$babel->getFormattedDate(CoreBabel::FORMAT_FULL, 19660410);
    self::assertSame('zondag 10 april 1966', $formatted, 'full');

    $formatted = Nub::$babel->getFormattedDate(CoreBabel::FORMAT_LONG, 19660410);
    self::assertSame('10 april 1966', $formatted, 'long');

    $formatted = Nub::$babel->getFormattedDate(CoreBabel::FORMAT_MEDIUM, 19660410);
    self::assertSame('10 apr 1966', $formatted, 'medium');

    $formatted = Nub::$babel->getFormattedDate(CoreBabel::FORMAT_SHORT, 19660410);
    self::assertSame('10-04-1966', $formatted, 'short');

    Nub::$babel->popLanguage();
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test cases for method Babel:getHtmlText.
   */
  public function testGetHtmlText1(): void
  {
    $text = Nub::$babel->getHtmlText(C::TXT_ID_HELLO_TEXT);
    self::assertSame('Hello Text', $text, 'TXT_ID_HELLO_TEXT');

    $text = Nub::$babel->getHtmlText(C::TXT_ID_HELLO_TEXT_SPECIAL);
    self::assertSame('&lt;Hello Text&gt;', $text, 'TXT_ID_HELLO_TEXT_SPECIAL');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test cases for method Babel:getHtmlTextFormatted.
   */
  public function testGetHtmlTextFormatted1(): void
  {
    $text = Nub::$babel->getHtmlTextFormatted(C::TXT_ID_FORMATTED1, true, true, ['Hello<br/>World']);
    self::assertSame('<a href="/">Hello<br/>World</a>', $text, 'TXT_ID_FORMATTED1 true true');

    $text = Nub::$babel->getHtmlTextFormatted(C::TXT_ID_FORMATTED1, true, false, ['Hello<br/>World']);
    self::assertSame('<a href="/">Hello&lt;br/&gt;World</a>', $text, 'TXT_ID_FORMATTED1 true false');

    $text = Nub::$babel->getHtmlTextFormatted(C::TXT_ID_FORMATTED1, false, false, ['Hello<br/>World']);
    self::assertSame('&lt;a href=&quot;/&quot;&gt;Hello&lt;br/&gt;World&lt;/a&gt;', $text, 'TXT_ID_FORMATTED1 false false');

    $text = Nub::$babel->getHtmlTextFormatted(C::TXT_ID_FORMATTED1, false, true, ['Hello<br/>World']);
    self::assertSame('&lt;a href=&quot;/&quot;&gt;Hello<br/>World&lt;/a&gt;', $text, 'TXT_ID_FORMATTED1 false true');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test cases for method Babel:getHtmlTextReplaced.
   */
  public function testGetHtmlTextReplaced1(): void
  {
    $text = Nub::$babel->getHtmlTextReplaced(C::TXT_ID_REPLACED1, true, true, ['@TEXT@' => 'Hello<br/>World']);
    self::assertSame('<a href="/">Hello<br/>World</a>', $text, 'TXT_ID_REPLACED1 true true');

    $text = Nub::$babel->getHtmlTextReplaced(C::TXT_ID_REPLACED1, true, false, ['@TEXT@' => 'Hello<br/>World']);
    self::assertSame('<a href="/">Hello&lt;br/&gt;World</a>', $text, 'TXT_ID_REPLACED1 true false');

    $text = Nub::$babel->getHtmlTextReplaced(C::TXT_ID_REPLACED1, false, false, ['@TEXT@' => 'Hello<br/>World']);
    self::assertSame('&lt;a href=&quot;/&quot;&gt;Hello&lt;br/&gt;World&lt;/a&gt;', $text, 'TXT_ID_REPLACED1 false false');

    $text = Nub::$babel->getHtmlTextReplaced(C::TXT_ID_REPLACED1, false, true, ['@TEXT@' => 'Hello<br/>World']);
    self::assertSame('&lt;a href=&quot;/&quot;&gt;Hello<br/>World&lt;/a&gt;', $text, 'TXT_ID_REPLACED1 false true');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test cases for method Babel:getHtmlWord.
   */
  public function testGetHtmlWord1(): void
  {
    $word = Nub::$babel->getHtmlWord(C::WRD_ID_HELLO_WORD);
    self::assertSame('Hello Word', $word, 'WRD_ID_HELLO_WORD');

    $word = Nub::$babel->getHtmlWord(C::WRD_ID_HELLO_WORD_SPECIAL);
    self::assertSame('&lt;Hello Word&gt;', $word, 'WRD_ID_HELLO_WORD_SPECIAL');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test cases for method getInternalLanguageMap.
   */
  public function testGetInternalLanguageMap(): void
  {
    $map = Nub::$babel->getInternalLanguageMap();
    self::assertSame(4, sizeof($map));
    self::assertEquals(1, $map['en']);
    self::assertEquals(2, $map['nl']);
    self::assertEquals(3, $map['ru']);
    self::assertEquals(4, $map['nl-be']);
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test cases for method Babel:getText.
   */
  public function testGetText1(): void
  {
    $text = Nub::$babel->getText(C::TXT_ID_HELLO_TEXT);
    self::assertSame('Hello Text', $text, 'TXT_ID_HELLO_TEXT');

    $text = Nub::$babel->getText(C::TXT_ID_HELLO_TEXT_SPECIAL);
    self::assertSame('<Hello Text>', $text, 'TXT_ID_HELLO_TEXT_SPECIAL');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test cases for method Babel:getWord.
   */
  public function testGetWord1(): void
  {
    $word = Nub::$babel->getWord(C::WRD_ID_HELLO_WORD);
    self::assertSame('Hello Word', $word, 'WRD_ID_HELLO_WORD');

    $word = Nub::$babel->getWord(C::WRD_ID_HELLO_WORD_SPECIAL);
    self::assertSame('<Hello Word>', $word, 'WRD_ID_HELLO_WORD_SPECIAL');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test cases for methods Babel::popLanguage and Babel::pushLanguage.
   */
  public function testLanguageStack(): void
  {
    self::assertEquals(C::LAN_ID_EN, Nub::$babel->getLanId());
    self::assertEquals('ltr', Nub::$babel->getDir());
    self::assertEquals('en', Nub::$babel->getInternalCode());
    self::assertEquals('en', Nub::$babel->getLang());
    self::assertEquals('en_US.utf8', Nub::$babel->getLocale());

    Nub::$babel->pushLanguage(C::LAN_ID_EN);
    self::assertEquals(C::LAN_ID_EN, Nub::$babel->getLanId(), 'Push 1');
    self::assertEquals('en', Nub::$babel->getInternalCode());
    self::assertEquals('en', Nub::$babel->getLang());
    self::assertEquals('en_US.utf8', Nub::$babel->getLocale());

    Nub::$babel->pushLanguage(C::LAN_ID_RU);
    self::assertEquals(C::LAN_ID_RU, Nub::$babel->getLanId(), 'Push 2');
    self::assertEquals('ru', Nub::$babel->getInternalCode());
    self::assertEquals('ru', Nub::$babel->getLang());
    self::assertEquals('ru_RU.utf8', Nub::$babel->getLocale());

    Nub::$babel->pushLanguage(C::LAN_ID_NL);
    self::assertEquals(C::LAN_ID_NL, Nub::$babel->getLanId(), 'Push 3');
    self::assertEquals('nl', Nub::$babel->getInternalCode());
    self::assertEquals('nl', Nub::$babel->getLang());
    self::assertEquals('nl_NL.utf8', Nub::$babel->getLocale());

    Nub::$babel->pushLanguage(C::LAN_ID_NL_BE);
    self::assertEquals(C::LAN_ID_NL_BE, Nub::$babel->getLanId(), 'Push 4');
    self::assertEquals('nl-be', Nub::$babel->getInternalCode());
    self::assertEquals('nl', Nub::$babel->getLang());
    self::assertEquals('nl_BE.utf8', Nub::$babel->getLocale());

    Nub::$babel->popLanguage();
    self::assertEquals(C::LAN_ID_NL, Nub::$babel->getLanId(), 'Pop 4');
    self::assertEquals('ltr', Nub::$babel->getDir());
    self::assertEquals('nl', Nub::$babel->getInternalCode());
    self::assertEquals('nl', Nub::$babel->getLang());
    self::assertEquals('nl_NL.utf8', Nub::$babel->getLocale());

    Nub::$babel->popLanguage();
    self::assertEquals(C::LAN_ID_RU, Nub::$babel->getLanId(), 'Pop 3');
    self::assertEquals('ltr', Nub::$babel->getDir());
    self::assertEquals('ru', Nub::$babel->getInternalCode());
    self::assertEquals('ru', Nub::$babel->getLang());
    self::assertEquals('ru_RU.utf8', Nub::$babel->getLocale());

    Nub::$babel->popLanguage();
    self::assertEquals(C::LAN_ID_EN, Nub::$babel->getLanId(), 'Pop 2');
    self::assertEquals('ltr', Nub::$babel->getDir());
    self::assertEquals('en', Nub::$babel->getInternalCode());
    self::assertEquals('en', Nub::$babel->getLang());
    self::assertEquals('en_US.utf8', Nub::$babel->getLocale());

    Nub::$babel->popLanguage();
    self::assertEquals(C::LAN_ID_EN, Nub::$babel->getLanId(), 'Pop 1');
    self::assertEquals('ltr', Nub::$babel->getDir());
    self::assertEquals('en', Nub::$babel->getInternalCode());
    self::assertEquals('en', Nub::$babel->getLang());
    self::assertEquals('en_US.utf8', Nub::$babel->getLocale());
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Connects to the MySQL server and cleans the BLOB tables.
   */
  protected function setUp(): void
  {
    Nub::$DL->connect('localhost', 'test', 'test', 'test');
    Nub::$DL->begin();
    Nub::$babel->setLanguage(C::LAN_ID_EN);
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Disconnects from the MySQL server.
   */
  protected function tearDown(): void
  {
    Nub::$DL->commit();
    Nub::$DL->disconnect();
  }

  //--------------------------------------------------------------------------------------------------------------------
}

//----------------------------------------------------------------------------------------------------------------------
