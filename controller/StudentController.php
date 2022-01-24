<?php

class StudentController extends Controller
{
    function index()
    {
    }
    function view()
    {
        $this->set(array(
            'text' => "salut",
            'nom' => "jean"
        ));
        $this->render('index');
    }
}
