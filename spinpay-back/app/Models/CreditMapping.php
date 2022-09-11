<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreditMapping extends Model
{
    use HasFactory;
    protected $table="credit_mappings";
    protected $primaryKey="id";
}
