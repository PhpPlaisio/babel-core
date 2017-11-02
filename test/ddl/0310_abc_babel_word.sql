insert into ABC_BABEL_WORD( wrd_id
,                           wdg_id
,                           wrd_timestamp
,                           wrd_label)
values( 1
,       1
,       now()
,       'WRD_ID_ENGLISH')
,     ( 2
,       1
,       now()
,       'WRD_ID_DUTCH')
,     ( 3
,       1
,       now()
,       'WRD_ID_RUSSIAN')
;

insert into ABC_BABEL_WORD( wrd_id
,                           wdg_id
,                           wrd_timestamp
,                           wrd_label)
values( 4
,       2
,       now()
,       'WRD_ID_HELLO_WORD')
,     ( 5
,       2
,       now()
,       'WRD_ID_HELLO_WORD_SPECIAL')
;

commit;

