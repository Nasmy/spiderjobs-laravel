<?php

namespace App\Interfaces;

interface JobRepositoryInterface
{
    public function all();
    public function findById($id);
    public function findByApplyUrl(string $applyUrl);
    public function findByCreatedUser($user_id);
    public function create(array $data);
    public function update(string $id, array $data);
    public function open();
    public function delete(string $id);
    public function getCount();
    public function getLatest();
    public function getRecent();
}
