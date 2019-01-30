<?php
use SaltedHerring\Debugger;
/**
 * Description
 *
 * @package silverstripe
 * @subpackage mysite
 */
class Cider extends DataObject
{
    /**
     * Database fields
     * @var array
     */
    private static $db = [
        'Title'             =>  'Text',
        'Promoted'          =>  'Boolean',
        'Content'           =>  'HTMLText',
        'ReserveRange'      =>  'Boolean',
        'Subtitle'          =>  'Varchar(128)',
        'See'               =>  'Varchar(128)',
        'Smell'             =>  'Varchar(128)',
        'Taste'             =>  'Varchar(128)',
        'TryMeWith'         =>  'Varchar(128)',
        'Dryness'           =>  'Decimal',
        'Tannin'            =>  'Decimal',
        'Alchohol'          =>  'Decimal',
        'SoldOut'           =>  'Boolean',
        'Availabilities'    =>  'Varchar(16)',
        'CiderColour'       =>  'Varchar(16)',
        'ProductStyle'      =>  'Varchar(100)',
        'ProudctVintage'    =>  'Varchar(16)'
    ];

    /**
     * Has_one relationship
     * @var array
     */
    private static $has_one = [
        'TitleImage'        =>  'Image',
        'ProductImage'      =>  'Image',
        'ProductSignature'  =>  'Image',
        'Page'              =>  'Ciders'
    ];

    /**
     * Defines extension names and parameters to be applied
     * to this object upon construction.
     * @var array
     */
    private static $extensions = [
        'SortOrderExtension',
        'SlugifyExtension'
    ];

    /**
     * Many_many relationship
     * @var array
     */
    private static $many_many = [
        'Xs'                =>  'Image'
    ];

    /**
     * CMS Fields
     * @return FieldList
     */
    public function getCMSFields()
    {
        Requirements::javascript('mainsite/js/cms.js');
        $fields         =   parent::getCMSFields();
        $SoldOut        =   $fields->fieldByName('Root.Main.SoldOut');
        $isReserved     =   $fields->fieldByName('Root.Main.ReserveRange');

        $fields->fieldByName('Root.Main.Promoted')->setDescription('Promoted ciders get displayed on the homepage, right under the carousel, in a row');

        $fields->addFieldsToTab(
            'Root.Main',
            [
                $isReserved,
                $SoldOut
            ],
            'Title'
        );

        $fields->addFieldToTab(
            'Root.Main',
            $fields->fieldByName('Root.Main.Subtitle'),
            'Content'
        );

        $fields->removeByName([
            'CiderColour'
        ]);

        $availability   =   CheckboxSetField::create(
                                'Availabilities',
                                "Availabilities",
                                [
                                    "Keg"   =>  "Keg",
                                    "500ML" =>  "500ML",
                                    "330ML" =>  "330ML"
                                ]
                            );
        $fields->replaceField('Availabilities', $availability);

        $fields->addFieldsToTab(
            'Root.ProductDetails',
            [
                $fields->fieldByName('Root.Main.See'),
                $fields->fieldByName('Root.Main.Smell'),
                $fields->fieldByName('Root.Main.Taste'),
                $fields->fieldByName('Root.Main.TryMeWith'),
                $fields->fieldByName('Root.Main.Dryness'),
                $fields->fieldByName('Root.Main.Tannin'),
                $fields->fieldByName('Root.Main.Alchohol'),
                $fields->fieldByName('Root.Main.Availabilities'),
                DropdownField::create(
                    'CiderColour',
                    'Cider colour',
                    $this->config()->colours
                )->setEmptyString('- select one -'),
                $fields->fieldByName('Root.Main.ProductStyle'),
                $fields->fieldByName('Root.Main.ProudctVintage')
            ]
        );

        $fields->addFieldsToTab(
            'Root.Graphics',
            [
                $fields->fieldByName('Root.Main.TitleImage'),
                $fields->fieldByName('Root.Main.ProductImage'),
                $fields->fieldByName('Root.Main.ProductSignature'),
                UploadField::create(
                    'Xs',
                    'Cross images'
                )
            ]
        );

        if ($this->exists()) {
            $fields->removeByName([
                'Xs'
            ]);

            $fields->addFieldsToTab(
                'Root.Graphics',
                [
                    UploadField::create(
                        'Xs',
                        'Cross images'
                    )
                ]
            );
        }

        return $fields;
    }

    public function getData()
    {
        $Xs                             =   null;

        if ($this->Xs()->exists()) {
            $Xs                         =   [];
            $xings                      =   $this->Xs();
            foreach ($xings as $xing)
            {
                $Xs[]                   =   [
                                                'url'       =>  $xing->URL
                                            ];
            }
        }

        return  [
                    'id'                =>  $this->ID,
                    'title'             =>  str_replace("\n", '<br>', $this->Title),
                    'subtitle'          =>  $this->Subtitle,
                    'content'           =>  $this->Content,
                    'see'               =>  $this->See,
                    'smell'             =>  $this->Smell,
                    'taste'             =>  $this->Taste,
                    'trymewith'         =>  $this->TryMeWith,
                    'dryness'           =>  $this->Dryness,
                    'tannin'            =>  $this->Tannin,
                    'alchohol'          =>  $this->Alchohol,
                    'soldout'           =>  $this->SoldOut,
                    'availabilities'    =>  $this->Availabilities,
                    'colour'            =>  $this->CiderColour,
                    'productstyle'      =>  $this->ProductStyle,
                    'proudctvintage'    =>  $this->ProudctVintage,
                    'is_reserved'       =>  $this->ReserveRange,
                    'title_image'       =>  $this->TitleImage()->exists() ? $this->TitleImage()->SetWidth(960)->URL : null,
                    'product_image'     =>  $this->ProductImage()->exists() ? $this->ProductImage()->SetWidth(620)->URL : null,
                    'product_signature' =>  $this->ProductSignature()->exists() ? $this->ProductSignature()->SetWidth(620)->URL : null,
                    'x_icons'           =>  $Xs
                ];
    }

    public function Labels($label)
    {
        $labels     =   $this->config()->labels;
        $labels     =   $labels[Controller::curr()->Locale];
        // Debugger::inspect($labels[Session::get('lang')]);
        return $labels[$label];
    }

    public function myAvailabilities()
    {
        $avail      =   explode(',', $this->Availabilities);
        foreach ($avail as &$item)
        {
            $item   =   [
                            'Title' =>  $item
                        ];
        }
        return ArrayList::create($avail);
    }

    public function Crosses($property)
    {
        $array          =   [];
        for ($i = 0; $i < 5; $i++)
        {
            $array[]    =   null;
        }

        for ($n = 0; $n < (int) $this->$property; $n++)
        {
            $array[$n]  =   [
                                'X'     =>  $this->Xs()->first()
                            ];
        }

        return ArrayList::create($array);
    }
}
