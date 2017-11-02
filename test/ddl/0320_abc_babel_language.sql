insert into ABC_BABEL_LANGUAGE( lan_id
,                               wrd_id
,                               lan_code
,                               lan_lang
,                               lan_locale
,                               lan_dir
,                               lan_date_format_full
,                               lan_date_format_long
,                               lan_date_format_medium
,                               lan_date_format_short
,                               lan_label )
values( 1
,       1
,       'en'
,       'en-US'
,       'en_US.utf8'
,       'ltr'
,       '%B %e, %Y'
,       '%b %d, %Y'
,       '%b %e, %Y'
,       '%x'
,       'LAN_ID_EN')
,     ( 2
,       2
,       'nl'
,       'nl_NL'
,       'nl_NL.utf8'
,       'ltr'
,       '%e %B %Y'
,       '%d %b %Y'
,       '%e %b %Y'
,       '%x'
,       'LAN_ID_NL')
,     ( 3
,       3
,       'ru'
,       'ru-RU'
,       'ru-RU.utf8'
,       'ltr'
,       '%B %e, %Y'
,       '%b %d, %Y'
,       '%b %e, %Y'
,       '%x'
,       'LAN_ID_RU')
;

commit;