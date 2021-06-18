<?php


namespace App\Http\Controllers;


use App\Http\HttpResponse;
use App\Models\ThreadModel;

class ThreadController
{

    public function index() : array
    {
        return ThreadModel::all();
    }

    public function show($id) : array
    {
        return ThreadModel::find($id);
    }

    public function create($request_data) : array
    {
        return ThreadModel::create($request_data);
    }

    public function update($request_data, $id) : array
    {
        return ThreadModel::update($request_data, $id);
    }

    public function destroy($id)
    {
        return ThreadModel::destroy($id);
    }
}