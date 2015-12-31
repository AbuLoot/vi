<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;
use App\User;
use App\Profile;
use App\Section;
use App\Http\Requests\ProfileRequest;
use Image;
use Storage;
use App\Post;
use Validator;

class ProfileController extends Controller
{
    public function getProfile($id)
    {
        $profile = Profile::find($id);
        $posts = $profile->user->posts()->orderBy('id', 'DESC')->get();
        $first_number = rand(1, 10);
        $second_number = rand(1, 10);

        return view('profile.profile_user', compact('posts', 'profile', 'first_number', 'second_number'));
    }

    public function getProfiles()
    {
        $profiles = Profile::paginate(20);

        return view('profile.profiles_users', compact('profiles'));
    }

    public function getMyProfile()
    {
        $profile = Auth::user()->profile;

    	return view('profile.my_profile', compact('profile'));
    }

    public function editMyProfile()
    {
        $profile = Auth::user()->profile;
        $section = Section::orderBy('sort_id')->where('status', 1)->get();

        return view('profile.my_profile_edit', compact('profile', 'section'));
    }

    public function updateMyProfile(ProfileRequest $request, $id)
    {
        $profile = Auth::user()->profile;

        if ($request->hasFile('avatar'))
        {
            $avatar = 'ava-'.str_random(20).'.'.$request->file('avatar')->getClientOriginalExtension();

            if ( ! file_exists('img/users/'.$profile->user->id))
            {
                Storage::makeDirectory('img/users/'.$profile->user->id);
            }

            $file = Image::make($request->file('avatar'));
            $file->fit(90, null);
            $file->crop(90, 90);
            $file->save('img/users/'.$profile->user->id.'/'.$avatar, 50);

            if ( ! empty($profile->avatar))
            {
                Storage::delete('img/users/'.$profile->user->id.'/'.$profile->avatar);
            }
        }

        $profile->user->name = $request->name;
        $profile->user->save();

        $profile->city_id = $request->city_id;
        if ($request->category_id != 0)
            $profile->category_id = $request->category_id;
        $profile->phone =  $request->phone;
        $profile->skills = $request->skills;
        $profile->address = $request->address;
        $profile->website = $request->website;
        if (isset($avatar))
            $profile->avatar = $avatar;
        $profile->save();

        return redirect('/my_profile')->with('status', 'Профиль обновлен!');
    }

    public function getMyPosts()
    {
        $posts = Post::where('user_id', Auth::id())
            ->orderBy('id', 'DESC')
            ->get();

        return view('profile.my_posts', compact('posts'));
    }

    public function getMyReviews()
    {
        $profile = Auth::user()->profile;

        return view('profile.my_reviews', compact('profile'));
    }

    public function getMySetting()
    {
    	return view('profile.my_setting');
    }

    public function updatePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|min:6|max:60',
            'new_password' => 'required|confirmed|min:6|max:60',
            'new_password_confirmation' => 'required|min:6|max:60'
        ]);

        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator);
        }

        if (Auth::attempt(['email' => Auth::user()->email, 'password' => $request->password]))
        {
            $user = User::findOrFail(Auth::id());
            $user->password = bcrypt($request->password);
            $user->update();

            return redirect()->back()->with('status', 'Пароль изменен!');
        }
        else
        {
            return redirect()->back()->withErrors('Пароль не верный!');
        }
    }

    public function deleteAccount(Request $request)
    {
        dd($request->all());
    }
}
