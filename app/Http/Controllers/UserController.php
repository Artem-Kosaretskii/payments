<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\PaymentResource;
use App\Http\Resources\UserResource;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Validation\Rule;

/**
 * User controller
 */
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //return User::all();
        return UserResource::collection(User::orderBy('created_at', 'desc')->paginate(2));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $form_fields = $request->validate([
            'name'=>['required','min:6'],
            'email'=>['required','email',Rule::unique('users','email')],
            'password'=>'required|confirmed|min:6'
        ]);
        $form_fields['password'] = bcrypt($form_fields['password']);
        //auth()->login($user);
        return User::create($form_fields);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return UserResource::collection(User::where('id',$id)->paginate(1));
        //return User::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);
        $form_fields = $request->validate([
            'name'=>['required','min:6'],
            'email'=>['required','email'],
            'password'=>'required|confirmed|min:6'
        ]);
        $form_fields['password'] = bcrypt($form_fields['password']);
        $user->update($form_fields);
        return $user;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return User::destroy($id);
    }

    /**
     * Searching for the specified resource in the storage.
     * @param string $name
     */
    public function search(string $name)
    {
        return UserResource::collection(User::where('name','like','%'.$name.'%')->paginate(2));
        //return User::where('name','like','%'.$name.'%')->get();
    }

    public function payments(string $id)
    {
        return PaymentResource::collection(Payment::where('user_id',$id)->paginate(2));
        //return Payment::where('user_id',$id)->get();
    }
}
