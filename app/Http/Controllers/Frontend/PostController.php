<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post as MainModel;
use Illuminate\Http\Request;
use App\Events\viewPostDetail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    private $pathViewController = 'frontend.pages.post.'; 

    public function __construct()
    {
        $this->model = new MainModel();
    }

    public function index(Request $request)
    {
        $params['post_id'] = $request->post_id;
        $itemPost = $this->model->getItem($params, ['task' => 'fe-get-item']);
        
        if(empty($itemPost))  return redirect()->route('home');
        
        // event
        viewPostDetail::dispatch($itemPost);

        return view($this->pathViewController . 'index', compact('itemPost'));
    }

    public function generateVoucherCode(Request $request)
    {
        DB::beginTransaction();
        try {
            $post = $this->model::findOrFail($request->id);
            if ($post->voucher_enabled && $post->voucher_quantity > 0) {
                $post->voucher_quantity--;
                $post->save();

                DB::commit();
                return Str::random(20);
            }

            return 'There is no more available voucher';
        } catch (\Exception $e) {
            DB::rollBack();
            return 'Something went wrong!!! Please, try again';
        }   
    }
}
?>
