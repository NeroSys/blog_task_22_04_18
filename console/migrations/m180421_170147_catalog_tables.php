<?php

use yii\db\Migration;

/**
 * Class m180421_170147_catalog_tables
 */
class m180421_170147_catalog_tables extends Migration
{
    public function safeUp()
    {

        $tableOptions = null;
        //Опции для mysql
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        //Создание таблицы для категорий
        $this->createTable('{{%catalog_lang}}', [
            'id' => $this->primaryKey(),
            'item_id' => $this->integer(11),
            'lang_id' => $this->integer(11),
            'lang' => $this->string(50),
            'title' => $this->string(255)->notNull()->defaultValue(''),
            'description' => $this->string()->notNull()->defaultValue('')
        ], $tableOptions);

        //Создание таблиц категорий
        $this->createTable('{{%catalog_list}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull()->defaultValue(''),
            'img' => $this->string(255)->defaultValue(null),
            'visible' => $this->smallInteger(1)->notNull()->defaultValue('1'),
            'sort' => $this->integer(11)->unsigned()->defaultValue(null),
            'slug' => $this->string(255)->defaultValue(null),
        ], $tableOptions);


        //Создание индекса в таблице catalog_lang для ячейки 'catalog_list_id'
        $this->createIndex('FK_catalog_lang', '{{%catalog_lang}}', 'item_id');

        /* Связывание таблицы catalog_lang с таблицей catalog_list по первичным ключам.
        * При удалении записи в таблице catalog_list, записи из графы item_id таблицы catalog_lang будут обновлены на NULL,
        * а при обновлении записи в таблице catalog_list, записи из графы item_id таблицы catalog_lang будут обновлены соответственно.
        */
        $this->addForeignKey(
            'FK_catalog_lang', '{{%catalog_lang}}', 'item_id', '{{%catalog_list}}', 'id', 'CASCADE', 'CASCADE'
        );

    }

    public function safeDown()
    {
        $this->dropTable('{{%catalog_lang}}');
        $this->dropTable('{{%catalog_list}}');
    }
}
