@role('admin|amministratore')
@if (session('message') || session('error'))
<div x-data="{ show: true }" x-init="setTimeout(() => show = false, 5000)" x-show="show" x-transition.duration.500ms
    class="fixed bottom-10 right-10 p-5 bg-zinc-100 dark:bg-zinc-700 border dark:border-zinc-500 shadow-lg rounded-lg w-[350px] h-[100px] flex items-center">
    @if (session('message'))
    <div class="w-full text-zinc-500 dark:text-white text-medium text-sm flex flex-col justify-center items-center ">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="size-10">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
        </svg>
        {{ session('message')}}
    </div>
    @elseif(session('error'))
    <div class="w-full text-red-500 text-medium text-sm flex flex-col justify-center items-center">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="size-10">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
        </svg>
        {{ session('error') }}
    </div>
    @endif
</div>
@endif
@endrole

@role('admin|amministratore')
@if (session('messageMail') || session('errorMail'))
<div x-data="{ showMessageMail: true }" x-init="setTimeout(() => showMessageMail = false, 5000)"
    x-show="showMessageMail" x-transition.duration.500ms
    class="fixed bottom-40 right-10 p-5 bg-zinc-100 dark:bg-zinc-700 border dark:border-zinc-500 shadow-lg rounded-lg w-[350px] h-[100px] flex items-center">
    @if (session('messageMail'))
    <div class="w-full text-zinc-500 text-medium text-sm flex flex-col justify-center items-center">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="size-10">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
        </svg>
        {{ session('messageMail') }}
    </div>
    @elseif(session('errorMail'))
    <div class="w-full text-red-500 text-center text-medium text-sm flex flex-col justify-center items-center">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="size-10">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
        </svg>
        {{ session('errorMail') }}
    </div>
    @endif
</div>
@endif
@endrole