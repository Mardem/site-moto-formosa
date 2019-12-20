<?php


namespace App\Support\Traits;


trait SharedFunctions
{
    public function getCreatedAtFormattedAttribute() // created_at_formatted
    {
        return $this->getAttribute('created_at')->format('d/m/Y H:i');
    }
}
