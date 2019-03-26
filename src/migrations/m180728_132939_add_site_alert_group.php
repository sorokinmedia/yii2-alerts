<?php
use yii\db\Migration;

/**
 * Class m180728_132939_add_site_alert_group
 * use this migration as `php yii migrate --migrationPath=@sorokinmedia/alerts/migrations/`
 */
class m180728_132939_add_site_alert_group extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('site_alert_group', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255),
            'role' => $this->string(255),
            'priority' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('site_alert_group');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180727_132939_refactor_user cannot be reverted.\n";

        return false;
    }
    */
}
