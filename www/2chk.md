 https://ruseller.com/lessons.php?id=2043&rub=32
 https://learn.javascript.ru/datetime - JS doc & datetime
 http://shpargalkablog.ru/2013/11/calendar.html#input
 http://beautifytools.com/image-to-base64-converter.php - IMG 2 Base64
 https://mind42.com/mindmap/f049a9be-1597-472d-9c30-591ad76b41ab - xls
 http://komotoz.ru/uroki/php/zagruzka_fajlov_na_server.php
 
 Delphi xls
 http://www.webdelphi.ru/2009/09/excel-v-delphi-svojstva-obekta-worksheet/
 http://www.webdelphi.ru/2009/08/excel-v-delphi-metody-obekta-worksheet-list/
 http://www.webdelphi.ru/2009/08/rabota-s-excel-v-delphi-osnovy-osnov/
 http://www.webdelphi.ru/2010/06/excel-v-delphi-rabota-so-svojstvami-dokumenta/
 http://www.webdelphi.ru/razrabotchiku/isxodniki-delphi/ 
 
 https://habrahabr.ru/post/114182/
 https://habrahabr.ru/post/323264/
 https://text-mask.github.io/text-mask/ - mask
 https://unmanner.github.io/imaskjs/#demo
 
 https://samy.pl/
 http://www.wisdomweb.ru/JS/trcat.php - js errors
 
 1) воспользоваться событием onerror объекта window.
 

<script type="text/JavaScript">
//подавить все сообщения об ошибках JavaScript 
window.onerror=null;
</script>
или можно назначить в качестве обработчика этого события функцию, возвращающую true для подавления сообщения об ошибке


<script type="text/JavaScript">
function myErrHandler()
{
... //здесь выполняем нужные нам действия

//Чтобы подавить стандартный диалог ошибки JavaScript, 
//функция должна возвратить true
return true;
}

//назначаем обработчик для события 
window.onerror = myErrHandler;
</script>

Во время возникновения ошибки вызывается обработчик события и ему передаются следующие параметры: текст сообщения, URL, номер строки с ошибкой. Для того чобы ими воспользоваться объявите их в качестве аргументов при описании функции обработчика: function myErrHandler(msg, url, lno){...}.

Обратите внимание на то, что все что расположено в скрипте после кода вызвавшего ошибку, выполняться не будет!

2) использование try...catch выполняет обработку ошибок.

Синтаксис:
try
tryStatement
catch(exception)
catchStatement

tryStatement - оператор, где произошла ошибка. Он может быть составным;
exception - имя любой переменной. Начальное значение exception – это значение возникшей ошибки;
catchStatement - оператор для обработки ошибок, появляющихся в связанном операторе tryStatement, он может быть составным.

Оператор try...catch предоставляет способ обработки некоторых или всех возможных ошибок, которые могу происходить в блоке программы во время ее выполнения. Если происходит ошибка, которую нет возможности убрать, то JavaScript просто предоставляет пользователю обычное сообщение об ошибке. 

Аргумент tryStatement содержит код, в котором может появится ошибка, при ее возникновении catchStatement включают код для ее обработки. Если ошибка появилась в tryStatement, то управление программой передается catchStatement. Начальное значение exception – это значение ошибки, которая возникает в tryStatement. 

Если ошибку не возможно обработать в catchStatement, связанного с tryStatement, где произошла ошибка, то используйте оператор throw для передачи ошибки к обработчику более высокого уровня.