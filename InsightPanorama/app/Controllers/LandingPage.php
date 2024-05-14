<?php

namespace App\Controllers;

class LandingPage extends BaseController
{
	public function __construct()
	{
		helper('form');
		helper(['url', 'Login_helper']);
	}

	public function index()
	{
		
		return view('LandingPage/index');
	}



}