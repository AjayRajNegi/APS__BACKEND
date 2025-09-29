<!-- Header -->
<div class="relative z-10 p-6 border-b border-neutral-700">
    <span class="px-3 py-1 bg-neutral-700/80 rounded-full text-xs text-neutral-300 mb-3 inline-block">CONTROL PANEL</span>
    <h2 class="heading-font text-2xl text-white">Settings</h2>
    <div class="h-1 w-12 bg-neutral-400 mt-2 rounded-full"></div>
</div>

<!-- Navigation -->
<nav class="relative z-10 p-6 flex-1 space-y-2">
    {{-- Example nav items --}}
    <a href="{{ route('submit-blog') }}"
       class="flex items-center px-4 py-3 {{ request()->routeIs('admin.blogs.*') ? 'bg-neutral-700/50 text-white border border-neutral-600/50' : 'text-neutral-300 hover:text-white hover:bg-neutral-700/30 rounded-lg transition' }}">
        <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd"
                  d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"></path>
        </svg>
        Post Blogs
    </a>

    {{-- <a href="{{ route('submit-blog') }}"
       class="flex items-center px-4 py-3 {{ request()->routeIs('admin.chat.*') ? 'bg-neutral-700/50 text-white border border-neutral-600/50' : 'text-neutral-300 hover:text-white hover:bg-neutral-700/30 rounded-lg transition' }}">
        <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd"
                  d="M5 3a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2V5a2 2 0 00-2-2H5zm3 4h4a1 1 0 010 2H8a1 1 0 110-2z"
                  clip-rule="evenodd"></path>
        </svg>
        Inquiries
    </a> --}}
</nav>

<!-- Account Status & Logout -->
<div
    class="absolute bottom-6 left-6 bg-neutral-800/80 backdrop-blur-sm rounded-lg px-4 py-3 z-10 border border-neutral-700 w-[calc(100%-3rem)]">
    <div class="text-xs text-neutral-400 mb-1">Account Status</div>
    <div class="heading-font text-sm text-green-400 flex items-center mb-3">
        <div class="w-2 h-2 bg-green-400 rounded-full mr-2"></div>
        Active
    </div>
    <form method="POST" action="{{ route('admin.logout') }}">
        @csrf
        <button type="submit"
                class="w-full bg-indigo-800 hover:bg-indigo-900 border-white/30 border-[0.5px] text-white text-sm px-4 py-2 rounded-lg">
            Logout
        </button>
    </form>
</div>
