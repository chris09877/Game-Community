<div>
    <nav class="fixed bg-gray-800 text-white flex flex-col h-screen text-center min-w-[250px] w-1/5">
        <!-- Logo -->
        <div class="flex top-0 left-0 items-center justify-center h-16 bg-gray-900">
            <img src="{{ asset('LogoPC.png') }}" alt="Logo" class="w-8 h-8">
        </div>

        <!-- Navigatiemenu van student -->
        <ul class="flex flex-col flex-grow">
            <li class="px-4 py-2 mb-2 hover:bg-gray-700">
                <a href="{{ route('dashboard') }}" class="block">
                </a>
            </li>
            <li class="px-4 py-2 mb-2 hover:bg-gray-700">
                <a href="{{ route('approvedProject') }}" class="block">
                    Projects
                </a>
            </li>

            
            <!--auth('')-->
           
            <!-- Voeg hier meer menu-items toe -->
            
        </ul>
    </nav>
</div>
       