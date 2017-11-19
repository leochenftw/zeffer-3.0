<?php
use SaltedHerring\Debugger;
class ControllerAjaxExtension extends DataExtension
{
    public function index()
    {
        $request    =   $this->owner->request;

        if ($request->isAjax()) {
            $header =   $this->owner->getResponse();
            $header->addHeader('Content-Type', 'application/json');
            // $header->addHeader('Cache-Control', 'no-transform, public, max-age=300, s-maxage=900');

            return json_encode($this->owner->AjaxResponse());
        }

        return $this->owner->renderWith([$this->owner->ClassName, 'AjaxPage']);
    }

    public function AjaxResponse()
    {
        $nav                    =   [];
        $navigation             =   $this->owner->getMenu(1);
        foreach ($navigation as $nav_item)
        {
            $nav[]              =   [
                                        'title'     =>  $nav_item->MenuTitle,
                                        'url'       =>  $nav_item->Link(),
                                        'is_active' =>  $nav_item->LinkOrCurrent() == 'current'
                                    ];
        }

        return  [
                    'id'            =>  $this->owner->ID,
                    'url'           =>  $this->owner->Link() == '/home/' ? '/' : $this->owner->Link(),
                    'title'         =>  $this->owner->Title,
                    'content'       =>  $this->owner->Content,
                    'navigation'    =>  $nav
                ];
    }
}
