<?php
namespace sorokinmedia\alerts\handlers\SiteAlertGroup\actions;

/**
 * Class Create
 * @package sorokinmedia\alerts\handlers\SiteAlertGroup\actions
 */
class Create extends AbstractAction
{
    /**
     * @return bool
     * @throws \Throwable
     * @throws \yii\db\Exception
     */
    public function execute() : bool
    {
        $this->site_alert_group->insertModel();
        return true;
    }
}