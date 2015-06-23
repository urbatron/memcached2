<?php header("Content-Type: text/html; charset=utf-8");
function __autoload($name){
	include_once $name.".php";
}

/*запись данных в разные носители*/
$obj = new AddData;
$start = "start";
/*если поставить "!" перед $start, то запись в базу данных производится не будет, при этом не сотруться те 
которые уже были*/
if(!$statr = "start")
{
	$obj->setBase();
}
$obj->setMemcached();
$obj->setFile();
echo "<hr>";
/*извлечение данныз из разных носителей*/

$get = new GetData;
$get->getbase();
$get->getMemcached();
$get->getFile();




?>