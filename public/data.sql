
INSERT INTO `cities` (`sort_id`, `slug`, `title`, `lang`) VALUES
(1, 'almaty', 'Алматы', 'ru'),
(2, 'astana', 'Астана', 'ru'),
(3, 'aktau', 'Актау', 'ru'),
(4, 'aktobe', 'Актобе', 'ru'),
(5, 'atyrau', 'Атырау', 'ru'),
(6, 'zhezkazgan', 'Жезказган', 'ru'),
(7, 'karaganda', 'Караганда', 'ru'),
(8, 'kokshetau', 'Кокшетау', 'ru'),
(9, 'kostanay', 'Костанай', 'ru'),
(10, 'kyzylorda', 'Кызылорда', 'ru'),
(11, 'pavlodar', 'Павлодар', 'ru'),
(12, 'petropavlovsk', 'Петропавловск', 'ru'),
(13, 'semey', 'Семей', 'ru'),
(14, 'taldykorgan', 'Талдыкорган', 'ru'),
(15, 'taraz', 'Тараз', 'ru'),
(16, 'temirtau', 'Темиртау', 'ru'),
(17, 'uralsk', 'Уральск', 'ru'),
(18, 'ust-kamenogorsk', 'Усть-Каменогорск', 'ru'),
(19, 'shymkent', 'Шымкент', 'ru'),
(20, 'ekibastuz', 'Экибастуз', 'ru');

INSERT INTO `pages` (`sort_id`, `slug`, `title`, `title_description`, `meta_description`, `text`, `lang`, `status`) VALUES
(1, 'o-proekte', 'О проекте', 'Вызов.кз', 'Вызов.кз - Доска объявлении.', 'Вызов.кз - Доска объявлении.', 'ru', 1),
(2, 'napisat-pismo', 'Написать письмо', '', '', '', 'ru', 1),
(3, 'pravila-sayta', 'Правила сайта', '', '', '', 'ru', 1),
(4, 'reklama-na-sayte', 'Реклама на сайте', '', '', '', 'ru', 1);

INSERT INTO `services` (`sort_id`, `route`, `slug`, `title`, `title_description`, `meta_description`, `text`, `lang`, `status`) VALUES
(1, 'call', 'uslugi_vyzova', 'Услуги вызова', '', '', '', 'ru', 1),
(2, 'repair', 'uslugi_remonta', 'Услуги ремонта', '', '', '', 'ru', 1),
(3, 'materials', 'stroymaterialy', 'Стройматериалы', '', '', '', 'ru', 1);

INSERT INTO `section` (`sort_id`, `service_id`, `slug`, `title`, `image`, `title_description`, `meta_description`, `text`, `lang`, `status`) VALUES
(1, 1, 'uslugi-blagoustroystva', 'Услуги благоустройства', 'Услуги-благоустроиства.png', '', '', '', 'ru', 1),
(2, 1, 'inzhenernye-uslugi', 'Инженерные услуги', 'Инженерные-услуги.png', '', '', '', 'ru', 1),
(3, 1, 'obrazovatelnye-uslugi', 'Образовательные услуги', 'Образование.png', '', '', '', 'ru', 1),
(4, 1, 'finansy-i-bukhgalteriya', 'Финансы и бухгалтерия', 'Финансы-и-бухгалтерия.png', '', '', '', 'ru', 1),
(5, 1, 'kulinariya', 'Кулинария', 'Кулинария.png', '', '', '', 'ru', 1),
(6, 1, 'meditsina', 'Медицина', 'Медицина.png', '', '', '', 'ru', 1),
(7, 1, 'okhrana-i-bezopasnost', 'Охрана и безопасность', 'Охрана.png', '', '', '', 'ru', 1),
(8, 1, 'turizm-i-puteshestvie', 'Туризм и путешествие', 'Туризм-и-путишествие.png', '', '', '', 'ru', 1),
(9, 1, 'uslugi-santekhnika', 'Услуги сантехника', 'Услуги-сантехника.png', '', '', '', 'ru', 1),
(10, 1, 'uslugi-elektrika', 'Услуги электрика', 'Услуги-электрика.png', '', '', '', 'ru', 1),
(11, 1, 'vskrytie-zamkov', 'Вскрытие замков', 'вскрытие-замков.png', 'Мета название', 'Мета описание', '', 'ru', 1),
(12, 1, 'uslugi-sborochno-plotnitskie', 'Услуги сборочно-плотницкие', 'услуги-сборочно-плотницки.png', '', '', '', 'ru', 1),
(13, 1, 'ustanovka-sborka-i-montazh', 'Установка, сборка и монтаж', 'Установка и сборка-монтаж.png', '', '', '', 'ru', 1),
(14, 1, 'kliningovye-uslugi', 'Клининговые услуги', 'Клининговые-услуги.png', '', '', '', 'ru', 1),
(15, 1, 'uslugi-nyani', 'Услуги няни', 'Услуги-няни.png', '', '', '', 'ru', 1),
(16, 1, 'rieltorskie-uslugi', 'Риэлторские услуги', 'Риэлтерские-услуги.png', '', '', '', 'ru', 1),
(17, 1, 'uslugi-perevozchika', 'Услуги перевозчика', 'Услуги-перевозчика.png', '', '', '', 'ru', 1),
(18, 1, 'arenda-oborudovaniya', 'Аренда оборудования', 'Аренда-оборудование.png', '', '', '', 'ru', 1),
(19, 1, 'arenda-transporta', 'Аренда транспорта', 'Аренда-транспорта.png', '', '', '', 'ru', 1),
(20, 1, 'yuridicheskie-uslugi', 'Юридические услуги', 'Юридические.png', '', '', '', 'ru', 1),
(21, 1, 'raspechatka-i-poligrafiya', 'Распечатка и полиграфия', 'Распечатка.png', '', '', '', 'ru', 1),
(22, 1, 'uslugi-dizaynera', 'Услуги дизайнера', 'Дизайн.png', '', '', '', 'ru', 1),
(23, 1, 'razrabotka-saytov-i-prilozhenii', 'Разработка сайтов и приложении', 'Разработка-и-програмирование.png', '', '', '', 'ru', 1),
(24, 1, 'marketing-i-reklama', 'Маркетинг и реклама', 'Маркетинг-и-реклама.png', '', '', '', 'ru', 1),

