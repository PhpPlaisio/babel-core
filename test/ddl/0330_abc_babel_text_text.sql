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

insert into ABC_BABEL_TEXT_TEXT( txt_id
,                                lan_id
,                                ttt_text
,                                ttt_timestamp)
values( 3
,       1
,       '<a href="/">%s</a>'
,       now())
,     ( 3
,       2
,       '<a href="/">%s</a>'
,       now())
,     ( 4
,       1
,       '<a href="/">@TEXT@</a>'
,       now())
,     ( 4
,       2
,       '<a href="/">@TEXT@</a>'
,       now())
;


commit;