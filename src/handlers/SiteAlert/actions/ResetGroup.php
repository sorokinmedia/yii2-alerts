<?php
namespace sorokinmedia\alerts\handlers\SiteAlert\actions;

/**
 * Class ResetGroup
 * @package sorokinmedia\alerts\handlers\SiteAlert\actions
 */
class ResetGroup extends AbstractAction
{
    /**
     * @return bool
     * @throws \Throwable
     * @throws \yii\db\Exception
     * @throws \yii\db\StaleObjectException
     */
    public function execute() : bool
    {
        $this->site_alert->resetGroup();
        return true;
    }
}