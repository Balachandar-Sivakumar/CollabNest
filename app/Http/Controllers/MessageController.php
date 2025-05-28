<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        return redirect('chatify/4'); // create resources/views/messages.blade.php
    }
}
