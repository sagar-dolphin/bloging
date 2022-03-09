<?php

namespace App\Http\Service;

use Illuminate\Http\Request;
use App\Models\Admin\Admin;
use Yajra\DataTables\Facades\DataTables;

class PostService {

    public $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }
}