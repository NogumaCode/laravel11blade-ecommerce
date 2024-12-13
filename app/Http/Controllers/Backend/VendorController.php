<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    /**
     * 管理者ログインビューを表示
     */
    public function login()
    {
        // すでにログイン済みの場合、ダッシュボードへリダイレクト
        if (Auth::guard('vendor')->check()) {
            return redirect()->route('vendor.dashboard');
        }

        return view('auth.vendor-login'); // 管理者ログイン用ビュー
    }

    /**
     * 管理者ログイン処理
     */
    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);
        $credentials = $request->only('email', 'password');

        if (Auth::guard('vendor')->attempt($credentials, $request->filled('remember'))) {
            // セッションを再生成してセッション固定攻撃を防止
            $request->session()->regenerate();
            return redirect()->intended(route('vendor.dashboard'));
        }

        // 認証失敗時のエラーを返す
        return back()->withErrors([
            'email' => __('auth.failed'), // 設定ファイルや翻訳ファイルを使用
        ])->onlyInput('email'); // 入力内容を保持
    }

    /**
     * 管理者ダッシュボードの表示
     */
    public function dashboard()
    {
        return view('vendor.dashboard'); // 管理者用ダッシュボードビュー
    }

    /**
     * 管理者ログアウト処理
     */
    public function logout(Request $request)
    {
        // ログアウト処理
        Auth::guard('vendor')->logout();

        // セッションを無効化し、CSRFトークンを再生成
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // ログインページへリダイレクト
        return redirect()->route('vendor.login');
    }
}
