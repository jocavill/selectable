<?php namespace Paddons;

trait Selectable
{
    public static function get_selection($empty_item_text = 'Please select', $excludes = [], $collection = null)
    {
        $model = new self();

        $primaryKey = $model->primaryKey;
        $label_field = $model->labelField ?: 'name';
        $selection = [];
        $records = $collection ?: $model->all();

        if ($empty_item_text) $selection[0] = $empty_item_text;

        foreach ($records as $record) {
            if(in_array($record->$primaryKey, $excludes)) continue;
            $selection[$record->$primaryKey] = $record->$label_field;
        }

        return $selection;
    }
}
