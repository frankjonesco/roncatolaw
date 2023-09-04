<nav class="border-b border-b-gray-200 bg-white fixed w-screen top-0 z-40">
    <div class="container">
        <ul class="w-full flex justify-between items-center text-3xl">
            <li class="w-1/4">
                <a href="#" id="openMenuIcon">
                    <i class="fa-solid fa-bars" id="menuBars"></i>
                </a>
            </li>
            <li class="w-1/2 text-center">
                <a href="/" class="site-logo">
                    Roncato Law.
                </a>
            </li>
            <li class="w-1/4">
                <ul class="flex flex-row gap-10 justify-end">
                    <li>
                        <a href="#" id="toggleSearchIcon">
                            <i class="fa-solid fa-search"></i>
                        </a>
                    </li>
                    @auth
                        <li>
                            <a href="/profile" id="toggleSearchIcon">
                                <i class="fa-solid fa-user"></i>
                            </a>
                        </li>
                        <li>
                            <a href="/dashboard" id="toggleSearchIcon">
                                <i class="fa-solid fa-dashboard"></i>
                            </a>
                        </li>
                    @endauth
                </ul>
            </li>
        </ul>
    </div>
</nav>



<div id="slideMenu" class="-left-1/4">
    <div class="flex justify-between p-6 bg-gray-900 text-white">
        <div class="menu-heading">Menu</div>
        <a href="#" id="closeMenuIcon" class="text-3xl hover:text-2xl !text-white flex justify-center items-center transition-all duration-150 ease-in hover:bg-yellow-300 hover:!text-gray-900 w-9 aspect-square rounded-full no-underline">
            <i class="fa-solid fa-times"></i>
        </a>
    </div>
    <ul>
        <li>
            <a href="/" id="homeBtn">Home</a>
        </li>
        <li>
            
            <a href="#" class="dropdown" rel="submenuAbout">About us <i class="fa fa-caret-down text-right"></i></a>
            <ul id="submenuAbout" class="submenu opacity-0 h-0 -translate-y-2/3">
                <li class="hover:!bg-sky-100 leading-300">
                    <a href="/about">Company</a>
                </li>
                <li>
                    <a href="/">Our partners</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="/articles">News</a>
        </li>
        <li>
            <a href="/services">Services</a>
        </li>
        <li>
            <a href="/testimonials">Testionials</a>
        </li>
        <li>
            <a href="/contact">Contact</a>
        </li>
        
        @auth
            <li>
                <a href="/dashboard">Dashboard</a>
            </li>
            <li>
                <a href="/profile">Profile</a>
            </li>
            <li>
                <form action="/logout" class="inline" method="POST">
                    @csrf
                    <a href="#" onclick="this.parentNode.submit()" class="py-3 px-3 mx-2 ">Logout</a>
                </form>
                
            </li>
        @else
            <li>
                <a href="/signup">Sign up</a>
            </li>
            <li>
                <a href="/login">Log in</a>
            </li>
        @endauth
    </ul>
</div>

<script>

let dropdown = document.querySelector('.dropdown');

dropdown.addEventListener("click", function(e){
    e.preventDefault();
    menuItem = e.target.rel;
    showSubMenu(menuItem);
    this.classList.toggle('bg-yellow-50');
    this.classList.toggle('hover:!bg-yellow-50');
    this.classList.toggle('text-gray-900');
    this.classList.toggle('hover:!text-gray-900');
    this.classList.toggle('hover:!no-underline');
    this.classList.toggle('border-b-2');
    this.classList.toggle('border-b-gray-300');

});

function showSubMenu(menuItem){
    let submenu = document.getElementById(menuItem);
    submenu.classList.toggle('h-0');
    submenu.classList.toggle('opacity-0');
    submenu.classList.toggle('-translate-y-2/3');
}

    
</script>


