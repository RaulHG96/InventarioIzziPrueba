<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        // dd($exception);
        // dd($exception instanceof \Illuminate\View\ViewException);
        // dd($this->isHttpException($exception));
        if ($this->isHttpException($exception)) {
            if ($exception->getStatusCode() == 404) {
                if ($request->ajax()) {
                    return response()->json([
                        'success' => false,
                        'error'  => ['404 - El recurso al que quiere acceder no se ha encontrado',
                    ]]);
                } else {
                    return response()->view('public.error-pages.error-page', ['codigoError' => 404]);
                }
            }

            if ($exception->getStatusCode() == 500) {
                if ($request->ajax()) {
                    return response()->json([
                        'success' => false,
                        'error'  => ['500 - ??Oops! Algo ha ido mal con su petici??n',
                        ]]);
                } else {
                    return response()->view('public.error-pages.error-page', ['codigoError' => 500]);
                }
            }
        }
        
        // dd($exception);
        if($exception instanceof \Illuminate\View\ViewException) {
            return response()->view('public.error-pages.error-page', ['codigoError' => 500]);
        }

        if ($exception instanceof MethodNotAllowedHttpException) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'error'  => ['401 - No tiene permiso para acceder a este recurso',
                    ]]);
            } else {
                return response()->view('public.error-pages.error-page', ['codigoError' => 401]);
            }
        }

        if ($exception instanceof \Illuminate\Database\QueryException) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'error'  => ['Algo sali?? mal al intentar obtener la informaci??n']
                ]);
            } else {
                return response()->view('public.error-pages.error-page', ['codigoError' => 500]);
            }
        }

        if ($exception instanceof \ErrorException) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'error'  => ['Algo sali?? mal al intentar visualizar esta p??gina']
                ]);
            } else {
                return response()->view('public.error-pages.error-page', ['codigoError' => 500]);
            }
        }

        if($exception instanceof \Symfony\Component\Debug\Exception\FatalThrowableError) {                    
            return response()->view('public.error-pages.error-page', ['codigoError' => 500]);                  
        }
        

        if ($exception instanceof \Illuminate\Foundation\Http\Exceptions\MaintenanceModeException) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'error'  => ['El sitio est?? en mantenimiento']
                ]);
            } else {            
                return response()->view('public.error-pages.error-page', ['codigoError' => 503]);
            }
        } 

        return parent::render($request, $exception);
    }
}
