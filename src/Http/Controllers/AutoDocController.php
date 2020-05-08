<?php

/**
 * Created by PhpStorm.
 * User: roman
 * Date: 29.08.16
 * Time: 11:29
 */

namespace RonasIT\Support\AutoDoc\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use RonasIT\Support\AutoDoc\Services\SwaggerService;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class AutoDocController
 *
 * @package RonasIT\Support\AutoDoc\Http\Controllers
 */
class AutoDocController extends BaseController
{
    /**
     * @var \Illuminate\Contracts\Foundation\Application|mixed|SwaggerService
     */
    protected $service;

    /**
     * AutoDocController constructor.
     */
    public function __construct()
    {
        $this->service = app(SwaggerService::class);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function documentationWeb()
    {
        $this->service->setDataCollectorFilePath(config('local-data-collector.path_web'));
        $documentation = $this->service->getDocFileContent();

        return response()->json($documentation);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function documentationMobile()
    {
        $this->service->setDataCollectorFilePath(config('local-data-collector.path_mobile'));
        $documentation = $this->service->getDocFileContent();

        return response()->json($documentation);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('auto-doc::documentation');
    }

    /**
     * @param $file
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function getFile($file)
    {
        $filePath = base_path("vendor/tarasov-krk/laravel-swagger/src/Views/swagger/{$file}");

        if (!file_exists($filePath)) {
            throw new NotFoundHttpException();
        }

        $ext = pathinfo($filePath, PATHINFO_EXTENSION);
        $memeType = $ext == "css" ? "text/css": "application/javascript";

        $content = file_get_contents($filePath);

        return response($content, 200, [
            "Content-Type"=> $memeType
        ]);
    }
}
