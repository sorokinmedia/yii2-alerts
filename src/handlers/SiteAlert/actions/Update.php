<?php
namespace sorokinmedia\alerts\handlers\SiteAlert\actions;

/**
 * Class Update
 * @package sorokinmedia\alerts\handlers\SiteAlert\actions
 */
class Update extends AbstractAction
{
    /**
     * @return bool
     * @throws \yii\db\Exception
     */
    public function execute() : bool
    {
        $this->site_alert->updateModel();
        return true;
    }
}