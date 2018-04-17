<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\modules\cms\assets\AppAsset;
use app\modules\cms\assets\AdminAsset;

AdminAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" style="overflow: hidden;">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
    <meta name="author" content="GeeksLabs">
    <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
    <link rel="shortcut icon" href="img/favicon.png">
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>


  <body data-pinterest-extension-installed="cr2.0.5">

  <!-- container section start -->
  <section id="container" class="">
      <!--header start-->
      <header class="header dark-bg">
            <div class="toggle-nav">
                <div class="icon-reorder tooltips" data-original-title="Toggle Navigation" data-placement="bottom"></div>
            </div>

            <!--logo start-->
            <a href="<?= \yii\helpers\Url::to(['admin/index'])?>" class="logo"><span class="lite"><img src="<?= \Yii::$app->controller->module->yiipress_logo?>"></span></a>
            <!--logo end-->

           

            <div class="top-nav notification-row">                
                <!-- notificatoin dropdown start-->
                <ul class="nav pull-right top-menu">
                     <li>
                       
                    </li>
                     <li>
                       
                    </li>
                      <li><a href="<?=\yii\helpers\Url::to(['default/page','slug'=>Yii::$app->controller->module->home_page])?>" target="_blank"><i class="fa fa-desktop"></i> Visualizza Sito</a>
                       
                    </li>
                   
                    <!-- user login dropdown start-->
                    <li>
                       <a href="<?=\yii\helpers\Url::to([Yii::$app->controller->module->logout])?>"><i class="icon_profile"></i> LogOut</a>
                    </li>
                    <!-- user login dropdown end -->
                </ul>
                <!-- notificatoin dropdown end-->
            </div>
      </header>      
      <!--header end-->

      <!--sidebar start-->
      <aside>
          <div id="sidebar" class="nav-collapse " tabindex="5000" style="overflow: hidden; outline: none;">
			  <?= \app\modules\cms\widgets\SideBar::widget()?>
              <!-- sidebar menu start-->
          <!--    <ul class="sidebar-menu" <?= (Yii::$app->controller->route=="cms/admin/index")?'style="display: block;"':''?>>                
                  <li <?= (Yii::$app->controller->route=="cms/admin/index")?'class="active"':''?>>
                      <a class="" href="<?=\yii\helpers\Url::to(['admin/index'])?>">
                          <i class="icon_house_alt"></i>
                          <span>Dashboard</span>
                      </a>
                  </li>
				  <li class="sub-menu<?= (Yii::$app->controller->route=="cms/admin/settings")?' active':''?>">
                      <a href="javascript:;">
                          <i class="fa fa-wrench"></i>
                          <span>Settings</span>
                          <span class="menu-arrow arrow_carrot-right"></span>
                      </a>
                      <ul class="sub" <?= (Yii::$app->controller->route=="cms/admin/settings")?'style="display: block;"':''?>>
                          <li <?= (Yii::$app->controller->route=="cms/admin/settings")?'class="active"':''?> ><a class="" href="<?= \yii\helpers\Url::to(['admin/settings'])?>">Generali</a></li>
                          
                      </ul>
                  </li>
                 
                             
                  <li class="sub-menu<?= (Yii::$app->controller->route=="cms/admin/menu")?' active':''?>">
                      <a href="javascript:;">
                          <i class="fa fa-list"></i>
                          <span>Menu</span>
                          <span class="menu-arrow arrow_carrot-right"></span>
                      </a>
                      <ul class="sub" <?= (Yii::$app->controller->route=="cms/admin/menu")?'style="display: block;"':''?>>
                          <li <?= (Yii::$app->controller->route=="cms/admin/menu")?'class="active"':''?> ><a class="" href="<?= \yii\helpers\Url::to(['admin/menu'])?>">Elenca</a></li>
                          <li><a class="" href="<?= \yii\helpers\Url::to(['admin/menu','action'=>'aggiungi'])?>">Aggiungi</a></li>
                 
                      </ul>
                  </li>
                  
                  <li class="sub-menu<?= (Yii::$app->controller->route=="cms/admin/pages")?' active':''?>">
                      <a href="javascript:;" class="">
                          <i class="icon_documents_alt"></i>
                          <span>Pagine</span>
                          <span class="menu-arrow arrow_carrot-right"></span>
                      </a>
                      <ul class="sub" <?= (Yii::$app->controller->route=="cms/admin/pages")?'style="display: block;"':''?>>                          
                          <li <?= (Yii::$app->controller->route=="cms/admin/pages")?'class="active"':''?>><a class="" href="<?= \yii\helpers\Url::to(['admin/pages'])?>">Elenca</a></li>
                          <li><a class="" href="<?= \yii\helpers\Url::to(['admin/pages','action'=>'aggiungi'])?>">Aggiungi</a></li>
                 
                      </ul>
                  </li>
                  <li class="sub-menu<?= (Yii::$app->controller->route=="cms/admin/sections")?' active':''?>">
                      <a href="javascript:;" class="">
                          <i class="icon_documents_alt"></i>
                          <span>Sezioni</span>
                          <span class="menu-arrow arrow_carrot-right"></span>
                      </a>
                      <ul class="sub" <?= (Yii::$app->controller->route=="cms/admin/sections")?'style="display: block;"':''?>>                          
                          <li <?= (Yii::$app->controller->route=="cms/admin/sections")?'class="active"':''?>><a class="" href="<?= \yii\helpers\Url::to(['admin/sections'])?>">Elenca</a></li>
                          <li><a class="" href="<?= \yii\helpers\Url::to(['admin/sections','action'=>'aggiungi'])?>">Aggiungi</a></li>
                 
                      </ul>
                  </li>
                  <li class="sub-menu<?= (Yii::$app->controller->route=="cms/admin/widgets")?' active':''?>">
                      <a href="javascript:;" class="">
                          <i class="icon_documents_alt"></i>
                          <span>Widgets</span>
                          <span class="menu-arrow arrow_carrot-right"></span>
                      </a>
                      <ul class="sub" <?= (Yii::$app->controller->route=="cms/admin/widgets")?'style="display: block;"':''?>>                          
                          <li <?= (Yii::$app->controller->route=="cms/admin/widgets")?'class="active"':''?>><a class="" href="<?= \yii\helpers\Url::to(['admin/widgets'])?>">Elenca</a></li>
                          <li><a class="" href="<?= \yii\helpers\Url::to(['admin/widgets','action'=>'aggiungi'])?>">Aggiungi</a></li>
                 
                      </ul>
                  </li>
                  <li class="sub-menu<?= (Yii::$app->controller->route=="cms/admin/layouts")?' active':''?>">
                      <a href="javascript:;" class="">
                          <i class="icon_documents_alt"></i>
                          <span>Layouts</span>
                          <span class="menu-arrow arrow_carrot-right"></span>
                      </a>
                      <ul class="sub" <?= (Yii::$app->controller->route=="cms/admin/layouts")?'style="display: block;"':''?>>                          
                          <li <?= (Yii::$app->controller->route=="cms/admin/layouts")?'class="active"':''?>><a class="" href="<?= \yii\helpers\Url::to(['admin/layouts'])?>">Elenca</a></li>
                          
                      </ul>
                  </li>
                  <li class="sub-menu<?= (Yii::$app->controller->route=="cms/admin/views")?' active':''?>">
                      <a href="javascript:;" class="">
                          <i class="icon_documents_alt"></i>
                          <span>Views</span>
                          <span class="menu-arrow arrow_carrot-right"></span>
                      </a>
                      <ul class="sub" <?= (Yii::$app->controller->route=="cms/admin/views")?'style="display: block;"':''?>>                          
                          <li <?= (Yii::$app->controller->route=="cms/admin/views")?'class="active"':''?>><a class="" href="<?= \yii\helpers\Url::to(['admin/views'])?>">Elenca</a></li>
                         
                      </ul>
                  </li>
                  
                  <li class="sub-menu">
                      <a href="javascript:;" class="">
                          <i class="fa fa-picture-o fa-2"></i>
                          <span>Media</span>
                          <span class="menu-arrow arrow_carrot-right"></span>
                      </a>
                      <ul class="sub" <?= (Yii::$app->controller->route=="cms/admin/media")?'style="display: block;"':''?>>                          
                          <li <?= (Yii::$app->controller->route=="cms/admin/media")?'class="active"':''?>><a class="" href="<?= \yii\helpers\Url::to(['admin/media'])?>">Elenca</a></li>
                          <li><a class="" href="<?= \yii\helpers\Url::to(['admin/media','action'=>'aggiungi'])?>">Aggiungi</a></li>
                      </ul>
                  </li>
                  <li class="sub-menu">
                      <a href="javascript:;" class="">
                          <i class="fa fa-cogs fa-2"></i>
                          <span>Plugins</span>
                          <span class="menu-arrow arrow_carrot-right"></span>
                      </a>
                      <ul class="sub" <?= (Yii::$app->controller->route=="cms/admin/plugins")?'style="display: block;"':''?>>                          
                          <li <?= (Yii::$app->controller->route=="cms/admin/plugins")?'class="active"':''?>><a class="" href="<?= \yii\helpers\Url::to(['admin/plugins'])?>">Elenca</a></li>
                          <li><a class="" href="<?= \yii\helpers\Url::to(['admin/plugins','action'=>'aggiungi'])?>">Aggiungi</a></li>
                      </ul>
                  </li>
              </ul>-->
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->

      <!--main content start-->
      <section id="main-content">
		 <section class="wrapper">
			 <?= \app\modules\cms\widgets\Alert::widget()?>
           <?= $content ?>
         </section>
      </section>
      <!--main content end-->
  </section>
    
    

