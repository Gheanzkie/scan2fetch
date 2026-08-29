<?= $this->extend('theme/template') ?>
<?= $this->section('content') ?>

<style>
.content-wrapper { background: transparent !important; position: relative; z-index: 1; }

.messages-card {
    border: 1px solid #e2e8f0 !important;
    background: #fff !important;
    border-radius: 10px !important;
    box-shadow: 0 1px 3px rgba(15, 23, 42, .07) !important;
    overflow: hidden !important;
    height: 100%;
    display: flex;
    flex-direction: column;
}

.chat-header {
    background: #0f172a;
    color: #fff;
    border-radius: 0 !important;
    padding: 1rem 1.4rem !important;
    font-weight: 700;
    border-bottom: none !important;
}

.chat-header small { color: rgba(226, 232, 240, .75); font-weight: 500; }

#chatBody {
    height: 420px;
    overflow-y: auto;
    padding: 1.2rem;
    background: #f8fafc;
    flex: 1;
}

.msg-row { display: flex; margin-bottom: 12px; }
.msg-row.me { justify-content: flex-end; }
.msg-row.them { justify-content: flex-start; }

.msg-bubble {
    max-width: 75%;
    padding: 10px 14px;
    border-radius: 8px;
    font-size: 14px;
    line-height: 1.45;
    word-break: break-word;
    box-shadow: 0 1px 3px rgba(15, 23, 42, .06);
}

.msg-row.me .msg-bubble {
    background: #4361ee;
    color: #fff;
}

.msg-row.them .msg-bubble {
    background: #fff;
    color: #334155;
    border: 1px solid #e2e8f0;
}

.msg-meta {
    font-size: 11px;
    color: #94a3b8;
    margin-top: 4px;
    display: block;
}

.msg-row.me .msg-meta { color: rgba(226, 232, 240, .65); text-align: right; }

.chat-input-bar {
    padding: 1rem;
    background: #f8fafc;
    border-top: 1px solid #e2e8f0;
}

.chat-input-bar .form-control { height: auto !important; }

/* ===== OFFICE THREAD LIST ===== */
.thread-list { height: 540px; overflow-y: auto; padding: 0 !important; }

.thread-item {
    display: flex;
    align-items: center;
    padding: 14px 18px;
    cursor: pointer;
    border-bottom: 1px solid #f1f5f9;
    transition: background .2s ease;
}

.thread-item:hover { background: #f8fafc; }
.thread-item.active {
    background: #eef2ff;
    border-left: 4px solid #4361ee;
}

.thread-avatar {
    width: 46px; height: 46px; min-width: 46px;
    border-radius: 8px;
    display: flex; align-items: center; justify-content: center;
    font-weight: 800; font-size: 16px; color: #fff;
    background: #4361ee;
}

.thread-item .unread-dot {
    background: #dc2626;
    color: #fff;
    border-radius: 6px;
    font-size: 11px;
    font-weight: 700;
    padding: 2px 9px;
}

.empty-chat {
    display: flex; flex-direction: column;
    align-items: center; justify-content: center;
    height: 100%; color: #64748b;
    text-align: center; padding: 2rem;
}

#msgSendBtn {
    background: #4361ee !important;
    color: #fff !important;
    border: none !important;
    padding: 0 22px !important;
    border-radius: 0 6px 6px 0 !important;
    font-weight: 700 !important;
}
#msgSendBtn:hover { background: #3b4fd8 !important; }

