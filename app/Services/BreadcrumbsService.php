<?php

namespace App\Services;

class BreadcrumbsService
{
    protected $breadcrumbs = [];

    public function add(string $title, string $url = null)
    {
        $this->breadcrumbs[] = ['title' => $title, 'url' => $url];
    }

    public function get()
    {
        return $this->breadcrumbs;
    }

    public function reset()
    {
        $this->breadcrumbs = [];
    }
}
