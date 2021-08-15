<?php

namespace App\Services;

class PostService{

    function calculateAuthorWords($author)
    {
        $words_count = 0;
        foreach($author->posts as $posts){
            $words_count += str_word_count($posts->post_text);
        }
        return $words_count;
    }

}






