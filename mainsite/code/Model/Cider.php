<?php

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
        'Title'             =>  'Varchar(32)',
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
        'CiderColour'       =>  'Varchar(7)',
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
        'SortOrderExtension'
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
        $fields         =   parent::getCMSFields();
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
                $fields->fieldByName('Root.Main.SoldOut'),
                $fields->fieldByName('Root.Main.Availabilities'),
                $fields->fieldByName('Root.Main.CiderColour'),
                $fields->fieldByName('Root.Main.ProductStyle'),
                $fields->fieldByName('Root.Main.ProudctVintage')
            ]
        );

        if ($this->exists()) {
            $fields->removeByName([
                'Xs'
            ]);
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
                    'title'             =>  $this->Title,
                    'see'               =>  $this->See,
                    'smell'             =>  $this->Smell,
                    'taste'             =>  $this->Taste,
                    'trymewith'         =>  $this->TryMeWith,
                    'dryness'           =>  $this->Dryness,
                    'tannin'            =>  $this->Tannin,
                    'alchohol'          =>  $this->Alchohol,
                    'soldout'           =>  $this->SoldOut,
                    'availabilities'    =>  $this->Availabilities,
                    'cidercolour'       =>  $this->CiderColour,
                    'productstyle'      =>  $this->ProductStyle,
                    'proudctvintage'    =>  $this->ProudctVintage,
                    'title_image'       =>  $this->TitleImage()->exists() ? $this->TitleImage()->SetWidth(300)->URL : null,
                    'product_image'     =>  $this->ProductImage()->exists() ? $this->ProductImage()->SetWidth(620)->URL : null,
                    'product_signature' =>  $this->ProductSignature()->exists() ? $this->ProductSignature()->SetWidth(620)->URL : null,
                    'x_icons'           =>  $Xs
                ];
    }
}
