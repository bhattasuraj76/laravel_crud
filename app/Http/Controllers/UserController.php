<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function addUser(Request $request)
    {
        if ($request->isMethod('get')) {
            return redirect()->route('index');
        }
        if ($request->isMethod('post')) {
            $this->validate($request, [
                'name' => 'required|min:3',
                'email' => 'required|email|unique:users,email',
                'description' => 'required|min:5',
                'password' => 'required|min:3',
                'upload' => 'required|mimes:jpg,png,gif,jpeg'
            ], [
                'name.required' => 'user must enter name',
                'upload.required'=>'user must upload a profile picture'
            ]);
            $data['name'] = $request->name;
            $data['email'] = $request->email;
            $data['password'] = bcrypt($request->password);
            $data['description'] = $request->description;
            if ($request->hasFile('upload')) {
                $image = $request->file('upload');
                $ext = $image->getClientOriginalExtension();
                $imageName = md5(microtime()) . '.' . $ext;
                if (!file_exists('images')) {
                    mkdir('images');
                }
                $uploadPath = public_path('images');
                if ($image->move($uploadPath, $imageName)) {
                    $data['upload'] = $imageName;
                }
            }
            if (User::create($data)) {
                return redirect()->route('index')->with('success', 'user was inserted');
            }
            return redirect()->back();
        }
    }

    public function viewUsers(Request $request)
    {
        if ($request->isMethod('post')) {
            return redirect()->back();
        }

        $userData = User::orderBy('name', 'desc')->paginate(4); //you can use all()
        $data['userData'] = $userData;
        return view('viewUsers', $data);

    }

    public function deleteWithImage($id)
    {
        $userId = $id;
        $findUser = User::find($userId);
        $imageName = $findUser->upload;
        $imagePath = public_path('images/' . $imageName);
        if (file_exists($imagePath) && is_file($imagePath)) {
            return unlink($imagePath);
        }
        return true;
    }

    public function deleteUser(Request $request)
    {
        if(!$request->uid){
            return redirect()->back();
        }
        $userId = $request->uid;
        if ($this->deleteWithImage($userId) && User::find($userId)->where('id', $userId)->delete()) {
            return redirect()->route('viewUsers')->with('success', 'user was deleted');
        }
    }

    public function editUser(Request $request)
    {
        if(!$request->uid){
            return redirect()->back();
        }
        $userId = $request->uid;
        $findUser=User::find($userId);
        $data['userData']=$findUser;
       return view('editUser',$data);
    }

    public function editUserAction(Request $request)
    {
        if ($request->isMethod('get')) {
            return redirect()->route('index');
        }
        if ($request->isMethod('post')) {
            $userId=$request->id;
            $this->validate($request, [
                'name' => 'required|min:3',
                'email' => 'required|email',[
                    Rule::unique('users','email')->ignore($userId)
                ],
                'description' =>'required|min:5',
                'upload' => 'mimes:jpg,png,gif,jpeg'
            ], [
                'name.required' => 'user must enter his/her name'
            ]);
            $data['name'] = $request->name;
            $data['email'] = $request->email;
            $data['description'] = $request->description;

            if ($request->hasFile('upload')) {
                $image = $request->file('upload');
                $ext = $image->getClientOriginalExtension();
                $imageName = md5(microtime()) . '.' . $ext;
                $uploadPath = public_path('images');
                if($this->deleteWithImage($userId) && $image->move($uploadPath, $imageName)) {
                    $data['upload'] = $imageName;
                }
            }
            if(User::where('id',$userId)->update($data)){
                return redirect()->route('viewUsers')->with('success','user was updated');
            }
            return redirect()->back();
        }
    }

}
