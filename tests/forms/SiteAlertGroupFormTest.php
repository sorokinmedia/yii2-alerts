<?php
namespace sorokinmedia\alerts\tests\forms;

use sorokinmedia\alerts\forms\SiteAlertGroupForm;
use sorokinmedia\alerts\tests\entities\SiteAlertGroup\SiteAlertGroup;
use sorokinmedia\alerts\tests\TestCase;

/**
 * Class SiteAlertGroupFormTest
 * @package sorokinmedia\alerts\tests\forms
 *
 * тест формы группы алертов
 */
class SiteAlertGroupFormTest extends TestCase
{
    /**
     * @group forms
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\db\Exception
     */
    public function testConstruct()
    {
        $this->initDb();
        $group = new SiteAlertGroup();
        $form = new SiteAlertGroupForm([
            'name' => 'test_group',
            'role' => 'userRole',
            'priority' => 10
        ], $group);
        $this->assertInstanceOf(SiteAlertGroupForm::class, $form);
        $this->assertEquals($form->name, 'test_group');
        $this->assertEquals($form->role, 'userRole');
        $this->assertEquals($form->priority, 10);
        $this->assertTrue($form->validate());
    }

    /**
     * @group forms
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\db\Exception
     */
    public function testConstructWithModel()
    {
        $this->initDb();
        $group = SiteAlertGroup::findOne(1);
        $form = new SiteAlertGroupForm([
            'priority' => 100
        ], $group);
        $this->assertInstanceOf(SiteAlertGroupForm::class, $form);
        $this->assertEquals($form->name, 'тестовая группа');
        $this->assertEquals($form->role, 'roleUser');
        $this->assertEquals($form->priority, 100);
        $this->assertTrue($form->validate());
    }
}