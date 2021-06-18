<?php


namespace App\Http\Controllers;


use App\Models\ThreadModel;

class ThreadController
{

    public function index()
    {
        return ThreadModel::all();
    }

    public function show($id)
    {

    }
}