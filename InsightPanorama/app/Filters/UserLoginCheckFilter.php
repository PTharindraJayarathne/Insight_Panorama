<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class UserLoginCheckFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        //To redirect the user back to the applicant/employer to login page if he tries to access other pages
        if (!session()->has('user_id')) {
            return redirect()->to('/Home')->with('fail','You must be logged in');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}