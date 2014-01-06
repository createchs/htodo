<?php

class m140105_121553_create_table_list_order extends CDbMigration
{
    public $table_name = 'list_order';

	public function up()
	{
        $this->createTable($this->table_name, [
            'id' => 'pk',
            'order' => 'text',
        ], 'Engine=InnoDB');
	}

	public function down()
	{
        $this->dropTable($this->table_name);
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}