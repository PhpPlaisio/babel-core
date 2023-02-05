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
,       'en'
,       'en_US.utf8'
,       'ltr'
,       'EEEE, LLLL dd, y'
,       'LLLL dd, y'
,       'MMM dd, y'
,       'MM/dd/y'
,       'LAN_ID_EN')
,     ( 2
,       2
,       'nl'
,       'nl'
,       'nl_NL.utf8'
,       'ltr'
,       'EEEE dd LLLL y'
,       'dd LLLL y'
,       'dd MMM y'
,       'dd-MM-y'
,       'LAN_ID_NL')
,     ( 3
,       3
,       'ru'
,       'ru'
,       'ru_RU.utf8'
,       'ltr'
,       'EEEE dd LLLL y'
,       'dd LLLL y'
,       'dd MMM y'
,       'dd-MM-y'
,       'LAN_ID_RU')
,     ( 4
,       2
,       'nl-be'
,       'nl'
,       'nl_BE.utf8'
,       'ltr'
,       'EEEE dd LLLL y'
,       'dd LLLL y'
,       'dd MMM y'
,       'dd-MM-y'
,       'LAN_ID_NL_BE')
;

commit;
