TODO:

Для кнопки обновить: 
- обновить и продолжить сессию
- обновить и начать новую сессию
Сделать список идентефикаторов контролей 

сделать первичную создавалку дефолтных файлов

- https://habrahabr.ru/post/245233/ excel
- https://habrahabr.ru/post/136540/ excel
- http://abcvg.com/9129-analog-json_decode-dlya-xml-na-php.html - xml
- http://yournet.kz/blog/php/phpexcel-formatirovanie-yacheek
- http://www.codenet.ru/webmast/php/Excel.php
- http://opennet.ru/base/dev/php_gen_excel.txt.html

Сделать проверку на мероприятия a) совпадающие по месту б) совпадающие по дате и времени в) совпадающие по дате, времени и месту

logger
1.формат: тип отдаваемых данных (1), Время, юзер, с какой стр., c какого объекта, какое действие, тип, успех или код ошибки
2.формат: тип отдаваемых данных (2), Ф-ция, имя переменной, знач. переменной
3.формат: тип отдаваемых данных (3), Ф-ция, что пишем, в какой файл .OR. ф-ция, какую файловую манипуляцию делаем, с каким файлом
// &act=ACTL&u=[username]&doc=[page]&obj=[object]&e=[action]&t=[event]&c=[code] --> actlog
// &act=VARL&f=[function_name]&doc=[page]&v1=[var_name]&v2=[var_value] --> varlog
// &act=FILEL&u=[username]&doc=[page]&fa=[fileact: CreateFile, Read, Write, DeleteFile, MakeDir, ScanDir, RenameFile, RenameDir, Drop, Zip, Echo]
// (CreateFile) CF	&fn1=[filename]
// (ReadFile) RF	&fn1=[filename]&v2=[read_string]
// (WriteFile) WF	&fn1=[filename]&v2=[write_string]
// (DeleteFile) DF	&fn1=[filename]
// (MakeDir) MD		&fn1=[dirname]
// (ScanDir) SD		&fn1=[dirname]
// (MoveFile, RenameFile) MF	&fn1=[old_filename]&fn2=[new_filename]
// (MoveDir, RenameDir) RD		&fn1=[old_dir]&fn2=[new_dir]
// (Drop) DBD		&fn1=[bd_name]
// (Compress) ZIP	&fn1=[filelist]&fn2=[zip.arch]&fn3=[workdir]
// (Comment) ECHO	&v1=[string]
// (Operation Result) OPR		&v1=[result_code]&v2=[result_string]

сделать 2 строчный режим ввода
сделать вертикальный режим ввода
edMode в sh_tab_xls_v10 отвечает за режим
div#ModalBody1 - режим горизонтальной правки в 1 строку

Ремейк 404

Конвертер версий в админку! Для переездов со старых версий БД на новые.
Указываем поля в старом документе -> поля в новом. Варианты: игнорить поле в старом (не переносить), переносить поле (номер) из старого в поле (номер) в новом, заполнять поле в номов документе однотипной инфой (указать какой), заполнить поле в новом документе пересчитываемыми данными (указать формулу... например для нумерации п/п - n+1).

формируем:
	list($n, $depart, $dStart, $dEnd, $vd, $acType, $acOwner, $acName, $acPlace, $oLvl, $oAud, $oSeer, $oPrt, $OOP, $hostHead, $hostLd, $hostOrg, $fin, $adInfo)
:: должно отдаваться 19 полей

ограничитель кол-ва td в строке - linelimit, лежит в отдельном файле // нет ничего более постоянное, чем временное

fix заглюка с id в последнем разделе
для ф-ции killrows из main'a:
				// есть вероятность, что цикл долистывает до конца и пытается выйти за пределы
				// поставить проверку на null? на существование elx[j]?