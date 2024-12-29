<!-- resources/views/userside/source/partials/chat.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Template</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<div class="floating-chat-container">
    <button id="chatToggleBtn" class="chat-toggle-btn">
        <i class="fas fa-comments"></i>
    </button>
    
    <div id="chatWindow" class="chat-window" style="display: none;">
        <div class="card shadow">
            <div class="card-header bg-gradient-primary text-white d-flex justify-content-between align-items-center">
                <h3 class="mb-0">Travel Assistant</h3>
                <button class="btn-close text-white" id="closeChatBtn"></button>
            </div>
            <div class="card-body">
                <div class="chat-messages p-4" id="chatMessages" style="height: 400px; overflow-y: auto;">
                    <!-- Messages will appear here -->
                </div>
                <div class="chat-input mt-4">
                    <form id="chatForm" class="d-flex gap-2">
                        @csrf
                        <input type="text" id="messageInput" class="form-control" placeholder="Ask me anything about travel in Jordan...">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.floating-chat-container {
    position: fixed;
    bottom: 20px;
    right: 20px;
    z-index: 1000;
}

.chat-toggle-btn {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: linear-gradient(45deg, #FA4032, #FA812F);
    border: none;
    color: white;
    font-size: 24px;
    cursor: pointer;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    transition: transform 0.3s ease;
}

.chat-toggle-btn:hover {
    transform: scale(1.1);
}

.chat-window {
    position: fixed;
    bottom: 90px;
    right: 20px;
    width: 350px;
    z-index: 1000;
}

.chat-message {
    display: flex;
    margin-bottom: 1rem;
}

.user-message {
    justify-content: flex-end;
}

.bot-message {
    justify-content: flex-start;
}

.message-content {
    border-radius: 15px !important;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

.user-message .message-content {
    background: linear-gradient(45deg, #FA4032, #FA812F) !important;
}

.card-header {
    background: linear-gradient(45deg, #FA4032, #FA812F);
}

.btn-primary {
    background: linear-gradient(45deg, #FA4032, #FA812F);
    border: none;
}

.form-control:focus {
    border-color: #FA4032;
    box-shadow: 0 0 0 0.2rem rgba(250, 64, 50, 0.25);
}

@media (max-width: 576px) {
    .chat-window {
        width: 100%;
        height: 100%;
        bottom: 0;
        right: 0;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const chatToggleBtn = document.getElementById('chatToggleBtn');
    const chatWindow = document.getElementById('chatWindow');
    const closeChatBtn = document.getElementById('closeChatBtn');
    const chatMessages = document.getElementById('chatMessages');
    const chatForm = document.getElementById('chatForm');
    const messageInput = document.getElementById('messageInput');

    // Toggle chat window
    chatToggleBtn.addEventListener('click', () => {
        chatWindow.style.display = chatWindow.style.display === 'none' ? 'block' : 'none';
    });

    closeChatBtn.addEventListener('click', () => {
        chatWindow.style.display = 'none';
    });

    // Add initial bot message
    addMessage("Hi! I'm your travel assistant. I can help you find tours, learn about destinations in Jordan, and answer your travel questions. How can I help you today?", 'bot');

    chatForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const message = messageInput.value.trim();
        if (!message) return;

        // Add user message
        addMessage(message, 'user');
        messageInput.value = '';

        // Get CSRF token
        const token = document.querySelector('input[name="_token"]').value;

        // Send to server
        fetch('/chat', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token
            },
            body: JSON.stringify({ message: message })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            // Add bot response
            addMessage(data.response, 'bot');
            chatMessages.scrollTop = chatMessages.scrollHeight;
        })
        .catch(error => {
            console.error('Error:', error);
            addMessage('Sorry, I encountered an error. Please try again.', 'bot');
        });
    });

    function addMessage(message, type) {
        const messageDiv = document.createElement('div');
        messageDiv.className = `chat-message ${type}-message mb-3`;
        messageDiv.innerHTML = `
            <div class="message-content p-3 rounded ${type === 'user' ? 'bg-primary text-white ms-auto' : 'bg-light'}" style="max-width: 80%">
                ${message}
            </div>
        `;
        chatMessages.appendChild(messageDiv);
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }
});
</script>