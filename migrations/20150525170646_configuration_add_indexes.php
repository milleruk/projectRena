<?php

use Phinx\Migration\AbstractMigration;

class ConfigurationAddIndexes extends AbstractMigration
{
				public function change()
				{
								$configuration = $this->table('configuration');
								$configuration
									->addIndex('key')
									->addIndex('value')
									->update();
				}

				/**
				 * Migrate Up.
				 */
				public function up()
				{
				}

				/**
				 * Migrate Down.
				 */
				public function down()
				{
				}
}
