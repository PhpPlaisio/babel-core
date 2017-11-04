<?php
//----------------------------------------------------------------------------------------------------------------------
namespace SetBased\Abc\Babel;

use SetBased\Abc\Abc;
use SetBased\Abc\Helper\Html;
use SetBased\Exception\FallenException;
use SetBased\Exception\RuntimeException;

/**
 * A concrete implementation of Babel that retrieves all linguistic entities from a database.
 */
class CoreBabel implements Babel
{
  //--------------------------------------------------------------------------------------------------------------------
  /**
   * The details of the (default) language.
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
   * Returns the language code of the current default language.
   *
   * @return string
   *
   * @since 1.0.0
   * @api
   */
  public function getCode()
  {
    return $this->language['lan_code'];
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Returns the direction of the current default language. See [dir](https://www.w3schools.com/tags/att_global_dir.asp)
   * attribute.
   *
   * @return string
   *
   * @since 1.0.0
   * @api
   */
  public function getDir()
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
  public function getFormattedDate($dateType, $date)
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
        throw new FallenException('dateType', $dateType);
    }

    $oldLocale = setlocale(LC_TIME, 0);
    $locale = setlocale(LC_TIME, $this->language['lan_locale']);
    if ($locale===false) throw new RuntimeException('Unable to set locate to %d', $this->language['lan_locale']);

    switch (true)
    {
      case is_string($date):
        $formatted = strftime($format, strtotime($date));
        break;

      case is_a($date, '\DateTimeInterface'):
        $formatted = strftime($format, $date->getTimestamp());
        break;

      default:
        throw new FallenException('type', gettype($date));
    }

    setlocale(LC_TIME, $oldLocale);

    return $formatted;
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Returns a text in the default language with special characters converted to HTML entities.
   *
   * @param int $txtId The ID of the text.
   *
   * @return string
   *
   * @since 1.0.0
   * @api
   */
  public function getHtmlText($txtId)
  {
    return Html::txt2Html($this->getText($txtId));
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Returns a text in the default language using formatting (using
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
  public function getHtmlTextFormatted($txtId, $formatIsHtml, $argsAreHtml, $args)
  {
    $formatIsHtml = !empty($formatIsHtml);
    $argsAreHtml  = !empty($argsAreHtml);

    switch (true)
    {
      case ($formatIsHtml===false && $argsAreHtml===false):
        return Html::txt2Html($this->getTextFormatted($txtId, $args));

      case ($formatIsHtml===false && $argsAreHtml===true):
        $text = Abc::$DL->abcBabelTextGetText($txtId, $this->language['lan_id']);

        return vsprintf(Html::txt2Html($text), $args);

      case ($formatIsHtml===true && $argsAreHtml===false):
        $text = Abc::$DL->abcBabelTextGetText($txtId, $this->language['lan_id']);

        $tmp = [];
        foreach ($args as $arg)
        {
          $tmp[] = Html::txt2Html($arg);
        }

        return vsprintf($text, $tmp);

      case ($formatIsHtml===true && $argsAreHtml===true):
        return $this->getTextFormatted($txtId, $args);

      default:
        throw new RuntimeException('2**2 > 4');
    }
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Returns a text in the default language in which substrings are replaced (using
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
  public function getHtmlTextReplaced($txtId, $formatIsHtml, $valuesAreHtml, $replacePairs)
  {
    $formatIsHtml  = !empty($formatIsHtml);
    $valuesAreHtml = !empty($valuesAreHtml);

    switch (true)
    {
      case ($formatIsHtml===false && $valuesAreHtml===false):
        return Html::txt2Html($this->getTextReplaced($txtId, $replacePairs));

      case ($formatIsHtml===false && $valuesAreHtml===true):
        $text = Abc::$DL->abcBabelTextGetText($txtId, $this->language['lan_id']);

        return strtr(Html::txt2Html($text), $replacePairs);

      case ($formatIsHtml===true && $valuesAreHtml===false):
        $text = Abc::$DL->abcBabelTextGetText($txtId, $this->language['lan_id']);

        $tmp = [];
        foreach ($replacePairs as $key => $value)
        {
          $tmp[$key] = Html::txt2Html($value);
        }

        return strtr($text, $tmp);

      case ($formatIsHtml===true && $valuesAreHtml===true):
        return $this->getTextReplaced($txtId, $replacePairs);

      default:
        throw new RuntimeException('2**2 > 4');
    }
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Returns a word in the default language with special characters converted to HTML entities.
   *
   * @param int $wrdId The ID of the word.
   *
   * @return string
   *
   * @since 1.0.0
   * @api
   */
  public function getHtmlWord($wrdId)
  {
    return Html::txt2Html($this->getWord($wrdId));
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Returns the ID of the language.
   *
   * @return int
   *
   * @since 1.0.0
   * @api
   */
  public function getLanId()
  {
    return $this->language['lan_id'];
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Returns the ISO 639-1 language code of the current default language. See
   * [lang](https://www.w3schools.com/tags/ref_language_codes.asp) attribute.
   *
   * @return string
   *
   * @since 1.0.0
   * @api
   */
  public function getLang()
  {
    return $this->language['lan_lang'];
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
  public function getText($txtId)
  {
    return Abc::$DL->abcBabelTextGetText($txtId, $this->language['lan_id']);
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Returns a text in the default language using formatting (using
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
  public function getTextFormatted($txtId, $args)
  {
    $text = Abc::$DL->abcBabelTextGetText($txtId, $this->language['lan_id']);

    return vsprintf($text, $args);
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Returns a text in the default language in which substrings are replaced (using
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
  public function getTextReplaced($txtId, $replacePairs)
  {
    $text = Abc::$DL->abcBabelTextGetText($txtId, $this->language['lan_id']);

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
  public function getWord($wrdId)
  {
    return Abc::$DL->abcBabelWordGetWord($wrdId, $this->language['lan_id']);
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Restores the previous default language as the current default language.
   *
   * @return void
   *
   * @since 1.0.0
   * @api
   */
  public function popLanguage()
  {
    array_pop($this->stack);
    $this->language = $this->stack[count($this->stack) - 1];
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Sets a new default language.
   *
   * @param int $lanId The ID of the new default language.
   *
   * @return void
   *
   * @since 1.0.0
   * @api
   */
  public function pushLanguage($lanId)
  {
    $this->language = Abc::$DL->abcBabelLanguageGetDetails($lanId);
    array_push($this->stack, $this->language);
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Replace the current default language with a new default language.
   *
   * @param int $lanId The ID of the new default language.
   *
   * @return void
   *
   * @since 1.0.0
   * @api
   */
  public function setLanguage($lanId)
  {
    $this->language                               = Abc::$DL->abcBabelLanguageGetDetails($lanId);
    $this->stack[max(0, count($this->stack) - 1)] = $this->language;
  }

  //--------------------------------------------------------------------------------------------------------------------
}

//----------------------------------------------------------------------------------------------------------------------
