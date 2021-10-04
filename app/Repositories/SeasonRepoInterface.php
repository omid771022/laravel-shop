<?php
namespace App\Repositories;

interface SeasonRepoInterface {
    public function findByIdSeasons($id);
    public function store($request,$id);
    public function update($request,$id);
    public function updateStatus($id);
    public function updateStatusPending($id);
    public function updateStatusRejected($id);
    public function delete($id);
    public function lock($id);
    public function open($id);
}