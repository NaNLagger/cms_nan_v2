<?
$result1 = mysql_query("SELECT * FROM news ORDER BY id DESC LIMIT 5");
$myrow1 = mysql_fetch_array($result1);
?>

<div class="container">
	<div id="content-slider">
    	<div id="slider">
        	<div id="mask">
            <ul>
           	<li id="first" class="firstanimation">
            <a href="<? printf("./index.php?page=news&id=%s",$myrow1['id']); ?>">
            <img height="320px;" width="600px;" src="<? printf("%snews/image/stories/%s",$URL_SITE,$myrow1['img']); ?>" alt="<? printf("%s",$myrow1['title']); ?>"/>
            </a>
            <div class="tooltip">
            <h1><a href="<? printf("./index.php?page=news&id=%s",$myrow1['id']); ?> "> <? printf("%s",$myrow1['title']); ?></a></h1>
            <p><? printf("%s",$myrow1['description']); ?></p>
            </div>
            </li>
            
            <? $myrow1 = mysql_fetch_array($result1); ?>
            <li id="second" class="secondanimation">
            <a href="<? printf("./index.php?page=news&id=%s",$myrow1['id']); ?>">
            <img height="320px;" width="600px;"  src="<? printf("%snews/image/stories/%s",$URL_SITE,$myrow1['img']); ?>" alt="<? printf("%s",$myrow1['title']); ?>"/>
            </a>
            <div class="tooltip">
            <h1><a href="<? printf("./index.php?page=news&id=%s",$myrow1['id']); ?> "> <? printf("%s",$myrow1['title']); ?></a></h1>
            <p><? printf("%s",$myrow1['description']); ?></p>
            </div>
            </li>
            
            <? $myrow1 = mysql_fetch_array($result1); ?>
            <li id="third" class="thirdanimation">
            <a href="<? printf("./index.php?page=news&id=%s",$myrow1['id']); ?>">
            <img height="320px;" width="600px;"  src="<? printf("%snews/image/stories/%s",$URL_SITE,$myrow1['img']); ?>" alt="<? printf("%s",$myrow1['title']); ?>"/>
            </a>
            <div class="tooltip">
            <h1><a href="<? printf("./index.php?page=news&id=%s",$myrow1['id']); ?> "> <? printf("%s",$myrow1['title']); ?></a></h1>
            <p><? printf("%s",$myrow1['description']); ?></p>
            </div>
            </li>
             
            <? $myrow1 = mysql_fetch_array($result1); ?>           
            <li id="fourth" class="fourthanimation">
            <a href="<? printf("./index.php?page=news&id=%s",$myrow1['id']); ?>">
            <img height="320px;" width="600px;"  src="<? printf("%snews/image/stories/%s",$URL_SITE,$myrow1['img']); ?>" alt="<? printf("%s",$myrow1['title']); ?>"/>
            </a>
            <div class="tooltip">
            <h1><a href="<? printf("./index.php?page=news&id=%s",$myrow1['id']); ?> "> <? printf("%s",$myrow1['title']); ?></a></h1>
            <p><? printf("%s",$myrow1['description']); ?></p>
            </div>
            </li>
            
            <? $myrow1 = mysql_fetch_array($result1); ?>          
            <li id="fifth" class="fifthanimation">
            <a href="<? printf("./index.php?page=news&id=%s",$myrow1['id']); ?>">
            <img height="320px;" width="600px;"  src="<? printf("%snews/image/stories/%s",$URL_SITE,$myrow1['img']); ?>" alt="<? printf("%s",$myrow1['title']); ?>"/>
            </a>
            <div class="tooltip">
            <h1><a href="<? printf("./index.php?page=news&id=%s",$myrow1['id']); ?> "> <? printf("%s",$myrow1['title']); ?></a></h1>
            <p><? printf("%s",$myrow1['description']); ?></p>
            </div>
            </li>
            </ul>
            </div>
            <div class="progress-bar"></div>
        </div>
    </div>
</div>