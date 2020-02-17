<?php

    class homeController extends Controller{

        function __construct(){
        }


        function index(){
            $data =[
                'title' => 'Inicio',
                // 'description' => '',
                // 'keywords' => '',
                //'theme_color' => '',
            ];
            View::render('home',$data);
        }

    }