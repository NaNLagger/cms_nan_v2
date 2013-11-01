<?
include_once('plugins/plg_timer/Timer.php'); 
$timer = new Timer();                   // инициализация таймера
$timer->start();                           // запуск таймера
include_once("connect.php");
include_once("plugins/plg_authorization/plg_authorization.php");
$user = new Authorization();
if(isset($_GET['PgOpen'])) { $PgOpen = $_GET['PgOpen']; } else { $PgOpen = NULL; }
switch($PgOpen)
{
	case "news":
	{
		include_once("news/PgNews.php");
		$page = new PgNews();
	} break;
	case "register":
	{
		include_once("plugins/plg_registration/PgRegister.php");
		$page = new PgRegister();
	} break;
	case "video":
	{
		include_once("video/PgVideo.php");
		$page = new PgVideo();
	} break;
	case "links":
	{
		include_once("links/PgLinks.php");
		$page = new PgLinks();
	} break;
	default:
	{
		if($PgOpen == "login") 
		{
			if(isset($_GET['action']) && $_GET['action']=="sumbit") $user->LogIn(); 
			if(isset($_GET['action']) && $_GET['action']=="exit") $user->ExitAction();
		}
		include_once("Main/PgIndex.php");
		$page = new PgIndex();
	} break;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="<? echo $page->keywords; ?>" />
<meta name="description" content="<? echo $page->description; ?>" />
<title><? echo $NAME_SITE." - ".$page->title; ?></title>
<meta name="title" content="<? echo $page->title; ?>" />
<link rel="image_src" href="<? echo $URL_SITE."".$page->miniimg; ?>">
<meta property="og:title" content="<? echo $page->title; ?>"/> 
<meta property="og:description" content="<? echo $page->description; ?>"/> 
<meta property="og:image" content="<? echo $URL_SITE."".$page->miniimg; ?>" />
<meta property="og:site_name" content="<? echo $NAME_SITE; ?>" />
<meta property="og:type" content="article" />
<link href="<? echo $URL_SITE; ?>style.css" rel="stylesheet" type="text/css" />
<link href="<? echo $URL_SITE; ?>modules/mod_sociallink/style.css" rel="stylesheet" type="text/css" />
<link href="<? echo $URL_SITE; ?>modules/mod_slide/style.css" rel="stylesheet" type="text/css" />
<link href="<? echo $URL_SITE; ?>Main/style.css" rel="stylesheet" type="text/css" />
<link href="<? echo $URL_SITE; ?>modules/lightbox/css/lightbox.css" rel="stylesheet" />
<script src="<? echo $URL_SITE; ?>modules/lightbox/js/jquery-1.7.2.min.js"></script>
<script src="<? echo $URL_SITE; ?>modules/lightbox/js/lightbox.js"></script>
<!-- Put this script tag to the <head> of your page -->
<script type="text/javascript" src="http://userapi.com/js/api/openapi.js?49"></script>
<script type="text/javascript">
  VK.init({apiId: 2943702, onlyWidgets: true});
</script>
<script type="text/javascript">
  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>


<script type="text/javascript">
  VK.init({apiId: 2943702});
</script>

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-38353317-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

</head>

<body>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/ru_RU/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<?
include_once("position/abs_top.php");
?>
<table class="toptable" width="1000px;">
<tr>
    <td class="center"><? include("position/top.php");include("position/menu.php");?></td>
</tr>
</table>
<table class="maintable" width="1000px;">
<tr>
    <td colspan="2" class="maintd"></td>
  </tr>
  <tr>
    <td colspan="2"></td>
  </tr>
  <tr>
    <td style="vertical-align:top; padding:10px; padding-left:25px; width:600px;">
    <?
	include_once("position/user_top.php");
	//MainAction
	switch($PgOpen)
	{
		case "news":
		{
			if( isset($_GET['id']) && $_GET['id'] != NULL ) { $id = $_GET['id']; } else { unset($id); }
			if(isset($id)) 
			{ 
				$page->PrintNew($id);
				include("plugins/plg_comments/plg_comments.php");
				$comments = new Comments();
				$comments->ViewComments($PgOpen,$id);
			}
			else
			{
				$page->PrintListNews(0,7);
			}
		} break;
		case "links":
		{
			$page->PrintListLinks(0,7);
		} break;
		case "register":
		{
			if( isset($_GET['action']) && $_GET['action'] != NULL ) { $action = $_GET['action']; } else { unset($action); }
			if(isset($action) && $action == "sumbit") 
			{ 
				$error = $page->SumbitRegister();
				if($error != 0) { $page->FormRegister($error); } else { $page->PrintSuccess();}
			}
			else
			{
			$page->FormRegister(0);
			}
		} break;
		case "video":
		{
			if( isset($_GET['id']) && $_GET['id'] != NULL ) { $id = $_GET['id']; } else { unset($id); }
			if(isset($id)) 
			{ 
				$page->PrintVideo($id);
			}
			else
			{
				$page->PrintListVideo(0,7);
			}
		} break;
		default:
		{
			$page->GetContent();
		} break;
	}	 
	?>
    </td>
    <? include("position/right.php"); ?>
  </tr>
  <tr>
    <td colspan="2" class="maintd"></td>
  </tr>
</table>
<? 
$timer->stop();
include("position/footer.php");
?>
</body>
</html>
