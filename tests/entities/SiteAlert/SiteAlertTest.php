<?php

namespace sorokinmedia\alerts\tests\entities\Company;

use sorokinmedia\alerts\forms\SiteAlertForm;
use sorokinmedia\alerts\tests\entities\SiteAlert\SiteAlert;
use sorokinmedia\alerts\tests\entities\SiteAlertGroup\SiteAlertGroup;
use sorokinmedia\alerts\tests\entities\UserSiteAlert\UserSiteAlert;
use sorokinmedia\alerts\tests\TestCase;
use Throwable;
use yii\base\InvalidConfigException;
use yii\db\Exception;

/**
 * Class SiteAlertTest
 * @package sorokinmedia\alerts\tests\entities\Company
 */
class SiteAlertTest extends TestCase
{
    /**
     * @group alert
     * @throws InvalidConfigException
     * @throws Exception
     */
    public function testFields(): void
    {
        $this->initDb();
        $alert = new SiteAlert();
        $this->assertEquals(
            [
                'id',
                'name',
                'text',
                'image',
                'role',
                'view_count_to_close',
                'finish_date',
                'group_id',
                'order_id',
            ],
            array_keys($alert->getAttributes())
        );
    }

    /**
     * @group alert
     * @throws InvalidConfigException
     * @throws Exception
     */
    public function testRelations(): void
    {
        $this->initDb();
        $alert = SiteAlert::findOne(1);
        $this->assertInstanceOf(SiteAlert::class, $alert);
        $this->assertInstanceOf(SiteAlertGroup::class, $alert->group);
        $this->assertInstanceOf(UserSiteAlert::class, $alert->userAlerts[0]);
    }

    /**
     * @group alert
     * @throws Throwable
     */
    public function testGetFromForm(): void
    {
        $this->initDb();
        $alert_form = new SiteAlertForm([
            'name' => 'тестовый алерт с ссылкой',
            'text' => '<p>тестовый алерт с ссылкой <a href="https://workhard.online">workhard.online</a></p>',
            'image' => 'https://workhard.online/img/ico_who.png',
            'role' => 'roleUser',
            'view_count_to_close' => 2,
            'finish_date' => 1575158400, // 01.12.2019
            'group_id' => 1,
            'order_id' => 1
        ]);
        $alert = new SiteAlert([], $alert_form);
        $alert->getFromForm();
        $this->assertInstanceOf(SiteAlertForm::class, $alert->form);
        $this->assertEquals('тестовый алерт с ссылкой', $alert->name);
        $this->assertEquals('<p>тестовый алерт с ссылкой <a href="https://workhard.online">workhard.online</a></p>', $alert->text);
        $this->assertEquals('https://workhard.online/img/ico_who.png', $alert->image);
        $this->assertEquals('roleUser', $alert->role);
        $this->assertEquals(2, $alert->view_count_to_close);
        $this->assertEquals(1575158400, $alert->finish_date);
        $this->assertEquals(1, $alert->group_id);
        $this->assertEquals(1, $alert->order_id);
    }

    /**
     * @group alert
     * @throws Throwable
     * @throws InvalidConfigException
     * @throws Exception
     */
    public function testInsertModel(): void
    {
        $this->initDb();
        $alert_form = new SiteAlertForm([
            'name' => 'тестовый алерт с ссылкой',
            'text' => '<p>тестовый алерт с ссылкой <a href="https://workhard.online">workhard.online</a></p>',
            'image' => 'https://workhard.online/img/ico_who.png',
            'role' => 'roleUser',
            'view_count_to_close' => 2,
            'finish_date' => 1575158400, // 01.12.2019
            'group_id' => 1,
            'order_id' => 1
        ]);
        $alert = new SiteAlert([], $alert_form);
        $this->assertTrue($alert->insertModel());
        $inserted_alert = SiteAlert::findOne(2);
        $this->assertInstanceOf(SiteAlert::class, $inserted_alert);
        $this->assertEquals('тестовый алерт с ссылкой', $inserted_alert->name);
        $this->assertEquals('<p>тестовый алерт с ссылкой <a href="https://workhard.online">workhard.online</a></p>', $inserted_alert->text);
        $this->assertEquals('https://workhard.online/img/ico_who.png', $inserted_alert->image);
        $this->assertEquals('roleUser', $inserted_alert->role);
        $this->assertEquals(2, $inserted_alert->view_count_to_close);
        $this->assertEquals(1575158400, $inserted_alert->finish_date);
        $this->assertEquals(1, $inserted_alert->group_id);
        $this->assertEquals(1, $inserted_alert->order_id);
    }

    /**
     * @group alert
     * @throws Throwable
     * @throws InvalidConfigException
     * @throws Exception
     */
    public function testUpdateModel(): void
    {
        $this->initDb();
        $model = SiteAlert::findOne(1);
        $form = new SiteAlertForm([
            'name' => 'test_alert',
            'view_count_to_close' => 100,
        ], $model);
        $model->form = $form;
        $this->assertTrue($model->updateModel());
        $updated_model = SiteAlert::findOne(1);
        $this->assertInstanceOf(SiteAlert::class, $updated_model);
        $this->assertEquals('test_alert', $updated_model->name);
        $this->assertEquals(100, $updated_model->view_count_to_close);
    }

    /**
     * @group alert
     * @throws InvalidConfigException
     * @throws Exception
     */
    public function testBeforeSiteAlertDelete(): void
    {
        $this->initDb();
        $model = SiteAlert::findOne(1);
        $this->assertTrue($model->beforeSiteAlertDelete());
    }

    /**
     * @group alert
     * @throws Throwable
     * @throws InvalidConfigException
     * @throws Exception
     */
    public function testDeleteModel(): void
    {
        $this->initDb();
        $model = SiteAlert::findOne(1);
        $this->assertTrue($model->deleteModel());
        $deleted_model = SiteAlert::findOne(1);
        $this->assertNull($deleted_model);
    }

    /**
     * @group alert
     * @throws Throwable
     * @throws InvalidConfigException
     * @throws Exception
     */
    public function testResetGroup(): void
    {
        $this->initDb();
        $model = SiteAlert::findOne(1);
        $this->assertTrue($model->resetGroup());
        $model->refresh();
        $this->assertNull($model->group_id);
    }

    /**
     * @group alert
     * @throws InvalidConfigException
     * @throws Exception
     */
    public function testStartShowing(): void
    {
        $this->initDb();
        $model = SiteAlert::findOne(1);
        $this->assertTrue($model->startShowing());
    }
}
