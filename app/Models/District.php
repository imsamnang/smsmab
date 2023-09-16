<?php

namespace App\Models;

use App\Models\Commune;
use App\Models\Village;
use App\Models\Customer;
use App\Models\Document;
use App\Models\Province;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class District extends Model
{
  use HasFactory;

  protected $guarded = [];

  /**
   * Get all of the communes for the District
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function communes(): HasMany
  {
    return $this->hasMany(Commune::class, 'district_id', 'id');
  }

  /**
   * Get all of the villages for the District
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
  */
  public function villages(): HasMany
  {
    return $this->hasMany(Village::class, 'district_id', 'id');
  }

  /**
   * Get the province that owns the District
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function province(): BelongsTo
  {
    return $this->belongsTo(Province::class, 'province_id', 'id');
  }

}
