<!DOCTYPE html>
<html lang="es" data-bs-theme="dark">
    <head>
        @include('layouts.partial.head')
    </head>
<body>
         <div id="app" class="app {{ (!empty($appClass)) ? $appClass : '' }}">
         @include('layouts.partial.header')
         @includeWhen(false, 'layouts.partial.sidebar')
         @includeWhen(true, 'layouts.partial.menu_lateral')
   <!--
<div  class="app-top-nav">
    <div class="menu">
    <div class="menu-item">
    <a href="index.html" class="menu-link">
    <span class="menu-icon"><i class="fa fa-laptop"></i></span>
    <span class="menu-text">Dashboard</span>
    </a>
    </div>
    <div class="menu-item">
    <a href="analytics.html" class="menu-link">
    <span class="menu-icon"><i class="fa fa-chart-pie"></i></span>
    <span class="menu-text">Analytics</span>
    </a>
    </div>
    <div class="menu-item has-sub">
    <a href="#" class="menu-link">
    <span class="menu-icon">
    <i class="fa fa-envelope"></i>
    <span class="menu-icon-label">6</span>
    </span>
    <span class="menu-text">Email</span>
    <span class="menu-caret"><b class="caret"></b></span>
    </a>
    <div class="menu-submenu">
    <div class="menu-item">
    <a href="email_inbox.html" class="menu-link">
    <span class="menu-text">Inbox</span>
    </a>
    </div>
    <div class="menu-item">
    <a href="email_compose.html" class="menu-link">
    <span class="menu-text">Compose</span>
    </a>
    </div>
    <div class="menu-item">
    <a href="email_detail.html" class="menu-link">
    <span class="menu-text">Detail</span>
    </a>
    </div>
    </div>
    </div>
    <div class="menu-item">
    <a href="widgets.html" class="menu-link">
    <span class="menu-icon"><i class="fa fa-qrcode"></i></span>
    <span class="menu-text">Widgets</span>
    </a>
    </div>
    <div class="menu-item has-sub">
    <a href="javascript:;" class="menu-link">
    <div class="menu-icon">
    <i class="fa fa-wallet"></i>
    </div>
    <div class="menu-text d-flex align-items-center">POS System</div>
    <span class="menu-caret"><b class="caret"></b></span>
    </a>
    <div class="menu-submenu">
    <div class="menu-item">
    <a href="pos_customer_order.html" target="_blank" class="menu-link">
    <div class="menu-text">Customer Order</div>
    </a>
    </div>
    <div class="menu-item">
    <a href="pos_kitchen_order.html" target="_blank" class="menu-link">
    <div class="menu-text">Kitchen Order</div>
    </a>
    </div>
    <div class="menu-item">
    <a href="pos_counter_checkout.html" target="_blank" class="menu-link">
    <div class="menu-text">Counter Checkout</div>
    </a>
    </div>
    <div class="menu-item">
    <a href="pos_table_booking.html" target="_blank" class="menu-link">
    <div class="menu-text">Table Booking</div>
    </a>
    </div>
    <div class="menu-item">
    <a href="pos_menu_stock.html" target="_blank" class="menu-link">
    <div class="menu-text">Menu Stock</div>
    </a>
    </div>
    </div>
    </div>
    <div class="menu-item has-sub">
    <a href="#" class="menu-link">
    <span class="menu-icon"><i class="fa fa-heart"></i></span>
    <span class="menu-text">UI Kits</span>
    <span class="menu-caret"><b class="caret"></b></span>
    </a>
    <div class="menu-submenu">
    <div class="menu-item">
    <a href="ui_bootstrap.html" class="menu-link">
    <span class="menu-text">Bootstrap</span>
    </a>
    </div>
    <div class="menu-item">
    <a href="ui_buttons.html" class="menu-link">
    <span class="menu-text">Buttons</span>
    </a>
    </div>
    <div class="menu-item">
    <a href="ui_card.html" class="menu-link">
    <span class="menu-text">Card</span>
    </a>
    </div>
    <div class="menu-item">
    <a href="ui_icons.html" class="menu-link">
    <span class="menu-text">Icons</span>
    </a>
    </div>
    <div class="menu-item">
    <a href="ui_modal_notification.html" class="menu-link">
    <span class="menu-text">Modal & Notification</span>
    </a>
    </div>
    <div class="menu-item">
    <a href="ui_typography.html" class="menu-link">
    <span class="menu-text">Typography</span>
    </a>
    </div>
    <div class="menu-item">
    <a href="ui_tabs_accordions.html" class="menu-link">
    <span class="menu-text">Tabs & Accordions</span>
    </a>
    </div>
    </div>
    </div>
    <div class="menu-item has-sub">
    <a href="#" class="menu-link">
    <span class="menu-icon"><i class="fa fa-file-alt"></i></span>
    <span class="menu-text">Forms</span>
    <span class="menu-caret"><b class="caret"></b></span>
    </a>
    <div class="menu-submenu">
    <div class="menu-item">
    <a href="form_elements.html" class="menu-link">
    <span class="menu-text">Form Elements</span>
    </a>
    </div>
    <div class="menu-item">
    <a href="form_plugins.html" class="menu-link">
    <span class="menu-text">Form Plugins</span>
    </a>
    </div>
    <div class="menu-item">
    <a href="form_wizards.html" class="menu-link">
    <span class="menu-text">Wizards</span>
    </a>
    </div>
    </div>
    </div>
    <div class="menu-item has-sub">
    <a href="#" class="menu-link">
    <span class="menu-icon"><i class="fa fa-table"></i></span>
    <span class="menu-text">Tables</span>
    <span class="menu-caret"><b class="caret"></b></span>
    </a>
    <div class="menu-submenu">
    <div class="menu-item">
    <a href="table_elements.html" class="menu-link">
    <span class="menu-text">Table Elements</span>
    </a>
    </div>
    <div class="menu-item">
    <a href="table_plugins.html" class="menu-link">
    <span class="menu-text">Table Plugins</span>
    </a>
    </div>
    </div>
    </div>
    <div class="menu-item has-sub">
    <a href="#" class="menu-link">
    <span class="menu-icon"><i class="fa fa-chart-bar"></i></span>
    <span class="menu-text">Charts</span>
    <span class="menu-caret"><b class="caret"></b></span>
    </a>
    <div class="menu-submenu">
    <div class="menu-item">
    <a href="chart_js.html" class="menu-link">
    <span class="menu-text">Chart.js</span>
    </a>
    </div>
    <div class="menu-item">
    <a href="chart_apex.html" class="menu-link">
    <span class="menu-text">Apexcharts.js</span>
    </a>
    </div>
    </div>
    </div>
    <div class="menu-item">
    <a href="map.html" class="menu-link">
    <span class="menu-icon"><i class="fa fa-map-marker-alt"></i></span>
    <span class="menu-text">Map</span>
    </a>
    </div>
    <div class="menu-item has-sub active">
    <a href="#" class="menu-link">
    <span class="menu-icon"><i class="fa fa-code-branch"></i></span>
    <span class="menu-text">Layout</span>
    <span class="menu-caret"><b class="caret"></b></span>
    </a>
    <div class="menu-submenu">
    <div class="menu-item">
    <a href="layout_starter.html" class="menu-link">
    <span class="menu-text">Starter Page</span>
    </a>
    </div>
    <div class="menu-item">
    <a href="layout_fixed_footer.html" class="menu-link">
    <span class="menu-text">Fixed Footer</span>
    </a>
    </div>
    <div class="menu-item">
    <a href="layout_full_height.html" class="menu-link">
    <span class="menu-text">Full Height</span>
    </a>
    </div>
    <div class="menu-item">
    <a href="layout_full_width.html" class="menu-link">
    <span class="menu-text">Full Width</span>
    </a>
    </div>
    <div class="menu-item">
    <a href="layout_boxed_layout.html" class="menu-link">
    <span class="menu-text">Boxed Layout</span>
    </a>
    </div>
    <div class="menu-item">
    <a href="layout_minified_sidebar.html" class="menu-link">
    <span class="menu-text">Minified Sidebar</span>
    </a>
    </div>
    <div class="menu-item active">
    <a href="layout_top_nav.html" class="menu-link">
    <span class="menu-text">Top Nav</span>
    </a>
    </div>
    <div class="menu-item">
    <a href="layout_mixed_nav.html" class="menu-link">
    <span class="menu-text">Mixed Nav</span>
    </a>
    </div>
    <div class="menu-item">
    <a href="layout_mixed_nav_boxed_layout.html" class="menu-link">
    <span class="menu-text">Mixed Nav Boxed Layout</span>
    </a>
    </div>
    </div>
    </div>
    <div class="menu-item has-sub">
    <a href="#" class="menu-link">
    <span class="menu-icon"><i class="fa fa-globe"></i></span>
    <span class="menu-text">Pages</span>
    <span class="menu-caret"><b class="caret"></b></span>
    </a>
    <div class="menu-submenu">
    <div class="menu-item">
    <a href="page_scrum_board.html" class="menu-link">
    <span class="menu-text">Scrum Board</span>
    </a>
    </div>
    <div class="menu-item">
    <a href="page_products.html" class="menu-link">
    <span class="menu-text">Products</span>
    </a>
    </div>
    <div class="menu-item">
    <a href="page_product_details.html" class="menu-link">
    <span class="menu-text">Product Details</span>
    </a>
    </div>
    <div class="menu-item">
    <a href="page_orders.html" class="menu-link">
    <span class="menu-text">Orders</span>
    </a>
    </div>
    <div class="menu-item">
    <a href="page_order_details.html" class="menu-link">
    <span class="menu-text">Order Details</span>
    </a>
    </div>
    <div class="menu-item">
    <a href="page_gallery.html" class="menu-link">
    <span class="menu-text">Gallery</span>
    </a>
    </div>
    <div class="menu-item">
    <a href="page_search_results.html" class="menu-link">
    <span class="menu-text">Search Results</span>
    </a>
    </div>
    <div class="menu-item">
    <a href="page_coming_soon.html" class="menu-link">
    <span class="menu-text">Coming Soon Page</span>
    </a>
    </div>
    <div class="menu-item">
    <a href="page_404_error.html" class="menu-link">
    <span class="menu-text">404 Error Page</span>
    </a>
    </div>
    <div class="menu-item">
    <a href="page_login.html" class="menu-link">
    <span class="menu-text">Login</span>
    </a>
    </div>
    <div class="menu-item">
    <a href="page_register.html" class="menu-link">
    <span class="menu-text">Register</span>
    </a>
    </div>
    <div class="menu-item">
    <a href="page_messenger.html" class="menu-link">
    <span class="menu-text">Messenger</span>
    </a>
    </div>
    <div class="menu-item">
    <a href="page_data_management.html" class="menu-link">
    <span class="menu-text">Data Management</span>
    </a>
    </div>
    </div>
    </div>
    <div class="menu-item">
    <a href="profile.html" class="menu-link">
    <span class="menu-icon"><i class="fa fa-user-circle"></i></span>
    <span class="menu-text">Profile</span>
    </a>
    </div>
    <div class="menu-item">
    <a href="calendar.html" class="menu-link">
    <span class="menu-icon"><i class="fa fa-calendar"></i></span>
    <span class="menu-text">Calendar</span>
    </a>
    </div>
    <div class="menu-item">
    <a href="settings.html" class="menu-link">
    <span class="menu-icon"><i class="fa fa-cog"></i></span>
    <span class="menu-text">Settings</span>
    </a>
    </div>
    <div class="menu-item">
    <a href="helper.html" class="menu-link">
    <span class="menu-icon"><i class="fa fa-question-circle"></i></span>
    <span class="menu-text">Helper</span>
    </a>
    </div>
    <div class="menu-item menu-control menu-control-start">
    <a href="javascript:;" class="menu-link" data-toggle="top-nav-prev"><i class="fa fa-chevron-left"></i></a>
    </div>
    <div class="menu-item menu-control menu-control-end">
    <a href="javascript:;" class="menu-link" data-toggle="top-nav-next"><i class="fa fa-chevron-right"></i></a>
    </div>
    </div>
    
    </div>
-->
    
         @include('layouts.partial.tablero')
         @include('layouts.partial.scripts')
</body>
</html>