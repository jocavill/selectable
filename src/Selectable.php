<?php namespace Paddons;

trait Selectable
{
    /**
     * @param mixed $empty_item. Set to false for none
     * @param array $excludes
     * @param null $collection
     * @return array
     */
    public static function get_selection($empty_item = 'Please select', $excludes = [], $collection = null)
    {
        $model = new self();

        $primaryKey = $model->primaryKey;
        $label_field = $model->labelField ?: 'name';
        $selection = [];
        $records = $collection !== null ? $collection : $model->all();

        if ($empty_item) {
            if (is_array($empty_item)) {
                $selection[key($empty_item)] = current($empty_item);
            } else {
                $selection[0] = $empty_item;
            }
        }

        foreach ($records as $record) {
            if(in_array($record->$primaryKey, $excludes)) continue;
            $selection[$record->$primaryKey] = $record->$label_field;
        }

        return $selection;
    }
}
