<?php


namespace App\Support\Scopes;


use Exception;
use Illuminate\Database\QueryException;

/**
 * Trait MessagesTrait
 * @package App\Support\Traits
 */

trait MessagesTrait
{
    /**
     * @param String $nameModel
     * @return string
     */
    public function successCreatedMessage(String $nameModel): string
    {
        return "$nameModel cadastrado com sucesso!";
    }

    /**
     * @param String $nameModel
     * @return string
     */
    public function errorCreatedMessage(String $nameModel, Exception $exception): string
    {
        return "Não foi possível cadastrar este $nameModel: " . $exception->getMessage();
    }

    public function successDeleteMessage(String $nameModel): string
    {
        return "$nameModel apagado com sucesso!";
    }

    public function errorDeleteMessage(String $nameModel, Exception $exception): string
    {
        return "Não foi possível apagar $nameModel: " . $exception->getMessage();
    }

    public function successUpdateMessage(String $nameModel): string
    {
        return "$nameModel atualizado com sucesso!";
    }

    public function errorUpdateMessage(String $nameModel, Exception $exception): string
    {
        return "Não foi possível atualizar $nameModel: " . $exception->getMessage();
    }

    public function deleteRelationship(String $nameModel, $msg = ''): string
    {
        return "Você não pode apagar a $nameModel pois ele está relacionado outro dado! " . $msg;
    }

    public function notFoundMessage(String $nameModel): string
    {
        return "$nameModel não encontrado!";
    }

}
