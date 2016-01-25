# com_downfiles

<p>Компонент «Загрузка файлов и статистика» (com_downfiles) для CMS Joomla позволяет администратору сайта загружать файлы определенных форматов (указываются в настройках компонента) для последующего размещения их для скачивания в публичной части сайта.</p>
<p>В публичной части сайта ссылки для скачивания файлов формируются в модуле mod_downfiles, который является частью компонента «Загрузка файлов и статистика».</p> 
<p>В момент скачивания файлов информация об этом сохраняется в базу данных. На основе этой информации формируется статистика загрузки, которая может быть просмотрена администратором сайта в админской части.</p>

<h2>Установка и настройка</h2>
<ol>
	<li>В админке «Расширения» → «Менеджер расширений». Производим установку из zip-архива (<b>com_downfiles.zip</b>);</li>
	<li>Выбираем в админке пункт меню «Компоненты» → «Загрузка файлов и статистика»;</li>
	<li>Нажимаем кнопку «Настройка» в правом верхнем углу. На странице настроек указываем папку, где будут храниться файлы для загрузки и разрешенные расширения файлов;</li>
	<li>Устанавливаем модуль <b>mod_downfiles</b> («Расширения» → «Менеджер расширений») и размещаем его в публичной части сайта;</li>
</ol>
<h2>Использование</h2>
<ol>
	<li>Добавляем файлы: выбираем в меню в админке «Компоненты» → «Загрузка файлов и статистика» → «Файлы»;</li>
	<li>Для добавления файлов нажать кнопку «Создать»;</li>
	<li>Загружаем файлы со своего компьютера. Добавляем описание файлов (Они будут отображаться ввиде анкора ссылки для загрузки файла в публичной части);</li>
	<li>Теперь можно просматривать статистику загрузки файлов;</li>
	<li>Выбираем в меню в админке «Компоненты» → «Загрузка файлов и статистика» → «Статистика»;</li>
	<li>На странице показана статистика загрузки по всем файлам за месяц. При клике по ссылкам вверху можно увидеть статистику за полгода и за год;</li>
	<li>Можно посмотреть статистику загрузок конкретного файла. Из списка файлов выбираем файл, статистика загрузок которого вам нужна. Подробную статистика загрузок показывается только за прошедший месяц;</li>
</ol>