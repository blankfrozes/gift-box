<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reward extends Model
{
  use HasFactory;
  protected $guarded = ['id', 'created_at', 'updated_at'];

  public function scopeActive()
  {
      return $this->where('is_active', true);
  }
}