html.theme-dark #chatBody { background: #0f172a; }
html.theme-dark .messages-card { background: #1e293b !important; border-color: #334155 !important; }
html.theme-dark .messages-card .card-header,
html.theme-dark .messages-card .card-body { background: #1e293b !important; }
html.theme-dark .msg-row.them .msg-bubble { background: #243247 !important; color: #e2e8f0 !important; border-color: #334155 !important; }
html.theme-dark .chat-input-bar { background: #243247 !important; border-top-color: #334155 !important; }
html.theme-dark .thread-item { border-bottom-color: #334155 !important; }
html.theme-dark .thread-item:hover { background: #243247 !important; }
html.theme-dark .thread-item.active { background: #334155 !important; }
html.theme-dark .empty-chat { color: #94a3b8 !important; }
</style>

<div class="content-wrapper" style="background: transparent;">
 <div class="content-header">
 <div class="container-fluid">
 <div class="row mb-2">
 <div class="col-sm-6">
 <h1><i class="fas fa-comments mr-2"></i> Messages</h1>
 </div>
 <div class="col-sm-6">
 <ol class="breadcrumb float-sm-right">
 <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li>
 <li class="breadcrumb-item active">Messages</li>
 </ol>
 </div>
 </div>
 </div>
 </div>

 <section class="content">
 <div class="container-fluid">

 <?php if (session('role') == 'parent'): ?>
 <!-- ==================== PARENT CHAT ==================== -->
 <div class="row justify-content-center">
 <div class="col-lg-7 col-md-9">
 <div class="messages-card">
 <div class="chat-header">
                             Messages — School Office
 <small class="d-block">Messages are read by the school admin / staff.</small>
 </div>
 <div id="chatBody">
 <?php if (!empty($thread)): foreach ($thread as $m): ?>
 <?php $isMe = ($m['sender_role'] == 'parent' && (int)$m['sender_id'] === (int)session('user_id')); ?>
 <div class="msg-row <?= $isMe ? 'me' : 'them' ?>">
 <div>
 <div class="msg-bubble"><?= esc($m['message']) ?></div>
 <span class="msg-meta"><?= date('h:i A', strtotime($m['created_at'])) ?></span>
 </div>
 </div>
 <?php endforeach; else: ?>
 <div class="empty-chat">
 <i class="fas fa-comments fa-3x mb-3" style="color: rgba(108,140,255,0.30);"></i>
 <h5 style="font-weight: 700;">No messages yet</h5>
 <p class="mb-0">Hello! Send a message to the school office below. </p>
 </div>
 <?php endif; ?>
 </div>
 <div class="chat-input-bar">
 <form id="msgForm">
 <div class="input-group">
 <textarea id="msgText" class="form-control" rows="1" placeholder="Type your message..." required></textarea>
 <div class="input-group-append">
 <button class="btn" type="submit" id="msgSendBtn">
 <i class="fas fa-paper-plane"></i> Send
 </button>
 </div>
 </div>
 <div id="msgStatus" class="small mt-1" style="color: var(--muted);"></div>
 </form>
 </div>
 </div>
 </div>
 </div>

 <?php else: ?>
 <!-- ==================== OFFICE INBOX (ADMIN / STAFF) ==================== -->
 <div class="row">
 <div class="col-md-4 mb-3">
 <div class="messages-card">
 <div class="chat-header">
                             Conversations
 <small class="d-block">Askings from parents appear here.</small>
 </div>
 <div class="thread-list">
 <?php if (!empty($threads)): foreach ($threads as $t): ?>
 <div class="thread-item <?= (isset($selected_id) && $selected_id == $t['parent_id']) ? 'active' : '' ?>"
                                 data-pid="<?= $t['parent_id'] ?>">
 <div class="thread-avatar mr-3">
 <?= esc(strtoupper(substr($t['fname'],0,1) . substr($t['lname'],0,1))) ?>
 </div>
 <div class="flex-grow-1" style="min-width: 0;">
 <div class="d-flex justify-content-between align-items-center">
 <strong style="color: var(--ink);"><?= esc($t['fname']) ?> <?= esc($t['lname']) ?></strong>
 <?php if ($t['unread'] > 0): ?>
 <span class="unread-dot"><?= $t['unread'] ?> new</span>
 <?php endif; ?>
 </div>
 <div class="small text-truncate" style="color: var(--muted); max-width: 100%;">
 <?= esc($t['last_message']) ?>
 </div>
 <div class="small" style="color: #b0b0c8;">
 <?= esc($t['phone']) ?> · <?= date('M d, h:i A', strtotime($t['last_time'])) ?>
 </div>
 </div>
 </div>
 <?php endforeach; else: ?>
 <div class="empty-chat">
 <i class="fas fa-inbox fa-3x mb-3" style="color: rgba(108,140,255,0.30);"></i>
 <h5 style="font-weight: 700;">No conversations yet</h5>
 <p class="mb-0">Messages from parents will show up here.</p>
 </div>
 <?php endif; ?>
 </div>
 </div>
 </div>

 <div class="col-md-8 mb-3">
 <div class="messages-card">
 <div class="chat-header">
 <span id="chatTitle"><?= isset($selected) ? esc($selected['fname'] . ' ' . $selected['lname']) : 'Conversation' ?></span>
 <small class="d-block" id="chatSubtitle">
 <?= isset($selected) ? ' ' . esc($selected['phone']) : 'Select a conversation to read and reply.' ?>
 </small>
 </div>
 <div id="chatBody">
 <?php if (isset($selectedThread) && !empty($selectedThread)): ?>
 <?php foreach ($selectedThread as $m): ?>
 <?php $isMe = in_array($m['sender_role'], ['staff', 'admin']) && (int)$m['sender_id'] === (int)session('user_id'); ?>
 <div class="msg-row <?= $isMe ? 'me' : 'them' ?>">
 <div>
 <div class="msg-bubble"><?= esc($m['message']) ?></div>
 <span class="msg-meta">
 <?= $isMe ? 'You' : esc($selected['fname']) ?> · <?= date('h:i A', strtotime($m['created_at'])) ?>
 </span>
 </div>
 </div>
 <?php endforeach; ?>
 <?php else: ?>
 <div class="empty-chat">
 <i class="fas fa-comment-dots fa-3x mb-3" style="color: rgba(108,140,255,0.30);"></i>
 <h5 style="font-weight: 700;">Select a conversation</h5>
 <p class="mb-0">Choose a parent from the list to view and reply to their message.</p>
 </div>
 <?php endif; ?>
 </div>
 <div class="chat-input-bar <?= !isset($selected) ? 'd-none' : '' ?>" id="chatInputBar">
 <form id="msgForm">
 <div class="input-group">
 <textarea id="msgText" class="form-control" rows="1" placeholder="Type your reply..." required></textarea>
 <div class="input-group-append">
 <button class="btn" type="submit" id="msgSendBtn">
 <i class="fas fa-paper-plane"></i> Reply
 </button>
 </div>
 </div>
 <div id="msgStatus" class="small mt-1" style="color: var(--muted);"></div>
 </form>
 </div>
 </div>
 </div>
 </div>
 <?php endif; ?>

 </div>
 </section>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<?php $role = session('role'); ?>
<script>
(function() {
    var ROLE = <?= json_encode($role) ?>;
    var ME = <?= (int) session('user_id') ?>;
    var toParent = <?= isset($selected_id) ? (int) $selected_id : 'null' ?>;

    var chatBody = document.getElementById('chatBody');

    function scrollBottom() {
        if (chatBody) {
            chatBody.scrollTop = chatBody.scrollHeight;
        }
    }

    function bubbleHtml(m) {
        var isMe;
        if (ROLE === 'parent') {
            isMe = m.sender_role === 'parent' && Number(m.sender_id) === ME;
        } else {
            isMe = (m.sender_role === 'staff' || m.sender_role === 'admin') && Number(m.sender_id) === Number(<?= (int) session('user_id') ?>);
        }
        var label = isMe ? '' : (m.sender_role === 'staff' ? 'Staff' : (m.sender_role === 'admin' ? 'Admin' : ''));
        var meta = label ? (label + ' · ') : '';
        return '<div class="msg-row ' + (isMe ? 'me' : 'them') + '">' +
               '<div><div class="msg-bubble">' + escapeHtml(m.message) + '</div>' +
               '<span class="msg-meta">' + meta + timeStr(m.created_at) + '</span></div></div>';
    }

    function escapeHtml(s) {
        return String(s).replace(/[&<>"']/g, function(c) {
            return { '&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;' }[c];
        });
    }

    function timeStr(dt) {
        if (!dt) return '';
        var d = new Date(String(dt).replace(' ', 'T'));
        if (isNaN(d)) { return dt; }
        var h = d.getHours(), m = d.getMinutes();
        var ap = h >= 12 ? 'PM' : 'AM';
        h = h % 12; if (h === 0) h = 12;
        return h + ':' + (m < 10 ? '0' : '') + m + ' ' + ap;
    }

    function render(messages) {
        if (!chatBody) return;
        chatBody.innerHTML = '';
        if (!messages || !messages.length) {
            chatBody.innerHTML = '<div class="empty-chat"><i class="fas fa-comments fa-2x mb-2" style="color:rgba(108,140,255,0.30);"></i><p>No messages yet.</p></div>';
            return;
        }
        messages.forEach(function(m) { chatBody.innerHTML += bubbleHtml(m); });
        scrollBottom();
    }

    function setStatus(msg) {
        var s = document.getElementById('msgStatus');
        if (s) s.innerHTML = msg;
    }

    function sendMessage(ev) {
        ev.preventDefault();
        var textEl = document.getElementById('msgText');
        var text = textEl.value.trim();
        if (!text) return;
        setStatus('<i class="fas fa-spinner fa-spin"></i> Sending...');

        var body = new URLSearchParams();
        body.append('message', text);
        if (ROLE !== 'parent' && toParent) {
            body.append('to_parent', toParent);
        }

        fetch('/messages/send', {
            method: 'POST',
            headers: { 'X-Requested-With': 'XMLHttpRequest' },
            body: body
        }).then(function(r) { return r.json(); }).then(function(d) {
            if (d.success) {
                textEl.value = '';
                setStatus('');
                refreshThread();
                refreshBadges();
            } else {
                setStatus('<span style="color:' + (window.matchMedia && matchMedia('(prefers-color-scheme: dark)').matches ? '#f2a8b2' : '#d0394f') + ';">' + escapeHtml(d.message || 'Failed to send.') + '</span>');
            }
        }).catch(function() {
            setStatus('<span style="color:#d0394f;">Could not reach the server.</span>');
        });
    }

    function refreshThread() {
        var url;
        if (ROLE === 'parent') {
            url = '/messages/thread/' + ME;
        } else if (toParent) {
            url = '/messages/thread/' + toParent;
        } else {
            return;
        }
        fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
            .then(function(r) { return r.json(); })
            .then(function(d) {
                if (d.success) { render(d.messages); }
            }).catch(function() {});
    }

    function refreshBadges() {
        fetch('/messages/unread', { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
            .then(function(r) { return r.json(); })
            .then(function(d) {
                var n = (d && d.count) ? d.count : 0;
                document.querySelectorAll('.msg-badge').forEach(function(el) {
                    el.textContent = n;
                    el.style.display = n > 0 ? 'inline-block' : 'none';
                });
            }).catch(function() {});
    }

    // Office: click a parent thread on the left
    document.querySelectorAll('.thread-item').forEach(function(item) {
        item.addEventListener('click', function() {
            var pid = item.getAttribute('data-pid');
            window.location.href = '/messages?with=' + pid;
        });
    });

    var form = document.getElementById('msgForm');
    if (form) { form.addEventListener('submit', sendMessage); }

    scrollBottom();
    refreshBadges();
    setInterval(refreshBadges, 20000);
    setInterval(refreshThread, 12000);
})();
</script>
<?= $this->endSection() ?>