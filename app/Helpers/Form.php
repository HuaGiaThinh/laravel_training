<?php

namespace App\Helpers;

class Form
{
    public static function show($elements)
    {
        $xhtml = null;
        foreach ($elements as $element) {
            $xhtml .= self::formGroup($element);
        }
        return $xhtml;
    }

    public static function formGroup($element, $params = null)
    {
        $type = isset($element['type']) ? $element['type'] : "input";
        $xhtml = null;

        switch ($type) {
            case 'input':
                $xhtml .= sprintf(
                    '<div class="form-group">%s %s</div>',
                    $element['label'],
                    $element['element']
                );
                break;
            case 'btn-submit':
                $xhtml .= sprintf(
                    '<div class="ln_solid"></div>
                    <div class="form-group">%s</div>',
                    $element['element']
                );
                break;
            case 'thumb':
                $xhtml .= sprintf(
                    '<div class="form-group">
                            %s %s
                            <div style="margin-top: 20px;">%s</div>
                        </div>',
                    $element['label'],
                    $element['element'],
                    $element['thumb']
                );
                break;
        }
        return $xhtml;
    }
}
