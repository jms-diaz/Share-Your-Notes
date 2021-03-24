<?php

class Pages extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        if (isLoggedIn()) {
            redirect('notes');
        }
        $data = [
            'title' => SITENAME,
            'description' => 'Simple notes sharing website built with MVC Framework'
        ];
        $this->view('pages/index', $data);
    }

    public function about()
    {
        $data = [
            'title' => 'About Us',
            'description' => 'Website to share notes to other users'
        ];
        $this->view('pages/about', $data);
    }
}
