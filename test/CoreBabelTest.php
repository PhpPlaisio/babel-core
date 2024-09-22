<?php
declare(strict_types=1);

namespace Plaisio\Babel\Test;

use PHPUnit\Framework\TestCase;
use Plaisio\Babel\Babel;
use Plaisio\C;

/**
 * Test cases for class CoreBabel.
 */
class CoreBabelTest extends TestCase
{
  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Our concrete instance of Kernel.
   *
   * @var TestKernel
   */
  private static TestKernel $nub;

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Creates the concrete implementation of the PhpPlaisio TestKernel.
   */
  public static function setUpBeforeClass(): void
  {
    parent::setUpBeforeClass();

    self::$nub = new TestKernel();
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test cases for method getFormattedDate with language en-US and date given as a string.
   */
  public function testGetFormattedDate1a(): void
  {
    $formatted = self::$nub->babel->getFormattedDate(Babel::FORMAT_FULL, '1966-04-10');
    self::assertSame('Sunday, April 10, 1966', $formatted, 'full');

    $formatted = self::$nub->babel->getFormattedDate(Babel::FORMAT_LONG, '1966-04-10');
    self::assertSame('April 10, 1966', $formatted, 'long');

    $formatted = self::$nub->babel->getFormattedDate(Babel::FORMAT_MEDIUM, '1966-04-10');
    self::assertSame('Apr 10, 1966', $formatted, 'medium');

    $formatted = self::$nub->babel->getFormattedDate(Babel::FORMAT_SHORT, '1966-04-10');
    self::assertSame('04/10/1966', $formatted, 'short');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test cases for method getFormattedDate with language en-US and date given as a DateTime object.
   */
  public function testGetFormattedDate1b(): void
  {
    $formatted = self::$nub->babel->getFormattedDate(Babel::FORMAT_FULL, new \DateTime('1966-04-10'));
    self::assertSame('Sunday, April 10, 1966', $formatted, 'full');

    $formatted = self::$nub->babel->getFormattedDate(Babel::FORMAT_LONG, new \DateTimeImmutable('1966-04-10'));
    self::assertSame('April 10, 1966', $formatted, 'long');

    $formatted = self::$nub->babel->getFormattedDate(Babel::FORMAT_MEDIUM, new \DateTime('1966-04-10'));
    self::assertSame('Apr 10, 1966', $formatted, 'medium');

    $formatted = self::$nub->babel->getFormattedDate(Babel::FORMAT_SHORT, new \DateTimeImmutable('1966-04-10'));
    self::assertSame('04/10/1966', $formatted, 'short');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test cases for method getFormattedDate with language en-US and date given as an int.
   */
  public function testGetFormattedDate1c(): void
  {
    $formatted = self::$nub->babel->getFormattedDate(Babel::FORMAT_FULL, 19660410);
    self::assertSame('Sunday, April 10, 1966', $formatted, 'full');

    $formatted = self::$nub->babel->getFormattedDate(Babel::FORMAT_LONG, 19660410);
    self::assertSame('April 10, 1966', $formatted, 'long');

    $formatted = self::$nub->babel->getFormattedDate(Babel::FORMAT_MEDIUM, 19660410);
    self::assertSame('Apr 10, 1966', $formatted, 'medium');

    $formatted = self::$nub->babel->getFormattedDate(Babel::FORMAT_SHORT, 19660410);
    self::assertSame('04/10/1966', $formatted, 'short');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test cases for method getFormattedDate with language en-US and empty dates.
   */
  public function testGetFormattedDate1d(): void
  {
    $formatted = self::$nub->babel->getFormattedDate(Babel::FORMAT_FULL, '');
    self::assertSame('', $formatted, 'empty');

    $formatted = self::$nub->babel->getFormattedDate(Babel::FORMAT_FULL, null);
    self::assertSame('', $formatted, 'null');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test cases for method getFormattedDate with language nl-NL and date given as a string..
   */
  public function testGetFormattedDate2a(): void
  {
    self::$nub->babel->pushLanguage(C::LAN_ID_NL);

    $formatted = self::$nub->babel->getFormattedDate(Babel::FORMAT_FULL, '1966-04-10');
    self::assertSame('zondag 10 april 1966', $formatted, 'full');

    $formatted = self::$nub->babel->getFormattedDate(Babel::FORMAT_LONG, '1966-04-10');
    self::assertSame('10 april 1966', $formatted, 'long');

    $formatted = self::$nub->babel->getFormattedDate(Babel::FORMAT_MEDIUM, '1966-04-10');
    self::assertSame('10 apr 1966', str_replace('.', '', $formatted), 'medium');

    $formatted = self::$nub->babel->getFormattedDate(Babel::FORMAT_SHORT, '1966-04-10');
    self::assertSame('10-04-1966', $formatted, 'short');

    self::$nub->babel->popLanguage();
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test cases for method getFormattedDate with language nl-NL and date given as an object.
   */
  public function testGetFormattedDate2b(): void
  {
    self::$nub->babel->pushLanguage(C::LAN_ID_NL);

    $formatted = self::$nub->babel->getFormattedDate(Babel::FORMAT_FULL, new \DateTimeImmutable('1966-04-10'));
    self::assertSame('zondag 10 april 1966', $formatted, 'full');

    $formatted = self::$nub->babel->getFormattedDate(Babel::FORMAT_LONG, new \DateTime('1966-04-10'));
    self::assertSame('10 april 1966', $formatted, 'long');

    $formatted = self::$nub->babel->getFormattedDate(Babel::FORMAT_MEDIUM, new \DateTimeImmutable('1966-04-10'));
    self::assertSame('10 apr 1966', str_replace('.', '', $formatted), 'medium');

    $formatted = self::$nub->babel->getFormattedDate(Babel::FORMAT_SHORT, new \DateTime('1966-04-10'));
    self::assertSame('10-04-1966', $formatted, 'short');

    self::$nub->babel->popLanguage();
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test cases for method getFormattedDate with language nl-NL and date given as an int.
   */
  public function testGetFormattedDate2c(): void
  {
    self::$nub->babel->pushLanguage(C::LAN_ID_NL);

    $formatted = self::$nub->babel->getFormattedDate(Babel::FORMAT_FULL, 19660410);
    self::assertSame('zondag 10 april 1966', $formatted, 'full');

    $formatted = self::$nub->babel->getFormattedDate(Babel::FORMAT_LONG, 19660410);
    self::assertSame('10 april 1966', $formatted, 'long');

    $formatted = self::$nub->babel->getFormattedDate(Babel::FORMAT_MEDIUM, 19660410);
    self::assertSame('10 apr 1966', str_replace('.', '', $formatted), 'medium');

    $formatted = self::$nub->babel->getFormattedDate(Babel::FORMAT_SHORT, 19660410);
    self::assertSame('10-04-1966', $formatted, 'short');

    self::$nub->babel->popLanguage();
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test cases for method Babel:getHtmlText.
   */
  public function testGetHtmlText1(): void
  {
    $text = self::$nub->babel->getHtmlText(C::TXT_ID_HELLO_TEXT);
    self::assertSame('Hello Text', $text, 'TXT_ID_HELLO_TEXT');

    $text = self::$nub->babel->getHtmlText(C::TXT_ID_HELLO_TEXT_SPECIAL);
    self::assertSame('&lt;Hello Text&gt;', $text, 'TXT_ID_HELLO_TEXT_SPECIAL');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test cases for method Babel:getHtmlTextFormatted.
   */
  public function testGetHtmlTextFormatted1(): void
  {
    $text = self::$nub->babel->getHtmlTextFormatted(C::TXT_ID_FORMATTED1, true, true, ['Hello<br/>World']);
    self::assertSame('<a href="/">Hello<br/>World</a>', $text, 'TXT_ID_FORMATTED1 true true');

    $text = self::$nub->babel->getHtmlTextFormatted(C::TXT_ID_FORMATTED1, true, false, ['Hello<br/>World']);
    self::assertSame('<a href="/">Hello&lt;br/&gt;World</a>', $text, 'TXT_ID_FORMATTED1 true false');

    $text = self::$nub->babel->getHtmlTextFormatted(C::TXT_ID_FORMATTED1, false, false, ['Hello<br/>World']);
    self::assertSame('&lt;a href=&quot;/&quot;&gt;Hello&lt;br/&gt;World&lt;/a&gt;', $text, 'TXT_ID_FORMATTED1 false false');

    $text = self::$nub->babel->getHtmlTextFormatted(C::TXT_ID_FORMATTED1, false, true, ['Hello<br/>World']);
    self::assertSame('&lt;a href=&quot;/&quot;&gt;Hello<br/>World&lt;/a&gt;', $text, 'TXT_ID_FORMATTED1 false true');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test cases for method Babel:getHtmlTextReplaced.
   */
  public function testGetHtmlTextReplaced1(): void
  {
    $text = self::$nub->babel->getHtmlTextReplaced(C::TXT_ID_REPLACED1, true, true, ['@TEXT@' => 'Hello<br/>World']);
    self::assertSame('<a href="/">Hello<br/>World</a>', $text, 'TXT_ID_REPLACED1 true true');

    $text = self::$nub->babel->getHtmlTextReplaced(C::TXT_ID_REPLACED1, true, false, ['@TEXT@' => 'Hello<br/>World']);
    self::assertSame('<a href="/">Hello&lt;br/&gt;World</a>', $text, 'TXT_ID_REPLACED1 true false');

    $text = self::$nub->babel->getHtmlTextReplaced(C::TXT_ID_REPLACED1, false, false, ['@TEXT@' => 'Hello<br/>World']);
    self::assertSame('&lt;a href=&quot;/&quot;&gt;Hello&lt;br/&gt;World&lt;/a&gt;', $text, 'TXT_ID_REPLACED1 false false');

    $text = self::$nub->babel->getHtmlTextReplaced(C::TXT_ID_REPLACED1, false, true, ['@TEXT@' => 'Hello<br/>World']);
    self::assertSame('&lt;a href=&quot;/&quot;&gt;Hello<br/>World&lt;/a&gt;', $text, 'TXT_ID_REPLACED1 false true');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test cases for method Babel:getHtmlWord.
   */
  public function testGetHtmlWord1(): void
  {
    $word = self::$nub->babel->getHtmlWord(C::WRD_ID_HELLO_WORD);
    self::assertSame('Hello Word', $word, 'WRD_ID_HELLO_WORD');

    $word = self::$nub->babel->getHtmlWord(C::WRD_ID_HELLO_WORD_SPECIAL);
    self::assertSame('&lt;Hello Word&gt;', $word, 'WRD_ID_HELLO_WORD_SPECIAL');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test cases for method getInternalLanguageMap.
   */
  public function testGetInternalLanguageMap(): void
  {
    $map = self::$nub->babel->getInternalLanguageMap();
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
    $text = self::$nub->babel->getText(C::TXT_ID_HELLO_TEXT);
    self::assertSame('Hello Text', $text, 'TXT_ID_HELLO_TEXT');

    $text = self::$nub->babel->getText(C::TXT_ID_HELLO_TEXT_SPECIAL);
    self::assertSame('<Hello Text>', $text, 'TXT_ID_HELLO_TEXT_SPECIAL');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test cases for method Babel:getWord.
   */
  public function testGetWord1(): void
  {
    $word = self::$nub->babel->getWord(C::WRD_ID_HELLO_WORD);
    self::assertSame('Hello Word', $word, 'WRD_ID_HELLO_WORD');

    $word = self::$nub->babel->getWord(C::WRD_ID_HELLO_WORD_SPECIAL);
    self::assertSame('<Hello Word>', $word, 'WRD_ID_HELLO_WORD_SPECIAL');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test cases for methods Babel::popLanguage and Babel::pushLanguage.
   */
  public function testLanguageStack(): void
  {
    self::assertEquals(C::LAN_ID_EN, self::$nub->babel->lanId);
    self::assertEquals('ltr', self::$nub->babel->getDir());
    self::assertEquals('en', self::$nub->babel->getInternalCode());
    self::assertEquals('en', self::$nub->babel->getLang());
    self::assertEquals('en_US.utf8', self::$nub->babel->getLocale());

    self::$nub->babel->pushLanguage(C::LAN_ID_EN);
    self::assertEquals(C::LAN_ID_EN, self::$nub->babel->lanId, 'Push 1');
    self::assertEquals('en', self::$nub->babel->getInternalCode());
    self::assertEquals('en', self::$nub->babel->getLang());
    self::assertEquals('en_US.utf8', self::$nub->babel->getLocale());

    self::$nub->babel->pushLanguage(C::LAN_ID_RU);
    self::assertEquals(C::LAN_ID_RU, self::$nub->babel->lanId, 'Push 2');
    self::assertEquals('ru', self::$nub->babel->getInternalCode());
    self::assertEquals('ru', self::$nub->babel->getLang());
    self::assertEquals('ru_RU.utf8', self::$nub->babel->getLocale());

    self::$nub->babel->pushLanguage(C::LAN_ID_NL);
    self::assertEquals(C::LAN_ID_NL, self::$nub->babel->lanId, 'Push 3');
    self::assertEquals('nl', self::$nub->babel->getInternalCode());
    self::assertEquals('nl', self::$nub->babel->getLang());
    self::assertEquals('nl_NL.utf8', self::$nub->babel->getLocale());

    self::$nub->babel->pushLanguage(C::LAN_ID_NL_BE);
    self::assertEquals(C::LAN_ID_NL_BE, self::$nub->babel->lanId, 'Push 4');
    self::assertEquals('nl-be', self::$nub->babel->getInternalCode());
    self::assertEquals('nl', self::$nub->babel->getLang());
    self::assertEquals('nl_BE.utf8', self::$nub->babel->getLocale());

    self::$nub->babel->popLanguage();
    self::assertEquals(C::LAN_ID_NL, self::$nub->babel->lanId, 'Pop 4');
    self::assertEquals('ltr', self::$nub->babel->getDir());
    self::assertEquals('nl', self::$nub->babel->getInternalCode());
    self::assertEquals('nl', self::$nub->babel->getLang());
    self::assertEquals('nl_NL.utf8', self::$nub->babel->getLocale());

    self::$nub->babel->popLanguage();
    self::assertEquals(C::LAN_ID_RU, self::$nub->babel->lanId, 'Pop 3');
    self::assertEquals('ltr', self::$nub->babel->getDir());
    self::assertEquals('ru', self::$nub->babel->getInternalCode());
    self::assertEquals('ru', self::$nub->babel->getLang());
    self::assertEquals('ru_RU.utf8', self::$nub->babel->getLocale());

    self::$nub->babel->popLanguage();
    self::assertEquals(C::LAN_ID_EN, self::$nub->babel->lanId, 'Pop 2');
    self::assertEquals('ltr', self::$nub->babel->getDir());
    self::assertEquals('en', self::$nub->babel->getInternalCode());
    self::assertEquals('en', self::$nub->babel->getLang());
    self::assertEquals('en_US.utf8', self::$nub->babel->getLocale());

    self::$nub->babel->popLanguage();
    self::assertEquals(C::LAN_ID_EN, self::$nub->babel->lanId, 'Pop 1');
    self::assertEquals('ltr', self::$nub->babel->getDir());
    self::assertEquals('en', self::$nub->babel->getInternalCode());
    self::assertEquals('en', self::$nub->babel->getLang());
    self::assertEquals('en_US.utf8', self::$nub->babel->getLocale());
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Connects to the MySQL server and cleans the BLOB tables.
   */
  protected function setUp(): void
  {
    self::$nub->DL->connect();
    self::$nub->DL->begin();
    self::$nub->babel->setLanguage(C::LAN_ID_EN);
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Disconnects from the MySQL server.
   */
  protected function tearDown(): void
  {
    self::$nub->DL->commit();
    self::$nub->DL->disconnect();
  }

  //--------------------------------------------------------------------------------------------------------------------
}

//----------------------------------------------------------------------------------------------------------------------
