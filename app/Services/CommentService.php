<?php

namespace App\Services;

use App\Exceptions\BadRequestException;
use App\Exceptions\NotFoundException;
use App\Models\Comments;
use App\Models\Post;
use App\Models\User;
use Cloudinary\Api\Exception\BadRequest;
use Exception;
use Illuminate\Support\Facades\DB;

class CommentService
{


    private Comments $comments;
    private Post $post;

    private User $user;

    public function __construct()
    {
        $this->comments = new Comments();
        $this->post = new Post();
        $this->user = new User();
    }

    public function addComment($userId, $postId, $comment)
    {
        $post = $this->post->where('id', $postId)->first();
        $user = $this->user->where('id', $userId)->first();
        if (!isset($user)) {
            throw new NotFoundException('gagal memberikan komentar , user tidak ditemukan');
        }
        DB::beginTransaction();
        if (isset($post)) {
            if ($post->can_comment) {
                $created = $this->comments->create([
                    'post_id' => $post->id,
                    'user_id' => $userId,
                    'comment' => $comment
                ]);
                if (isset($created)) {
                    Db::commit();
                    return ['data' => $created, 'status' => true, 'code' => 201, 'message' => 'success add comment'];
                }
                throw new Exception('gagal memberikan komentar , terjadi kesalahan');
            }
            throw new BadRequestException('ops , nampaknya user tidak mengaktifkan komentar pada postingan ini');

        }
        throw new NotFoundException('gagal memberikan komentar , postingan tidak ditemukan');
    }

    public function deleteComment($postId, $commentId, $userId)
    {
        $post = $this->post->where('id', $postId)->first();
        $comment = $this->comments->where('id', $commentId)->first();
        if (!isset($post)) {
            throw new NotFoundException('gagal menghapus , post tidak ditemukan');
        }
        if (!isset($comment)) {
            throw new NotFoundException('gagal menghapus komentar , comment tidak ditemukan');
        }
        if ($comment->user_id != $userId) {
            throw new BadRequestException('ops , kamu tidak boleh menghapus komentar user lain');
        }

        Db::beginTransaction();

        $isDelete = $comment->delete();
        if ($isDelete) {
            Db::commit();
            return [
                'status' => true,
                'message' => 'success delete comment',
                'code' => 200,
                'data' => $isDelete
            ];
        }

        throw new Exception('ops , gagal menghapus komentar terjadi kesalahan');

    }

}