<?php
namespace sorokinmedia\alerts\handlers\SiteAlert;

use sorokinmedia\alerts\entities\SiteAlert\AbstractSiteAlert;
use sorokinmedia\alerts\handlers\SiteAlert\interfaces\{Create, ResetGroup, Update, Delete};

/**
 * Class SiteAlertHandler
 * @package sorokinmedia\alerts\handlers\SiteAlert
 *
 * @property AbstractSiteAlert $site_alert
 */
class SiteAlertHandler implements Create, Update, Delete, ResetGroup
{
    public $site_alert;

    /**
     * SiteAlertHandler constructor.
     * @param AbstractSiteAlert $siteAlert
     */
    public function __construct(AbstractSiteAlert $siteAlert)
    {
        $this->site_alert = $siteAlert;
        return $this;
    }

    /**
     * @return bool
     * @throws \Throwable
     * @throws \yii\db\Exception
     */
    public function create() : bool
    {
        return (new actions\Create($this->site_alert))->execute();
    }

    /**
     * @return bool
     * @throws \yii\db\Exception
     */
    public function update() : bool
    {
        return (new actions\Update($this->site_alert))->execute();
    }

    /**
     * @return bool
     * @throws \Throwable
     * @throws \yii\db\Exception
     * @throws \yii\db\StaleObjectException
     */
    public function delete() : bool
    {
        return (new actions\Delete($this->site_alert))->execute();
    }

    /**
     * @return bool
     * @throws \Throwable
     * @throws \yii\db\Exception
     * @throws \yii\db\StaleObjectException
     */
    public function resetGroup() : bool
    {
        return (new actions\ResetGroup($this->site_alert))->execute();
    }
}