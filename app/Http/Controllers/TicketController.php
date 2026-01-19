<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TicketController extends Controller
{
    public function create(Request $request)
    {
        return view('ticket.create');
    }

    public function show(Ticket $ticket)
    {
        if (!auth()->user()->isAdmin() && auth()->id() !== $ticket->user_id) {
            abort(403);
        }
        return view('ticket.show', compact('ticket'));
    }

    public function download(Attachment $attachment)
    {
        $ticket = $attachment->ticket;

        if (!auth()->user()->isAdmin() && auth()->id() !== $ticket->user_id) {
            abort(403);
        }

        $path = $attachment->file_path;
        $mime = Storage::mimeType($path);

        if (str_starts_with($mime, 'image/')) {
            return response()->file(Storage::path($path));
        }

        return Storage::download($path, $attachment->file_name);
    }
}
