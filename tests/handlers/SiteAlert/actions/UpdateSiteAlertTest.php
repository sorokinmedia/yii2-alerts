<?php
namespace sorokinmedia\alert\tests\handlers\SiteAlert\actions;

use sorokinmedia\alerts\forms\SiteAlertForm;
use sorokinmedia\alerts\handlers\SiteAlert\SiteAlertHandler;
use sorokinmedia\alerts\tests\entities\SiteAlert\SiteAlert;
use sorokinmedia\alerts\tests\TestCase;

/**
 * Class UpdateSiteAlertTest
 * @package sorokinmedia\alert\tests\handlers\SiteAlert\actions
 */
class UpdateSiteAlertTest extends TestCase
{
    /**
     * @group site-alert-handler
     * @throws \Throwable
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\db\Exception
     */
    public function testHandler()
    {
        $this->initDb();
        $this->initDbAdditional();
        $model = SiteAlert::findOne(1);
        $form = new SiteAlertForm([
            'name' => 'test_alert',
            'view_count_to_close' => 10,
        ], $model);
        $model->form = $form;
        $handler = new SiteAlertHandler($model);
        $this->assertTrue($handler->update());
    }
}