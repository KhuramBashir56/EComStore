<x-panel.menu-bar.menu-item href="{{ route('admin.dashboard') }}" :title="__('Dashboard')" :icon="__('dashboard')" :active="__('admin.dashboard')" />
{{-- <x-panel.menu-bar.heading :title="__('Orders Management')" />
<x-panel.menu-bar.menu-item href="{{ route('dashboard') }}" :title="__('Orders')" :icon="__('list_alt')" :active="__('bia')" />
<x-panel.menu-bar.menu-item href="{{ route('dashboard') }}" :title="__('Order Tracking')" :icon="__('account_tree')" :active="__('bia')" /> --}}
<x-panel.menu-bar.heading :title="__('Product Management')" />
<x-panel.menu-bar.menu-item href="{{ route('admin.products.units') }}" :title="__('Units')" :icon="__('bia')" :active="__('admin.products.units')" />
<x-panel.menu-bar.menu-item href="{{ route('admin.products.brands.list') }}" :title="__('Brands')" :icon="__('brand_family')" :active="__('admin.products.brands.*')" />
<x-panel.menu-bar.menu-item href="{{ route('dashboard') }}" :title="__('Categories')" :icon="__('category')" :active="__('category')" />
<x-panel.menu-bar.menu-item href="{{ route('admin.products.sub_categories.list') }}" :title="__('Sub Categories')" :icon="__('linked_services')" :active="__('admin.products.sub_categories.*')" />
<x-panel.menu-bar.menu-item href="{{ route('dashboard') }}" :title="__('Products')" :icon="__('widgets')" :active="__('category')" />
{{-- <x-panel.menu-bar.heading :title="__('Reports')" />
<x-panel.menu-bar.menu-item href="{{ route('dashboard') }}" :title="__('Invoices')" :icon="__('receipt_long')" :active="__('category')" />
<x-panel.menu-bar.menu-item href="{{ route('dashboard') }}" :title="__('Transactions')" :icon="__('schedule')" :active="__('category')" /> --}}
<x-panel.menu-bar.heading :title="__('User Management')" />
<x-panel.menu-bar.menu-item href="{{ route('admin.products.users.add') }}" :title="__('Add New Users')" :icon="__('group_add')" :active="__('admin.products.users.add')" />
<x-panel.menu-bar.menu-item href="{{ route('admin.products.users.list') }}" :title="__('Users')" :icon="__('groups')" :active="__('admin.products.users.list')" />
{{-- <x-panel.menu-bar.menu-item href="{{ route('dashboard') }}" :title="__('Messages')" :icon="__('mail')" :active="__('category')" />
<x-panel.menu-bar.menu-item href="{{ route('dashboard') }}" :title="__('Departments')" :icon="__('trip_origin')" :active="__('category')" />
<x-panel.menu-bar.menu-item href="{{ route('dashboard') }}" :title="__('Roles')" :icon="__('supervisor_account')" :active="__('category')" /> --}}
<x-panel.menu-bar.menu-item href="{{ route('admin.products.users.news_letter_subscribers') }}" :title="__('News Letter Subscribers')" :icon="__('subscriptions')" :active="__('admin.products.users.news_letter_subscribers')" />
