<?php
namespace sorokinmedia\alerts\tests;

use yii\console\Application;
use yii\db\Connection;
use yii\db\Schema;

/**
 * Class TestCase
 * @package sorokinmedia\user\tests
 */
abstract class TestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * @throws \yii\base\InvalidConfigException
     */
    protected function setUp()
    {
        parent::setUp();
        $this->mockApplication();
    }

    /**
     *
     */
    protected function tearDown()
    {
        $this->destroyApplication();
        parent::tearDown();
    }

    /**
     * @throws \yii\base\InvalidConfigException
     */
    protected function mockApplication()
    {
        new Application([
            'id' => 'testapp',
            'basePath' => __DIR__,
            'vendorPath' => dirname(__DIR__) . '/vendor',
            'runtimePath' => __DIR__ . '/runtime',
            'aliases' => [
                '@tests' => __DIR__,
            ],
        ]);
    }

    /**
     *
     */
    protected function destroyApplication()
    {
        \Yii::$app = null;
    }

    /**
     * инициализация нужных таблиц
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\db\Exception
     */
    public function initDb()
    {
        @unlink(__DIR__ . '/runtime/sqlite.db');
        $db = new Connection([
            'dsn' => 'sqlite:' . \Yii::$app->getRuntimePath() . '/sqlite.db',
            'charset' => 'utf8',
        ]);
        \Yii::$app->set('db', $db);
        if ($db->getTableSchema('user')){
            $db->createCommand()->dropTable('user')->execute();
        }
        $db->createCommand()->createTable('user', [
            'id' => Schema::TYPE_PK,
            'email' => Schema::TYPE_STRING . '(255) NOT NULL',
            'password_hash' => Schema::TYPE_STRING . '(60) NOT NULL',
            'password_reset_token' =>Schema::TYPE_STRING . '(255)',
            'auth_key' => Schema::TYPE_STRING . '(45)',
            'username' => Schema::TYPE_STRING . '(255) NOT NULL',
            'status_id' => Schema::TYPE_TINYINT,
            'created_at' => Schema::TYPE_INTEGER . '(11)',
            'last_entering_date' => Schema::TYPE_INTEGER . '(11)',
            'email_confirm_token' => Schema::TYPE_STRING . '(255)'
        ])->execute();
        if ($db->getTableSchema('site_alert')){
            $db->createCommand()->dropTable('site_alert')->execute();
        }
        $db->createCommand()->createTable('site_alert', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING . '(255) NOT NULL',
            'text' => Schema::TYPE_TEXT,
            'image' =>Schema::TYPE_STRING . '(255)',
            'role' => Schema::TYPE_STRING . '(255)',
            'view_count_to_close' => Schema::TYPE_INTEGER . '(11)',
            'finish_date' => Schema::TYPE_INTEGER . '(11)',
            'group_id' => Schema::TYPE_INTEGER . '(11)',
            'order_id' => Schema::TYPE_INTEGER . '(11)',
        ])->execute();
        if ($db->getTableSchema('site_alert_group')){
            $db->createCommand()->dropTable('site_alert_group')->execute();
        }
        $db->createCommand()->createTable('site_alert_group', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING . '(255)',
            'role' => Schema::TYPE_STRING . '(255)',
            'priority' => Schema::TYPE_INTEGER . '(11)',
        ])->execute();
        if ($db->getTableSchema('user_site_alert')){
            $db->createCommand()->dropTable('user_site_alert')->execute();
        }
        $db->createCommand()->createTable('user_site_alert', [
            'id' => Schema::TYPE_PK,
            'user_id' => Schema::TYPE_INTEGER,
            'alert_id' => Schema::TYPE_INTEGER,
            'view_count' => Schema::TYPE_INTEGER . ' default 0',
            'is_removable' => Schema::TYPE_TINYINT . ' default 0',
            'is_clicked' => Schema::TYPE_TINYINT . ' default 0',
            'is_closed' => Schema::TYPE_TINYINT . ' default 0',
            'is_finished' => Schema::TYPE_TINYINT . ' default 0',
        ])->execute();

        $this->initDefaultData();
    }

    /**
     * дефолтный набор данных для тестов
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\db\Exception
     */
    public function initDefaultData()
    {
        $db = new Connection([
            'dsn' => 'sqlite:' . \Yii::$app->getRuntimePath() . '/sqlite.db',
            'charset' => 'utf8',
        ]);
        \Yii::$app->set('db', $db);
        $db->createCommand()->insert('user', [
            'id' => 1,
            'email' => 'test@yandex.ru',
            'password_hash' => '$2y$13$965KGf0VPtTcQqflsIEDtu4kmvM4mstARSbtRoZRiwYZkUqCQWmcy',
            'password_reset_token' => null,
            'auth_key' => 'NdLufkTZDHMPH8Sw3p5f7ukUXSXllYwM',
            'username' => 'IvanSidorov',
            'status_id' => 1,
            'created_at' => 1460902430,
            'last_entering_date' => 1532370359,
            'email_confirm_token' => null,
        ])->execute();
        $db->createCommand()->insert('site_alert_group', [
            'id' => 1,
            'name' => 'тестовая группа',
            'role' => 'roleUser',
            'priority' => 10,
        ])->execute();
        $db->createCommand()->insert('site_alert', [
            'id' => 1,
            'name' => 'тестовый алерт с ссылкой',
            'text' => '<p>тестовый алерт с ссылкой <a href="https://workhard.online">workhard.online</a></p>',
            'image' => 'https://workhard.online/img/ico_who.png',
            'role' => 'roleUser',
            'view_count_to_close' => 2,
            'finish_date' => 1575158400, // 01.12.2019
            'group_id' => 1,
            'order_id' => 1
        ])->execute();
        $db->createCommand()->insert('user_site_alert', [
            'id' => 1,
            'user_id' => 1,
            'alert_id' => 1,
            'view_count' => 0,
            'is_removable' => 0,
            'is_clicked' => 0,
            'is_closed' => 0,
            'is_finished' => 0,
        ])->execute();
    }

    /**
     * доп данные для таблицы user
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\db\Exception
     */
    public function initDbAdditional()
    {
        $db = new Connection([
            'dsn' => 'sqlite:' . \Yii::$app->getRuntimePath() . '/sqlite.db',
            'charset' => 'utf8',
        ]);
        \Yii::$app->set('db', $db);
        $db->createCommand()->insert('site_alert', [
            'id' => 2,
            'name' => 'второй тестовый алерт с ссылкой',
            'text' => '<p>тестовый алерт с ссылкой <a href="https://workhard.online">workhard.online</a></p>',
            'image' => 'https://workhard.online/img/ico_who.png',
            'role' => 'roleUser',
            'view_count_to_close' => 2,
            'finish_date' => 1575158400, // 01.12.2019
            'group_id' => 1,
            'order_id' => 1
        ])->execute();
    }
}