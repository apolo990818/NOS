@extends('layouts.app')

@section('content')
<style>
    .chat-sidebar-container {
        max-width: 500px;
        margin: 30px auto;
        border: 1px solid #dee2e6;
        border-radius: 8px;
        background-color: #ffffff;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
    }

    .chat-sidebar-header {
        padding: 16px;
        background-color: #0d6efd;
        color: white;
        border-top-left-radius: 8px;
        border-top-right-radius: 8px;
        font-weight: 600;
        font-size: 18px;
    }

    .chat-list {
        max-height: 70vh;
        overflow-y: auto;
    }

    .chat-item {
        padding: 15px 20px;
        border-bottom: 1px solid #f1f1f1;
        transition: background-color 0.2s;
        cursor: pointer;
        background-color: #ffffff;
    }

    .chat-item:hover {
        background-color: #f8f9fa;
    }

    .chat-title {
        font-weight: 600;
        color: #212529;
        margin-bottom: 4px;
    }

    .chat-snippet {
        font-size: 14px;
        color: #495057;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .chat-time {
        font-size: 12px;
        color: #6c757d;
        float: right;
    }

    .no-conversations {
        padding: 20px;
        text-align: center;
        color: #adb5bd;
    }

    @media (max-width: 576px) {
        .chat-sidebar-container {
            margin: 15px;
        }
    }
</style>

<div class="chat-sidebar-container">
    <div class="chat-sidebar-header">
        Conversaciones
    </div>
    <div class="chat-list">
        @forelse($latestMessages as $message)
            <a href="{{ route('admin.chat.show', $message->guest_id) }}" class="text-decoration-none">
                <div class="chat-item">
                    <div class="d-flex justify-content-between">
                        <div class="chat-title">Invitado #{{ $message->guest_id }}</div>
                        <div class="chat-time">{{ $message->created_at->diffForHumans() }}</div>
                    </div>
                    <div class="chat-snippet">{{ $message->message }}</div>
                </div>
            </a>
        @empty
            <div class="no-conversations">No hay conversaciones.</div>
        @endforelse
    </div>
</div>
@endsection
