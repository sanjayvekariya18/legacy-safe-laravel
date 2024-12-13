<?php

namespace App\Repositories;

use App\Models\Document;

class FileManagerRepositories
{
    // public function create(array $data)
    // {
    //     // Handle file upload
    //     if (isset($data['url']) && $data['url']->isValid()) {
    //         $imageName = time() . '.' . $data['url']->extension();
    //         $data['url']->move(public_path('images'), $imageName);
    //         $data['url'] = 'images/' . $imageName;  // Store the file path
    //     }

    //     // Insert data into the database
    //     return Document::create([
    //         'name' => $data['name'],
    //         'user_id' => $data['user_id'],
    //         'url' => $data['url'] ?? null,
    //     ]);
    // }



    public function store(array $data)
    {
        // Handle the file upload
        if (isset($data['url']) && $data['url']->isValid()) {
            $fileName = $data['url']->getClientOriginalName();
            $path = $data['url']->storeAs('uploads', $fileName, 'public');
            $data['url'] = $path;
        }

        // Insert document data into the database
        return Document::create([
            'name' => $data['name'],
            'user_id' => $data['user_id'],
            'url' => $data['url'],
        ]);
    }


}
