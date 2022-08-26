<?php

namespace App\Helpers;

class Template {
    public static function showItemStatus($item, $routeName)
    {
        $activeClass = 'btn-success';
        $activeIcon = 'fa-check';

        if ($item['status'] == 'inactive') {
            $activeClass = 'btn-danger';
            $activeIcon = 'fa-minus';
        }

        $dataURL = route("$routeName.changeStatus", ['status' => $item['status'], 'id' => $item['id']]);
        return sprintf('
            <a id="status-%s" href="%s" class="btn %s rounded-circle btn-sm btn-ajax-status">
                <i class="fas %s"></i>
            </a>', $item['id'], $dataURL, $activeClass, $activeIcon);
    }

    public static function showItemHistory($by, $time)
    {
        return sprintf('
            <p class="mb-0"><i class="far fa-user"></i> %s</p>
            <p class="mb-0"><i class="far fa-clock"></i> %s</p>', 
            $by, date(config('myConfig.format.short_time'), strtotime($time))
        );
    }

    public static function showButtonAction($controllerName, $id, $routeName)
    {
        $tmplButton   = config('myConfig.template.button');
        $buttonInArea = config('myConfig.config.button');

        $controllerName = (array_key_exists($controllerName, $buttonInArea)) ? $controllerName : "default";
        $listButtons    = $buttonInArea[$controllerName]; // ['edit', 'delete']

        $xhtml = '';
        foreach ($listButtons as $btn) {
            $currentButton = $tmplButton[$btn];

            $link = route($routeName . $currentButton['route-name'], ['id' => $id]);
            $xhtml .= sprintf(
                '<a href="%s" class="btn %s rounded-circle btn-sm">
                    <i class="fa %s"></i>
                </a> ',
                $link,
                $currentButton['class'],
                $currentButton['icon']
            );
        }

        return $xhtml;
    }

    public static function showButtonFilter($routeName, $itemsStatusCount, $currentFilterStatus, $paramsSearch = null)
    {
        $xhtml = null;

        if (count($itemsStatusCount) > 0) {
            foreach ($itemsStatusCount as $item) {
                $statusValue = $item['status'];

                $link = route($routeName) . "?filter_status=" .  $statusValue;

                $class  = ($currentFilterStatus == $statusValue) ? 'btn-info' : 'btn-secondary';

                $xhtml  .= sprintf('
                    <a href="%s" class="btn %s">%s 
                        <span class="badge badge-pill badge-light">%s</span>
                    </a>', $link, $class, ucfirst($statusValue), $item['count']);
            }
        }
        return $xhtml;
    }

    public static function showCategoriesInSelectBox($categories, $item, $routeName)
    {
        $dataURL = route("$routeName.changeSelectBox", ['category_id' => 'value_new', 'id' => $item->id]);
        $xhtml = '<select class="form-control changeSelectBox-ajax" data-url="'.$dataURL.'">';
        foreach ($categories as $key => $value) {
            $selected = ($item->category_id == $key) ? 'selected' : '';
            $xhtml .= sprintf('<option value="%s" %s>%s</option>', $key, $selected, $value);
        }
        $xhtml .= '</select>';
        return $xhtml;
    }
}
