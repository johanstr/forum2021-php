<?php


namespace App\Http\Controllers;


use App\Http\HttpResponse;
use App\Models\ThreadModel;

class ThreadController
{

    public function index()
    {
        return ThreadModel::all();
    }

    public function show($id)
    {
        return ThreadModel::find($id);
    }

    public function create($request_data)
    {
        return ThreadModel::create($request_data);
    }
}