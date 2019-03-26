<?php
use yii\db\Migration;

/**
 * Class m180729_132939_add_user_site_alert
 * use this migration as `php yii migrate --migrationPath=@sorokinmedia/alerts/migrations/`
 */
class m180729_132939_add_user_site_alert extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('user_site_alert', [
            'user_id' => $this->integer(),
            'alert_id' => $this->integer(),
            'view_count' => $this->integer(),
            'is_removable' => $this->integer(1),
            'is_clicked' => $this->integer(1),
            'is_finished' => $this->integer(1),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('user_site_alert');
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
