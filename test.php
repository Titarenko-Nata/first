<?

class Bankomat{ //создаем класс Банкомат
	

	public function enter_money($money){ // создаем функцию выдачи суммы купюрами от большего наминала к меньшему

		$notes = array(1,2,5,10,20,50,100,200,500); // номиналы банкнот в банкомате
         
          if($money > 10000){
        	$res = "Недостаточно денег в банкомате";
        	
           }else{
           	echo "Cумма для выдачи: $money <br>";
         	  for($i = count($notes)-1;($i >= 0 && $money!=0);$i--){  // идем от конца массива к началу
		    	$value=$notes[$i];                                   // записываем элемент массива в переменную
					if($money>=$value){                             // сравниваем запрашиваему сумму со значение переменной, если она больше или равна
						$k = (int) ($money / $value);              // ищем результат деления  целое число
						$cntNotes = min($k, $notes);              // количество банкнот каждого номинала
						// указывает склонение слова купюра в зависимости от количества
						if (($cntNotes==1) || (($cntNotes>20) && ($cntNotes%10 == 1))) {
                          $resText = $cntNotes.' купюра';
                        }else if ((($cntNotes>=2) && ($cntNotes<=4)) || (($cntNotes>20) && (($cntNotes%10==2) || ($cntNotes%10==3) || ($cntNotes%10==4)))) {
                          $resText = $cntNotes.' купюры';
                         }else{
                            $resText = $cntNotes.' купюр';
                         }
							$money = $money - $cntNotes * $value;                                   // считаем остаток суммы
							echo "Номинал $value грн. Выдано $resText. Остаток суммы = $money<br>"; // выводим результат на экран
		            }
	              }
                }
           return $res;
        }
    }

$bank = new Bankomat(); // создаем объект
echo $bank -> enter_money(5468); //вызываем функцию с переданным параметром суммы для выдачи

?>
