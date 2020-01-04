<?php

namespace sorokinmedia\alerts\handlers\SiteAlert\actions;

use Throwable;
use yii\db\Exception;

/**
 * Class Create
 * @package sorokinmedia\alerts\handlers\SiteAlert\actions
 */
class Create extends AbstractAction
{
    /**
     * @return bool
     * @throws Throwable
     * @throws Exception
     */
    public function execute(): bool
    {
        $this->site_alert->insertModel();
        return true;
    }
}
