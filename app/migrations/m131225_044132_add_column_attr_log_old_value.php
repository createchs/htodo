<?php

class m131225_044132_add_column_attr_log_old_value extends CDbMigration
{
    public $table_name = 'attr_log';
    public $column_name = 'old_value';

	public function up()
	{
        $this->addColumn($this->table_name, $this->column_name, 'string');
	}

	public function down()
	{
        $this->dropColumn($this->table_name, $this->column_name);
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