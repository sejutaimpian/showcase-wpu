<?php

use function Livewire\Volt\{state};

//

?>

<footer class="container mx-auto mt-4 bg-gray-800 rounded-lg shadow md:mt-8 md:mb-4">
    <div class="w-full px-6 py-4 mx-auto md:flex md:items-center md:justify-between">
        <span class="text-sm text-gray-100 sm:text-center dark:text-gray-400">© 2023
            <a href="https://github.com/sejutaimpian" class="hover:underline">Eris Sulistina</a>
        </span>
        <ul
            class="flex flex-wrap items-center gap-4 mt-3 text-sm font-medium text-gray-100 md:gap-6 dark:text-gray-400 sm:mt-0">
            <li>
                <a href="https://discord.gg/S4rrXQU" class="hover:underline">Discord/WPU</a>
            </li>
            <li>
                <a href="https://www.youtube.com/@sandhikagalihWPU" class="hover:underline">YT/WPU</a>
            </li>
            <li>
                <a href="https://github.com/sejutaimpian" class="hover:underline">Github/sejutaimpian</a>
            </li>
            <li>
                <a href="{{ route('login') }}" wire:navigate
                    class="inline-flex text-cyan-500 items-center justify-center rounded-lg font-medium lg:text-lg focus:outline-none px-2 lg:px-3 focus-visible:ring shadow-sm transition-colors duration-75 border border-cyan-600 hover:bg-cyan-600 hover:text-white active:bg-cyan-700 disabled:bg-cyan-700 focus-visible:ring-cyan-400 disabled:cursor-not-allowed;">Login</a>
            </li>
        </ul>
    </div>
</footer>
