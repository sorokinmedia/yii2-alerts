<?php
namespace sorokinmedia\alerts\handlers\UserSiteAlert\actions;

/**
 * Class Delete
 * @package sorokinmedia\alerts\handlers\UserSiteAlert\actions
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
        $this->user_site_alert->deleteModel();
        return true;
    }
}