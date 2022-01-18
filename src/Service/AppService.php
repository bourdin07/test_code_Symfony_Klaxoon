<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\Request;

class AppService
{
    /**
     * Decode la requete
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return Request
     */
    public function transformJsonBody(Request $request)
    {
        $data = json_decode($request->getContent(), true);

        if ($data === null) {
            return $request;
        }

        $request->request->replace($data);

        return $request;
    }
}
