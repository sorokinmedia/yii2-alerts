<?php

namespace sorokinmedia\alerts\handlers\SiteAlert\actions;

use Throwable;
use yii\db\Exception;
use yii\db\StaleObjectException;

/**
 * Class Delete
 * @package sorokinmedia\alerts\handlers\SiteAlert\actions
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
        $this->site_alert->deleteModel();
        return true;
    }
}
