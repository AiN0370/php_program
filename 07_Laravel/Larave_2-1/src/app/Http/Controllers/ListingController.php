<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Listing;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    // トップ画面（全てのメモ）を表示
    public function index() {
        return view('listings.index', [
            'listings' => Listing::latest()->filter(request(['userId']))->simplepaginate(5),
            'users' => User::all()
        ]);
    }
    // １つのメモを表示
    public function show(Listing $listing) {
        return view('listings.show', [
            'listing' => $listing
        ]);
    }

    // メモの投稿画面を表示
    public function create() {
        return view('listings.create');
    }
 
    // 投稿されたデータを保存
    public function store(Request $request) {
        $formFields = $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);

        $formFields['user_id'] = auth()->id();

        Listing::create($formFields);

        return redirect('/')->with('message', 'メモを投稿しました！');
    }

    // 
    public function edit(Listing $listing) {
        return view('listings.edit', ['listing' => $listing]);
    }

    // メモを編集する画面を表示
    public function update(Request $request, Listing $listing) {
        if($listing->user_id != auth()->id()) {
            abort(403, 'この操作は認められていません');
        }

        $formFields = $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);

        $listing->update($formFields);

        return redirect('/')->with('message', 'メモが編集されました!');
    }

    // メモを削除する
    public function destroy(Listing $listing) {
        if($listing->user_id != auth()->id()) {
            abort(403, 'この操作は認められていません');
        }
        $listing->delete();
        return redirect('/')->with('message', 'メモが削除されました');
    }
}

