<?php
namespace sorokinmedia\alerts\handlers\UserSiteAlert\actions;

/**
 * Class UpdateViews
 * @package sorokinmedia\alerts\handlers\UserSiteAlert\actions
 */
class UpdateViews extends AbstractAction
{
    /**
     * @return bool
     * @throws \Throwable
     * @throws \yii\db\Exception
     */
    public function execute() : bool
    {
        $this->user_site_alert->updateViewCount();
        return true;
    }
}