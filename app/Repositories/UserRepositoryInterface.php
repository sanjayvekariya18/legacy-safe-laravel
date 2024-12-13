<?php

namespace App\Repositories;



interface UserRepositoryInterface
{
    public function index($search=null);
    public function destroy($id);
}









