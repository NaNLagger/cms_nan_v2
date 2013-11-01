<?
class Comments {
	public function ListComments($page,$id)
	{
		$date = date("y.m.d");
		$time = date("H:i:s");
		global $user;
		global $URL_SITE;
		$result1 = mysql_query("SELECT * FROM comment WHERE id_news='$id' AND page='$page' ORDER BY id DESC");
		$myrow1 = mysql_fetch_array($result1);
		if ($myrow1)
		{
			do
			{
				printf("
				<div style='margin-bottom:10px; background:#F0F0F0; padding:15px 20px 0px 20px; border:#E5E5E5 solid 1px;
	-moz-border-radius:1px; -webkit-border-radius:1px; -o-border-radius:1px;'>
        			<p style=\"margin:0px 0px 10px 0px;; padding:0px;\">%s</p>
					<p style=\"margin:10px 0px 0px 0px; padding:0px; font-size:11px; color:#666; display:inline;\">Отправил: <a href=\"%sprofile\user-%s\">%s</a> &nbsp;&nbsp;&nbsp; %s %s 
		",nl2br($myrow1['text']),$URL_SITE,$myrow1['login'],$myrow1['login'],$myrow1['date'],$myrow1['time']); 
				if($user->Check() && (($user->userdata['login'] == $myrow1['login']) or ($user->userdata['prava']==1)))
				printf("<div style=\"float:right; display:inline; font-size:11px;\">
				<a href=\"%s%s\id-%s?action=delete_com&id_com=%s\">Удалить</a>
				</div>",$URL_SITE,$page,$id,$myrow1['id']); 
				printf("
				</p>
				</div>");
			}
			while ($myrow1 = mysql_fetch_array($result1));
			}
		else
		{
			echo "А комментарий нет,нет,нет...";
		}
	}
	public function FormComments($page,$id)
	{
		$date = date("y.m.d");
		$time = date("H:i:s");
		global $user;
		global $URL_SITE;
		printf("Написать комментарий:
		<form action='%s%s/id-%s' method='post'>",$URL_SITE,$page,$id);
		printf("
		<input name=\"com_login\" id=\"com_login\" type=\"hidden\" onclick=\"hid('com_login')\"");
		if($user->Check()) printf("value='%s' ",$user->userdata['login']); else printf("value='Аноним' ");
		printf("><br><textarea name=\"text\" id=\"text\" cols=\"60\" rows=\"5\"></textarea><br>");
		//printf("<input name='id_news' type='hidden' id='id_news' value='%s'>",$id);
		//printf("<input name='page' type='hidden' id='page' value='%s'>",$page);
		printf("<input name=\"date\" type=\"hidden\" id=\"date\" value='%s'>",$date);
		printf("<input name=\"time\" type=\"hidden\" id=\"time\" value='%s'>",$time);
		printf("
		<input class=\"register_bottom\" name=\"submit\" type=\"submit\" id=\"submit\" value=\"Отправить\">
		</form>");
	}
	public function DeleteCom($id_com)
	{
		$result = mysql_query ("DELETE FROM comment WHERE id='$id_com'"); 
		if ($result == true) {echo "Удалено";}
		else {echo "Не удалено";}
	}
	public function ViewComments($page,$id) {
		if (isset($_POST['com_login'])) {$login=$_POST['com_login'];} if ($login == '') { unset($login);}
		if (isset($_POST['text'])) {$text=htmlspecialchars($_POST['text']);} if ($text == '') { unset($text);}
		if (isset($_POST['date'])) {$date=$_POST['date'];} if ($date == '') { unset($date);}
		if (isset($_POST['time'])) {$time=$_POST['time'];} if ($time == '') { unset($time);}
		if (isset($_GET['id_com'])) {$id_com=$_GET['id_com'];} if ($id_com == '') { unset($id_com);}
		if (isset($_GET['action'])) {$action=$_GET['action'];} if ($action == '') { unset($action);}
		if (isset($login) && isset($text) && isset($date) && isset($time))
		{
			$result = mysql_query ("INSERT INTO comment (id_news,login,text,date,time,page) VALUES ('$id','$login','$text','$date','$time','$page')"); 
			if ($result == true) {echo "Добавлено";}
			else {echo "Не добавлено";}
		}

		if (isset($id_com) && isset($action))
			if($action=="delete_com") $this->DeleteCom($id_com);
		printf("
		<style>
		.active {color:#CCC;}
		.active:hover {color:#CCC;}
		</style>
		<script type=\"text/javascript\">
		function tabSwitch(new_tab, new_content) {
        	document.getElementById('comment_1').style.display = 'none';
        	document.getElementById('comment_2').style.display = 'none';
        	document.getElementById(new_content).style.display = 'block';   

        	document.getElementById('tab_1').className = '';
        	document.getElementById('tab_2').className = '';
        	document.getElementById(new_tab).className = 'active';  
		}
		</script>
		<div class=\"comments\">
		<div class=\"comments_links\">
		<a href=\"javascript:tabSwitch('tab_1', 'comment_1');\" id=\"tab_1\"><b>Комментарии на сайте</b></a>
		<a href=\"javascript:tabSwitch('tab_2', 'comment_2');\" id=\"tab_2\" class=\"active\"><b>Комментарии VK</b></a>
		</div>
		<div id=\"comment_1\" class=\"block_comments\" style=\"display:none;\">
		<br />");
		$this->ListComments($page,$id);
		$this->FormComments($page,$id);
		printf("
		</div>
			<div id=\"comment_2\" class=\"block_comments\" style=\"display:block;\">
			<!-- Put this div tag to the place, where the Comments block will be -->
			<p>
				<div id=\"vk_comments\"></div>
					<script type=\"text/javascript\">
					VK.Widgets.Comments(\"vk_comments\", {limit: 10, width: \"560\", attach: \"*\"});
					</script>
			</p>
			</div>
		</div>");
	}
};
?>