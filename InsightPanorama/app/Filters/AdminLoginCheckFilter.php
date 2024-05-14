<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AdminLoginCheckFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // To redirect the user back to the admin dashboard if he tries to access the login page
        if (session()->has('admin_id')) {
            return redirect()->to('/AdminHome');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}