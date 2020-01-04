<?php

namespace sorokinmedia\alerts\handlers\SiteAlertGroup;

use sorokinmedia\alerts\entities\SiteAlertGroup\AbstractSiteAlertGroup;
use sorokinmedia\alerts\handlers\SiteAlertGroup\interfaces\{Create, Delete, Update};
use Throwable;
use yii\db\Exception;
use yii\db\StaleObjectException;

/**
 * Class SiteAlertGroupHandler
 * @package sorokinmedia\alerts\handlers\SiteAlertGroup
 *
 * @property AbstractSiteAlertGroup $site_alert_group
 */
class SiteAlertGroupHandler implements Create, Update, Delete
{
    public $site_alert_group;

    /**
     * SiteAlertGroupHandler constructor.
     * @param AbstractSiteAlertGroup $siteAlertGroup
     */
    public function __construct(AbstractSiteAlertGroup $siteAlertGroup)
    {
        $this->site_alert_group = $siteAlertGroup;
        return $this;
    }

    /**
     * @return bool
     * @throws Throwable
     * @throws Exception
     */
    public function create(): bool
    {
        return (new actions\Create($this->site_alert_group))->execute();
    }

    /**
     * @return bool
     * @throws Exception
     */
    public function update(): bool
    {
        return (new actions\Update($this->site_alert_group))->execute();
    }

    /**
     * @return bool
     * @throws Throwable
     * @throws Exception
     * @throws StaleObjectException
     */
    public function delete(): bool
    {
        return (new actions\Delete($this->site_alert_group))->execute();
    }
}
