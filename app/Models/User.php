<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Helpers\Template;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str; 
use Tymon\JWTAuth\Contracts\JWTSubject;
class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    protected $table = 'users';
    protected $crudNotAccepted = ['_token'];
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'status', 'level', 'last_login'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function listItems($params = null, $options = null)
    {
        $result = null;
        $query = self::select('id', 'name', 'email', 'status', 'level', 'created_at', 'updated_at', 'last_login');

        // filter by status
        if ($params['filter']['status'] !== "all")  {
            $query->where('status', $params['filter']['status']);
        }

        // filter by level
        if ($params['filter']['level'] !== "default")  {
            $query->where('level', $params['filter']['level']);
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
            $params['password']     = Hash::make($params['password']);
            $params['created_at']   = now();
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
    }

    public function prepareParams($params)
    {
        return array_diff_key($params, array_flip($this->crudNotAccepted));
    }
}