(25, 2, 'remont-avto', 'Ремонт авто', 'Ремонт-авто.png', '', '', '', 'ru', 1),
(26, 2, 'remont-bytovoy-tekhniki', 'Ремонт бытовой техники', 'Ремонт-бытовой-техники.png', '', '', '', 'ru', 1),
(27, 2, 'remont-domov-i-kvartir', 'Ремонт домов и квартир', 'Ремонт-домов-и-квартир.png', '', '', '', 'ru', 1),
(28, 2, 'remont-obuvi', 'Ремонт обуви', 'Ремонт-обуви.png', '', '', '', 'ru', 1),
(29, 2, 'remont-odezhdy', 'Ремонт одежды', 'Ремонт-одежды.png', '', '', '', 'ru', 1),
(30, 2, 'remont-i-restavratsiya-mebeli', 'Ремонт и реставрация мебели', 'Ремонт-мебели.png', '', '', '', 'ru', 1),
(31, 2, 'khimchistka', 'Химчистка', 'Химчистка.png', '', '', '', 'ru', 1),
(32, 2, 'remont-telefonov', 'Ремонт телефонов', 'Ремонт-телефонов.png', '', '', '', 'ru', 1),
(33, 2, 'remont-kompyuterov', 'Ремонт компьютеров', 'Ремонт-компьютеров.png', '', '', '', 'ru', 1),
(34, 2, 'elektronika', 'Электроника', 'Электроника.png', '', '', '', 'ru', 1),
(35, 2, 'oborudovanie', 'Оборудование', 'Оборудование.png', '', '', '', 'ru', 1),
(36, 2, 'otoplenie', 'Отопление', 'Отопления.png', '', '', '', 'ru', 1),

(37, 3, 'tsement-beton', 'Цемент / Бетон', 'Цемент,-Бетон.png', '', '', '', 'ru', 1),
(38, 3, 'gipsokarton-i-komplektuyushchie', 'Гипсокартон  и комплектующие', 'Гипсокардон-и-материалы.png', '', '', '', 'ru', 1),
(39, 3, 'santekhnika-i-otoplenie', 'Сантехника и отопление', 'Сантехника-и-отопления.png', '', '', '', 'ru', 1),
(40, 3, 'montazhnye-materialy', 'Монтажные материалы', 'Монтажные-материалы.png', '', '', '', 'ru', 1),
(41, 3, 'pesok-graviti', 'Песок / Гравити', 'Песок-грави.png', '', '', '', 'ru', 1),
(42, 3, 'bruschatka-plitka', 'Брусчатка / Плитка', 'Плитки-брусчатки.png', '', '', '', 'ru', 1),
(43, 3, 'elektromaterialy', 'Электроматериалы', 'Электроматериалы.png', '', '', '', 'ru', 1),
(44, 3, 'keramika', 'Керамика', 'Керамика.png', '', '', '', 'ru', 1),
(45, 3, 'drevesina', 'Древесина', 'Древисина.png', '', '', '', 'ru', 1),
(46, 3, 'metall', 'Металл', 'Метал.png', '', '', '', 'ru', 1);
