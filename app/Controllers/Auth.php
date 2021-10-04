<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Libraries\Hash;

class Auth extends Controller
{
    public function __construct(){
        helper(['url','form']);
    }
    public function index()
    {
        return view('auth/login');
    }
    public function register()
    {
        return view('auth/register');
    }
    public function add_user()
    {
        // $validation = $this->validate([
        //     'username'=>'required|is_unique[users.username]',
        //     'email'=> 'required|valid_email|is_unique[users.email]',
        //     'password'=> 'required|min_length[5]|max_length[10]',
        //     'confirm_pass'=> 'required|min_length[5]|max_length[10]|matches[password]'
        // ]);

        $validation=$this->validate([
            'username'=>[
                'rules'=>'required|is_unique[users.username]',
                'errors'=>[
                    'required'=> 'Username is required',
                    'is_unique'=> 'Username not available',
                ]
                ],
                'email'=>[
                    'rules'=>'required|valid_email|is_unique[users.email]',
                    'errors'=>[
                        'required'=> 'Email is required',
                        'is_unique'=> 'This email aleady exists',
                        'valid_email'=> 'Enter a valid email'
                    ]
                    ],
                'password'=>[
                    'rules'=>'required|min_length[5]|max_length[10]',
                    'errors'=>[
                        'required'=> 'Password is required',
                        'min_length'=> 'Password must have atleast 5 characters',
                        'max_length'=> 'Password must not have more than 10 characters '
                    ]
                    ],
                    'confirm_pass'=>[
                        'rules'=>'required|min_length[5]|max_length[10]|matches[password]',
                        'errors'=>[
                            'required'=> 'Confirm password is required',
                            'min_length'=> 'Password must have atleast 5 characters',
                            'max_length'=> 'Password must not have more than 10 characters ',
                            'matches'=>'Password does not match'
                        ]
                    ]
                        ]);

        if(!$validation){
            return view('auth/register',['validation'=>$this->validator]);
        }
        else{
            $username=$this->request->getPost('username');
            $email=$this->request->getPost('email');
            $password=$this->request->getPost('password');

            $data=[
                'username'=> $username,
                'password'=> $password,
                'email'=> $email,
            ];

            $userModel=new \App\Models\UserModel();
            $query=$userModel->insert($data);
            if(!$query){
                return redirect()->back()->with('fail','Something went wrong, could not register user');
            }
            else{
                return redirect()->to('auth/register')->with('success','Successfully registered');
            }
        }
    }
    public function login()
        {
            $validation=$this->validate([
                'username'=>[
                    'rules'=>'required|is_not_unique[users.username]',
                    'errors'=>[
                        'required'=> 'Username is required',
                        'is_not_unique'=> 'User not registered!!',
                    ]
                    ],
                    'password'=>[
                        'rules'=>'required|min_length[5]|max_length[10]',
                        'errors'=>[
                            'required'=> 'Password is required',
                            'min_length'=> 'Password must have atleast 5 characters',
                            'max_length'=> 'Password must not have more than 10 characters '
                        ]
                        ],
            ]);
            if(!$validation){
                return view('auth/login',['validation'=>$this->validator]);
            }
            else{
                $username=$this->request->getPost('username');
                $password=$this->request->getPost('password');

                $userModel=new \App\Models\UserModel();
                $user_data=$userModel->where('username',$username)->first();
                //$check_pass=Hash::check($password,$user_data['password']);

                if($password!=$user_data['password']){
                    session()->setFlashdata('fail','Incorrect Password');
                    return redirect()->to('/auth')->withInput();
                }
                else{
                    $user_id=$user_data['id'];
                    session()->set('loggesUser',$user_id);
                    return redirect()->to('/dashboard');
                }
            }
        }
}