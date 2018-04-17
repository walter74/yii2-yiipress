<?php
namespace plugins\mailinglist\migrations;

use yii\db\Migration;
use yii\db\Schema;

class Mailinglist extends Migration
{
    public function up()
    {
        $this->createTable('cms_mailing_list', [
            'id' => Schema::TYPE_PK,
            'email' => Schema::TYPE_STRING . ' NOT NULL',
            'description' => Schema::TYPE_TEXT,
            'created_at'=>Schema::TYPE_INTEGER,
            'updated_at'=>Schema::TYPE_INTEGER,
        ]);
    }

    public function down()
    {
        $this->dropTable('cms_mailing_list');
    }

    
}
