<?php

namespace sorokinmedia\alerts\handlers\SiteAlert\actions;

use yii\db\Exception;

/**
 * Class Update
 * @package sorokinmedia\alerts\handlers\SiteAlert\actions
 */
class Update extends AbstractAction
{
    /**
     * @return bool
     * @throws Exception
     */
    public function execute(): bool
    {
        $this->site_alert->updateModel();
        return true;
    }
}
