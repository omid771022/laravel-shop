<?php
namespace App\Repositories;

interface SeasonRepoInterface {
    public function findByIdSeasons($id);
    public function store($request,$id);
}