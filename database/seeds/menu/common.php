<?php
\Admin::addMenu([
            'parent_id'=>null,
            'title'=>'Dashboard',
            'controller'=>'Admin\DashboardController',
            'slug'=>'dashboard',
            'order'=>1,
        ],['index']);


/**
 * User
 */


\Admin::addMenu([
            'parent_id'=>null,
            'title'=>'User',
            'controller'=>'#',
            'slug'=>'user',
            'order'=>20,
        ],[]);

        \Admin::addMenu([
            'parent_id'=>'user',
            'title'=>'Role',
            'controller'=>'Admin\User\RoleController',
            'slug'=>'user-role',
            'order'=>1,
        ],['index','create','update','delete','view']);

        \Admin::addMenu([
            'parent_id'=>'user',
            'title'=>'User',
            'controller'=>'Admin\User\UserController',
            'slug'=>'user-user',
            'order'=>2,
        ],['index','create','update','delete']);

        \Admin::addMenu([
            'parent_id'=>'user',
            'title'=>'Profile',
            'controller'=>'Admin\MyProfileController',
            'slug'=>'my-profile',
            'order'=>2,
        ],['index']);
/**
 * Development
 */

\Admin::addMenu([
            'parent_id'=>null,
            'title'=>'Development',
            'controller'=>'#',
            'slug'=>'development',
            'order'=>21,
        ],[]);

        \Admin::addMenu([
            'parent_id'=>'development',
            'title'=>'Action',
            'controller'=>'Admin\Development\ActionController',
            'slug'=>'development-action',
            'order'=>1,
        ],['index','create','update','delete']);

        \Admin::addMenu([
            'parent_id'=>'development',
            'title'=>'Example',
            'controller'=>'Admin\ExampleController',
            'slug'=>'example',
            'order'=>2,
        ],['index','create','update','delete']);
        