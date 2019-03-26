<?php
namespace sorokinmedia\alerts\handlers\SiteAlertGroup\actions;

/**
 * Class Delete
 * @package sorokinmedia\alerts\handlers\SiteAlertGroup\actions
 */
class Delete extends AbstractAction
{
    /**
     * @return bool
     * @throws \Throwable
     * @throws \yii\db\Exception
     * @throws \yii\db\StaleObjectException
     */
    public function execute() : bool
    {
        $this->site_alert_group->deleteModel();
        return true;
    }
}