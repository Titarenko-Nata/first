
<?
class Bankomat{
	private $file = 'pin.txt';
	private $balanceFile = 'balance.txt';
	private $pin;
	public $pinEnter;
        private $balance;
	public $action;
	public $money;

 public function __construct(){
			$this->pin = file_get_contents($this->file);
			$this->balance = file_get_contents($this->balanceFile);
			$this->pinEnter = isset($_POST['PIN']) ? $_POST['PIN'] : null;
			$this->action = isset($_POST['action']) ? $_POST['action'] : null;
			$this->money = isset($_POST['SUMM']) ? $_POST['SUMM'] : null;
	}

 public function enterPin(){
 	
		  	echo '<form method="POST">
			 <input name = "PIN" type="text" placeholder="Введите пин"/>
			 <input type="submit" name="submit" value="Отправить" />
		   </form>';

  }


 public function comparePin(){
		if($this->pinEnter == $this->pin){
			echo '<form method="POST">
			<input type="submit" name="action" value="Баланс" />
			<input type="submit" name="action" value="Снять" />
			<input type="submit" name="action" value="Выход" />
			</form>';
											
		}else{
			echo "Пин-код введен не правильно";
		}	 
	}

	public function action() {
    if($this->action == "Баланс"){
		 $this -> showBalance();
			}else if($this->action == "Снять"){
			  echo '<form method="post">
				<input name = "SUMM" type="text" placeholder="Введите сумму для снятия"/>
				<input type="submit" name="GET" value="Снять" />
        </form>';
			}else if($this->action == "Выход"){
				 unset($this->pinEnter, $this->action, $this->money);
		}
	}

  
public function showBalance(){
	echo "Ваш баланс: $this->balance";
}

public function updateBalance(){
	$this->balance = $this->balance - $this->money;
	file_put_contents($this->balanceFile, $this->balance);
}
	 

 public function enterMoney(){
   if($this->money > $this->balance){
     echo "Недостаточно денег на балансе";
      }else{
       echo "Выдана сумма: $this->money";
         $this->updateBalance();
		  }   
     }
                 
}
?>

<?
$myBank = new Bankomat();
$myBank -> enterPin();
 if(isset($myBank->pinEnter)) {
    $myBank -> comparePin();
 	}
 if(isset($myBank->action)) {
    $myBank -> action();
 	}
 if(isset($myBank->money)) {
    $myBank -> enterMoney();
 	}


