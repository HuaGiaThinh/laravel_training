<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Helpers\Template;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class Event extends Model
{
    use HasFactory;
    // public $table = 'events';

    protected $crudNotAccepted  = ['_token', 'thumb_current'];

    public function listItems($params = null, $options = null)
    {

        $result = null;
        $query = self::select('id', 'name', 'user_is_editing', 'editable');

        $result = $query->latest('id')->paginate($params['pagination']['totalItemsPerPage']);
        return $result;
    }

    public function getItem($params = null, $options = null)
    {
        $result = null;
        if ($options['task'] == 'admin-get-item') {
            $result = self::find($params['id']);
        }
        
        if ($options['task'] == 'fe-get-item') {
            $result = self::with('category')->where('status', 'active')->find($params['id']);
        }
        return $result;
    }

    public function countItemsStatus($params = null, $options  = null)
    {
        $query = $this::groupBy('status')
            ->select(DB::raw('status , COUNT(id) as count'));
        $result = $query->get()->toArray();

        array_unshift($result, [
            'status'  => 'all',
            'count'   => array_sum(array_column($result, 'count'))
        ]);

        return $result;
    }

    public function saveItem($params, $options = null)
    {
        if ($options['task'] == 'add-item') {
            self::insert($this->prepareParams($params));
        }

        if ($options['task'] == 'edit-item') {
            self::where('id', $params['id'])->update($this->prepareParams($params));
        }
    }

    public function deleteItem($id, $options = null)
    {
        $thumbName = self::find($id)->thumb;
        $this->deleteThumb($thumbName);
        self::where('id', $id)->delete();
    }

    public function handleAjax($params = null, $options = null)
    {
        if ($options['task'] == 'change-status') {
            $params['status'] = ($params['status'] == 'active') ? 'inactive' : 'active';
            self::where('id', $params['id'])->update($this->prepareParams($params));
            return Template::showItemStatus($params, $this->table);
        }

        if ($options['task'] == 'change-selectBox') {
            self::where('id', $params['id'])->update($this->prepareParams($params));
        }

        if ($options['task'] == 'change-voucher-enabled') {
            $params['voucher_enabled'] = ($params['voucher_enabled'] == 0) ? 1 : 0;
            self::where('id', $params['id'])->update($this->prepareParams($params));
            return Template::showItemVoucherEnabled($params, $this->table);
        }

        if ($options['task'] == 'change-voucher-quantity') {
            self::where('id', $params['id'])->update($this->prepareParams($params));
        }
    }
    // note: $this->prepareParams($params) có thể nên tạo scope

    public function prepareParams($params)
    {
        return array_diff_key($params, array_flip($this->crudNotAccepted));
    }
}
