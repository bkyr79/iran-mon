<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

use Intervention\Image\Facades\Image; 

use App\Services\CheckExtensionServices;

use App\Services\FileUploadServices;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            // 'img_name' => ['file', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2000'], 
            'self_introduction' => ['string', 'max:255'], 
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        //?????? $data ?????? name='img_name'?????????(??????????????????????????????????????????)
        // $imageFile = $data['img_name'];

        // $list = FileUploadServices::fileUpload($imageFile); 

        // list($extension, $fileNameToStore, $fileData) = $list; 

        // //$imageFile??????????????????????????????(???????????????)
        // $filenameWithExt = $imageFile->getClientOriginalName();

        // //?????????????????????????????????????????????
        // $fileName = pathinfo($filenameWithExt, PATHINFO_FILENAME);

        // //??????????????????
        // $extension = $imageFile->getClientOriginalExtension();

        // // ???????????????_??????_????????? ???????????????
        // $fileNameToStore = $fileName.'_'.time().'.'.$extension;

        // //????????????????????????
        // $fileData = file_get_contents($imageFile->getRealPath());

        // $data_url = CheckExtensionServices::checkExtension($fileData, $extension);

        // //?????????????????? base64?????????????????????
        // if ($extension = 'jpg'){
        // $data_url = 'data:image/jpg;base64,'. base64_encode($fileData);
        // }

        // if ($extension = 'jpeg'){
        // $data_url = 'data:image/jpg;base64,'. base64_encode($fileData);
        // }

        // if ($extension = 'png'){
        // $data_url = 'data:image/png;base64,'. base64_encode($fileData);
        // }

        // if ($extension = 'gif'){
        // $data_url = 'data:image/gif;base64,'. base64_encode($fileData);
        // }

        // //????????????????????????(Image????????? make?????????????????????)
        // $image = Image::make($data_url);

        // //????????????400px, ???400px????????????????????????
        // $image->resize(400,400)->save(storage_path() . '/app/public/user_images/' . $fileNameToStore );

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            // 'self_introduction' => $data['self_introduction'],
            // 'sex' => $data['sex'],
            // 'img_name' => $data['img_name'],


            // 'img_name' => $fileNameToStore,
        ]);
    }

    public function guestUserCreate(Request $request)
    {    
        // ???????????????????????????????????????????????????????????????
        $dummy_data = User::create([
            'name' => '?????????'.mt_rand(10, 99),
            'email' => mt_rand().'@gmail.com',
            'password' => Hash::make('12345678'),
        ]);
        
        // ??????????????????????????????
        $this->guard()->login($dummy_data);

        return $this->registered($request, $dummy_data)
        ?: redirect($this->redirectPath());

    }
}
