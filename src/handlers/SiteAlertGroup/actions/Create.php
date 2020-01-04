<?php

namespace sorokinmedia\alerts\handlers\SiteAlertGroup\actions;

use Throwable;
use yii\db\Exception;

/**
 * Class Create
 * @package sorokinmedia\alerts\handlers\SiteAlertGroup\actions
 */
class Create extends AbstractAction
{
    /**
     * @return bool
     * @throws Throwable
     * @throws Exception
     */
    public function execute(): bool
    {
        $this->site_alert_group->insertModel();
        return true;
    }
}