<?php $this->endBody() ?>

<div id="ascrail2000" class="nicescroll-rails" style="width: 6px; z-index: 1000; cursor: default; position: fixed; top: 0px; height: 100%; right: 0px; opacity: 0; display: none; background: rgb(247, 247, 247);"><div style="position: relative; top: 0px; float: right; width: 6px; height: 0px; border-radius: 10px; background-color: rgb(0, 122, 255); background-clip: padding-box;"></div></div>
<div id="ascrail2000-hr" class="nicescroll-rails" style="height: 6px; z-index: 1000; position: fixed; left: 0px; width: 100%; bottom: 0px; cursor: default; display: none; opacity: 0; background: rgb(247, 247, 247);">
<div style="position: relative; top: 0px; height: 6px; width: 0px; border-radius: 10px; left: 0px; background-color: rgb(0, 122, 255); background-clip: padding-box;"></div></div><div id="ascrail2001" class="nicescroll-rails" style="width: 3px; z-index: auto; cursor: default; position: fixed; top: 0px; left: 177px; height: 362px; display: block; opacity: 0; background: rgb(247, 247, 247);"><div style="position: relative; top: 0px; float: right; width: 3px; height: 309px; border-radius: 10px; background-color: rgb(0, 122, 255); background-clip: padding-box;"></div></div><div id="ascrail2001-hr" class="nicescroll-rails" style="height: 3px; z-index: auto; top: 359px; left: 0px; position: fixed; cursor: default; display: none; opacity: 0; width: 177px; background: rgb(247, 247, 247);">
<div style="position: relative; top: 0px; height: 3px; width: 180px; border-radius: 10px; left: 0px; background-color: rgb(0, 122, 255); background-clip: padding-box;"></div></div><span style="border-radius: 2px !important; text-indent: 20px !important; width: auto !important; padding: 0px 4px 0px 0px !important; text-align: center !important; font-style: normal !important; font-variant: normal !important; font-weight: bold !important; font-stretch: normal !important; font-size: 11px !important; line-height: 20px !important; font-family: &quot;Helvetica Neue&quot;, Helvetica, sans-serif !important; color: rgb(255, 255, 255) !important; position: absolute !important; opacity: 1 !important; display: none; cursor: pointer !important; border: none !important; -webkit-font-smoothing: antialiased !important; background: url(&quot;data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIGhlaWdodD0iMzBweCIgd2lkdGg9IjMwcHgiIHZpZXdCb3g9Ii0xIC0xIDMxIDMxIj48Zz48cGF0aCBkPSJNMjkuNDQ5LDE0LjY2MiBDMjkuNDQ5LDIyLjcyMiAyMi44NjgsMjkuMjU2IDE0Ljc1LDI5LjI1NiBDNi42MzIsMjkuMjU2IDAuMDUxLDIyLjcyMiAwLjA1MSwxNC42NjIgQzAuMDUxLDYuNjAxIDYuNjMyLDAuMDY3IDE0Ljc1LDAuMDY3IEMyMi44NjgsMC4wNjcgMjkuNDQ5LDYuNjAxIDI5LjQ0OSwxNC42NjIiIGZpbGw9IiNmZmYiIHN0cm9rZT0iI2ZmZiIgc3Ryb2tlLXdpZHRoPSIxIj48L3BhdGg+PHBhdGggZD0iTTE0LjczMywxLjY4NiBDNy41MTYsMS42ODYgMS42NjUsNy40OTUgMS42NjUsMTQuNjYyIEMxLjY2NSwyMC4xNTkgNS4xMDksMjQuODU0IDkuOTcsMjYuNzQ0IEM5Ljg1NiwyNS43MTggOS43NTMsMjQuMTQzIDEwLjAxNiwyMy4wMjIgQzEwLjI1MywyMi4wMSAxMS41NDgsMTYuNTcyIDExLjU0OCwxNi41NzIgQzExLjU0OCwxNi41NzIgMTEuMTU3LDE1Ljc5NSAxMS4xNTcsMTQuNjQ2IEMxMS4xNTcsMTIuODQyIDEyLjIxMSwxMS40OTUgMTMuNTIyLDExLjQ5NSBDMTQuNjM3LDExLjQ5NSAxNS4xNzUsMTIuMzI2IDE1LjE3NSwxMy4zMjMgQzE1LjE3NSwxNC40MzYgMTQuNDYyLDE2LjEgMTQuMDkzLDE3LjY0MyBDMTMuNzg1LDE4LjkzNSAxNC43NDUsMTkuOTg4IDE2LjAyOCwxOS45ODggQzE4LjM1MSwxOS45ODggMjAuMTM2LDE3LjU1NiAyMC4xMzYsMTQuMDQ2IEMyMC4xMzYsMTAuOTM5IDE3Ljg4OCw4Ljc2NyAxNC42NzgsOC43NjcgQzEwLjk1OSw4Ljc2NyA4Ljc3NywxMS41MzYgOC43NzcsMTQuMzk4IEM4Ljc3NywxNS41MTMgOS4yMSwxNi43MDkgOS43NDksMTcuMzU5IEM5Ljg1NiwxNy40ODggOS44NzIsMTcuNiA5Ljg0LDE3LjczMSBDOS43NDEsMTguMTQxIDkuNTIsMTkuMDIzIDkuNDc3LDE5LjIwMyBDOS40MiwxOS40NCA5LjI4OCwxOS40OTEgOS4wNCwxOS4zNzYgQzcuNDA4LDE4LjYyMiA2LjM4NywxNi4yNTIgNi4zODcsMTQuMzQ5IEM2LjM4NywxMC4yNTYgOS4zODMsNi40OTcgMTUuMDIyLDYuNDk3IEMxOS41NTUsNi40OTcgMjMuMDc4LDkuNzA1IDIzLjA3OCwxMy45OTEgQzIzLjA3OCwxOC40NjMgMjAuMjM5LDIyLjA2MiAxNi4yOTcsMjIuMDYyIEMxNC45NzMsMjIuMDYyIDEzLjcyOCwyMS4zNzkgMTMuMzAyLDIwLjU3MiBDMTMuMzAyLDIwLjU3MiAxMi42NDcsMjMuMDUgMTIuNDg4LDIzLjY1NyBDMTIuMTkzLDI0Ljc4NCAxMS4zOTYsMjYuMTk2IDEwLjg2MywyNy4wNTggQzEyLjA4NiwyNy40MzQgMTMuMzg2LDI3LjYzNyAxNC43MzMsMjcuNjM3IEMyMS45NSwyNy42MzcgMjcuODAxLDIxLjgyOCAyNy44MDEsMTQuNjYyIEMyNy44MDEsNy40OTUgMjEuOTUsMS42ODYgMTQuNzMzLDEuNjg2IiBmaWxsPSIjYmQwODFjIj48L3BhdGg+PC9nPjwvc3ZnPg==&quot;) 3px 50% / 14px 14px no-repeat rgb(189, 8, 28) !important;">Salva</span>


</body>
</html>
<?php $this->endPage() ?>
