<?php

namespace App\Http\Controllers\Api\v1;

use App\Course;
use App\Exceptions\CourseIsPrivateException;
use App\Http\Controllers\Controller;
use App\Http\Requests\CourseRequest;
use App\Http\Resources\v1\Course as CourseResource;
use App\Http\Resources\v1\CourseCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::paginate(2);
        return new CourseCollection($courses);
    }

    public function single(Course $course)
    {
//        throw new CourseIsPrivateException();
        return new CourseResource($course);
    }

    public function store(CourseRequest $request)
    {
        //method one
//        $validator = Validator::make($request->all(), [
//            'title' => 'required|unique:courses|max:255',
//            'body' => 'required',
//        ]);
//        if ($validator->fails()){
//            return response([
//                'message'=> $validator->errors(),
//                'status' => 'error'
//            ],Response::HTTP_UNPROCESSABLE_ENTITY);
//        }


        //method two
//        $this->validate($request, [
//            'title' => 'required|unique:courses|max:255',
//            'body' => 'required',
//        ]);


        return response([
            'data'=> [],
            'status' => 'success'
        ],Response::HTTP_OK);
    }
}
