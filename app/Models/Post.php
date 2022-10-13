<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use App\Helpers\Template;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class Post extends Model
{
    use HasFactory, Notifiable;
    public $table = 'posts';
    protected $fillable = [
        'name', 'description', 'thumb', 'status', 'voucher_enabled', 'voucher_quantity'
    ];
    protected $crudNotAccepted  = ['_token', 'thumb_current'];
    protected $folderUpload     = 'posts';

    // Relationship
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function listItems($params = null, $options = null)
    {
        $result = null;
        $query  = self::with('categories')->select('id', 'name', 'description', 'status', 'thumb', 'voucher_enabled', 'voucher_quantity');

        // filter by status
        if ($params['filter']['status'] !== "all") {
            $query->where('status', $params['filter']['status']);
        }

        $result = $query->latest('id')->paginate($params['pagination']['totalItemsPerPage']);
        return $result;
    }

    public function filterByCategory($params)
    {
        return Category::with('posts')->find($params['filter']['category'])->posts;
    }

    public function getItem($params = null, $options = null)
    {
        $result = null;
        if ($options['task'] == 'admin-get-item') {
            $result = self::find($params['id']);
        }

        if ($options['task'] == 'fe-get-item') {
            $result = self::with('categories')->where('status', 'active')->find($params['id']);
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
            $params['thumb'] = $this->uploadThumb($params['thumb']);

            $category_id = $params['category_id'];
            unset($params['category_id']);

            $post = self::create($this->prepareParams($params));
            $post->categories()->attach($category_id);
        }

        if ($options['task'] == 'edit-item') {
            if (!empty($params['thumb'])) {
                // Delete old thumbnail
                $this->deleteThumb($params['thumb_current']);

                // Upload new thumbnail
                $params['thumb'] = $this->uploadThumb($params['thumb']);
            }
            $category_id = $params['category_id'];
            unset($params['category_id']);

            self::where('id', $params['id'])->update($this->prepareParams($params));

            $post = self::find($params['id']);
            $post->categories()->attach($category_id);
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

    public function prepareParams($params)
    {
        return array_diff_key($params, array_flip($this->crudNotAccepted));
    }

    public function uploadThumb($thumbObj)
    {
        $thumbName = Str::random(10) . '.' . $thumbObj->clientExtension();
        $thumbObj->storeAs($this->folderUpload, $thumbName, 'my_storage_image');
        return $thumbName;
    }

    public function deleteThumb($thumbName)
    {
        Storage::disk('my_storage_image')->delete($this->folderUpload . '/' . $thumbName);
    }
}
