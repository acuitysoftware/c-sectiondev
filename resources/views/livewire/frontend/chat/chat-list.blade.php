<div class="app-container">

    <!-- Sidebar Navigation -->
    <nav class="sidebar">


        <ul class="nav-menu">
            <li class="nav-item {{ $current_tab == '1' ? 'active' : '' }}" wire:click="changeTab(1);">
                <img src="{{ asset('public/frontend/images/n9.png') }}" width="20" alt="">
                <span>Home</span>
            </li>
            <li class="nav-item {{ $current_tab == '2' ? 'active' : '' }} " wire:click="changeTab(2);">
                <img src="{{ asset('public/frontend/images/n10.png') }}" width="20" alt="">
                <span>Ask Question</span>
            </li>
            <li class="nav-item {{ $current_tab == '3' ? 'active' : '' }}" wire:click="changeTab(3);">
                <img src="{{ asset('public/frontend/images/n11.png') }}" width="20" alt="">
                <span>My Questions</span>
            </li>
            <li class="nav-item {{ $current_tab == '4' ? 'active' : '' }}" wire:click="changeTab(4);">
                <img src="{{ asset('public/frontend/images/n12.png') }}" width="20" alt="">
                <span>Leaderboard</span>
            </li>
            <li class="nav-item {{ $current_tab == '5' ? 'active' : '' }}" wire:click="changeTab(5);">
                <img src="{{ asset('public/frontend/images/n13.png') }}" width="20" alt="">
                <span>Group Tests</span>
            </li>
            <li class="nav-item {{ $current_tab == '6' ? 'active' : '' }}" wire:click="changeTab(6);">
                <img src="{{ asset('public/frontend/images/n14.png') }}" width="20" alt="">
                <span>Profile</span>
            </li>
        </ul>
    </nav>
    @if ($current_tab == '1')
        <livewire:frontend.chat.chat-home :wire:key="'child-1'" />
    @elseif($current_tab == '2')
        <livewire:frontend.chat.chat-ask-question :wire:key="'child-2'" />
    @elseif($current_tab == '3')
        <livewire:frontend.chat.chat-my-question :wire:key="'child-3'" />
    @elseif($current_tab == '4')
        <livewire:frontend.chat.chat-leaderboard :wire:key="'child-4'" />
    @elseif($current_tab == '5')
        <livewire:frontend.chat.chat-group-test :wire:key="'child-5'" />
    @elseif($current_tab == '6')
        <livewire:frontend.chat.chat-profile :wire:key="'child-6'" />
    @endif

</div>
