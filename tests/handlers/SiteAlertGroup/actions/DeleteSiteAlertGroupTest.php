<?php
namespace sorokinmedia\alert\tests\handlers\SiteAlertGroup\actions;

use sorokinmedia\alerts\handlers\SiteAlertGroup\SiteAlertGroupHandler;
use sorokinmedia\alerts\tests\entities\SiteAlertGroup\SiteAlertGroup;
use sorokinmedia\alerts\tests\TestCase;

/**
 * Class DeleteSiteAlertGroupTest
 * @package sorokinmedia\alert\tests\handlers\SiteAlertGroup\actions
 */
class DeleteSiteAlertGroupTest extends TestCase
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
        $handler = new SiteAlertGroupHandler($model);
        $this->assertTrue($handler->delete());
    }
}