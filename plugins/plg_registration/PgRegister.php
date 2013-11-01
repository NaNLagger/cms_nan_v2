<?
class PgRegister
{
	public $title;
	public $description;
	public $keywords;
	public $miniimg;
	public function __construct() {
		$result = mysql_query("SELECT * FROM settings WHERE page='register'");
		$myrow = mysql_fetch_array($result);
		$this->title = $myrow['title'];
		$this->description = $myrow['description'];
		$this->keywords = $myrow['keywords'];
		$this->miniimg = $myrow['miniimg'];
	}
	public function FormRegister($error) {
		global $URL_SITE;
		printf("
		<table class='tableregister'>
			<tr>
    			<td>
		");
		if (count($error) != 0 && $error !=0)
		{
		print "<b>При регистрации произошли следующие ошибки:</b><br>";

        foreach($error AS $err)

        {

            print $err."<br>";

        }
		}
		printf("
				<form class=\"fields\" method=\"POST\" action=\"%sregister/action-sumbit\">
				<table>
					<tr>
						<td colspan=\"2\" style=\"padding:10px; font-weight:bold;\">
						<center>Регистрация пользователя</center>
						</td>
					</tr>
					<tr>
						<td>Логин*:</td><td><input name=\"login\" class=\"textpole\" type=\"text\"></td>
					</tr>
					<tr>
						<td>Пароль*:</td><td><input name=\"password\" class=\"textpole\" type=\"password\"></td>
					</tr>
					<tr>
						<td>Повторите пароль*:</td><td><input name=\"repassword\" class=\"textpole\" type=\"password\"></td>
					</tr>
					<tr>
						<td>Адрес электронной почты:</td><td><input name=\"email\" class=\"textpole\" type=\"text\"></td>
					</tr>
					<tr>
						<td><div class='data_and_author'>Поля со (*) обязательные.</div></td><td><input class=\"register_bottom\" name=\"submit\" type=\"submit\" value=\"Зарегистрироваться\"></td>
					</tr>
				</table>
				</form>
				</td>
   			</tr>
		</table>",$URL_SITE);
	}
	public function SumbitRegister() {
		if(isset($_POST['submit']))

		{

    		$err = array();



    		# проверям логин

    		if(!preg_match("/^[a-zA-Z0-9]+$/",$_POST['login']))

    		{

        		$err[] = "Логин может состоять только из букв английского алфавита и цифр";

    		}

    

    		if(strlen($_POST['login']) < 3 or strlen($_POST['login']) > 30)

    		{

        		$err[] = "Логин должен быть не меньше 3-х символов и не больше 30";

    		}

    

    		# проверяем, не сущестует ли пользователя с таким именем

    		$query = mysql_query("SELECT COUNT(id) FROM users WHERE login='".mysql_real_escape_string($_POST['login'])."'");

    		if(mysql_result($query, 0) > 0)

    		{

        		$err[] = "Пользователь с таким логином уже существует в базе данных";

    		}

    		if(($_POST['password'] != $_POST['repassword']) or ($_POST['password'] == ""))

    		{

        		$err[] = "Пароли не совпадают";

    		}

    

    		# Если нет ошибок, то добавляем в БД нового пользователя

    		if(count($err) == 0)

    		{

        

        		$login = $_POST['login'];

        

        		# Убераем лишние пробелы и делаем двойное шифрование

        		$password = md5(md5(trim($_POST['password'])));

        

        		mysql_query("INSERT INTO users SET login='".$login."', password='".$password."'");

        		//header("Location: index.php?page=register&action=success"); 
				return 0;

    		}

    		else

    		{

        		return $err;

    		}

		}
	}
	public function PrintSuccess()
	{
		printf("
		<table class='tableregister'>
			<tr>
    			<td>
        		<p>Регистрация прошла успешно!<br> Теперь вы можете войти воспользовавшись формой Авторизации.
        		</td>
   			</tr>
		</table>");
	}
};
?>