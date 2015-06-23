<?php header('Content-Type: text/html; charset=utf-8');

class GetData
{

	function getBase()
	{
		try{
		$DBH = new PDO("mysql:host=localhost;dbname=php","root","") or die('Not connect');
		$DBH->exec('set name utf-8');
		$time = microtime(1);
		$STH = $DBH->prepare("SELECT tel FROM data WHERE name = 'sergei'");
		$STH->execute();
		$q = $STH-> fetchAll(PDO::FETCH_ASSOC);
		$time2 = microtime(1);
		echo "<br>Время изборочного извлечения данных из базы MySql = ";
		echo $time2-$time; 
		$namemass = array();
		$time = microtime(1);
		$STH = $DBH->prepare("SELECT * FROM data2");
		$STH->execute();
		$q = $STH-> fetchAll(PDO::FETCH_ASSOC);
		foreach($q as $key => $value)
		{
			$name = explode(" ",$value['text']);
			if($name[0] == "Sergei")
			{
				$namemass[] = $name[2];
			}
		}
		$time2 = microtime(1);
		echo "<br>Время извлечения строки из базы, а потом извлечение подстроки = ";
		echo $time2-$time;

		}catch(PDOException $e){
			echo iconv('windows-1251','utf-8',$e->getMessage());
		}
	}


	function getMemcached()
	{
		$memcache  = new Memcache;
		$memcache->connect('localhost',11211);
		$i = 0;
		$time = microtime(1);
		$q = $memcache->get('0');
		foreach($q as $key => $value)
		{
		$name = explode(" ",$value);
			if($name[0] == "Sergei")
			{
				$namemass[] = $name[2];
			}
		}
	$time2 = microtime(1);
echo "<br>Время извлечения массива из memcached, а потом извлечение подстроки = ";
		echo $time2-$time;
	}

	function getFile()
	{
		$time = microtime(1);
		 $text = file_get_contents('data.txt');
		 $q = explode(";",$text);
		 echo "<pre>";
		 print_r($q);
		 echo "</pre>";
		 foreach($q as $key => $value)
		{
			$name = explode(" ",$value);
			if($name[0] == "Sergei")
			{
				echo $name[2];
				$namemass[] = $name[2];
			}
		}
		$time2 = microtime(1);
		echo "<br>Время извлечения строки из базы, а потом извлечение подстроки = ";
		echo $time2-$time;





	}
}