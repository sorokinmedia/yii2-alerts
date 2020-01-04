<?php

namespace sorokinmedia\alerts\handlers\UserSiteAlert\interfaces;

/**
 * Interface EventClose
 * @package sorokinmedia\alerts\handlers\UserSiteAlert\interfaces
 */
interface EventClose
{
    /**
     * @return bool
     */
    public function eventClose(): bool;
}
