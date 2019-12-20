<?php


namespace App\Support\Search;


use App\Models\Blog\Post;

class BlogSearch
{
    public static function main($query)
    {
        return Post::where('title', 'LIKE', '%' . $query . '%')
            ->orWhere('content', 'LIKE', '%' . $query . '%');
    }

    public static function byCategory($index)
    {
        return Post::where('category_id', '=', $index);
    }
}
