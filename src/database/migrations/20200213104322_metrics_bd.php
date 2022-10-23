<?php

use Phinx\Migration\AbstractMigration;

class MetricsBd extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    addCustomColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Any other destructive changes will result in an error when trying to
     * rollback the migration.
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
	$table = $this->table("metric");
	$table->addColumn("name","string",["length"=>"20"])
		->addColumn("code","string",["length"=>"255"])
		->create();

	$refTable = $this->table("metric_data");
	$refTable->addColumn("metric_data_id","integer")
		->addColumn("user_id","integer")
		->addColumn("metric_id","integer")
		->addColumn("value","string",["length"=>"255"])
		->addColumn("timeshtamp","timestamp", ["default" => "CURRENT_TIMESTAMP"])
		->addForeignKey("metric_id","metric")
		->create();
    }
}
