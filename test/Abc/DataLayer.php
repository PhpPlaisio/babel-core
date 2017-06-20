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
}

//----------------------------------------------------------------------------------------------------------------------
