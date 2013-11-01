<?
$search = $_POST['search'];
$result = mysql_query("SELECT * FROM news WHERE text like '%$search%' OR title like '%$search%' OR description like '%$search%' ORDER BY id DESC");
$search_result = mysql_fetch_array($result);
 
do 
{
$i++;
$g=$i%2;	 
printf ("
<div style=\"border-bottom:1px solid #999; height:130px; padding-top:20px; padding-bottom:20px;\">
<img class='line1' src='./image/stories/%s'><h4><a class='anews' href='./index.php?page=news&id=%s'>%s</a></h4>
<p style=\"margin:0px; padding:0px; font-size:11px; color:#666;\">Дата: %s.   Автор: %s.</p>%s<br><a class=\"readon\" href=\"./index.php?page=news&id=%s\">Читать далее</a>
</div>",$search_result['miniimg'],$search_result['id'],$search_result['title'],$search_result['date'],$search_result['author'],$search_result['description'],$search_result['id']);
}
while ($search_result = mysql_fetch_array($result));
?>