<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Helpers\Template;
use Illuminate\Support\Facades\Hash;
use DB;
class PostModel extends Model
{
    use HasFactory;
    public $table = 'posts';

    public function __construct()
    {
        $this->crudNotAccepted = ['_token'];
    }

    public function listItems($params = null, $options = null)
    {
        
        $result = null;
        $query = self::select('id', 'name', 'description', 'status', 'category_id', 'created_at', 'updated_at');

        if ($params['filter']['status'] !== "all")  {
            $query->where('status', $params['filter']['status']);
        }

        $result = $query->latest('id')->paginate($params['pagination']['totalItemsPerPage']);
        return $result;
    }

    public function getItem($params = null, $options = null)
    {
        $result = null;
        $result = self::find($params['id']);
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
    }
    // note: $this->prepareParams($params) có thể nên tạo scope

    public function prepareParams($params)
    {
        return array_diff_key($params, array_flip($this->crudNotAccepted));
    }
}
