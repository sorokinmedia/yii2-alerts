<?php
namespace sorokinmedia\alerts\tests\entities;


use sorokinmedia\alerts\tests\entities\SiteAlert\SiteAlert;
use sorokinmedia\alerts\tests\entities\SiteAlertGroup\SiteAlertGroup;
use sorokinmedia\alerts\tests\entities\UserSiteAlert\UserSiteAlert;
use sorokinmedia\user\tests\entities\User\User;

trait RelationClassTrait
{
    public $__siteAlertClass;
    public $__siteAlertGroupClass;
    public $__userSiteAlertClass;
    public $__userClass;

    public function initClasses()
    {
        $this->__siteAlertClass = SiteAlert::class;
        $this->__siteAlertGroupClass = SiteAlertGroup::class;
        $this->__userSiteAlertClass = UserSiteAlert::class;
        $this->__userClass = User::class;
    }

    /**
     * инициализация связей
     */
    public function init()
    {
        parent::init();
        $this->initClasses();
    }

    /**
     * метод для динамической подстановки нужного класса в связь
     * @param string $field
     * @param string $class
     * @return mixed
     */
    public function setRelationClass(string $field, string $class)
    {
        return $this->{$field} = $class;
    }
}