<?php
namespace sorokinmedia\alerts\handlers\SiteAlert\actions;

/**
 * Class Delete
 * @package sorokinmedia\alerts\handlers\SiteAlert\actions
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
        $this->site_alert->deleteModel();
        return true;
    }
}