insert into ABC_BABEL_TEXT( txt_id
,                           ttg_id
,                           txt_timestamp
,                           txt_label)
values( 1
,       1
,       now()
,       'TXT_ID_HELLO_TEXT')
,     ( 2
,       1
,       now()
,       'TXT_ID_HELLO_TEXT_SPECIAL')
;

commit;
