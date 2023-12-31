<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
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

    public function handle($request)
  {
      try
      {
          return parent::handle($request);
      }
          catch(\Symfony\Component\HttpKernel\Exception\NotFoundHttpException $e)
      {
          return response()->view('Viewname', [], 404);
      }
      catch (Exception $e)
      {
          $this->reportException($e);

          return $this->renderException($request, $e);
      }
  }
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    // public function render($request, Exception $e)
    // {
    //     return response()->view('errors.error'); 
    // }
}
