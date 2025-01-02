@extends('layouts.admin')

@section('content')
<div class="text-center">
    <h1 class="text-4xl font-bold mb-4">Message</h1>
    <p class="text-lg text-gray-600">Message page for HMIF.</p>

    <div id="chat-box" class="border p-4 h-64 overflow-y-scroll mb-4"></div>

    <form id="chat-form">
        <input type="text" id="chat-input" class="border p-2 w-full" placeholder="Type your message here...">
        <button type="submit" class="mt-2 bg-blue-500 text-white p-2 rounded">Send</button>
    </form>

    <div id="alert" class="hidden fixed top-4 left-1/2 transform -translate-x-1/2 bg-green-500 text-white px-4 py-2 rounded shadow-lg">
        Message sent successfully!
    </div>
</div>

<script>
    document.getElementById('chat-form').addEventListener('submit', function(e) {
        e.preventDefault();
        const message = document.getElementById('chat-input').value;

        if (!message) {
            console.error('Message is empty.');
            return;
        }

        fetch('/messages', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ message: message })
        }).then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok: ' + response.statusText);
            }
            return response.json();
        }).then(data => {
            document.getElementById('chat-input').value = '';
            showAlert();
            loadMessages();
        }).catch(error => {
            console.error('There was a problem with the fetch operation:', error);
        });
    });

    function loadMessages() {
        const currentUserId = {{ auth()->id() }};
        fetch('/messages')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok: ' + response.statusText);
                }
                return response.json();
            })
            .then(data => {
                const chatBox = document.getElementById('chat-box');
                chatBox.innerHTML = '';
                data.forEach(message => {
                    const messageElement = document.createElement('div');
                    const isCurrentUser = message.sender_id === currentUserId;

                    messageElement.classList.add('p-2', 'border', 'mb-2', 'rounded');
                    messageElement.classList.add(isCurrentUser ? 'bg-blue-100' : 'bg-gray-100');
                    messageElement.style.textAlign = isCurrentUser ? 'right' : 'left';

                    const header = document.createElement('div');
                    header.textContent = `${message.sender_name}`;
                    header.classList.add('font-bold', 'mb-1');

                    const time = document.createElement('div');
                    time.textContent = message.sent_at;
                    time.classList.add('text-sm', 'text-gray-500');

                    const body = document.createElement('div');
                    body.textContent = message.message_text;
                    body.classList.add('mt-1');

                    if (isCurrentUser) {
                        messageElement.style.marginLeft = 'auto';
                    } else {
                        messageElement.style.marginRight = 'auto';
                    }

                    messageElement.appendChild(header);
                    messageElement.appendChild(body);
                    messageElement.appendChild(time);

                    chatBox.appendChild(messageElement);
                });

                chatBox.scrollTop = chatBox.scrollHeight;
            })
            .catch(error => {
                console.error('There was a problem with loading messages:', error);
            });
    }

    function showAlert() {
        const alert = document.getElementById('alert');
        alert.classList.remove('hidden');
        alert.classList.add('block');

        setTimeout(() => {
            alert.classList.add('hidden');
            alert.classList.remove('block');
        }, 3000);
    }

    setInterval(loadMessages, 3000);
    loadMessages();
</script>
@endsection
