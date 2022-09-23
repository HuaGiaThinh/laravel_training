<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post as MainModel;
use Illuminate\Http\Request;
use App\Events\viewPostDetail;
use App\Models\Voucher;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    private $pathViewController = 'frontend.pages.post.';

    public function __construct()
    {
        $this->model = new MainModel();
    }

    public function index(Request $request)
    {
        $params['id'] = $request->id;
        $itemPost = $this->model->getItem($params, ['task' => 'fe-get-item']);

        if (empty($itemPost))  return redirect()->route('home');

        // event
        viewPostDetail::dispatch($itemPost);

        return view($this->pathViewController . 'index', compact('itemPost'));
    }

    public function generateVoucherCode(Request $request)
    {
        DB::beginTransaction();
        try {
            $post = $this->model::findOrFail($request->id);
            $hasVoucher = $this->checkHasVoucher($post->id);

            if (!empty($hasVoucher)) return response()->json(['type' => 'old_code', 'data' => $hasVoucher->code]);

            if ($post->voucher_enabled && $post->voucher_quantity > 0) {
                $post->voucher_quantity--;
                $post->save();

                $voucherCode = Str::random(20);
                $this->insertVoucherCode($voucherCode, $post->id);

                DB::commit();
                return response()->json(['type' => 'new_code', 'data' => $voucherCode]);
            }

            return response()->json(['type' => 'error', 'data' => config('myConfig.notify_FE.voucher.not-available')]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['type' => 'error', 'data' => config('myConfig.notify_FE.error')]);
        }
    }

    public function checkHasVoucher($postID)
    {
        return Voucher::where('post_id', $postID)->where('user_id', Auth::id())->first();
    }

    public function insertVoucherCode($voucherCode, $postID)
    {
        Voucher::create([
            'code'      => $voucherCode,
            'post_id'   => $postID,
            'user_id'   => Auth::id(),
        ]);
    }
}
