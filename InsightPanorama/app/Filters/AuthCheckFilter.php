<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthCheckFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        //To redirect the user back to the admin login page if he tries to access other pages
        if (!session()->has('admin_id')) {
            return redirect()->to('/Admin')->with('fail','You must be logged in');
        }

        // To redirect the user back to the admin dashboard if he tries to access the login page
        // if (session()->has('user_id')) {
        //     return redirect()->to('/Adminhome');
        // }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}