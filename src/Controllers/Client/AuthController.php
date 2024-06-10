<?php

namespace Admin\asm\Controllers\Client;

use Admin\asm\Commons\Controller;

use Admin\asm\Commons\Helper;
use Admin\asm\Models\User;

class AuthController extends Controller
{
    private User $user;

    public function __construct()
    {
        $this->user = new User();
    }

    public function index(){

        avoid_login();
        
        $this->renderViewClient('login');
    }

    public function registerForm(){

        avoid_login();
        
        $this->renderViewClient('resgiter');
     //   return $this ->renderViewClient('resgiter');
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            try {
                // Kiểm tra email đã tồn tại hay chưa
                $existingUser = $this->user->findByEmail($email);
                if ($existingUser) {
                    throw new \Exception('Email đã tồn tại');
                }

                // Mã hóa mật khẩu
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                // Tạo người dùng mới
                $newUser = $this->user->create([
                    'name' => $name,
                    'email' => $email,
                    'password' => $hashedPassword,
                ]);

                if ($newUser) {
                    // Đăng ký thành công, chuyển hướng tới trang đăng nhập
                    header('Location: ' . url('auth/login'));
                    exit;
                } else {
                    throw new \Exception('Đăng ký thất bại');
                }
            } catch (\Throwable $th) {
                // Lưu lỗi vào session và chuyển hướng về trang đăng ký
                $_SESSION['error'] = $th->getMessage();
                header('Location: ' . url('auth/register'));
                exit;
            }
        }
    }

    public function login() {
        avoid_login();

        try {
            $user = $this->user->findByEmail($_POST['email']);

            if (empty($user)) {
                throw new \Exception('Không tồn tại email: ' . $_POST['email']);
            }

            $flag = password_verify($_POST['password'], $user['password']); 
            if ($flag) {

                $_SESSION['user'] = $user;

                if ($user['type'] == 'admin') {
                    header('Location: ' . url('admin/') );
                    exit;
                }
                
                header('Location: ' . url() );
                exit;
            }

            throw new \Exception('Password không đúng');
        } catch (\Throwable $th) {
            $_SESSION['error'] = $th->getMessage();

            header('Location: ' . url('auth/login') );
            exit;
        }
    }

    public function logout() {
        unset($_SESSION['user']);

        header('Location: ' . url() );
        exit;
    }
}