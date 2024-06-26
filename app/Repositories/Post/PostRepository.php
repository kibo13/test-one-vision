<?php


namespace App\Repositories\Post;

use App\Exceptions\RecordNotFoundException;
use App\Models\Post;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class PostRepository implements PostRepositoryInterface
{
    public function getAll($data): LengthAwarePaginator
    {
        $perPage = data_get($data, 'per_page', 10);

        return Post::with('user:id,name')->paginate($perPage);
    }

    public function getPostsByDummyId($dummyId, $data): LengthAwarePaginator
    {
        $perPage = data_get($data, 'per_page', 10);

        return Post::query()->where('dummy_post_id', $dummyId)->paginate($perPage);
    }

    public function create($data): Model|Builder
    {
        $data['user_id'] = auth()->id();

        return Post::query()->create($data);
    }

    public function find($id): Model|Collection|Builder|array
    {
        $post = Post::query()
            ->where('id', $id)
            ->where('user_id', auth()->id())
            ->first();

        if (! $post) {
            throw new RecordNotFoundException();
        }

        return $post;
    }

    public function update($id, $data): bool|int
    {
        $post = $this->find($id);
        return $post->update($data);
    }

    public function delete($id)
    {
        $post = $this->find($id);
        $post->delete();
    }
}
