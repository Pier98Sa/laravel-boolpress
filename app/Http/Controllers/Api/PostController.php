<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //richiamo tutti i post, gestendo anche le categorie e creando un impaginazione da 6
        $posts = Post::with(['category', 'tags'])->paginate(6);

        //diamo una path assoluta alle immagini
        foreach($posts as $post){
            if ($post->cover) {
                $post->cover = url('storage/'.$post->cover);
            } else {
                $post->cover = url('img/fallback_img.jpg');
            }
        }
        //ritorno un file Json che poi passerĂ² al Front
        return response()->json(
            [
                'result' => $posts,
                'success'=> true
            ]
        );
    }

    public function show($slug){

        $post = Post::where('slug', '=', $slug)->with( ['category', 'tags'])->first();
        
        if ($post->cover) {
            $post->cover = url('storage/'.$post->cover);
        } else {
            $post->cover = url('img/fallback_img.jpg');
        }

        if ($post){
            return response()-> json(
                [
                    'result' => $post,
                    'success' => true
                ],
            );
        }else{
            return response()->json(
                [
                    'result' => 'Nessun risultato trovato',
                    'success' => false
                ]
            );
        }
    }

   
}
