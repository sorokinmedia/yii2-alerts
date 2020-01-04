<?php

namespace sorokinmedia\alerts\handlers\UserSiteAlert\interfaces;

/**
 * Interface EventClick
 * @package sorokinmedia\alerts\handlers\UserSiteAlert\interfaces
 */
interface EventClick
{
    /**
     * @return bool
     */
    public function eventClick(): bool;
}
