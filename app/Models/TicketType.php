<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class TicketType extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'ticket_types'; // Sesuaikan dengan nama tabel database Anda jika berbeda
}
