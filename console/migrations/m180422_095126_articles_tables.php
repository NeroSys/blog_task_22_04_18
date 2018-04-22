<?php

use yii\db\Migration;

/**
 * Class m180422_095126_articles_tables
 */
class m180422_095126_articles_tables extends Migration
{
    public function safeUp()
    {

        $tableOptions = null;
        //Опции для mysql
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        //Создание таблицы для переводов
        $this->createTable('{{%articles_lang}}', [
            'id' => $this->primaryKey(),
            'item_id' => $this->integer(11),
            'lang_id' => $this->integer(11),
            'lang' => $this->string(50),
            'title' => $this->string()->notNull()->defaultValue(''),
            'description' => $this->string()->notNull()->defaultValue(''),
            'text' => $this->string()->notNull()->defaultValue(''),
            'author' => $this->string()->notNull()->defaultValue('')
        ], $tableOptions);

        //Создание таблиц articles
        $this->createTable('{{%articles}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull()->defaultValue(''),
            'main_img' => $this->string(255)->defaultValue(null),
            'small_img' => $this->string(255)->defaultValue(null),
            'category_id' => $this->integer(11)->defaultValue(null),
            'slug' => $this->string(255)->defaultValue(null),
            'sort' => $this->integer(11)->defaultValue(null),
            'status' => $this->string(255)->defaultValue(null),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createIndex('FK_articles', '{{%articles}}', 'category_id');
        $this->createIndex('FK_articles_lang', '{{%articles_lang}}', 'item_id');


        $this->addForeignKey(
            'FK_articles_lang', '{{%articles_lang}}', 'item_id', '{{%articles}}', 'id', 'CASCADE', 'CASCADE'
        );

        $this->addForeignKey(
            'FK_catalog', '{{%articles}}', 'category_id', '{{%catalog_list}}', 'id', 'RESTRICT', 'RESTRICT'
        );



    }

    public function safeDown()
    {
        $this->dropTable('{{%articles_lang}}');
        $this->dropTable('{{%articles}}');
    }
}
