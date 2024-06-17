<?php

namespace Rookieedev\HhhaKit\Http\Resources\Json;

use Illuminate\Http\Resources\Json\JsonResource as BaseJsonResource;
use Illuminate\Http\Request;
use Rookieedev\HhhaKit\Http\Contracts\Macro;
use Illuminate\Http\Resources\Json\ResourceResponse;

class JsonResource extends BaseJsonResource
{
    use Macro;

    /**
     * Get any additional data that should be returned with the resource array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function with(Request $request)
    {
        return array_unique(
            array_merge(
                $this->defineMacro(), 
                $this->with()
            )
        );
    }

    /**
     * Create an HTTP response that represents the object.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function toResponse($request)
    {
        return (new ResourceResponse($this))
            ->toResponse($request)
            //->setStatusCode($this->httpCode)
            ->header('Charset', 'utf-8')
            ->setEncodingOptions(JSON_UNESCAPED_UNICODE);
    } 
}