<?php


namespace Sashapekh\VfApi;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class VfApiToken extends Model
{
    protected $table = 'vf_api_tokens';
    protected $dates = ['expires', 'created_at'];
    protected $guarded = ['id'];

    public function isExpireToken(): bool
    {
        if ($this->expires) {
            return Carbon::now()->gt($this->expire);
        }
        return false;
    }
}
