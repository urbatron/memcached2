<?php 
header("Content-Type; text/html; charset=utf-8");

class AddData
{
	public $names = ["Sergei","Artem","Stas","Alexandr","Mila","Maria","Polina","Ludmila","Igor","Oleg","Natalia","Thomas"];
	public $first = ["info","media","locate","tel","name","adress","contact"];
	public $last = ["mail","gmail","yandex","rabbler","index","list","bk"];
	public $data = array();
	public $mas = array();
	public $count = 100;

	public function __construct()
	{
	$this->add();	
	}

	private function add()
	{
		for($t = 0; $t < $this->count; $t++)
		{
			$this->data[] = 
			$this->names[rand(0,count($this->names)-1)]." ".
			$this->first[rand(0,count($this->first)-1)]."@".
			$this->last[rand(0,count($this->last)-1)]." ".
			rand(111,999)."-".rand(11,99)."-".rand(11,99)." ".rand(1980,1995);
		
		}
	}

	public function setBase()
	{
		try{
		$DBH = new PDO("mysql:host=localhost;dbname=php;","root","") or die("Not connect");
		$STH = $DBH->prepare("DELETE FROM data WHERE 1");
		$STH->execute();
		}catch(PDOException $e){
			echo iconv('windows-1251','utf-8',$e->getMessage());
		}
		foreach($this->data as $value)
		{
			$this->mas[] = explode(" ",$value);	
		}
		$STH = $DBH->prepare("INSERT INTO data(name,email,tel,year) VALUES (?,?,?,?)");
		$time = microtime(1);
		foreach($this->mas as $val)
		{
			$STH->execute($val);
		}
		$time2 = microtime(1);
		echo "Время добавления $this->count данных (4-e столбца) в MySQL = ";
		echo $time2-$time;



		$STH = $DBH->prepare("DELETE FROM data2 WHERE 1");
		$STH->execute();
		$STH = $DBH->prepare("INSERT INTO data2(text) VALUES (?)");
		$STH->bindParam(1, $text);
		$time = microtime(1);
		foreach($this->data as $value)
		{
			$text = $value;
		$STH->execute();
		}
		$time2 = microtime(1);
		echo "<br>Время добавления $this->count данных (только значение в виде строки) в MySQL = ";
		echo $time2-$time;
	}


	public function setMemcached(){
		$memcache = new Memcache;
		$memcache->connect('localhost',11211);
		$memcache->flush();
		$time = microtime(1);
		$memcache->set('0',$this->data,false);
		$time2 = microtime(1);
		echo "<br>Время добавления $this->count данных в Memcached (ключ-значение) = ";
		echo $time2-$time;
	}

	public function setFile(){
		if(file_exists("data.txt")){
			unlink("data.txt");
		}
		foreach($this->data as $value)
		{
		$textFile[] = $value.";";
	}

		$time = microtime(1);
		foreach($textFile as $value)
		{
		file_put_contents("data.txt",$textFile,FILE_APPEND);
	}
	$time2 = microtime(1);
		echo "<br>Время добавления $this->count данных в файл (строка) = ";
		echo $time2-$time;
	}
}