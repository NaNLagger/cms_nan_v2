<?
class Authorization {
	public $userdata;
	public $notlogpass;
	public function __construct() {
		$this->notlogpass = NULL;
		if (isset($_COOKIE['id']) and isset($_COOKIE['hash']))
		{   
 			$query = mysql_query("SELECT * FROM users WHERE id = '".intval($_COOKIE['id'])."' LIMIT 1");
 			$this->userdata = mysql_fetch_assoc($query);
		}
		else $this->userdata = NULL;
	}
	public function generateCode($length=6) {

    		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHI JKLMNOPRQSTUVWXYZ0123456789";

    		$code = "";

    		$clen = strlen($chars) - 1;  

    		while (strlen($code) < $length) {

            		$code .= $chars[mt_rand(0,$clen)];  

    		}

    		return $code;

	}
	public function LogIn()
	{
		global $URL_SITE;
		if(isset($_POST['submit']))

		{

    		# Вытаскиваем из БД запись, у которой логин равняеться введенному

    		$query = mysql_query("SELECT id, password FROM users WHERE login='".mysql_real_escape_string($_POST['login'])."' LIMIT 1");

    		$data = mysql_fetch_assoc($query);

    

    		# Соавниваем пароли

    		if($data['password'] === md5(md5($_POST['password'])))

    		{

        		# Генерируем случайное число и шифруем его

        		$hash = md5($this->generateCode(10));

            


        

        		# Записываем в БД новый хеш авторизации и IP

        		mysql_query("UPDATE users SET hash='".$hash."' WHERE id='".$data['id']."'");

        

        		# Ставим куки

        		setcookie("id", $data['id'], time()+60*60*24*30,"/",".v2.nanolagger.ru");

        		setcookie("hash", $hash, time()+60*60*24*30,"/",".v2.nanolagger.ru");
				
				$title = "Location: ".$URL_SITE;
				header($title);
    		}
    		else

    		{
       		$this->notlogpass = "Вы ввели неправильный логин и пароль";
    		}

		}
		
	}
	public function FormLogin() {
		global $URL_SITE;
		printf("
		<script type=\"text/javascript\">
		function hid(n) {
			var hid = window.document.getElementById(n);
			hid.value = \"\";
		}

		function vis(n) {
			var vis = window.document.getElementById(n);
			vis.value = \"Логин\";
		}
		</script>

		<div class=\"cell\">");
		if ($this->notlogpass != NULL)
        {
            print $this->notlogpass;
        } 
		printf("
		<form class=\"fields\" method=\"POST\" action=\"%slogin/action-sumbit\">
		<input name=\"login\" id=\"login\" value=\"Логин\" onclick=\"hid('login')\" type=\"text\">
		<input name=\"password\" id=\"password\" value=\"Kjghj\" onclick=\"hid('password')\"  type=\"password\"><br>
		<input name=\"submit\" type=\"submit\" class=\"register_bottom\" value=\"Войти\">
		</form> или <a href=\"%sregister\">зарегистрируйтесь</a>
		</div>",$URL_SITE,$URL_SITE);
	}
	public function Privetstvie() {
		global $URL_SITE;
		printf("<div class=\"cell\">
		Привет <a href=\"%sprofile/user-%s\">%s</a>",$URL_SITE,$this->userdata['login'],$this->userdata['login']);
		echo "<br><a href='".$URL_SITE."login/action-exit'>Выйти</a>";
		echo "</div>";
	}
	public function Check() {
		if (isset($_COOKIE['id']) and isset($_COOKIE['hash']))
		{   
    		if(($this->userdata['hash'] !== $_COOKIE['hash']) or ($this->userdata['id'] !== $_COOKIE['id']))
    		{
			return false;
			}
			else 
			{
			return true;
			}
		}
		else
		return false;
	}
	public function ExitAction()
	{
		global $URL_SITE;
		setcookie("id","", time()+60*60*24*30,"/",".v2.nanolagger.ru");
		setcookie("hash", "", time()+60*60*24*30,"/",".v2.nanolagger.ru");
		$title = "Location: ".$URL_SITE;
		header($title);
	}
};
?>