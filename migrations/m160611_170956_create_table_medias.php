<?php

use yii\db\Migration;

/**
 * Handles the creation for table `medias`.
 */
class m160611_170956_create_table_medias extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('medias', [
            'id' => $this->primaryKey(),
            'url' => 'string NOT NULL',
            'desc' => 'string',
        ]);
        $prefix = $this->db->tablePrefix;
        $this->createIndex($prefix.'medias_url_idx', '{{%medias}}', 'url', true);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('medias');
    }
}
