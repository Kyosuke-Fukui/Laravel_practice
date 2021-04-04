<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request; //HTTPリクエストを扱うための様々なメソッドを使えるようにする設定


//使うClassを宣言:自分で追加
use App\Models\Book; //Eloquentモデル（Book.php）を参照する設定（BooksController内で使用するため）
use Validator; //BooksController内で使用するため


class BooksController extends Controller
{

    // コンストラクタ（最初に必ず実行される関数）
    public function __construct() 
    {
        $this->middleware('auth');
    }



    //一覧表示
    public function index() {
    $books = Book::orderBy('created_at','asc')->paginate(3);
    //本の一覧表示(books.blade.php)を読み込む
    return view('books',[
        'books' => $books
    ]); 
}
    
    
    //登録
    public function register(Request $request){
        //バリデーション
        $validator = Validator::make($request->all(), [
                // 必須かつ3文字以上255文字以下
                'item_name' => 'required|min:3|max:255',
                'item_number' => 'required',
                'item_amount' => 'required|max:6',
                'published' => 'required',

        ]);
        //バリデーション:エラー
        if ($validator->fails()) {
                return redirect('/')
                    ->withInput()
                    ->withErrors($validator);
                    //$errorsを返す
        }
        
        // Eloquent モデル
        $books = new Book;
        $books->item_name = $request->item_name;
        $books->item_number = $request->item_number;
        $books->item_amount = $request->item_amount;
        $books->published = $request->published;
        $books->save(); 
        return redirect('/'); //「/」ルートにリダイレクト
    }

    //更新画面に遷移
    public function edit(Book $books) {
    //{books}id 値を取得 => Book $books id 値の1レコード取得
    return view('booksedit', ['book' => $books]);
    }

    //更新処理
    public function update(Request $request){
        //バリデーション
        $validator = Validator::make($request->all(), [
                // 必須かつ3文字以上255文字以下
                'id' => 'required',
                'item_name' => 'required|min:3|max:255',
                'item_number' => 'required',
                'item_amount' => 'required|max:6',
                'published' => 'required',

        ]);
        //バリデーション:エラー
        if ($validator->fails()) {
                return redirect('/')
                    ->withInput()
                    ->withErrors($validator);
                    //$errorsを返す
        }
        
        // Eloquent モデル
        $books = Book::find($request->id);
        $books->item_name = $request->item_name;
        $books->item_number = $request->item_number;
        $books->item_amount = $request->item_amount;
        $books->published = $request->published;
        $books->save(); 
        return redirect('/'); //「/」ルートにリダイレクト
    }
    //削除処理
    public function delete(Book $book){
        $book->delete();
        return redirect('/'); //「/」ルートにリダイレクト
    }
}




