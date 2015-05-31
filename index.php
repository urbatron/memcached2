<?php header("Content-Type: text/html; charset=utf-8");

class MyClass
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
			echo $e->getMessage();
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
		echo "Время добавления $this->count данных в MySQL = ";
		echo $time2-$time;
		
	}
}

$obj = new MyClass;
$start = "start";
if($statr = "start")
{
	$obj->setBase();
}





?>