<?php
namespace sorokinmedia\alerts\handlers\UserSiteAlert\actions;

/**
 * Class EventClose
 * @package sorokinmedia\alerts\handlers\UserSiteAlert\actions
 */
class EventClose extends AbstractAction
{
    /**
     * @return bool
     * @throws \Throwable
     * @throws \yii\db\Exception
     */
    public function execute() : bool
    {
        $this->user_site_alert->closeEvent();
        return true;
    }
}