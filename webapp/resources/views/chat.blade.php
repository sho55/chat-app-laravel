<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Chat with ') }} {{ $user->name }}
        </h2>
    </x-slot>

    <div class="container">
        <div class="flex flex-row justify-center">
            <div class="w-2/3 max-w-md">
                <div class="bg-white rounded-lg shadow p-4">
                    <div class="chat-container">
                        @foreach ($messages as $message)
                        @if ($message->user_id === auth()->id())
                        <div class="self-message mb-4">
                            <div class="flex items-end justify-end">
                                <div class="flex-shrink-0 bg-blue-500 text-white rounded-lg py-2 px-4">
                                    <p class="text-sm">{{ $message->message }}</p>
                                </div>
                            </div>
                            <div class="ml-2 text-xs text-gray-500 text-right">{{ $message->created_at->format('Y年m月d日 H:i') }}</div>
                        </div>
                        @else
                        <div class="other-message mb-4">
                            <div class="flex items-end">
                                <div class="flex-shrink-0 bg-gray-100 rounded-lg py-2 px-4">
                                    <p class="text-sm">{{ $message->message }}</p>
                                </div>
                            </div>
                            <div class="ml-2 text-xs text-gray-500">{{ $message->created_at->format('Y年m月d日 H:i') }}</div>
                        </div>
                        @endif
                        @endforeach
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow p-4 mt-4">
                    <form method="POST" action="{{ route('chat.send', $user) }}">
                        @csrf
                        <div class="form-group flex flex-wrap">
                            <button type="button" class="text-2xl pr-2 focus:outline-none" onclick="insertEmoji('😀')">
                                😀
                            </button>
                            <button type="button" class="text-2xl pr-2 focus:outline-none" onclick="insertEmoji('😆')">
                                😆
                            </button>
                            <button type="button" class="text-2xl pr-2 focus:outline-none" onclick="insertEmoji('😍')">
                                😍
                            </button>
                            <button type="button" class="text-2xl pr-2 focus:outline-none" onclick="insertEmoji('👋')">
                                👋
                            </button>
                            <button type="button" class="text-2xl pr-2 focus:outline-none" onclick="insertEmoji('🤔')">
                                🤔
                            </button>
                            <div class="w-full">
                                <textarea id="message" name="message" class="w-full px-3 py-2 border rounded-lg" rows="4"
                                    placeholder="{{ __('メッセージを入力') }}"></textarea>
                            </div>
                        </div>
                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-4">
                            {{ __('送信') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<script>
    function insertEmoji(emoji) {
        document.getElementById('message').value += emoji;
    }
</script>


<script src="https://js.pusher.com/7.2/pusher.min.js"></script>
<script>
    Pusher.logToConsole = true;

    var pusher = new Pusher('4a6171e9e97d3edc2951', {
        cluster: 'ap3'
    });

    var channel = pusher.subscribe('my-channel');
   channel.bind('my-event', function(data) {
var chatContainer = document.querySelector('.chat-container');
var lastChild = chatContainer.lastElementChild;

var divMessage = document.createElement('div');
divMessage.classList.add('other-message', 'mb-4');

var divFlex = document.createElement('div');
divFlex.classList.add('flex', 'items-end');

var divFlexShrink = document.createElement('div');
divFlexShrink.classList.add('flex-shrink-0', 'bg-gray-100', 'rounded-lg', 'py-2', 'px-4');

var p = document.createElement('p');
p.classList.add('text-sm');
p.textContent = data.chat.message;

divFlexShrink.appendChild(p);
divFlex.appendChild(divFlexShrink);
divMessage.appendChild(divFlex);

var divDate = document.createElement('div');
divDate.classList.add('ml-2', 'text-xs', 'text-gray-500');
divDate.textContent = moment(data.chat.created_at).format('YYYY-MM-DD h:mm');

divMessage.appendChild(divDate);
chatContainer.insertBefore(divMessage, lastChild.nextSibling);
});
</script>
</x-app-layout>
