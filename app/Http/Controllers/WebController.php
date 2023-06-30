<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        //


    }
    protected $admin;
    protected $data;
    protected $redirectTo = '/';

    public function getIndex()
    {
        return View('home.index');
    }
    public function getTopBlog()
    {
        return View('home.top_blog');
    }
    public function getLogin()
    {
        return View('home.login');
    }

    public function getRegister()
    {
        return View('home.register');
    }
    public function getSecutityUser()
    {
        return View('home.user_security_detail');
    }
    public function getDeatil()
    {
        return View('home.detail');
    }
    public function getUserDetail()
    {
        return View('home.user_detail');
    }
    public function getListUserBlog()
    {
        return View('home.list_blog');
    }
    public function getAdminLogin()
    {
        return View('admin.login_admin');
    }
    public function getAdminDashboard()
    {
        return View('admin.dashboard');
    }
    public function getAdminType()
    {
        return View('admin.admin_type');
    }
    public function getAdminBlog()
    {
        return View('admin.admin_blog');
    }

    public function getTest($id)
    {
        $data = $this->data;
        $data['id'] = $id;
        return View('home.edit_blog', $data);
    }
    public function getBlogAfterSearch($keyword)
    {
        $data = $this->data;
        $data['keyword'] = $keyword;
        return View('home.search_blog', $data);
    }
    public function getPostIndex($id)
    {
        // $request-> id;
        $data = $this->data;
        $data['id'] = $id;
        return View('home.post_detail', $data);
    }
    public function getProfile($id)
    {
        $data = $this->data;
        $data['id'] = $id;
        return View('home.profile', $data);
    }
    public function getProfileUser($id)
    {
        $data = $this->data;
        $data['id'] = $id;
        return View('home.profile_user', $data);
    }
}
