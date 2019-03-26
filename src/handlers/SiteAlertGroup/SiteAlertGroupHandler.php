<?php
namespace sorokinmedia\alerts\handlers\SiteAlertGroup;

use sorokinmedia\alerts\entities\SiteAlertGroup\AbstractSiteAlertGroup;
use sorokinmedia\alerts\handlers\SiteAlertGroup\interfaces\{Create, Update, Delete};

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
     * @throws \Throwable
     * @throws \yii\db\Exception
     */
    public function create() : bool
    {
        return (new actions\Create($this->site_alert_group))->execute();
    }

    /**
     * @return bool
     * @throws \yii\db\Exception
     */
    public function update() : bool
    {
        return (new actions\Update($this->site_alert_group))->execute();
    }

    /**
     * @return bool
     * @throws \Throwable
     * @throws \yii\db\Exception
     * @throws \yii\db\StaleObjectException
     */
    public function delete() : bool
    {
        return (new actions\Delete($this->site_alert_group))->execute();
    }
}