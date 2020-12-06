<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class CoursesController extends Controller
    {
        public function Courses()
        {
            return Inertia::render('Courses/Courses');
        }
    }