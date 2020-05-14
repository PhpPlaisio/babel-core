<?php
declare(strict_types=1);

namespace Plaisio\Babel;

use Plaisio\Helper\Html;
use Plaisio\PlaisioObject;
use SetBased\Exception\FallenException;
use SetBased\Exception\RuntimeException;

/**
 * A concrete implementation of Babel that retrieves all linguistic entities from a database.
 */
class CoreBabel extends PlaisioObject implements Babel
{
  //--------------------------------------------------------------------------------------------------------------------
  /**
   * The details of the current language.
   *
   * @var array
   */
  private $language;

  /**
   * The stack with language details.
   *
   * @var array[]
   */
  private $stack = [];

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Returns the direction of the current language. See [dir](https://www.w3schools.com/tags/att_global_dir.asp)
   * attribute.
   *
   * @return string
   *
   * @since 1.0.0
   * @api
   */
  public function getDir(): string
  {
    return $this->language['lan_dir'];
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Returns a date formatted according to a date format specifier.
   *
   * @param int                            $dateType The date format specifier. One of:
   *                                                 <ul>
   *                                                 <li>Babel::FORMAT_FULL
   *                                                 <li>Babel::FORMAT_LONG
   *                                                 <li>Babel::FORMAT_MEDIUM
   *                                                 <li>Babel::FORMAT_SHORT
   *                                                 </ul>
   * @param string|\DateTimeInterface|null $date     The date.
   *
   * @return string
   *
   * @since 1.0.0
   * @api
   */
  public function getFormattedDate(int $dateType, $date): string
  {
    if ($date=='') return '';

    switch ($dateType)
    {
      case self::FORMAT_FULL:
        $format = $this->language['lan_date_format_full'];
        break;

      case self::FORMAT_LONG:
        $format = $this->language['lan_date_format_long'];
        break;

      case self::FORMAT_MEDIUM:
        $format = $this->language['lan_date_format_medium'];
        break;

      case self::FORMAT_SHORT:
        $format = $this->language['lan_date_format_short'];
        break;

      default:
        throw new FallenException('dateType', $dateType); // @codeCoverageIgnore
    }

    $oldLocale = setlocale(LC_TIME, 0);
    $locale    = setlocale(LC_TIME, $this->language['lan_locale']);
    if ($locale===false) throw new RuntimeException('Unable to set locate to %s', $this->language['lan_locale']);

    switch (true)
    {
      case is_string($date):
        $formatted = strftime($format, strtotime($date));
        break;

      case is_int($date):
        $formatted = strftime($format, strtotime((string)$date));
        break;

      case is_a($date, '\DateTimeInterface'):
        $formatted = strftime($format, $date->getTimestamp());
        break;

      default:
        throw new FallenException('type', gettype($date)); // @codeCoverageIgnore
    }

    setlocale(LC_TIME, $oldLocale);

    return $formatted;
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Returns a text in the current language with special characters converted to HTML entities.
   *
   * @param int $txtId The ID of the text.
   *
   * @return string
   *
   * @since 1.0.0
   * @api
   */
  public function getHtmlText(int $txtId): string
  {
    return Html::txt2Html($this->getText($txtId));
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Returns a text in the current language using formatting (using
   * [vsprintf](http://php.net/manual/en/function.vsprintf.php)) with special characters converted to HTML entities.
   *
   * @param int   $txtId        The ID of the text.
   * @param bool  $formatIsHtml If true the format is valid HTML code with special characters converted to HTML
   *                            entities. Otherwise, the format is plain text and special characters will be converted
   *                            to HTML entities.
   * @param bool  $argsAreHtml  If true the arguments are valid HTML code with special characters converted to HTML
   *                            entities. Otherwise, the arguments are plain text and special characters will be
   *                            converted to HTML entities.
   * @param array $args         The parameters for the format string.
   *
   * @return string
   *
   * @since 1.0.0
   * @api
   */
  public function getHtmlTextFormatted(int $txtId, bool $formatIsHtml, bool $argsAreHtml, array $args): string
  {
    switch (true)
    {
      case ($formatIsHtml===false && $argsAreHtml===false):
        return Html::txt2Html($this->getTextFormatted($txtId, $args));

      case ($formatIsHtml===false && $argsAreHtml===true):
        $text = $this->nub->DL->abcBabelCoreTextGetText($txtId, $this->lanId);

        return vsprintf(Html::txt2Html($text), $args);

      case ($formatIsHtml===true && $argsAreHtml===false):
        $text = $this->nub->DL->abcBabelCoreTextGetText($txtId, $this->lanId);

        $tmp = [];
        foreach ($args as $arg)
        {
          $tmp[] = Html::txt2Html($arg);
        }

        return vsprintf($text, $tmp);

      case ($formatIsHtml===true && $argsAreHtml===true):
        return $this->getTextFormatted($txtId, $args);

      default:
        throw new RuntimeException('2**2 > 4'); // @codeCoverageIgnore
    }
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Returns a text in the current language in which substrings are replaced (using
   * [strtr](http://php.net/manual/en/function.strtr.php)) with special characters converted to HTML entities.
   *
   * @param int   $txtId         The ID of the text.
   * @param bool  $formatIsHtml  If true the text is valid HTML code with special characters converted to HTML
   *                             entities. Otherwise, the text is plain text and special characters will be converted
   *                             to HTML entities.
   * @param bool  $valuesAreHtml If true the replace values are valid HTML code with special characters converted to
   *                             HTML entities. Otherwise, the replace values are plain text and special characters
   *                             will be converted to HTML entities.
   * @param array $replacePairs  The parameters for the format string.
   *
   * @return string
   *
   * @since 1.0.0
   * @api
   */
  public function getHtmlTextReplaced(int $txtId, bool $formatIsHtml, bool $valuesAreHtml, array $replacePairs): string
  {
    switch (true)
    {
      case ($formatIsHtml===false && $valuesAreHtml===false):
        return Html::txt2Html($this->getTextReplaced($txtId, $replacePairs));

      case ($formatIsHtml===false && $valuesAreHtml===true):
        $text = $this->nub->DL->abcBabelCoreTextGetText($txtId, $this->lanId);

        return strtr(Html::txt2Html($text), $replacePairs);

      case ($formatIsHtml===true && $valuesAreHtml===false):
        $text = $this->nub->DL->abcBabelCoreTextGetText($txtId, $this->lanId);

        $tmp = [];
        foreach ($replacePairs as $key => $value)
        {
          $tmp[$key] = Html::txt2Html($value);
        }

        return strtr($text, $tmp);

      case ($formatIsHtml===true && $valuesAreHtml===true):
        return $this->getTextReplaced($txtId, $replacePairs);

      default:
        throw new RuntimeException('2**2 > 4'); // @codeCoverageIgnore
    }
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Returns a word in the current language with special characters converted to HTML entities.
   *
   * @param int $wrdId The ID of the word.
   *
   * @return string
   *
   * @since 1.0.0
   * @api
   */
  public function getHtmlWord(int $wrdId): string
  {
    return Html::txt2Html($this->getWord($wrdId));
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Returns the internal language code of the current language.
   *
   * @return string
   *
   * @since 1.0.0
   * @api
   */
  public function getInternalCode(): string
  {
    return $this->language['lan_code'];
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Returns a map from internal language code to the ID of the language for all available languages. In other words
   * returns an array of which keys are internal language codes and the values are the ID of the corresponding
   * language.
   *
   * @return array
   *
   * @since 1.0.0
   * @api
   */
  public function getInternalLanguageMap(): array
  {
    return $this->nub->DL->abcBabelCoreInternalCodeMap();
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Returns the ISO 639-1 language code of the current language. See
   * [lang](https://www.w3schools.com/tags/ref_language_codes.asp) attribute.
   *
   * @return string
   *
   * @since 1.0.0
   * @api
   */
  public function getLang(): string
  {
    return $this->language['lan_lang'];
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Returns the locale suitable for PHP [setlocale](http://php.net/manual/en/function.setlocale.php) of the current
   * language.
   *
   * @return string
   *
   * @since 1.0.0
   * @api
   */
  public function getLocale(): string
  {
    return $this->language['lan_locale'];
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Returns the value of a text.
   *
   * @param int $txtId The ID of the text.
   *
   * @return string
   *
   * @since 1.0.0
   * @api
   */
  public function getText(int $txtId): string
  {
    return $this->nub->DL->abcBabelCoreTextGetText($txtId, $this->lanId);
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Returns a text in the current language using formatting (using
   * [vsprintf](http://php.net/manual/en/function.vsprintf.php)).
   *
   * @param int   $txtId The ID of the text.
   * @param array $args  The parameters for the format string.
   *
   * @return string
   *
   * @since 1.0.0
   * @api
   */
  public function getTextFormatted(int $txtId, array $args): string
  {
    $text = $this->nub->DL->abcBabelCoreTextGetText($txtId, $this->lanId);

    return vsprintf($text, $args);
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Returns a text in the current language in which substrings are replaced (using
   * [strtr](http://php.net/manual/en/function.strtr.php)).
   *
   * @param int   $txtId        The ID of the text.
   * @param array $replacePairs The replace pairs.
   *
   * @return string
   *
   * @since 1.0.0
   * @api
   */
  public function getTextReplaced(int $txtId, array $replacePairs): string
  {
    $text = $this->nub->DL->abcBabelCoreTextGetText($txtId, $this->lanId);

    return strtr($text, $replacePairs);
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Returns the text of a word.
   *
   * @param int $wrdId The ID of the word.
   *
   * @return string
   *
   * @since 1.0.0
   * @api
   */
  public function getWord(int $wrdId): string
  {
    return $this->nub->DL->abcBabelCoreWordGetWord($wrdId, $this->lanId);
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Restores the previous language as the current language.
   *
   * @return void
   *
   * @since 1.0.0
   * @api
   */
  public function popLanguage(): void
  {
    array_pop($this->stack);
    $this->language = $this->stack[count($this->stack) - 1];
    $this->lanId    = $this->language['lan_id'];
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Sets and pushes a new current language.
   *
   * @param int $lanId The ID of the new current language.
   *
   * @return void
   *
   * @since 1.0.0
   * @api
   */
  public function pushLanguage(int $lanId): void
  {
    $this->language = $this->nub->DL->abcBabelCoreLanguageGetDetails($lanId);
    $this->lanId    = $this->language['lan_id'];
    array_push($this->stack, $this->language);
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Replaces the current language.
   *
   * @param int $lanId The ID of the new current language.
   *
   * @return void
   *
   * @since 1.0.0
   * @api
   */
  public function setLanguage(int $lanId): void
  {
    $this->language                               = $this->nub->DL->abcBabelCoreLanguageGetDetails($lanId);
    $this->lanId                                  = $this->language['lan_id'];
    $this->stack[max(0, count($this->stack) - 1)] = $this->language;
  }

  //--------------------------------------------------------------------------------------------------------------------
}

//----------------------------------------------------------------------------------------------------------------------
