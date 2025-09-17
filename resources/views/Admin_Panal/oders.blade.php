<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Management - Modern Bootstrap Admin</title>
    
    <!-- SEO Meta Tags -->
    <meta name="description" content="Comprehensive order management with tracking, fulfillment, and analytics">
    <meta name="keywords" content="bootstrap, admin, dashboard, orders, e-commerce, tracking">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.13.1/font/bootstrap-icons.min.css" integrity="sha512-t7Few9xlddEmgd3oKZQahkNI4dS6l80+eGEzFQiqtyVYdvcSG2D3Iub77R20BdotfRPA9caaRkg1tyaJiPmO0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="./assets/favicon-CvUZKS4z.svg">
    <link rel="icon" type="image/png" href="./assets/favicon-B_cwPWBd.png">
    
    <!-- PWA Manifest -->
    <link rel="manifest" href="./assets/manifest-DTaoG9pG.json">
    
    <!-- Preload critical fonts -->
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" as="style">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- ApexCharts CDN -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>  <script type="module" crossorigin src="./assets/main-BPhDq89w.js"></script>
  <script type="module" crossorigin src="./assets/orders-BCZLXwp9.js"></script>
  <link rel="stylesheet" crossorigin href="./assets/main-D9K-blpF.css">
</head>

<body data-page="orders" class="order-management">
    <!-- Admin App Container -->
    <div class="admin-app">
        <div class="admin-wrapper" id="admin-wrapper">
            
            @include("layout.navbar");

            <!-- Main Content -->
            <main class="admin-main">
                <div class="container-fluid p-4 p-lg-5">
                    
                    <!-- Page Header -->
                    <div class="d-flex justify-content-between align-items-center mb-4 mb-lg-5">
                        <div>
                            <h1 class="h3 mb-0">Order Management</h1>
                            <p class="text-muted mb-0">Track orders, manage fulfillment, and analyze sales</p>
                        </div>
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-outline-secondary" @click="exportOrders()">
                                <i class="bi bi-download me-2"></i>Export
                            </button>
                            <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#bulkUpdateModal">
                                <i class="bi bi-arrow-repeat me-2"></i>Bulk Update
                            </button>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#orderModal">
                                <i class="bi bi-plus-lg me-2"></i>New Order
                            </button>
                        </div>
                    </div>

                    <!-- Order Management Container -->
                    <div x-data="orderTable" x-init="init()">
                        
                        <!-- Order Stats Widgets -->
                        <div class="row g-4 g-lg-5 mb-5">
                            <div class="col-xl-3 col-lg-6">
                                <div class="card stats-card">
                                    <div class="card-body p-3 p-lg-4">
                                        <div class="d-flex align-items-center">
                                            <div class="stats-icon bg-primary bg-opacity-10 text-primary me-3">
                                                <i class="bi bi-bag-check"></i>
                                            </div>
                                            <div>
                                                <h6 class="mb-0 text-muted">Total Orders</h6>
                                                <h3 class="mb-0" x-text="stats.total"></h3>
                                                <small class="text-success">
                                                    <i class="bi bi-arrow-up"></i> +12% from last month
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-6">
                                <div class="card stats-card">
                                    <div class="card-body p-3 p-lg-4">
                                        <div class="d-flex align-items-center">
                                            <div class="stats-icon bg-warning bg-opacity-10 text-warning me-3">
                                                <i class="bi bi-clock"></i>
                                            </div>
                                            <div>
                                                <h6 class="mb-0 text-muted">Pending</h6>
                                                <h3 class="mb-0" x-text="stats.pending"></h3>
                                                <small class="text-warning">
                                                    <i class="bi bi-exclamation-circle"></i> Needs attention
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-6">
                                <div class="card stats-card">
                                    <div class="card-body p-3 p-lg-4">
                                        <div class="d-flex align-items-center">
                                            <div class="stats-icon bg-info bg-opacity-10 text-info me-3">
                                                <i class="bi bi-truck"></i>
                                            </div>
                                            <div>
                                                <h6 class="mb-0 text-muted">Shipped</h6>
                                                <h3 class="mb-0" x-text="stats.shipped"></h3>
                                                <small class="text-info">
                                                    <i class="bi bi-arrow-right"></i> In transit
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-6">
                                <div class="card stats-card">
                                    <div class="card-body p-3 p-lg-4">
                                        <div class="d-flex align-items-center">
                                            <div class="stats-icon bg-success bg-opacity-10 text-success me-3">
                                                <i class="bi bi-currency-dollar"></i>
                                            </div>
                                            <div>
                                                <h6 class="mb-0 text-muted">Revenue</h6>
                                                <h3 class="mb-0" x-text="`$${stats.revenue.toLocaleString()}`"></h3>
                                                <small class="text-success">
                                                    <i class="bi bi-arrow-up"></i> +8% from last week
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Charts Row -->
                        <div class="row g-4 g-lg-5 mb-5">
                            <!-- Order Trends Chart -->
                            <div class="col-lg-8">
                                <div class="card h-100">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h5 class="card-title mb-0">Order Trends</h5>
                                        <div class="btn-group btn-group-sm" role="group">
                                            <input type="radio" class="btn-check" name="trendsPeriod" id="trends7d" autocomplete="off" checked>
                                            <label class="btn btn-outline-secondary" for="trends7d">7D</label>
                                            <input type="radio" class="btn-check" name="trendsPeriod" id="trends30d" autocomplete="off">
                                            <label class="btn btn-outline-secondary" for="trends30d">30D</label>
                                            <input type="radio" class="btn-check" name="trendsPeriod" id="trends90d" autocomplete="off">
                                            <label class="btn btn-outline-secondary" for="trends90d">90D</label>
                                        </div>
                                    </div>
                                    <div class="card-body p-3 p-lg-4">
                                        <div id="orderTrendsChart" style="height: 300px;"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Order Status Distribution -->
                            <div class="col-lg-4">
                                <div class="card h-100">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">Order Status</h5>
                                    </div>
                                    <div class="card-body p-3 p-lg-4">
                                        <div id="statusChart" style="height: 200px;"></div>
                                        <div class="mt-3">
                                            <template x-for="status in statusStats" :key="status.name">
                                                <div class="d-flex justify-content-between align-items-center mb-2">
                                                    <span class="small" x-text="status.name"></span>
                                                    <div class="d-flex align-items-center">
                                                        <span class="small text-muted me-2" x-text="`${status.percentage}%`"></span>
                                                        <span class="small fw-medium" x-text="status.count"></span>
                                                    </div>
                                                </div>
                                            </template>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Orders Table -->
                        <div class="card">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h5 class="card-title mb-0">Orders</h5>
                                    </div>
                                    <div class="col-auto">
                                        <div class="d-flex gap-2">
                                            <!-- Search -->
                                            <div class="position-relative">
                                                <input type="search" 
                                                       class="form-control form-control-sm" 
                                                       placeholder="Search orders..."
                                                       x-model="searchQuery"
                                                       @input="filterOrders()"
                                                       style="width: 200px;">
                                                <i class="bi bi-search position-absolute top-50 end-0 translate-middle-y me-2 text-muted"></i>
                                            </div>
                                            
                                            <!-- Status Filter -->
                                            <select class="form-select form-select-sm" 
                                                    x-model="statusFilter" 
                                                    @change="filterOrders()"
                                                    style="width: 150px;">
                                                <option value="">All Status</option>
                                                <option value="pending">Pending</option>
                                                <option value="processing">Processing</option>
                                                <option value="shipped">Shipped</option>
                                                <option value="delivered">Delivered</option>
                                                <option value="cancelled">Cancelled</option>
                                            </select>
                                            
                                            <!-- Date Range -->
                                            <select class="form-select form-select-sm" 
                                                    x-model="dateFilter" 
                                                    @change="filterOrders()"
                                                    style="width: 150px;">
                                                <option value="">All Dates</option>
                                                <option value="today">Today</option>
                                                <option value="week">This Week</option>
                                                <option value="month">This Month</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <!-- Bulk Actions Bar -->
                                <div class="bulk-actions-bar p-3 bg-light border-bottom" x-show="selectedOrders.length > 0" x-transition>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="text-muted">
                                            <span x-text="selectedOrders.length"></span> order(s) selected
                                        </span>
                                        <div class="d-flex gap-2">
                                            <button class="btn btn-sm btn-outline-secondary" @click="bulkAction('processing')">
                                                <i class="bi bi-arrow-clockwise me-1"></i>Mark Processing
                                            </button>
                                            <button class="btn btn-sm btn-outline-info" @click="bulkAction('shipped')">
                                                <i class="bi bi-truck me-1"></i>Mark Shipped
                                            </button>
                                            <button class="btn btn-sm btn-outline-success" @click="bulkAction('delivered')">
                                                <i class="bi bi-check-circle me-1"></i>Mark Delivered
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Table -->
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th style="width: 40px;">
                                                    <input type="checkbox" 
                                                           class="form-check-input" 
                                                           @change="toggleAll($event.target.checked)"
                                                           :checked="selectedOrders.length === filteredOrders.length && filteredOrders.length > 0">
                                                </th>
                                                <th @click="sortBy('orderNumber')" class="sortable">Order #</th>
                                                <th>Customer</th>
                                                <th>Items</th>
                                                <th @click="sortBy('total')" class="sortable">Total</th>
                                                <th>Status</th>
                                                <th @click="sortBy('orderDate')" class="sortable">Date</th>
                                                <th style="width: 120px;">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <template x-for="order in paginatedOrders" :key="order.id">
                                                <tr>
                                                    <td>
                                                        <input type="checkbox" 
                                                               class="form-check-input" 
                                                               :value="order.id"
                                                               x-model="selectedOrders">
                                                    </td>
                                                    <td>
                                                        <div class="fw-medium" x-text="order.orderNumber"></div>
                                                        <small class="text-muted" x-text="'ID: ' + order.id"></small>
                                                    </td>
                                                    <td>
                                                        <div class="order-customer">
                                                            <img :src="order.customer.avatar" 
                                                                 class="customer-avatar" 
                                                                 :alt="order.customer.name">
                                                            <div>
                                                                <div class="fw-medium" x-text="order.customer.name"></div>
                                                                <small class="text-muted" x-text="order.customer.email"></small>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="order-items">
                                                            <div x-text="order.itemCount + ' item' + (order.itemCount > 1 ? 's' : '')"></div>
                                                            <small class="text-muted" x-text="order.items[0].name + (order.itemCount > 1 ? ' +' + (order.itemCount - 1) + ' more' : '')"></small>
                                                        </div>
                                                    </td>
                                                    <td class="fw-medium" x-text="`$${order.total}`"></td>
                                                    <td>
                                                        <span class="order-status" 
                                                              :class="{
                                                                  'status-pending': order.status === 'pending',
                                                                  'status-processing': order.status === 'processing',
                                                                  'status-shipped': order.status === 'shipped',
                                                                  'status-delivered': order.status === 'delivered',
                                                                  'status-cancelled': order.status === 'cancelled'
                                                              }"
                                                              x-text="order.status.charAt(0).toUpperCase() + order.status.slice(1)"></span>
                                                    </td>
                                                    <td x-text="order.orderDate"></td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" 
                                                                    type="button" 
                                                                    data-bs-toggle="dropdown">
                                                                <i class="bi bi-three-dots"></i>
                                                            </button>
                                                            <ul class="dropdown-menu">
                                                                <li><a class="dropdown-item" href="#" @click="viewOrder(order)">
                                                                    <i class="bi bi-eye me-2"></i>View Details
                                                                </a></li>
                                                                <li><a class="dropdown-item" href="#" @click="trackOrder(order)">
                                                                    <i class="bi bi-truck me-2"></i>Track Order
                                                                </a></li>
                                                                <li><a class="dropdown-item" href="#" @click="printInvoice(order)">
                                                                    <i class="bi bi-printer me-2"></i>Print Invoice
                                                                </a></li>
                                                                <li><hr class="dropdown-divider"></li>
                                                                <li><a class="dropdown-item text-danger" href="#" @click="cancelOrder(order)">
                                                                    <i class="bi bi-x-circle me-2"></i>Cancel Order
                                                                </a></li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </template>
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Pagination -->
                                <div class="d-flex justify-content-between align-items-center p-3">
                                    <div class="text-muted">
                                        Showing <span x-text="(currentPage - 1) * itemsPerPage + 1"></span> to 
                                        <span x-text="Math.min(currentPage * itemsPerPage, filteredOrders.length)"></span> of 
                                        <span x-text="filteredOrders.length"></span> results
                                    </div>
                                    <nav>
                                        <ul class="pagination pagination-sm mb-0">
                                            <li class="page-item" :class="{ 'disabled': currentPage === 1 }">
                                                <a class="page-link" href="#" @click.prevent="goToPage(currentPage - 1)">Previous</a>
                                            </li>
                                            <template x-for="(page, index) in visiblePages" :key="`page-${index}`">
                                                <li class="page-item" :class="{ 'active': page === currentPage }">
                                                    <a class="page-link" href="#" @click.prevent="page !== '...' && goToPage(page)" x-text="page"></a>
                                                </li>
                                            </template>
                                            <li class="page-item" :class="{ 'disabled': currentPage === totalPages }">
                                                <a class="page-link" href="#" @click.prevent="goToPage(currentPage + 1)">Next</a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                        
                    </div> <!-- End Order Management Container -->

                </div>
            </main>

            <!-- Footer -->
            <footer class="admin-footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <p class="mb-0 text-muted">© 2025 Modern Bootstrap Admin Template</p>
                        </div>
                        <div class="col-md-6 text-md-end">
                            <p class="mb-0 text-muted">Built with Bootstrap 5.3.7</p>
                        </div>
                    </div>
                </div>
            </footer>

        </div> <!-- /.admin-wrapper -->
    </div>

    <!-- Order Details Modal -->
    <div class="modal fade" id="orderModal" tabindex="-1">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Order Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <!-- Order Information -->
                        <div class="col-lg-8">
                            <h6 class="mb-3">Order Items</h6>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Sample Product</td>
                                            <td>2</td>
                                            <td>$49.99</td>
                                            <td>$99.98</td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="3">Total:</th>
                                            <th>$99.98</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        
                        <!-- Order Timeline -->
                        <div class="col-lg-4">
                            <h6 class="mb-3">Order Timeline</h6>
                            <div class="order-timeline">
                                <div class="timeline-item completed">
                                    <div class="fw-medium">Order Placed</div>
                                    <small class="text-muted">Jan 15, 2025 at 10:30 AM</small>
                                </div>
                                <div class="timeline-item completed">
                                    <div class="fw-medium">Payment Confirmed</div>
                                    <small class="text-muted">Jan 15, 2025 at 10:32 AM</small>
                                </div>
                                <div class="timeline-item active">
                                    <div class="fw-medium">Processing</div>
                                    <small class="text-muted">Jan 16, 2025 at 9:15 AM</small>
                                </div>
                                <div class="timeline-item">
                                    <div class="fw-medium">Shipped</div>
                                    <small class="text-muted">Pending</small>
                                </div>
                                <div class="timeline-item">
                                    <div class="fw-medium">Delivered</div>
                                    <small class="text-muted">Pending</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Update Status</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bulk Update Modal -->
    <div class="modal fade" id="bulkUpdateModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Bulk Update Orders</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Update Status</label>
                        <select class="form-select">
                            <option value="">Select new status</option>
                            <option value="processing">Processing</option>
                            <option value="shipped">Shipped</option>
                            <option value="delivered">Delivered</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Filter Orders</label>
                        <select class="form-select">
                            <option value="">All orders</option>
                            <option value="pending">Only pending orders</option>
                            <option value="processing">Only processing orders</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">Update Orders</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Page-specific Component -->

    <!-- Main App Script -->

    <script>
      document.addEventListener('DOMContentLoaded', () => {
        const toggleButton = document.querySelector('[data-sidebar-toggle]');
        const wrapper = document.getElementById('admin-wrapper');

        if (toggleButton && wrapper) {
          const isCollapsed = localStorage.getItem('sidebar-collapsed') === 'true';
          if (isCollapsed) {
            wrapper.classList.add('sidebar-collapsed');
            toggleButton.classList.add('is-active');
          }

          toggleButton.addEventListener('click', () => {
            const isCurrentlyCollapsed = wrapper.classList.contains('sidebar-collapsed');
            
            if (isCurrentlyCollapsed) {
              wrapper.classList.remove('sidebar-collapsed');
              toggleButton.classList.remove('is-active');
              localStorage.setItem('sidebar-collapsed', 'false');
            } else {
              wrapper.classList.add('sidebar-collapsed');
              toggleButton.classList.add('is-active');
              localStorage.setItem('sidebar-collapsed', 'true');
            }
          });
        }
      });
    </script>
</body>
</html>