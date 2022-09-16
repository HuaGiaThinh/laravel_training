<?php

namespace App\Helpers;

class Template
{
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
        $byXhtml = '';
        if (!empty($by)) {
            $byXhtml = '<p class="mb-0"><i class="far fa-user"></i> ' . $by . '</p>';
        }
        return sprintf(
            '
            %s
            <p class="mb-0"><i class="far fa-clock"></i> %s</p>',
            $byXhtml,
            date(config('myConfig.format.short_time'), strtotime($time))
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
        $xhtml = '<select class="form-control changeSelectBox-ajax" data-url="' . $dataURL . '">';
        foreach ($categories as $key => $value) {
            $selected = ($item->category_id == $key) ? 'selected' : '';
            $xhtml .= sprintf('<option value="%s" %s>%s</option>', $key, $selected, $value);
        }
        $xhtml .= '</select>';
        return $xhtml;
    }

    public static function showItemThumb($controllerName, $thumbName, $thumbAlt)
    {
        $xhtml = sprintf(
            '<img src="%s" alt="%s" style="max-height:80px;max-width: 80px">',
            asset("images/$controllerName/$thumbName"),
            $thumbAlt
        );
        return $xhtml;
    }

    public static function showContent($content, $length, $prefix = '...')
    {
        $prefix = ($length == 0) ? '' : $prefix;
        $content = str_replace(['<p>', '</p>'], '', $content);
        if (strlen($content) <= $length) return $content;
        return preg_replace('/\s+?(\S+)?$/', '', substr($content, 0, $length)) . $prefix;
    }

    public static function showItemVoucherEnabled($item, $routeName)
    {
        $activeClass = 'btn-success';
        $activeIcon = 'fa-check';

        if ($item['voucher_enabled'] == 0) {
            $activeClass = 'btn-danger';
            $activeIcon = 'fa-minus';
        }

        $dataURL = route("$routeName.changeVoucherEnabled", ['voucher_enabled' => $item['voucher_enabled'], 'id' => $item['id']]);
        return sprintf('
            <a id="status-%s" href="%s" class="btn %s rounded-circle btn-sm btn-ajax-status">
                <i class="fas %s"></i>
            </a>', $item['id'], $dataURL, $activeClass, $activeIcon);
    }

    public static function showItemVoucherQuantity($item, $routeName)
    {
        $dataURL = route("$routeName.changeVoucherQuantity", ['quantity' => 'value_new', 'id' => $item['id']]);
        return sprintf('<input type="number" value="%s" data-url="%s" class="form-control text-center ajax-voucher-quantity">', $item['voucher_quantity'], $dataURL);
    }

    public static function showEmailStatus($status)
    {
        $color = config('myConfig.template.email_status');

        return sprintf('<span class="btn %s btn-sm" style="width: 76px"><b>%s</b></span>', $color[$status], $status);
    }
}
