<!-- Floating AI chatbox UI (UI-only) -->
<style>
#ef-chat-toggle { position: fixed; right: 1.25rem; bottom: 1.25rem; z-index: 70; }
#ef-chat-toggle button { padding: 0; border: none; background: transparent; box-shadow: none; display:inline-flex; align-items:center; justify-content:center; outline: none; }
#ef-chat-toggle img{ width:128px; height:128px; border-radius:9999px; display:block; }
#ef-chat-panel { position: fixed; right: 1.25rem; bottom: 9.5rem; z-index: 75; width: 360px; max-width: calc(100% - 2rem); height: 480px; background: #fff; border-radius: 12px; box-shadow: 0 20px 40px rgba(2,6,23,0.2); display:none; flex-direction:column; overflow:hidden; }
#ef-chat-panel.open { display:flex; }
#ef-chat-panel .ef-header{ padding: 12px 16px; background: #0ea5a0; color: white; display:flex; align-items:center; justify-content:space-between; }
#ef-chat-panel .ef-body{ padding: 16px; overflow-y:auto; flex:1; }
#ef-chat-panel .ef-footer{ padding: 10px; border-top:1px solid #eee; display:flex; gap:8px; }
@media (max-width:640px){ #ef-chat-panel{ right:8px; left:8px; width:auto; bottom:9.5rem; height:420px; } }
</style>

<div id="ef-chat-toggle" aria-hidden="false">
  <button id="ef-open-chat" aria-label="Mở chat">
    <img src="{{ asset('images/chatbox.png') }}" alt="Chatbot" onerror="efFallbackImage(this)" class="w-32 h-32 object-cover rounded-full" />
  </button>
</div>

<div id="ef-chat-panel" role="dialog" aria-hidden="true" aria-label="Chatbox">
  <div class="ef-header">
    <div class="font-bold">Trợ lý</div>
    <button id="ef-close-chat" aria-label="Đóng chat" class="text-white font-bold text-xl leading-none">&times;</button>
  </div>
  <div class="ef-body" id="ef-chat-body">
    <div class="text-sm text-gray-500">Xin chào! Đây là giao diện chat. Bấm vào nút gửi để thêm tin nhắn.</div>
  </div>
  <div class="ef-footer">
    <input id="ef-chat-input" type="text" placeholder="Gõ tin nhắn..." class="flex-1 border rounded px-3 py-2 text-sm" />
    <button id="ef-chat-send" class="bg-amber-800 text-white px-3 py-2 rounded text-sm">Gửi</button>
  </div>
</div>

<script>
(function(){
  const toggleBtn = document.getElementById('ef-open-chat');
  const panel = document.getElementById('ef-chat-panel');
  const closeBtn = document.getElementById('ef-close-chat');
  const sendBtn = document.getElementById('ef-chat-send');
  const input = document.getElementById('ef-chat-input');
  const body = document.getElementById('ef-chat-body');

  function open(){ panel.classList.add('open'); panel.setAttribute('aria-hidden','false'); input.focus(); }
  function close(){ panel.classList.remove('open'); panel.setAttribute('aria-hidden','true'); }

  toggleBtn && toggleBtn.addEventListener('click', function(){ if(panel.classList.contains('open')) close(); else open(); });
  closeBtn && closeBtn.addEventListener('click', close);

  function appendMessage(text, fromUser){
    const wrapper = document.createElement('div');
    wrapper.className = fromUser ? 'mb-3 text-right' : 'mb-3 text-left';
    const bubble = document.createElement('div');
    bubble.className = fromUser ? 'inline-block bg-amber-100 text-amber-800 px-3 py-2 rounded' : 'inline-block bg-gray-100 text-gray-800 px-3 py-2 rounded';
    bubble.innerText = text;
    wrapper.appendChild(bubble);
    body.appendChild(wrapper);
    body.scrollTop = body.scrollHeight;
  }

  sendBtn && sendBtn.addEventListener('click', function(){ const v = (input.value || '').trim(); if(!v) return; appendMessage(v,true); input.value=''; setTimeout(function(){ appendMessage('Xin lỗi, hiện tại chỉ là bản demo UI.'); }, 500); });

  input && input.addEventListener('keydown', function(e){ if(e.key === 'Enter'){ sendBtn.click(); }});
})();

function efFallbackImage(img){
  try {
    img.onerror = null;
    var svg = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#ffffff"><path d="M12 2a10 10 0 100 20 10 10 0 000-20zM7.5 11.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM20 14.5c0 2.485-3.582 4.5-8 4.5s-8-2.015-8-4.5V12l1.5-1.5L7 12v2.5c0 .833 2.865 2.5 5 2.5s5-1.667 5-2.5V12l.5-1.5L20 12v2.5z"/></svg>';
    img.src = 'data:image/svg+xml;utf8,' + encodeURIComponent(svg);
  } catch(e) {
    // fallback to a plain color image
    img.src = 'data:image/svg+xml;utf8,' + encodeURIComponent('<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#ef4444"><rect width="24" height="24"/></svg>');
  }
}
</script>