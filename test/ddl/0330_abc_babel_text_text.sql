insert into ABC_BABEL_TEXT_TEXT( txt_id
,                                lan_id
,                                ttt_text
,                                ttt_timestamp)
values( 1
,       1
,       'Hello Text'
,       now())
,     ( 1
,       2
,       'Hallo Tekst'
,       now())
,     ( 2
,       1
,       '<Hello Text>'
,       now())
,     ( 2
,       2
,       '<Hallo Tekst>'
,       now())
;


commit;