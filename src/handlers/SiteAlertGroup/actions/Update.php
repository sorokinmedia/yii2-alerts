<?php

namespace sorokinmedia\alerts\handlers\SiteAlertGroup\actions;

use yii\db\Exception;

/**
 * Class Update
 * @package sorokinmedia\alerts\handlers\SiteAlertGroup\actions
 */
class Update extends AbstractAction
{
    /**
     * @return bool
     * @throws Exception
     */
    public function execute(): bool
    {
        $this->site_alert_group->updateModel();
        return true;
    }
}
