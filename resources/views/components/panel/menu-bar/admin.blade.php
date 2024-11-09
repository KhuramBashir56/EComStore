<x-panel.menu-bar.menu-item href="{{ route('admin.dashboard') }}" :title="__('Dashboard')" :icon="__('dashboard')" :active="__('admin.dashboard')" />
{{-- <x-panel.menu-bar.heading :title="__('Orders Management')" />
<x-panel.menu-bar.menu-item href="{{ route('dashboard') }}" :title="__('Orders')" :icon="__('list_alt')" :active="__('bia')" />
<x-panel.menu-bar.menu-item href="{{ route('dashboard') }}" :title="__('Order Tracking')" :icon="__('account_tree')" :active="__('bia')" /> --}}
<x-panel.menu-bar.heading :title="__('Product Management')" />
<x-panel.menu-bar.menu-item href="{{ route('admin.products.units.list') }}" :title="__('Units')" :icon="__('bia')" :active="__('admin.products.units.list')" />
<x-panel.menu-bar.menu-item href="{{ route('dashboard') }}" :title="__('Brands')" :icon="__('brand_family')" :active="__('category')" />
<x-panel.menu-bar.menu-item href="{{ route('dashboard') }}" :title="__('Categories')" :icon="__('category')" :active="__('category')" />
<x-panel.menu-bar.menu-item href="{{ route('dashboard') }}" :title="__('Sub Categories')" :icon="__('linked_services')" :active="__('category')" />
<x-panel.menu-bar.menu-item href="{{ route('dashboard') }}" :title="__('Products')" :icon="__('widgets')" :active="__('category')" />
{{-- <x-panel.menu-bar.heading :title="__('Reports')" />
<x-panel.menu-bar.menu-item href="{{ route('dashboard') }}" :title="__('Invoices')" :icon="__('receipt_long')" :active="__('category')" />
<x-panel.menu-bar.menu-item href="{{ route('dashboard') }}" :title="__('Transactions')" :icon="__('schedule')" :active="__('category')" />
<x-panel.menu-bar.heading :title="__('User Management')" />
<x-panel.menu-bar.menu-item href="{{ route('dashboard') }}" :title="__('Add New Users')" :icon="__('group_add')" :active="__('category')" />
<x-panel.menu-bar.menu-item href="{{ route('dashboard') }}" :title="__('Users')" :icon="__('groups')" :active="__('category')" />
<x-panel.menu-bar.menu-item href="{{ route('dashboard') }}" :title="__('Messages')" :icon="__('mail')" :active="__('category')" />
<x-panel.menu-bar.menu-item href="{{ route('dashboard') }}" :title="__('Departments')" :icon="__('trip_origin')" :active="__('category')" />
<x-panel.menu-bar.menu-item href="{{ route('dashboard') }}" :title="__('Roles')" :icon="__('supervisor_account')" :active="__('category')" /> --}}
