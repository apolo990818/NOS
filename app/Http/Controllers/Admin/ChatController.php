<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ChatMessage;
use App\Models\Cliente;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{
    // Muestra todos los clientes con su último mensaje
    public function index()
    {
        $latestMessages = ChatMessage::select('chat_messages.*')
            ->join(DB::raw('(
                SELECT guest_id, MAX(created_at) as latest_created_at
                FROM chat_messages
                GROUP BY guest_id
            ) as latest'), function($join) {
                $join->on('chat_messages.guest_id', '=', 'latest.guest_id')
                     ->on('chat_messages.created_at', '=', 'latest.latest_created_at');
            })
            ->orderByDesc('chat_messages.created_at')
            ->limit(30)
            ->get();

            //$cliente = Cliente::find('chat_messages.guest_id');
            

        return view('admin.chat.index', compact('latestMessages'));
    }

    // Mostrar mensajes y datos del cliente
    public function show($usuario)
    {
        $messages = ChatMessage::where('guest_id', $usuario)
            ->orderBy('created_at')
            ->get();

        $lastId = $messages->last() ? $messages->last()->id : 0;

        // Buscar datos del cliente con id = guest_id
        $cliente = Cliente::find($usuario);

        return view('admin.chat.show', compact('usuario', 'messages', 'lastId', 'cliente'));
    }

    // API para obtener mensajes nuevos desde un último ID conocido
    public function getMessages($usuario, Request $request)
    {
        $lastId = $request->query('last_id', 0);

        $messages = ChatMessage::where('guest_id', $usuario)
            ->where('id', '>', $lastId)
            ->orderBy('created_at')
            ->get();

        return response()->json($messages);
    }

    // Enviar mensaje
    public function sendMessage(Request $request, $usuario)
    {
        $request->validate([
            'message' => 'required|string',
        ]);

        $message = ChatMessage::create([
            'guest_id' => $usuario,
            'message' => $request->message,
            'from_admin' => true,
            'user_id' => auth()->id(),
        ]);

        if ($request->expectsJson()) {
            return response()->json(['message' => $message]);
        }

        return redirect()->route('admin.chat.show', ['usuario' => $usuario])
            ->with('success', 'Mensaje enviado correctamente.');
    }
}
