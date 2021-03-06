<?php

namespace walter74\yiipress;

/**
 * cms module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $userModel = 'app\models\User';
    public $controllerNamespace = 'walter74\yiipress\controllers';
    public $modelNamespace='walter74\yiipress\models';
    public $actionNamespace='walter74\yiipress\actions';
    public $assetNamespace='walter74\yiipress\assets';
    public $widgetNamespace='walter74\yiipress\widgets';
    public $admin_layout = 'main';

    public $upload_dir='@webroot';
    public $upload_url="@web";
    public $template_layout_dir='@yipress-layout-dir';
    public $template_views_dir='@yipress-view-dir';

    public $yiipress_logo="data:image/png;base64,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";
    public $home_page="home";
    public $theme=null;
    public $logout="admin/logout";
    public $action_page_root=null;//configure on external controller
    public $action_run_root=null;//configure on external controller to permit plugin run on default controller
    public $action_maintenance_root=null;//configure on external controller
    public $main_view_default=null;//configure on external controller
    public $error_view_default=null;//configure on external controller
    public $sitemapControllers=[];
    public $status=10;

    public $maintenanceLayout='@yipress-maintenance';
    public $plugin_dir= '@plugins';
    public $theme_dir= '@themes';
    public $permission_admin_controller="?";

    public $params=['sidebar'=>[]];
    private $dir_plugin_name="";
    public $editor=true;
    /**
     * @inheritdoc
     */
    public function init()
    {

        //$this->template_layout_dir = __DIR__ .'/templates/layouts';
        //$this->template_views_dir = __DIR__ .'/templates/views';
        //\Yii::$classMap['yiipress-layout-dir'] = __DIR__ .'/templates/layouts';
        \Yii::setAlias('@yipress-layout-dir', __DIR__ .'/templates/layouts');
       // \Yii::$classMap['yiipress-view-dir'] = __DIR__ .'/templates/views';
        \Yii::setAlias('@yipress-view-dir', __DIR__ .'/templates/views');
        \Yii::setAlias('@yipress-maintenance', __DIR__ .'/templates/layouts/maintenance');
   
        
        
        \Yii::$classMap['themes'] = __DIR__ .'/themes';
        \Yii::setAlias('@themes', __DIR__ .'/themes');
        \Yii::$classMap['plugins'] = __DIR__ .'/plugins';
        \Yii::setAlias('@plugins', __DIR__ .'/plugins');
        \Yii::$classMap['themes'] = __DIR__ .'/themes';
        \Yii::setAlias('@themes', __DIR__ .'/themes');

        \Yii::$classMap['module'] = __DIR__;
        \Yii::setAlias('@module', __DIR__);
        $this->dir_plugin_name=basename(__DIR__);
        parent::init();
        // initialize the module with the configuration loaded from config.php
        $file_settings=file_get_contents(__DIR__.'/settings.php');
        $settings=\yii\helpers\Json::decode($file_settings);
      //  $config=require(__DIR__ . '/config.php');
      //  $settings = array_merge($settings,$config);
        if(is_array($settings)&&!empty($settings)){
				\Yii::configure($this, $settings);
		}
        // custom initialization code goes here
    }
}
