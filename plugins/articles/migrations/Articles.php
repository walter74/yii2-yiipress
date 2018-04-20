<?php
namespace plugins\articles\migrations;

use yii\db\Migration;
use yii\db\Schema;

class Articles extends Migration
{
    public function up()
    {
        $this->createTable('cms_articles', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'description'=>$this->string()->notNull(),
            'img' => $this->bynary()->notNull(),
            'status'=>$this->integer(11)->notNull(),
            'created_at'=>$this->integer(11)->notNull(),
            'updated_at'=>$this->integer(11)->notNull(),
            'created_by'=>$this->integer(11)->notNull(),
            'updated_by'=>$this->integer(11)->notNull(),
            'content' => $this->string(),
        ]);
    }

    public function down()
    {
        $this->dropTable('cms_articles');
    }

    
}
