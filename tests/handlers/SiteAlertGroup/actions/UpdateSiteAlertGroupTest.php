<?php
namespace sorokinmedia\alert\tests\handlers\SiteAlertGroup\actions;

use sorokinmedia\alerts\forms\SiteAlertGroupForm;
use sorokinmedia\alerts\handlers\SiteAlertGroup\SiteAlertGroupHandler;
use sorokinmedia\alerts\tests\entities\SiteAlertGroup\SiteAlertGroup;
use sorokinmedia\alerts\tests\TestCase;

/**
 * Class UpdateSiteAlertGroupTest
 * @package sorokinmedia\alert\tests\handlers\SiteAlertGroup\actions
 */
class UpdateSiteAlertGroupTest extends TestCase
{
    /**
     * @group site-alert-group-handler
     * @throws \Throwable
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\db\Exception
     */
    public function testHandler()
    {
        $this->initDb();
        $this->initDbAdditional();
        $model = SiteAlertGroup::findOne(1);
        $form = new SiteAlertGroupForm([
            'name' => 'test_group',
            'priority' => 100,
        ], $model);
        $model->form = $form;
        $handler = new SiteAlertGroupHandler($model);
        $this->assertTrue($handler->update());
    }
}