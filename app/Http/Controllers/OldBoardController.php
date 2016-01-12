<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Service;
use App\Section;
use App\Category;
use App\Post;
use App\Profile;

class BoardController extends Controller
{
    // Section Services

    public function getServices()
    {
        $service = Service::where('slug', 'uslugi')->first();
        $section = Section::where('service_id', '1')->where('status', 1)->orderBy('sort_id')->get();
        $categories = Category::all();

    	return view('board.section', compact('service', 'section', 'categories'));
    }

    public function showServices($category)
    {
        $category = Category::where('slug', $category)->first();
        $profiles = Profile::where('category_id', $category->id)->take(5)->get();
        $posts = Post::where('category_id', $category->id)->where('status', 1)->orderBy('id', 'DESC')->paginate(10);

        return view('board.posts', compact('category', 'profiles', 'posts'));
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

    // Section Products

    public function getProducts()
    {
        $service = Service::where('slug', 'tovary')->first();
        $sections = Section::where('service_id', 3)->where('status', 1)->orderBy('sort_id')->get();

        return view('board.section', compact('service', 'sections'));
    }

    public function showProducts($category)
    {
        $category = Category::where('slug', $category)->first();
        $profiles = Profile::where('category_id', $category->id)->take(5)->get();
        $posts = Post::where('category_id', $category->id)->where('status', 1)->orderBy('id', 'DESC')->paginate(10);

        return view('board.posts', compact('category', 'profiles', 'posts'));
    }

    public function showPostProduct($post, $id)
    {
        $post = Post::findOrFail($id);
        $post->views = ++$post->views;
        $post->save();

        $profiles = Profile::where('category_id', $post->category_id)->take(5)->get();
        $prev = Post::where('category_id', $post->category_id)->where('status', 1)->where('id', '>', $post->id)->select('id', 'slug')->first();
        $next = Post::where('category_id', $post->category_id)->where('status', 1)->orderBy('id', 'DESC')->where('id', '<', $post->id)->select('id', 'slug')->first();

        $images = ($post->images) ? unserialize($post->images) : null;
        $first_number = rand(1, 10);
        $second_number = rand(1, 10);

        return view('board.post', compact('post', 'images', 'profiles', 'prev', 'next', 'first_number', 'second_number'));
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
        echo $request->tag[1];
        dd($request->all());

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
            : 'price <= 9999999';

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
            ]);
        }

        return view('board.found_posts', compact('section', 'sections', 'profiles', 'posts'));
    }

    public function filterPostsOld(Request $request)
    {
        dd($request->all());

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
            : 'price <= 9999999';

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
            ]);
        }

        return view('board.found_posts', compact('section', 'sections', 'profiles', 'posts'));
    }
}