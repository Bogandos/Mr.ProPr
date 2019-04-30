<?php

Class MyFunctions {
	
	public function getFibonacci($id){
		
		if($id > 0)
		{
			return $result = round(((5 ** .5 + 1) / 2) ** $id / 5 ** .5);
		}
		else
		{
			return $result = null;
		}
	}

	public function getRegion($id){
		
		$codes=array("01"=>"Республика Адыгея", "02"=>"Республика Башкортостан", "102"=>"Республика Башкортостан","03"=>"Республика Бурятия","04"=>"Республика Алтай (Горный Алтай)","05"=>"Республика Дагестан","06"=>"Республика Ингушетия","07"=>"Кабардино-Балкарская Республика","08"=>"Республика Калмыкия","09"=>"Республика Карачаево-Черкессия","10"=>"Республика Карелия","11"=>"Республика Коми","12"=>"Республика Марий Эл","13"=>"Республика Мордовия","113"=>"Республика Мордовия","14"=>"Республика Саха (Якутия)","15"=>"Республика Северная Осетия — Алания","16"=>"Республика Татарстан","116"=>"Республика Татарстан","716"=>"Республика Татарстан","17"=>"Республика Тыва","18"=>"Удмуртская Республика","19"=>"Республика Хакасия","21"=>"Чувашская Республика","121"=>"Чувашская Республика","22"=>"Алтайский край","23"=>"Краснодарский край","93"=>"Краснодарский край","123"=>"Краснодарский край","24"=>"Красноярский край","84"=>"Красноярский край","88"=>"Красноярский край","124"=>"Красноярский край","25"=>"Приморский край","125"=>"Приморский край","26"=>"Ставропольский край","126"=>"Ставропольский край","27"=>"Хабаровский край","28"=>"Амурская область","29"=>"Архангельская область","30"=>"Астраханская область","31"=>"Белгородская область","32"=>"Брянская область","33"=>"Владимирская область","34"=>"Волгоградская область","134"=>"Волгоградская область","35"=>"Вологодская область","36"=>"Воронежская область","136"=>"Воронежская область","37"=>"Ивановская область","38"=>"Иркутская область","85"=>"Иркутская область","138"=>"Иркутская область","39"=>"Калининградская область","91"=>"Калининградская область","40"=>"Калужская область","41"=>"Камчатский край","42"=>"Кемеровская область","142"=>"Кемеровская область","43"=>"Кировская область","44"=>"Костромская область","45"=>"Курганская область","46"=>"Курская область","47"=>"Ленинградская область","147"=>"Ленинградская область","48"=>"Липецкая область","49"=>"Магаданская область","50"=>"Московская область","90"=>"Московская область","150"=>"Московская область","190"=>"Московская область","750"=>"Московская область","51"=>"Мурманская область","52"=>"Нижегородская область","152"=>"Нижегородская область","53"=>"Новгородская область","54"=>"Новосибирская область","154"=>"Новосибирская область","55"=>"Омская область","56"=>"Оренбургская область","57"=>"Орловская область","58"=>"Пензенская область","59"=>"Пермский край","81"=>"Пермский край","159"=>"Пермский край","60"=>"Псковская область","61"=>"Ростовская область","161"=>"Ростовская область","761"=>"Ростовская область","62"=>"Рязанская область","63"=>"Самарская область","163"=>"Самарская область","763"=>"Самарская область","64"=>"Саратовская область","164"=>"Саратовская область","65"=>"Сахалинская область","66"=>"Свердловская область","96"=>"Свердловская область","196"=>"Свердловская область","67"=>"Смоленская область","68"=>"Тамбовская область","69"=>"Тверская область","70"=>"Томская область","71"=>"Тульская область","72"=>"Тюменская область","73"=>"Ульяновская область","173"=>"Ульяновская область","74"=>"Челябинская область","174"=>"Челябинская область","75"=>"Забайкальский край","80"=>"Забайкальский край","76"=>"Ярославская область","77"=>"г. Москва","97"=>"г. Москва","99"=>"г. Москва","177"=>"г. Москва","197"=>"г. Москва","199"=>"г. Москва","777"=>"г. Москва","799"=>"г. Москва","78"=>"г. Санкт-Петербург","98"=>"г. Санкт-Петербург","178"=>"г. Санкт-Петербург","198"=>"г. Санкт-Петербург","79"=>"Еврейская автономная область","82"=>"Республика Крым","83"=>"Ненецкий автономный округ","86"=>"Ханты-Мансийский автономный округ — Югра","186"=>"Ханты-Мансийский автономный округ — Югра","87"=>"Чукотский автономный округ","89"=>"Ямало-Ненецкий автономный округ","92"=>"г. Севастополь","94"=>"Территории, находящиеся за пределами РФ и обслуживаемые Департаментом режимных объектов МВД России","95"=>"Чеченская республика");

		$result=$codes["$id"];

		return $result;
	}

	public function getWeekday($date){
		
		$dmy = explode(".", $date);
		$result = date("l", mktime(0, 0, 0, $dmy[1], $dmy[0], $dmy[2]));
				
		return $result;
	}

	public function getQuadratic($a, $b, $c){
		
		$d=($b*$b)-(4*$a*$c);

		$result=array();

		if ($d>0)
		{
			$result['x1']=(-$b+sqrt($d))/(2*$a);
			$result['x2']=(-$b-sqrt($d))/(2*$a);
		}
		elseif ($d==0)
		{
			$result['x']=-$b/(2*$a);
		}
		else
		{
			$result[]="Т.к. дискриминант меньше нуля, то уравнение не имеет действительных решений";
		}
				
		return $result;
	}

	public function getPathParameter($id){
		
		$pathNum=$id;
		return $pathNum;
	}	
}
?>