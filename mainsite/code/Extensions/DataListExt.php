<?php

class DataListExt extends Extension
{
    public function getData()
    {
        $list           =   $this->owner;
        $data           =   [];

        foreach ($list as $item)
        {
            if ($item->hasMethod('getData')) {
                $data[] =   $item->getData();
            }
        }

        return !empty($data) ? $data : $list->column();
    }
}
