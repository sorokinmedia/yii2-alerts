<?php

namespace sorokinmedia\alerts\handlers\SiteAlert\actions;

use Throwable;
use yii\db\Exception;

/**
 * Class ResetGroup
 * @package sorokinmedia\alerts\handlers\SiteAlert\actions
 */
class ResetGroup extends AbstractAction
{
    /**
     * @return bool
     * @throws Throwable
     * @throws Exception
     */
    public function execute(): bool
    {
        $this->site_alert->resetGroup();
        return true;
    }
}
