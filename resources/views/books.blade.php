<!-- resources/views/books.blade.php -->
<!-- 親テンプレート読み込み -->
@extends('layouts.app') 

@section('content')
    
    
    <div class="panel-body">
        <!-- バリデーションエラーの表示に使用-->
        @include('common.errors')
        <!-- バリデーションエラーの表示に使用-->
        
        <!-- 本登録フォーム -->
        <!-- urlはヘルパー関数（自身のアドレスを追加） -->
        <form action="{{ url('books') }}" method="POST" class="form-horizontal">
            <!-- セキュリティ強化のため -->
            {{ csrf_field() }}
            
            <!-- 本のタイトル -->
            <div class="form-group">
                <label for="book" class="col-sm-3 control-label">Book</label>
                
                <div class="col-sm-6">
                    <input type="text" name="item_name" id="book-name"class="form-control">
                </div>
            </div>

            <!-- 冊数 -->
            <div class="form-group">
                <label for="number" class="col-sm-3 control-label">Number</label>
                
                <div class="col-sm-6">
                    <input type="number" name="item_number" id="book-number"class="form-control">
                </div>
            </div>

            <!-- 金額 -->
            <div class="form-group">
                <label for="number" class="col-sm-3 control-label">Amount</label>
                
                <div class="col-sm-6">
                    <input type="text" name="item_amount" id="book-amount"class="form-control">
                </div>
            </div>

            <!-- 発行日 -->
            <div class="form-group">
                <label for="number" class="col-sm-3 control-label">Published</label>
                
                <div class="col-sm-6">
                    <input type="date" name="published" id="published"class="form-control">
                </div>
            </div>
            
            <!-- 本登録ボタン -->
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-default">
                        <i class="glyphicon glyphicon-plus"></i> Save
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Book: 既に登録されてる本のリスト -->
    @if (count($books) > 0)
    <div class="panel panel-default">
        <div class="panel-heading"> 
        </div>
        <div class="panel-body">
        <table class="table table-striped task-table">
            <!-- テーブルヘッダ -->
            <thead>
                <th>タイトル</th>
                <th>冊数</th>
                <th>金額</th>
                <th>発行日</th>
                <th>&nbsp;</th>
            </thead>
            <!-- テーブル本体 -->
            <tbody>
                    @foreach ($books as $book)
                    <tr>
                        <td class="table-text">
                            <div>{{ $book->item_name }}</div>
                        </td>
                        <td class="table-text">
                            <div>{{ $book->item_number }}</div>
                        </td>
                        <td class="table-text">
                            <div>{{ $book->item_amount }}</div>
                        </td>
                        <td class="table-text">
                            <div>{{ $book->published }}</div>
                        </td>
                        
                        <!-- 本: 更新ボタン -->
                        <td>
                            <form action="{{ url('booksedit/'.$book->id) }}" method="POST">
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-primary">
                                    <i class="glyphicon glyphicon-pencil"></i> 更新
                                </button>
                            </form>
                        </td>

                        <!-- 本: 削除ボタン -->
                        <td>
                            <form action="{{ url('book/'.$book->id) }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}

                                <button type="submit" class="btn btn-danger"> 
                                <i class="glyphicon glyphicon-trash"></i> 削除
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
            </tbody>
        </table>
        </div>
    </div>
    @endif
    <!--  Book: 既に登録されてる本リスト -->
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
        {{ $books->links()}}
        </div>
    </div>
    
    
    
@endsection




