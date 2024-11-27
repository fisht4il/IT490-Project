<button class="chat-btn" onclick="funcChat()">Help Chat</button>

<section id="chatwindow" class="chat-window" style="display: none;">
    <div class="chat-header">What can we help with</div>
    <div class="chat-content" id="chatcontent">
    </div>
    <div class="input-chat">
        <textarea id="chatinput" placeholder="Message..."></textarea>
        <button onclick="messageSend()">Send</button>
    </div>
</section>

<script>
    function funcChat() {
        var chatwindow = document.getElementById('chatwindow');
        chatwindow.style.display = (chatwindow.style.display === 'none' || chatwindow.style.display === '') ? 'flex' : 'none';
    }

    function messageSend() {
        var inputfield = document.getElementById('chatinput');
        var chatcontent = document.getElementById('chatcontent');

        if (inputfield.value.trim() !== '') {
            var message = document.createElement('div');
            message.textContent = inputfield.value;
            chatcontent.appendChild(message);

            inputfield.value = '';
            chatcontent.scrollTop = chatcontent.scrollHeight;
        }
    }
</script>
