<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpinpayTransaction extends Model
{
    use HasFactory;
    protected $table="spinpay_transactions";
    protected $primaryKey="id";
}
