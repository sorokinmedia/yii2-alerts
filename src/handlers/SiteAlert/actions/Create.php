<?php
namespace sorokinmedia\alerts\handlers\SiteAlert\actions;

/**
 * Class Create
 * @package sorokinmedia\alerts\handlers\SiteAlert\actions
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
        $this->site_alert->insertModel();
        return true;
    }
}