<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Service;
use App\Section;
use App\Category;
use App\Post;
use App\Tag;
use App\Profile;
use App\User;

class BoardController extends Controller
{
    public function __construct() 
    {
        User::detectUserLocation();
    }

    // Section Services

    public function getServices()
    {
        $service = Service::where('slug', 'uslugi')->first();
        $section = Section::where('service_id', '1')->where('status', 1)->orderBy('sort_id')->get();

    	return view('board.section', compact('service', 'section'));
    }

    public function showServices($category)
    {
        $category = Category::where('slug', $category)->first();
        $profiles = Profile::where('category_id', $category->id)->take(5)->get();
        $posts = Post::where('category_id', $category->id)->where('status', 1)->orderBy('id', 'DESC')->paginate(10);

        $category_tags = $category->tags()->get();

        return view('board.posts', compact('category', 'category_tags', 'profiles', 'posts'));
    }

    public function showPostService($post, $id)
    {
        $post = Post::findOrFail($id);
        $post->views = ++$post->views;
        $post->save();

        $profiles = Profile::where('category_id', $post->category_id)->take(5)->get();
        $prev = Post::where('category_id', $post->category_id)->where('status', 1)->where('id', '>', $post->id)->select('id', 'slug')->first();
        $next = Post::where('category_id', $post->category_id)->where('status', 1)->orderBy('id', 'DESC')->where('id', '<', $post->id)->select('id', 'slug')->first();

        $images = ($post->images) ? unserialize($post->images) : null;
        $contacts = json_decode($post->phone);
        $first_number = rand(1, 10);
        $second_number = rand(1, 10);

        return view('board.post', compact('post', 'profiles', 'prev', 'next', 'images', 'contacts', 'first_number', 'second_number'));
    }

    // Section Projects

    public function getProjects()
    {
        $service = Service::where('slug', 'proekty')->first();
        $section = Section::where('service_id', '2')->where('status', 1)->orderBy('sort_id')->get();

        return view('tender.section', compact('service', 'section'));
    }

    public function showProjects($category)
    {
        $category = Category::where('slug', $category)->first();
        $profiles = Profile::where('category_id', $category->id)->take(5)->get();
        $posts = Post::where('category_id', $category->id)->where('status', 1)->orderBy('id', 'DESC')->paginate(10);

        return view('tender.posts', compact('category', 'profiles', 'posts'));
    }

    public function showPostProject($post, $id)
    {
        $post = Post::findOrFail($id);
        $post->views = ++$post->views;
        $post->save();

        $profiles = Profile::where('category_id', $post->category_id)->take(5)->get();
        $prev = Post::where('category_id', $post->category_id)->where('status', 1)->where('id', '>', $post->id)->select('id', 'slug')->first();
        $next = Post::where('category_id', $post->category_id)->where('status', 1)->orderBy('id', 'DESC')->where('id', '<', $post->id)->select('id', 'slug')->first();

        $images = ($post->images) ? unserialize($post->images) : null;
        $contacts = json_decode($post->phone);
        $first_number = rand(1, 10);
        $second_number = rand(1, 10);

        return view('tender.post', compact('post', 'profiles', 'prev', 'next', 'images', 'contacts', 'first_number', 'second_number'));
    }

    // Additional functionality

    public function searchPosts(Request $request)
    {
        $city_id = (int) $request->city_id;
        $text = trim(strip_tags($request->text));
        $profiles = Profile::take(5)->get();
        $posts = Post::where('status', 1)
            ->where(function($query) use ($text) {
                return $query->where('title', 'LIKE', '%'.$text.'%')
                ->orWhere('description', 'LIKE', '%'.$text.'%');
            })
            ->orderBy('id', 'DESC')
            ->paginate(10);

        return view('board.found_posts', compact('text', 'posts', 'profiles'));
    }

    public function filterPosts(Request $request)
    {
        $query  = ($request->city_id)
            ? 'city_id = ' . (int) $request->city_id . ' AND '
            : NULL;

        $query .= ($request->image == 'on')
            ? 'image IS NOT NULL AND '
            : NULL;

        $query .= ($request->from)
            ? 'price >= ' . (int) $request->from . ' AND '
            : 'price >= 0 AND ';

        $query .= ($request->to)
            ? 'price <= ' . (int) $request->to
            : 'price <= 9999999999';

        if ($request->text)
        {
            $text = trim(strip_tags($request->text));
            $query .= " AND (title LIKE '%$text%' or description LIKE '%$text%')";
        }

        $section = Section::all();
        $profiles = Profile::take(5)->get();

        if ($request->category_id)
        {
            $section = Section::find($request->category_id);
            $posts = Post::where('status', 1)
                ->where('category_id', $request->category_id)
                ->whereRaw($query)
                ->orderBy('id', 'DESC')
                ->paginate(10);

            $posts->appends([
                'category_id' => (int) $request->category_id,
                'city_id' => (int) $request->city_id,
                'text' => $request->text,
                'image' => ($request->image == 'on') ? 'on' : NULL,
                'from' => (int) $request->from,
                'to' => (int) $request->to,
                'tag_id' => $request->tags_id,
            ]);
        }
        else
        {
            $posts = Post::where('status', 1)
                ->whereRaw($query)
                ->orderBy('id', 'DESC')
                ->paginate(10);

            $posts->appends([
                'city_id' => (int) $request->city_id,
                'text' => $request->text,
                'image' => ($request->image == 'on') ? 'on' : NULL,
                'from' => (int) $request->from,
                'to' => (int) $request->to,
                'tag_id' => $request->tags_id,
            ]);
        }

        $selected_tags = [];

        if( isset($request->tags_id) ) {

            $selected_tags = $request->tags_id;

            foreach ($posts as $post_key => $post) 
            {
                $hasTag = false;
                foreach ($selected_tags as $tag_id) 
                {
                    if( $post->hasTag($tag_id) ) {
                        $hasTag = true;
                    }
                }

                if( !$hasTag ) {
                    unset($posts[$post_key]);
                }
            }
        }

        $category = Category::findOrFail($request->category_id);
        $category_tags = $category->tags()->get();

        return view('board.found_posts', compact('category', 'category_tags', 'selected_tags', 'section', 'sections', 'profiles', 'posts'));
    }
}
