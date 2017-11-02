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
,       'en_US'
,       'ltr'
,       '%A, %B %e, %Y'
,       '%B %d, %Y'
,       '%b %e, %Y'
,       '%x'
,       'LAN_ID_EN')
,     ( 2
,       2
,       'nl'
,       'nl-NL'
,       'nl_NL'
,       'ltr'
,       '%A %e %B %Y'
,       '%d %B %Y'
,       '%e %b %Y'
,       '%d-%m-%Y'
,       'LAN_ID_NL')
,     ( 3
,       3
,       'ru'
,       'ru-RU'
,       'ru_RU'
,       'ltr'
,       '%A %e %B %Y'
,       '%d %B %Y'
,       '%e %b %Y'
,       '%d-%m-%Y'
,       'LAN_ID_RU')
;

commit;