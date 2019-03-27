<?php
namespace sorokinmedia\alerts\forms;

use sorokinmedia\alerts\entities\SiteAlert\AbstractSiteAlert;
use sorokinmedia\alerts\entities\SiteAlertGroup\AbstractSiteAlertGroup;
use yii\base\Model;

/**
 * Class SiteAlertForm
 * @package sorokinmedia\alerts\forms
 *
 * @property string $name
 * @property string $text
 * @property string $image
 * @property string $role
 * @property int $view_count_to_close
 * @property int $finish_date
 * @property int $group_id
 * @property int $order_id
 */
class SiteAlertForm extends Model
{
    public $name;
    public $text;
    public $image;
    public $role;
    public $view_count_to_close;
    public $finish_date;
    public $group_id;
    public $order_id;

    /**
     * SiteAlertForm constructor.
     * @param array $config
     * @param AbstractSiteAlert|null $alert
     */
    public function __construct(array $config = [], AbstractSiteAlert $alert = null)
    {
        if ($alert !== null){
            $this->name = $alert->name;
            $this->text = $alert->text;
            $this->image = $alert->image;
            $this->role = $alert->role;
            $this->view_count_to_close = $alert->view_count_to_close;
            $this->finish_date = $alert->finish_date;
            $this->group_id = $alert->group_id;
            $this->order_id = $alert->order_id;
        }
        parent::__construct($config);
    }

    /**
     * @return array
     */
    public function rules() : array
    {
        return [
            [['name', 'text', 'role', 'order_id'], 'required'],
            [['name', 'role', 'image'], 'string', 'max' => 255],
            [['text'], 'string'],
            [['group_id'], 'exist', 'targetClass' => AbstractSiteAlertGroup::class, 'targetAttribute' => ['group_id' => 'id']],
            [['view_count_to_close', 'finish_date', 'order_id'], 'integer']
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels() : array
    {
        return [
            'name' => \Yii::t('app', 'Название'),
            'text' => \Yii::t('app', 'Текст'),
            'image' => \Yii::t('app', 'Изображение'),
            'role' => \Yii::t('app', 'Роль'),
            'view_count_to_close' => \Yii::t('app', 'Кол-во просмотров для отображения кнопки закрытия'),
            'finish_date' => \Yii::t('app', 'Дата окончания показов'),
            'group_id' => \Yii::t('app', 'Группа'),
            'order_id' => \Yii::t('app', 'Порядковый номер'),
        ];
    }
}