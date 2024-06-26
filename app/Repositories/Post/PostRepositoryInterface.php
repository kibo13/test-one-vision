<?php


namespace App\Repositories\Post;


interface PostRepositoryInterface
{
    public function getAll($data);
    public function getPostsByDummyId($dummyId, $data);
    public function create($data);
    public function find($id);
    public function update($id, $data);
    public function delete($id);
}
