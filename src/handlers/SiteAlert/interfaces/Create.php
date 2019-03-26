<?php
namespace sorokinmedia\alerts\handlers\SiteAlert\interfaces;

/**
 * Interface Create
 * @package sorokinmedia\alerts\handlers\SiteAlert\interfaces
 */
interface Create
{
    /**
     * @return bool
     */
    public function create() : bool;
}