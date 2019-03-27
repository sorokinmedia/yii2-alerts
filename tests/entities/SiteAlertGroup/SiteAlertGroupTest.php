<?php
namespace sorokinmedia\alerts\tests\entities\Company;

use sorokinmedia\alerts\forms\SiteAlertGroupForm;
use sorokinmedia\alerts\tests\entities\SiteAlert\SiteAlert;
use sorokinmedia\alerts\tests\entities\SiteAlertGroup\SiteAlertGroup;
use sorokinmedia\alerts\tests\TestCase;
use yii\rbac\Role;

/**
 * Class SiteAlertGroupTest
 * @package sorokinmedia\alerts\tests\entities\Company
 */
class SiteAlertGroupTest extends TestCase
{
    /**
     * @group alert_group
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\db\Exception
     */
    public function testFields()
    {
        $this->initDb();
        $group = new SiteAlertGroup();
        $this->assertEquals(
            [
                'id',
                'name',
                'role',
                'priority',
            ],
            array_keys($group->getAttributes())
        );
    }

    /**
     * @group alert_group
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\db\Exception
     */
    public function testRelations()
    {
        $this->initDb();
        $group = SiteAlertGroup::findOne(1);
        $this->assertInstanceOf(SiteAlertGroup::class, $group);
        $this->assertInstanceOf(SiteAlert::class, $group->getAlerts()->all()[0]);
    }

    /**
     * @group alert_group
     * @throws \Throwable
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\db\Exception
     */
    public function testGetRoles()
    {
        $this->initDb();
        $roles = SiteAlertGroup::getRoles();
        $this->assertInstanceOf(Role::class, $roles[0]);
    }

    /**
     * @group alert_group
     * @throws \Throwable
     */
    public function testGetFromForm()
    {
        $this->initDb();
        $group_form = new SiteAlertGroupForm([
            'name' => 'тестовая группа',
            'role' => 'roleUser',
            'priority' => 10,
        ]);
        $group = new SiteAlertGroup([], $group_form);
        $group->getFromForm();
        $this->assertInstanceOf(SiteAlertGroupForm::class, $group->form);
        $this->assertEquals('тестовая группа', $group->name);
        $this->assertEquals('roleUser', $group->role);
        $this->assertEquals(10, $group->priority);
    }

    /**
     * @group alert_group
     * @throws \Throwable
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\db\Exception
     */
    public function testInsertModel()
    {
        $this->initDb();
        $group_form = new SiteAlertGroupForm([
            'name' => 'test_group',
            'role' => 'roleUser',
            'priority' => 10,
        ]);
        $group = new SiteAlertGroup([], $group_form);
        $this->assertTrue($group->insertModel());
        $inserted_group = SiteAlertGroup::findOne(2);
        $this->assertInstanceOf(SiteAlertGroup::class, $inserted_group);
        $this->assertEquals('test_group', $inserted_group->name);
        $this->assertEquals('roleUser', $inserted_group->role);
        $this->assertEquals(10, $inserted_group->priority);
    }

    /**
     * @group alert_group
     * @throws \Throwable
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\db\Exception
     */
    public function testUpdateModel()
    {
        $this->initDb();
        $group_form = new SiteAlertGroupForm([
            'name' => 'test_group',
            'role' => 'roleUser',
            'priority' => 100,
        ]);
        $group = SiteAlertGroup::findOne(1);
        $group->form = $group_form;
        $this->assertTrue($group->updateModel());
        $updated_group = SiteAlertGroup::findOne(1);
        $this->assertInstanceOf(SiteAlertGroup::class, $updated_group);
        $this->assertEquals('test_group', $updated_group->name);
        $this->assertEquals('roleUser', $updated_group->role);
        $this->assertEquals(100, $updated_group->priority);
    }

    /**
     * @group alert_group
     * @throws \Throwable
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\db\Exception
     */
    public function testDeleteModel()
    {
        $this->initDb();
        $group = SiteAlertGroup::findOne(1);
        $this->assertTrue($group->deleteModel());
        $deleted_group = SiteAlertGroup::findOne(1);
        $this->assertNull($deleted_group);
        $this->assertEmpty(SiteAlert::find()->where(['group_id' => 1])->all());
    }
}