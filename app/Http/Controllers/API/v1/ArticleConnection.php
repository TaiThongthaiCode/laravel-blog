<?php

namespace App\Http\Controllers\API\v1;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Http\Controllers\Controller;

class ArticleConnection extends Controller
{

    public static function getAllArticles(Request $request) {
        
        return Article::orderBy('created_at', 'DESC')->get();
        // return Article::all();
    }

    public static function getArticle(Request $request, $id) {

        if (Article::where('id', $id)->exists()) {
            return Article::where("id", $id)->get();

        } else {
            return response()->json([
                "message" => "article not found",
            ], 404);
        }        
    }

    public static function postArticle(Request $request) {

        //request->all gives the body
        $article = new Article;
        $article->title = $request->input("title");
        $article->body = $request->input("body");

        $article->save();

        return response()->json([
            "message" => "article created"], 201);

    }

    public static function deleteArticle(Request $request, $id){

        if (Article::where('id', $id)->exists()){
        
            $article = Article::find($id);
            $article->delete();

            return response()->json([
                "message" => "article successfully deleted"
            ], 201);
        } else {

            return response()->json([
                "message" => "article not found",
            ], 404);
        }
    }

    public static function updateArticle(Request $request, $id){

        if (Article::where('id', $id)->exists()){

            $article = Article::find($id);
            $article->title = $request->input('title');
            $article->body = $request->input('body');
            $article->save();

            return response()->json([
                "message" => "message successfully updated",
            ], 201);
        } else {
            
            return response()->json([
                "message" => "article not found",
            ], 404);
        }
        
    }
}
