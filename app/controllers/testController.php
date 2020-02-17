<?php

    class testController extends Controller{

        function __construct(){
        }

        function index($name=null){
          if($name == null){
              $name = 'Invitado';
          }
            $data =[
                'title'=> 'Ginger framework TESTING',
                'name'=> $name,

            ];
            View::render('test', $data);
        }

        function hola_mundo(){
            echo '<h3>Hola Mundo</h3>';
        }

        function hola($name='Invitado'){
            
        }

    }
