это папка для фунционала который не нужен в этом сайте.

Все файлы и папаки имеют туже структуру и перенесены сюда -- для работы - просто возвращаем их на место и , или
подключаем , классы инициализируем если это необходимо


Классы -из App перенесены сюда. и не инициализированы
если необходимо -возвращаем из назад в папку App  структруой как сдесь и инициализируем обьекты класса и или применяем их фунционал-
подключение автомитическое через "psr-4" в composer.json

functions , includes -- подключение отключеныы с core файлах и перенесены сюда с той же структурой вложения
-- если необходимо - возвращаем -используем


в корне Темы файл theme.json -- ширина гутенберг блоков в редакторе!

Подключение carbon fields
добавление в composer.json сторочек подулючение классов
 "autoload": {
        "psr-4": {
            "AlexExtraCore\\App\\": "src/App/",
 ===>       "Carbon_Fields\\": "src/Libs/CarbonFieldsInit/"  <=====

        }
    },
это подключит классы
 add it in composer.json and update for get carbon-fields
 {composer update} command Require!

 "require": {
        "htmlburger/carbon-fields": "^3.3"
    }


autoload!! -- set autoloading for carbon fields setting and   {composer update} command Require!
 "autoload": {
        "psr-4": {
            "AlexExtraCore\\App\\": "src/App/",
            "Carbon_Fields\\": "src/Libs/CarbonFieldsInit/", == ADD this string in autoload for carbon fields setting
            "AlexExtraCore\\TGM\\TgmSettings\\": "src/Libs/TGM/TgmSettings/"
        }
    },