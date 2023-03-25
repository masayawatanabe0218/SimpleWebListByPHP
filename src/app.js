const messageList = document.querySelector('.message-list');
const messageInput = document.querySelector('.chat-input input[type="text"]');
const sendButton = document.querySelector('.chat-input button');

// メッセージを追加する関数
function addMessage(message, author) {
  const li = document.createElement('li');
  li.classList.add('message');
  li.innerHTML = `<span class="author">${author}:</span> ${message}`;
  messageList.appendChild(li);
}

// ボタンがクリックされたときにメッセージを送信する
sendButton.addEventListener('click', function(event) {
    event.preventDefault();
    const message = messageInput.value;
    if (message) {
      addMessage(message, 'Me');
      messageInput.value = '';
    }
  })
  ;