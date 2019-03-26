<?php
use yii\db\Migration;

/**
 * Class m180727_132939_add_site_alert
 * use this migration as `php yii migrate --migrationPath=@sorokinmedia/alerts/migrations/`
 */
class m180727_132939_add_site_alert extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('site_alert', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255),
            'text' => $this->text(),
            'image' => $this->string(255),
            'role' => $this->string(255),
            'view_count_to_close' => $this->integer(),
            'finish_date' => $this->integer(),
            'group_id' => $this->integer(),
            'order_id' => $this->integer()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('site_alert');
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
