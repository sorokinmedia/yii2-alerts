<?php

namespace sorokinmedia\alerts\tests\entities\Company;

use sorokinmedia\alerts\tests\entities\SiteAlert\SiteAlert;
use sorokinmedia\alerts\tests\entities\UserSiteAlert\UserSiteAlert;
use sorokinmedia\alerts\tests\TestCase;
use sorokinmedia\user\tests\entities\User\User;
use Throwable;
use yii\base\InvalidConfigException;
use yii\db\Exception;
use yii\web\IdentityInterface;

/**
 * Class UserSiteAlertTest
 * @package sorokinmedia\alerts\tests\entities\Company
 */
class UserSiteAlertTest extends TestCase
{
    /**
     * @group user_alert
     * @throws InvalidConfigException
     * @throws Exception
     */
    public function testFields(): void
    {
        $this->initDb();
        $model = new UserSiteAlert();
        $this->assertEquals(
            [
                'id',
                'user_id',
                'alert_id',
                'view_count',
                'is_removable',
                'is_clicked',
                'is_closed',
                'is_finished',
            ],
            array_keys($model->getAttributes())
        );
    }

    /**
     * @group user_alert
     * @throws InvalidConfigException
     * @throws Exception
     */
    public function testRelations(): void
    {
        $this->initDb();
        $model = UserSiteAlert::findOne(1);
        $this->assertInstanceOf(UserSiteAlert::class, $model);
        $this->assertInstanceOf(IdentityInterface::class, $model->user);
        $this->assertInstanceOf(SiteAlert::class, $model->alert);
    }

    /**
     * @group user_alert
     * @throws Throwable
     */
    public function testCreateOld(): void
    {
        $this->initDb();
        $user = User::findOne(1);
        $alert = SiteAlert::findOne(1);
        $model = UserSiteAlert::create($user, $alert);
        $this->assertInstanceOf(UserSiteAlert::class, $model);
    }

    /**
     * @group user_alert
     * @throws Throwable
     */
    public function testCreateNew(): void
    {
        $this->initDb();
        $this->initDbAdditional();
        $user = User::findOne(1);
        $alert = SiteAlert::findOne(2);
        $model = UserSiteAlert::create($user, $alert);
        $this->assertInstanceOf(UserSiteAlert::class, $model);
        $this->assertEquals(2, $model->alert_id);
    }

    /**
     * @group user_alert
     * @throws Throwable
     * @throws InvalidConfigException
     * @throws Exception
     */
    public function testUpdateViewCount(): void
    {
        $this->initDb();
        $model = UserSiteAlert::findOne(1);
        $this->assertTrue($model->updateViewCount());
        $this->assertEquals(1, $model->view_count);
        $this->assertTrue($model->updateViewCount());
        $this->assertEquals(2, $model->view_count);
        $this->assertEquals(1, $model->is_removable);
    }

    /**
     * @group user_alert
     * @throws Throwable
     * @throws InvalidConfigException
     * @throws Exception
     */
    public function testClickEvent(): void
    {
        $this->initDb();
        $model = UserSiteAlert::findOne(1);
        $this->assertTrue($model->clickEvent());
        $this->assertEquals(1, $model->is_clicked);
        $this->assertEquals(1, $model->is_finished);
    }

    /**
     * @group user_alert
     * @throws Throwable
     * @throws InvalidConfigException
     * @throws Exception
     */
    public function testCloseEvent(): void
    {
        $this->initDb();
        $model = UserSiteAlert::findOne(1);
        $this->assertTrue($model->closeEvent());
        $this->assertEquals(1, $model->is_closed);
        $this->assertEquals(1, $model->is_finished);
    }

    /**
     * @group user_alert
     * @throws Throwable
     * @throws InvalidConfigException
     * @throws Exception
     */
    public function testMakeRemovable(): void
    {
        $this->initDb();
        $model = UserSiteAlert::findOne(1);
        $model->makeRemovable();
        $this->assertEquals(1, $model->is_removable);
    }

    /**
     * @group user_alert
     * @throws Throwable
     * @throws InvalidConfigException
     * @throws Exception
     */
    public function testMakeFinished(): void
    {
        $this->initDb();
        $model = UserSiteAlert::findOne(1);
        $this->assertTrue($model->makeFinished());
        $this->assertEquals(1, $model->is_finished);
    }

    /**
     * @group user_alert
     * @throws Throwable
     * @throws InvalidConfigException
     * @throws Exception
     */
    public function testAfterFinish(): void
    {
        $this->initDb();
        $model = UserSiteAlert::findOne(1);
        $this->assertTrue($model->afterFinish());
    }

    /**
     * @group user_alert
     * @throws Throwable
     * @throws InvalidConfigException
     * @throws Exception
     */
    public function testDeleteModel(): void
    {
        $this->initDb();
        $model = UserSiteAlert::findOne(1);
        $this->assertTrue($model->deleteModel());
        $deleted_model = UserSiteAlert::findOne(1);
        $this->assertNull($deleted_model);
    }

    /**
     * @group user_alert
     * @throws Throwable
     * @throws InvalidConfigException
     * @throws Exception
     */
    public function testBeforeDeleteUserSiteAlert(): void
    {
        $this->initDb();
        $model = UserSiteAlert::findOne(1);
        $this->assertTrue($model->beforeDeleteUserSiteAlert());
    }
}
