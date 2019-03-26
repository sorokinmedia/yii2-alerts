<?php
namespace sorokinmedia\alerts\handlers\SiteAlertGroup\actions;

/**
 * Class Update
 * @package sorokinmedia\alerts\handlers\SiteAlertGroup\actions
 */
class Update extends AbstractAction
{
    /**
     * @return bool
     * @throws \yii\db\Exception
     */
    public function execute() : bool
    {
        $this->site_alert_group->updateModel();
        return true;
    }
}