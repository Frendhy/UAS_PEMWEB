@extends('layouts.user')

@section('content')
<div class="text-center">
    <h1 class="text-4xl font-bold mb-4">Message</h1>
    <p class="text-lg text-gray-600">Message page for HMIF.</p>

    <div id="chat-box" class="border p-4 h-64 overflow-y-scroll mb-4"></div>

    <form id="chat-form">
        <input type="text" id="chat-input" class="border p-2 w-full" placeholder="Type your message here...">
        <button type="submit" class="mt-2 bg-blue-500 text-white p-2 rounded">Send</button>
    </form>
</div>

<script>
    document.getElementById('chat-form').addEventListener('submit', function(e) {
        e.preventDefault();
        const message = document.getElementById('chat-input').value;

        if (!message) {
            console.error('Message is empty.');
            return;
        }

        console.log('Message:', message);

        fetch('/messages', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ message: message })
        }).then(response => {
            console.log('Response status:', response.status); // Log response status
            if (!response.ok) {
                throw new Error('Network response was not ok: ' + response.statusText);
            }
            return response.json();
        }).then(data => {
            console.log('Response data:', data); // Log the response to console
            document.getElementById('chat-input').value = '';
            loadMessages();
        }).catch(error => {
            console.error('There was a problem with the fetch operation:', error);
        });
    });

    function loadMessages() {
    fetch('/messages')
        .then(response => {
            console.log('Load messages response status:', response.status);
            if (!response.ok) {
                throw new Error('Network response was not ok: ' + response.statusText);
            }
            return response.json();
        })
        .then(data => {
            console.log('Load messages data:', data); // Log load messages data
            const chatBox = document.getElementById('chat-box');
            chatBox.innerHTML = '';
            data.forEach(message => {
                const messageElement = document.createElement('div');
                messageElement.classList.add('p-2', 'border', 'mb-2');
                messageElement.textContent = message.message_text;
                chatBox.appendChild(messageElement);
            });
            chatBox.scrollTop = chatBox.scrollHeight;
        })
        .catch(error => {
            console.error('There was a problem with loading messages:', error);
        });
}

setInterval(loadMessages, 3000); // Refresh every 3 seconds

loadMessages(); // Load messages initially


</script>
@endsection
