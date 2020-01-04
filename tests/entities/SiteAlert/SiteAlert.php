<?php

namespace sorokinmedia\alerts\tests\entities\SiteAlert;

use sorokinmedia\alerts\entities\SiteAlert\AbstractSiteAlert;
use sorokinmedia\alerts\tests\entities\RelationClassTrait;

/**
 * Class SiteAlert
 * @package sorokinmedia\alerts\tests\entities\SiteAlert
 */
class SiteAlert extends AbstractSiteAlert
{
    use RelationClassTrait;

    /**
     * @return bool
     */
    public function beforeSiteAlertDelete(): bool
    {
        return true;
    }

    /**
     * @return bool
     */
    public function startShowing(): bool
    {
        return true;
    }
}
