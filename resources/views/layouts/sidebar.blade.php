<!-- Sidebar -->
<div class="hidden lg:flex w-sidebar bg-white border-r border-gray-200 fixed h-screen flex-col pt-6 z-40">
    <!-- Navigation Menu -->
    <nav class="flex-1 px-4 space-y-2 overflow-y-auto">
        <!-- Dashboard -->
        <a href="{{ route('dashboard') }}"
           class="flex items-center gap-3 px-4 py-3 rounded-md transition-all duration-150 {{ request()->routeIs('dashboard') ? 'bg-primary-50 text-primary-600 font-semibold' : 'text-gray-700 hover:bg-gray-50' }}">
            <span class="text-lg">📊</span>
            <span>Dashboard</span>
        </a>

        <!-- Products -->
        <a href="{{ route('products.index') }}"
           class="flex items-center gap-3 px-4 py-3 rounded-md transition-all duration-150 {{ request()->routeIs('products.*') ? 'bg-primary-50 text-primary-600 font-semibold' : 'text-gray-700 hover:bg-gray-50' }}">
            <span class="text-lg">📦</span>
            <span>Products</span>
        </a>

        <!-- Inventory -->
        <a href="{{ route('inventory.index') }}"
           class="flex items-center gap-3 px-4 py-3 rounded-md transition-all duration-150 {{ request()->routeIs('inventory.*') ? 'bg-primary-50 text-primary-600 font-semibold' : 'text-gray-700 hover:bg-gray-50' }}">
            <span class="text-lg">📋</span>
            <span>Inventory</span>
        </a>

        <!-- Admin Only Section -->
        @if(auth()->user()->role === 'admin')
            <div class="pt-4">
                <div class="px-4 py-2 text-xs font-semibold text-gray-400 uppercase tracking-wider">Admin</div>

                <!-- Categories -->
                <a href="{{ route('categories.index') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-md transition-all duration-150 {{ request()->routeIs('categories.*') ? 'bg-primary-50 text-primary-600 font-semibold' : 'text-gray-700 hover:bg-gray-50' }}">
                    <span class="text-lg">🏷️</span>
                    <span>Categories</span>
                </a>

                <!-- Suppliers -->
                <a href="{{ route('suppliers.index') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-md transition-all duration-150 {{ request()->routeIs('suppliers.*') ? 'bg-primary-50 text-primary-600 font-semibold' : 'text-gray-700 hover:bg-gray-50' }}">
                    <span class="text-lg">🏢</span>
                    <span>Suppliers</span>
                </a>

                <!-- Reports -->
                <a href="{{ route('reports.index') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-md transition-all duration-150 {{ request()->routeIs('reports.*') ? 'bg-primary-50 text-primary-600 font-semibold' : 'text-gray-700 hover:bg-gray-50' }}">
                    <span class="text-lg">📈</span>
                    <span>Reports</span>
                </a>
            </div>
        @endif
    </nav>

    <!-- Footer -->
    <div class="border-t border-gray-200 px-4 py-4">
        <div class="bg-primary-50 rounded-lg p-4">
            <div class="text-xs font-semibold text-primary-600 mb-2">📌 TIP</div>
            <p class="text-xs text-gray-600">Check low stock items regularly to maintain optimal inventory levels.</p>
        </div>
    </div>
</div>

<!-- Mobile Menu Toggle (if needed for responsive) -->
<script>
    // Optional: Add mobile responsiveness toggle if needed
</script>
