<?php
use Cocur\Slugify\Slugify;

class SlugifyExtension extends DataExtension
{
    /**
     * Database fields
     * @var array
     */
    private static $db = [
        'Slug'      =>  'Varchar(128)'
    ];

    /**
     * Update Fields
     * @return FieldList
     */
    public function updateCMSFields(FieldList $fields)
    {
        $owner                      =   $this->owner;
        $slug_field                 =   $fields->fieldByName('Root.Main.Slug');
        $slug_field                 =   $slug_field->performReadonlyTransformation();

        $fields->replaceField('Slug', $slug_field);

        return $fields;
    }

    /**
     * Event handler called before writing to the database.
     */
    public function onBeforeWrite()
    {
        parent::onBeforeWrite();

        if ($this->owner->hasField('Title')) {
            $slugify                =   new Slugify();
            $this->owner->Slug      =   $slugify->slugify($this->owner->Title);
        }
    }
}
