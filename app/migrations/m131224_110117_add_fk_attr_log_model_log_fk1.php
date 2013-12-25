<?php

class m131224_110117_add_fk_attr_log_model_log_fk1 extends CDbMigration
{
    public $fk_name = 'attr_log_model_log_fk1';
    public $table_name = 'attr_log';

    public function up()
    {
        $this->addForeignKey($this->fk_name, $this->table_name,
            'model_log_id', 'model_log', 'id', 'RESTRICT', 'RESTRICT');
    }

    public function down()
    {
        $this->dropForeignKey($this->fk_name, $this->table_name);
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