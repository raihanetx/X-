<div v-if="currentView === 'orderHistory'" class="bg-white min-h-screen">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 pt-6 pb-12">
        <h1 class="text-3xl font-bold text-gray-800 mb-8 font-display tracking-wider">Your Order History</h1>

        <template v-if="orderHistory.length === 0 && !isSearchingOrders">
            <div class="py-16 text-center">
                <i class="fas fa-receipt text-6xl text-gray-300 mb-4"></i>
                <h3 class="text-2xl font-semibold text-gray-700 mb-2 font-display tracking-wider">You have no orders yet</h3>
                <p class="text-gray-500 mb-6">Looks like you haven't placed any orders. Let's change that!</p>
                <a :href="basePath + '/products'" @click.prevent="setView('products')" class="inline-block px-8 py-3 bg-[var(--primary-color)] text-white font-semibold rounded-lg shadow-md hover:bg-[var(--primary-color-darker)] transition">Start Shopping</a>
            </div>
        </template>
        <div v-show="isSearchingOrders" class="text-center py-16">
            <i class="fas fa-spinner animate-spin text-4xl text-[var(--primary-color)]"></i>
            <p class="mt-4 text-gray-600">Loading your order history...</p>
        </div>
        <template v-if="orderHistory.length > 0 && !isSearchingOrders">
            <div class="space-y-6">
                <template v-for="(order, index) in orderHistory" :key="order.order_id">
                    <div class="bg-white rounded-lg shadow-md overflow-hidden border">
                        <div class="p-4 sm:p-6 bg-gray-50 flex flex-col sm:flex-row justify-between items-start sm:items-center">
                            <div>
                                <h3 class="text-lg font-bold text-gray-800 font-display tracking-wider">Order #<span>{{ order.order_id }}</span></h3>
                                <p class="text-sm text-gray-500 mt-1">{{ 'Placed on ' + new Date(order.order_date).toLocaleDateString() }}</p>
                            </div>
                            <div class="mt-4 sm:mt-0 flex items-center gap-4">
                                <span class="text-sm font-medium px-3 py-1 rounded-full" :class="{'bg-green-100 text-green-800': order.status === 'Confirmed', 'bg-yellow-100 text-yellow-800': order.status === 'Pending', 'bg-red-100 text-red-800': order.status === 'Cancelled'}">{{ order.status }}</span>
                                <p class="text-xl font-bold text-[var(--primary-color)]">{{ formatPrice(order.totals.total) }}</p>
                            </div>
                        </div>
                        <div class="p-4 sm:p-6">
                            <div class="mb-4">
                                <template v-for="item in order.items" :key="item.id">
                                    <div class="flex items-center gap-4 py-2">
                                        <div class="flex-shrink-0 w-12 h-12 rounded-md flex items-center justify-center bg-gray-100 border"><img :src="basePath + '/' + (getProductById(item.id)?.image || '')" class="product-image rounded-md"></div>
                                        <p class="font-semibold text-gray-700">{{ item.name }}</p>
                                        <p class="ml-auto text-gray-500">{{ 'Qty: ' + item.quantity }}</p>
                                    </div>
                                </template>
                            </div>
                            <button @click="openOrder = (openOrder === order.order_id ? null : order.order_id)" class="text-sm font-semibold text-[var(--primary-color)] hover:underline">
                                <span v-show="openOrder !== order.order_id">View Details</span>
                                <span v-show="openOrder === order.order_id" style="display: none;">Hide Details</span>
                            </button>
                            <div v-show="openOrder === order.order_id" class="mt-4 pt-4 border-t">
                                <h4 class="font-semibold text-gray-800 mb-2 font-display tracking-wider">Customer Information</h4>
                                <p class="text-sm text-gray-600">{{ 'Name: ' + order.customer.name }}</p>
                                <p class="text-sm text-gray-600">{{ 'Email: ' + order.customer.email }}</p>
                                <p class="text-sm text-gray-600">{{ 'Phone: ' + order.customer.phone }}</p>
                                <p class="text-sm text-gray-600">{{ 'Transaction ID: ' + order.payment.trx_id }}</p>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </template>
    </div>
</div>