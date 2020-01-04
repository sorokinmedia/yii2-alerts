<?php

namespace sorokinmedia\alert\tests\handlers\SiteAlertGroup\actions;

use sorokinmedia\alerts\forms\SiteAlertGroupForm;
use sorokinmedia\alerts\handlers\SiteAlertGroup\SiteAlertGroupHandler;
use sorokinmedia\alerts\tests\entities\SiteAlertGroup\SiteAlertGroup;
use sorokinmedia\alerts\tests\TestCase;
use Throwable;
use yii\base\InvalidConfigException;
use yii\db\Exception;

/**
 * Class UpdateSiteAlertGroupTest
 * @package sorokinmedia\alert\tests\handlers\SiteAlertGroup\actions
 */
class UpdateSiteAlertGroupTest extends TestCase
{
    /**
     * @group site-alert-group-handler
     * @throws Throwable
     * @throws InvalidConfigException
     * @throws Exception
     */
    public function testHandler(): void
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
