<?php

return [
    'format'           => [
        'long_time'    => 'H:m:s d/m/Y',
        'short_time'   => 'd/m/Y',
    ],
    'template'         => [
        'classInput'   => ['class' => 'form-control'],
        'level'         => [
            'admin'      => ['name' => 'Administrator'],
            'member'      => ['name' => 'Normal User'],
        ],
        'search'       => [
            'all'           => ['name' => 'Search by All'],
            'id'            => ['name' => 'Search by ID'],
            'name'          => ['name' => 'Search by Name'],
            'username'      => ['name' => 'Search by Username'],
            'fullname'      => ['name' => 'Search by Fullname'],
            'email'         => ['name' => 'Search by Email'],
            'description'   => ['name' => 'Search by Description'],
            'link'          => ['name' => 'Search by Link'],
            'content'       => ['name' => 'Search by Content'],

        ],
        'button' => [
            'edit'      => ['class' => 'btn-info', 'title' => 'Edit', 'icon' => 'fa-pen', 'route-name' => '.form'],
            'delete'    => ['class' => 'btn-danger btn-delete', 'title' => 'Delete', 'icon' => 'fa-trash', 'route-name' => '.delete'],
            'info'      => ['class' => 'btn-success', 'title' => 'View', 'icon' => 'fa-eye', 'route-name' => '.info'],
        ]

    ],
    'config' => [
        'search' => [
            'default'   => ['all', 'id'],
            'slider'    => ['all', 'id', 'name', 'description', 'link'],
            'categoryProduct'  => ['all', 'name'],
            'article'   => ['all', 'name', 'content'],
            'product'   => ['all', 'name', 'content'],
            'rss'       => ['all', 'name', 'link'],
            'menu'      => ['all', 'name', 'link'],
            'user'      => ['all', 'username', 'email', 'fullname'],
        ],
        'button' => [
            'default'       => ['edit', 'delete'],
            'category'    => ['edit', 'delete'],
            'post'         => ['edit', 'delete'],
            'user'         => ['edit', 'delete'],
        ]
    ],
    'notify' => [
        'add'       => 'Thêm mới phần tử thành công!',
        'edit'      => 'Chỉnh sửa phần tử thành công',
        'delete'    => 'Xoá phần tử thành công',
        'status'    => 'Status change successful',
        'category'  => 'Category change successful',
        'ajaxError' => 'Something went wrong!!!',
    ]


];
