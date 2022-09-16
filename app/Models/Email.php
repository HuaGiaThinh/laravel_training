<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\Template;
use Illuminate\Support\Facades\DB;

class Email extends Model
{
    public $table = 'emails';
    protected $fillable = ['email'];
    protected $crudNotAccepted  = ['_token'];

    public function listItems($params = null, $options = null)
    {
        $result = null;
        $query = self::latest('id');

        // filter by status
        if ($params['filter']['status'] !== "all") {
            $query->where('status', $params['filter']['status']);
        }

        $result = $query->paginate($params['pagination']['totalItemsPerPage']);
        return $result;
    }

    public function getItem($id = null, $options = null)
    {
        return self::find($id);
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
            // self::create($params);
            self::create($this->prepareParams($params));
        }

        if ($options['task'] == 'edit-item') {
            self::where('id', $params['id'])->update($this->prepareParams($params));
        }
    }

    public function deleteItem($id, $options = null)
    {
        self::where('id', $id)->delete();
    }

    public function prepareParams($params)
    {
        return array_diff_key($params, array_flip($this->crudNotAccepted));
    }
}
