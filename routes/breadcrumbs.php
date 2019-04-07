<?php

// Home
Breadcrumbs::for('home', function ($trail) {
    $trail->push(__('menus.pages.home'), route('home'));
});

// Home > Users
Breadcrumbs::for('users', function ($trail) {
    $trail->parent('home');
    $trail->push( __('menus.users.main'), route('users.index'));
});

// Home > Users > Create
Breadcrumbs::for('users.create', function ($trail) {
    $trail->parent('users');
    $trail->push(__('labels.general.create_new'), route('users.create'));
});

// Home > Users > Show
Breadcrumbs::for('users.show', function ($trail, $user) {
    $trail->parent('users');
    $trail->push($user->full_name, route('users.show', $user));
});

// Home > Users > Edit
Breadcrumbs::for('users.edit', function ($trail, $user) {
    $trail->parent('users');
    $trail->push($user->full_name . ' - ' . __('labels.users.edit'), route('users.edit', $user));
});
