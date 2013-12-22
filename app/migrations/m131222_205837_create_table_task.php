<?php

class m131222_205837_create_table_task extends CDbMigration
{
    public $table_name = 'task';

	public function up()
	{
        $this->createTable($this->table_name, [
            'id' => 'pk',
            'title' => 'string',
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