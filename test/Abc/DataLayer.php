<?php
//----------------------------------------------------------------------------------------------------------------------
namespace SetBased\Abc\Babel\Test\Abc;

use SetBased\Exception\FallenException;

/**
 * Mocke up data layer for testing purposes.
 */
class DataLayer
{
  //--------------------------------------------------------------------------------------------------------------------
  public function abcBabelLanguageGetDetails($lanId)
  {
    switch ($lanId)
    {
      case C::LAN_ID_EN:
        return ['lan_id'     => C::LAN_ID_EN,
                'lan_code'   => 'en',
                'lan_dir'    => 'ltr',
                'lan_lang'   => 'en',
                'lan_locale' => 'en_US.utf8'];

      case C::LAN_ID_NL:
        return ['lan_id'     => C::LAN_ID_NL,
                'lan_code'   => 'nl',
                'lan_dir'    => 'ltr',
                'lan_lang'   => 'nl',
                'lan_locale' => 'nl_NL.urf8'];

      case C::LAN_ID_RU:
        return ['lan_id'     => C::LAN_ID_RU,
                'lan_code'   => 'ru',
                'lan_dir'    => 'ltr',
                'lan_lang'   => 'ru',
                'lan_locale' => 'ru_RU.utf8'];
    }
  }

  //--------------------------------------------------------------------------------------------------------------------
  public function abcBabelTextGetText($txtId, $lanId)
  {
    switch ($txtId)
    {
      case C::TXT_ID_HELLO_TEXT:
        return 'Hello Text';

      case C::TXT_ID_HELLO_TEXT_SPECIAL:
        return '<Hello Text>';

      default:
        throw new FallenException('txt_id', $txtId);
    }
  }

  //--------------------------------------------------------------------------------------------------------------------
  public function abcBabelWordGetWord($wrdId, $lanId)
  {
    switch ($wrdId)
    {
      case C::WRD_ID_HELLO_WORD:
        return 'Hello Word';

      case C::WRD_ID_HELLO_WORD_SPECIAL:
        return '<Hello Word>';

      default:
        throw new FallenException('wrd_id', $wrdId);
    }
  }
  //--------------------------------------------------------------------------------------------------------------------
}

//----------------------------------------------------------------------------------------------------------------------
