<?php

namespace sorokinmedia\alerts\handlers\UserSiteAlert\actions;

use Throwable;
use yii\db\Exception;
use yii\db\StaleObjectException;

/**
 * Class Delete
 * @package sorokinmedia\alerts\handlers\UserSiteAlert\actions
 */
class Delete extends AbstractAction
{
    /**
     * @return bool
     * @throws Throwable
     * @throws Exception
     * @throws StaleObjectException
     */
    public function execute(): bool
    {
        $this->user_site_alert->deleteModel();
        return true;
    }
}
