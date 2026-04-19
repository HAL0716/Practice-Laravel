<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'body'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function latestList(): Collection
    {
        return self::query()->with('user')->latest()->get();
    }

    public static function createForUser(int $userId, string $body): self
    {
        return self::create(['user_id' => $userId, 'body' => $body]);
    }

    public function updateBody(string $body): void
    {
        $this->update(['body' => $body]);
    }

    public function deletePost(): void
    {
        $this->delete();
    }
}
