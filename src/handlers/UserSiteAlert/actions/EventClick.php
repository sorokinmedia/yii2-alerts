<?php

namespace sorokinmedia\alerts\handlers\UserSiteAlert\actions;

use Throwable;
use yii\db\Exception;

/**
 * Class EventClick
 * @package sorokinmedia\alerts\handlers\UserSiteAlert\actions
 */
class EventClick extends AbstractAction
{
    /**
     * @return bool
     * @throws Throwable
     * @throws Exception
     */
    public function execute(): bool
    {
        $this->user_site_alert->clickEvent();
        return true;
    }
}
