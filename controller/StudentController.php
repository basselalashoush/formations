<?php

class StudentController extends Controller
{
    function index()
    {
        $this->set(array(
            'text' => "salut",
            'nom' => "jean"
        ));
    }
    function view($id)
    {
        $this->laodModel('Student');
        $student = $this->Student->findFirst(['conditions' => ["student_id" => $id]]);
        if (empty($student)) {
            $this->e404('Not found');
        }
        $this->set('student', $student);
    }
}
