<?php

namespace App\Http\Controllers\Api\v2;

use App\Course;
use App\Http\Controllers\Controller;
use App\Http\Resources\v2\Course as CourseResource;
use App\Http\Resources\v2\CourseCollection;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::paginate(4);
        return new CourseCollection($courses);
    }
    public function single(Course $course)
    {
//        throw new CourseIsPrivateException();
        return new CourseResource($course);
    }
}
