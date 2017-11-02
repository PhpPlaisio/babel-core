insert into ABC_BABEL_WORD_TEXT( wrd_id
,                                lan_id
,                                wdt_text
,                                wdt_timestamp)
values( 1
,       1
,       'English'
,       now())
,     ( 1
,       2
,       'Engels'
,       now())
,     ( 2
,       1
,       'Dutch'
,       now())
,     ( 2
,       2
,       'Nederlands'
,       now())
;

insert into ABC_BABEL_WORD_TEXT( wrd_id
,                                lan_id
,                                wdt_text
,                                wdt_timestamp)
values( 4
,       1
,       'Hello Word'
,       now())
,     ( 4
,       2
,       'Hallo Woord'
,       now())
,     ( 5
,       1
,       '<Hello Word>'
,       now())
,     ( 5
,       2
,       '<Hallo Woord>'
,       now())
;


commit;