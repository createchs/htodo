<?php

class m131224_061916_create_table_attr_log extends CDbMigration
{
    public $table_name = 'attr_log';

	public function up()
	{
        $this->createTable($this->table_name, [
            'id' => 'pk',
            'model_log_id' => 'integer',
            'name' => 'string',
            'value' => 'string',
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