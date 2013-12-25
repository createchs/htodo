<?php

class m131224_061902_create_table_model_log extends CDbMigration
{
    public $table_name = 'model_log';

	public function up()
	{
        $this->createTable($this->table_name, [
            'id' => 'pk',
            'created_at' => 'datetime',
            'model' => 'string',
            'pk' => 'string',
            'event' => 'string',
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