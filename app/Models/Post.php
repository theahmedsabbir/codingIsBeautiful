<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public const STATUS_ACTIVE = "active";
    public const STATUS_DRAFT = "draft";
    public const STATUS_DISABLED = "disabled";
}
