<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class CourseIsPrivateException extends Exception
{
    /**
     * Render the exception as an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return JsonResponse
     */
    public function render($request)
    {
        return $request->expectsJson()
            ? new JsonResponse([
                'data' => 'Course is Private !',
                'status' => '401'
            ], Response::HTTP_UNAUTHORIZED)
            : view('errors.courseisprivate');
    }
}
