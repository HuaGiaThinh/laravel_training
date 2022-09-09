<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Helpers\Template;
use DB;
use Kalnoy\Nestedset\NodeTrait;

class Category extends Model
{
    use HasFactory;
    use NodeTrait;
    
    protected $fillable = ['name', 'status'];
    protected $table = 'categories';
    protected $crudNotAccepted = ['_token'];

    // Accessor 
    public function getNameWithDepthAttribute()
    {
        return str_repeat('|----- ', $this->depth) . " {$this->name}";
    }

    public function getNameWithDepthNoRootAttribute()
    {
        if ($this->id == 1) return false;

        return str_repeat('|----- ', $this->depth - 1) . " {$this->name}";
    }

    // relationship
    public function posts()
    {
        return $this->hasMany(Post::class);
    }


    public function listItems($params = null, $options = null)
    {
        $result = null;
        if ($options['task'] == 'admin-list-items') {
            $result = self::withDepth()->defaultOrder()->having('depth', '>', 0)
                    ->get()->toTree();
        }

        if ($options['task'] == 'admin-list-categories-in-selectbox') {
            $query = self::withDepth()->defaultOrder();

            if (isset($params['id'])) {
                $item = self::find($params['id']);

                $query->where('_lft', '<', $item->_lft)
                ->orWhere('_rgt', '>', $item->_rgt);
            }
            $result = $query->get();
        }
        
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
            $parent = self::find($params['parent_id']);
            $parent->children()->create($this->prepareParams($params));
        }

        if ($options['task'] == 'edit-item') {
            $parent = self::find($params['parent_id']);
            $node   = self::find($params['id']);

            $node->update($this->prepareParams($params));
            if ($node->parent_id != $params['parent_id']) $node->prependToNode($parent)->save();
        }
    }

    public function handleAjax($params = null, $options = null)
    {
        if ($options['task'] == 'change-status') {
            $params['status'] = ($params['status'] == 'active') ? 'inactive' : 'active';
            self::where('id', $params['id'])->update($this->prepareParams($params));
            return Template::showItemStatus($params, $this->table);
        }
    }

    public function deleteItem($params = null, $options = null)
    {
        if ($options['task'] == 'delete-item') {
            self::where('id', $params['id'])->delete();
        }

        if ($options['task'] == 'delete-nodes') {
            $node = self::find($params['id']);
            $node->delete();
        }
    }

    // note: $this->prepareParams($params) có thể nên tạo scope

    public function prepareParams($params)
    {
        return array_diff_key($params, array_flip($this->crudNotAccepted));
    }
}
