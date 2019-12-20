<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use FlyingLuscas\Correios\Client;
use FlyingLuscas\Correios\Service;
use Illuminate\Http\Request;


class SigepController extends Controller
{
    private const ORIGIN = '01001-000';

    public function consultCode(Request $request)
    {
        $correios = new Client;
        return $correios->freight()
            ->origin(self::ORIGIN)
            ->destination($request->postCode)
            ->services(Service::SEDEX, Service::PAC)
            ->item($request->width, $request->height, $request->length, .5, $request->quantity)
            ->calculate();
    }

    public function multiple()
    {
        $correios = new Client;
        $items = [
            [10, 10, 15, .5, 1], // largura, altura, comprimento, peso e quantidade
            [10, 10, 15, .5, 1], // largura, altura, comprimento, peso e quantidade
            [10, 10, 15, .5, 1], // largura, altura, comprimento, peso e quantidade
            [10, 10, 15, .5, 1], // largura, altura, comprimento, peso e quantidade
            [10, 10, 15, .5, 1], // largura, altura, comprimento, peso e quantidade
            [10, 10, 15, .5, 1], // largura, altura, comprimento, peso e quantidade
        ];

        $correios = $correios->freight()
            ->origin(self::ORIGIN)
            ->destination('87047-230')
            ->services(Service::SEDEX, Service::PAC);

        foreach ($items as $item) {
            $correios = $correios->item($item[0], $item[1], $item[2], $item[3], $item[4]);
        }
        return $correios->calculate();
    }
}
