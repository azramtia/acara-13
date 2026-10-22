<?php

$routes = [
    '/' => ['DashboardController', 'index'],
    '/dashboard' => ['DashboardController', 'index'],
    '/login' => ['AuthController', 'loginForm'],

    '/mahasiswa' => ['MahasiswaController', 'index'],
    '/mahasiswa/create' => ['MahasiswaController', 'create'],
    '/mahasiswa/store' => ['MahasiswaController', 'store'],
    '/mahasiswa/detail' => ['MahasiswaController', 'detail'],
    '/mahasiswa/edit' => ['MahasiswaController', 'edit'],
    '/mahasiswa/update' => ['MahasiswaController', 'update'],
    '/mahasiswa/delete' => ['MahasiswaController', 'delete'],

    '/dosen' => ['DosenController', 'index'],
    '/dosen/create' => ['DosenController', 'create'],

    '/logout' => ['AuthController', 'logout'],
];
