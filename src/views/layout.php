<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submonth - Premium Digital Subscriptions</title>

    <meta name="description" content="Submonth is your trusted source for premium digital subscriptions and courses in Bangladesh. Get affordable access to tools like Canva Pro, ChatGPT Plus, and more.">
    <meta name="keywords" content="digital subscriptions, premium accounts, online courses, submonth, bangladesh, canva pro, chatgpt plus, affordable price">

    <?php if (!empty($favicon_path) && file_exists($favicon_path)): ?>
        <link rel="icon" type="image/png" href="<?= htmlspecialchars(BASE_PATH . '/' . $favicon_path) ?>">
        <link rel="apple-touch-icon" href="<?= htmlspecialchars(BASE_PATH . '/' . $favicon_path) ?>">
    <?php else: ?>
        <link rel="icon" type="image/png" href="https://i.postimg.cc/ncGxB1jm/IMG-20250919-WA0036.jpg">
        <link rel="apple-touch-icon" href="https://i.postimg.cc/ncGxB1jm/IMG-20250919-WA0036.jpg">
    <?php endif; ?>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&family=League+Spartan:wght@400;500;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>

    <style>
        :root {
            --primary-color: #7C3AED;
            --primary-color-darker: #6D28D9;
            --primary-color-light: #F5F3FF;
            --strong-border-color: #C4B5FD;
        }
        [v-cloak] { display: none !important; }
        html { scroll-behavior: smooth; }
        body { font-family: 'Inter', sans-serif; background-color: #f9fafb; }
        h1, h2, h3, h4, .font-display { font-family: 'League Spartan', 'Inter', sans-serif; -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale; }
        .hero-section { margin: 1rem; position: relative; }
        .hero-slide {
            position: absolute;
            inset: 0;
            opacity: 0;
            transition: opacity 0.5s ease-in-out;
            background-size: cover;
            background-position: center;
        }
        .hero-slide.active { opacity: 1; }
        .preserve-whitespace { white-space: pre-wrap; }
        .category-icon { display: flex; flex-direction: column; align-items: center; justify-content: center; cursor: pointer; transition: all 0.2s ease; text-decoration: none; width: 72px; height: 72px; padding: 0.5rem; flex-shrink: 0; border: 2px solid var(--strong-border-color); border-radius: 0.75rem; background-color: #ffffff; }
        .category-icon:hover { border-color: var(--primary-color); }
        .category-icon i { font-size: 1.75rem; color: var(--primary-color); }
        .category-icon span { font-size: 0.7rem; color: #374151; font-weight: 500; text-align: center; line-height: 1.1; margin-top: 0.25rem; }
        .category-scroll-container { display: flex; flex-wrap: nowrap; gap: 1rem; width: max-content; padding: 0 1rem; }
        .horizontal-scroll { overflow-x: auto; scrollbar-width: none; }
        .horizontal-scroll::-webkit-scrollbar { display: none; }
        .smooth-scroll { scroll-behavior: smooth; }
        @media (min-width: 768px) { .category-scroll-container { gap: 2rem; padding: 0; } div[ref="categoryScroller"] { padding: 0; } .category-icon { width: 90px; height: 90px; } .category-icon i { font-size: 2.5rem; margin-bottom: -0.25rem; } .category-icon span { font-size: 0.875rem; margin-top: 0.75rem; } }
        .product-card { transition: all 0.2s ease; border-width: 2px; border-color: #e5e7eb; box-shadow: none; }
        .product-card:hover { border-color: #d1d5db; }
        .product-card:active { transform: scale(0.98); filter: brightness(0.98); }
        .product-card { width: 170px; display: flex; flex-direction: column; flex-shrink: 0; border-radius: 0.75rem; overflow: hidden; position: relative; scroll-snap-align: start; cursor: pointer; background-color: white; }
        .product-scroll-container { display: flex; width: max-content; padding-left: 10px; padding-right: 10px; gap: 10px; }
        .product-card-image-container { aspect-ratio: 4 / 3; background-color: #f3f4f6; overflow: hidden; }
        .product-image { width: 100%; height: 100%; object-fit: cover; }
        .line-clamp-1 { overflow: hidden; display: -webkit-box; -webkit-box-orient: vertical; -webkit-line-clamp: 1; }
        .line-clamp-2 { overflow: hidden; display: -webkit-box; -webkit-box-orient: vertical; -webkit-line-clamp: 2; }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        .hot-deals-container { overflow: hidden; -webkit-mask-image: linear-gradient(to right, transparent 0%, white 10%, white 90%, transparent 100%); mask-image: linear-gradient(to right, transparent 0%, white 10%, white 90%, transparent 100%); }
        .hot-deals-scroller { display: flex; width: max-content; animation-name: scroll-anim; animation-timing-function: linear; animation-iteration-count: infinite; }
        .hot-deal-card { width: 100px; margin: 0 8px; flex-shrink: 0; text-align: center; text-decoration: none; color: inherit; }
        .hot-deal-image-container { aspect-ratio: 4 / 3; border-radius: 0.75rem; overflow: hidden; margin-bottom: 0.5rem; border: 2px solid #e5e7eb; }
        .hot-deal-image { width: 100%; height: 100%; object-fit: cover; }
        .hot-deal-title { font-size: 0.75rem; font-weight: 500; color: #374151; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
        @keyframes scroll-anim { 0% { transform: translateX(0); } 100% { transform: translateX(-50%); } }
        @media (min-width: 768px) { .hero-section { aspect-ratio: 5 / 2; } .product-card { width: 280px; } .product-scroll-container { padding-left: 30px; padding-right: 30px; gap: 30px; } .hot-deal-card { width: 180px; margin: 0 14px; } .hot-deal-title { font-size: 0.875rem; } .hot-deals-container { -webkit-mask-image: linear-gradient(to right, transparent, #f9fafb 8%, #f9fafb 92%, transparent); mask-image: linear-gradient(to right, transparent, #f9fafb 8%, #f9fafb 92%, transparent); } }
        @media (max-width: 767px) { html { font-size: 80%; } .hero-section { aspect-ratio: 2 / 1; } #related-products-container > div:nth-of-type(n+3) { display: none; } }
        .feature-card { transition: all 0.3s ease; }
        .feature-card:hover { box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1); }
        .product-grid-card { display: flex; flex-direction: column; background-color: white; border-radius: 0.75rem; border-width: 2px; border-color: #e5e7eb; overflow: hidden; transition: all 0.3s ease; position: relative; cursor: pointer; box-shadow: none; }
        .product-grid-card:hover { border-color: #d1d5db; }
        .notification-badge { position: absolute; top: -2px; right: -4px; background-color: #ef4444; color: white; border-radius: 50%; width: 12px; height: 12px; display: flex; align-items: center; justify-content: center; font-size: 6px; font-weight: bold; line-height: 1; }
        .product-detail-title { font-size: 1.75rem; max-width: 25ch; }
        @media (min-width: 768px) { .product-detail-title { font-size: 2rem; } .product-detail-content { display: flex; flex-direction: row; align-items: flex-start; gap: 2rem;} .product-detail-image-container { flex-shrink: 0; position: relative; width: 50%; } .product-detail-info-container { flex-grow: 1; } .duration-button-selected::after { content: '✓'; position: absolute; top: -8px; right: -8px; font-size: 1rem; color: white; background-color: var(--primary-color); border-radius: 50%; width: 20px; height: 20px; display: flex; align-items: center; justify-content: center; font-weight: bold; box-shadow: 0 2px 4px rgba(0,0,0,0.2); } }
        @media (max-width: 767px) { .product-detail-image-container { aspect-ratio: 1 / 1; } .duration-button-selected::after { content: '✓'; position: absolute; top: -8px; right: -8px; font-size: 0.8rem; color: white; background-color: var(--primary-color); border-radius: 50%; width: 18px; height: 18px; display: flex; align-items: center; justify-content: center; font-weight: bold; box-shadow: 0 2px 4px rgba(0,0,0,0.2); } }
        .fab-icon { transition: transform 0.3s ease; }
    </style>
</head>
<body class="bg-gray-50 flex flex-col min-h-screen">

    <div id="app" v-cloak>
        <!-- Custom Modal Popup -->
        <div v-show="modal.visible" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 p-4" @click.self="closeModal" style="display: none;">
            <div @click.stop class="bg-white rounded-lg shadow-xl w-full max-w-sm text-center p-6" v-if="modal.visible">
                <div class="mb-4">
                    <i class="fas text-5xl" :class="{ 'fa-check-circle text-green-500': modal.type === 'success', 'fa-exclamation-circle text-red-500': modal.type === 'error', 'fa-info-circle text-blue-500': modal.type === 'info' }"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">{{ modal.title }}</h3>
                <p class="text-gray-600 mb-6">{{ modal.message }}</p>
                <button @click="closeModal" class="w-full bg-[var(--primary-color)] text-white font-semibold py-2 px-4 rounded-lg hover:bg-[var(--primary-color-darker)] transition">
                    OK
                </button>
            </div>
        </div>

        <!-- Side Menu -->
        <div v-show="isSideMenuOpen" class="fixed inset-0 z-50 flex" style="display: none;">
            <div @click="isSideMenuOpen = false" v-show="isSideMenuOpen" class="fixed inset-0 bg-black bg-opacity-50"></div>
            <div v-show="isSideMenuOpen" class="relative w-72 max-w-xs bg-white h-full shadow-xl p-6">
                <button @click="isSideMenuOpen = false" class="absolute top-4 right-4 text-gray-500 hover:text-gray-800 text-2xl"><i class="fas fa-times"></i></button>
                <h2 class="text-2xl font-bold text-[var(--primary-color)] mb-8 font-display tracking-wider">Menu</h2>
                <nav class="flex flex-col space-y-4">
                    <a :href="basePath + '/'" @click.prevent="setView('home'); isSideMenuOpen = false;" class="text-lg text-gray-700 hover:text-[var(--primary-color)]">Home</a>
                    <a :href="basePath + '/about-us'" @click.prevent="setView('aboutUs'); isSideMenuOpen = false;" class="text-lg text-gray-700 hover:text-[var(--primary-color)]">About Us</a>
                    <a :href="basePath + '/privacy-policy'" @click.prevent="setView('privacyPolicy'); isSideMenuOpen = false;" class="text-lg text-gray-700 hover:text-[var(--primary-color)]">Privacy Policy</a>
                    <a :href="basePath + '/terms-and-conditions'" @click.prevent="setView('termsAndConditions'); isSideMenuOpen = false;" class="text-lg text-gray-700 hover:text-[var(--primary-color)]">Terms & Conditions</a>
                    <a :href="basePath + '/refund-policy'" @click.prevent="setView('refundPolicy'); isSideMenuOpen = false;" class="text-lg text-gray-700 hover:text-[var(--primary-color)]">Refund Policy</a>
                </nav>
                <hr class="my-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-4 font-display tracking-wider">Categories</h3>
                <nav class="flex flex-col space-y-3">
                     <?php foreach ($all_categories as $category): ?>
                        <a :href="basePath + '/products/category/<?= htmlspecialchars($category['slug']) ?>'" @click.prevent="setView('products', { filterType: 'category', filterValue: '<?= htmlspecialchars($category['name']) ?>' }); isSideMenuOpen = false;" class="text-gray-600 hover:text-[var(--primary-color)]"><?= htmlspecialchars($category['name']) ?></a>
                    <?php endforeach; ?>
                </nav>
            </div>
        </div>

        <!-- Header -->
        <header class="header flex justify-between items-center px-4 bg-white shadow-md sticky top-0 z-40 h-16 md:h-20">
            <div class="flex items-center justify-between w-full md:hidden gap-2">
                <a :href="basePath + '/'" @click.prevent="setView('home')" class="logo flex-shrink-0">
                    <?php if (!empty($site_logo_path) && file_exists($site_logo_path)): ?>
                        <img src="<?= htmlspecialchars(BASE_PATH . '/' . $site_logo_path) ?>" alt="Submonth Logo" class="h-8">
                    <?php else: ?>
                        <img src="https://i.postimg.cc/gJRL0cdG/1758261543098.png" alt="Submonth Logo" class="h-8">
                    <?php endif; ?>
                </a>
                <form @submit.prevent="performSearch" class="relative flex-1 min-w-0">
                     <input type="text" v-model.lazy="searchQuery" placeholder="Search..." class="w-full py-2 pl-3 pr-10 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-gray-400 h-9 text-sm" aria-label="Search mobile">
                    <div class="absolute top-2 bottom-2 right-8 w-px bg-gray-300"></div>
                    <button type="submit" class="absolute right-2 top-1/2 transform -translate-y-1/2" aria-label="Submit search mobile">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M15.5 14h-.79l-.28-.27A6.471 6.471 0 0 0 16 9.5 6.5 6.5 0 1 0 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"></path>
                        </svg>
                    </button>
                </form>
                <div class="flex items-center gap-3">
                    <button @click="toggleCurrency()" class="icon text-gray-600 hover:text-[var(--primary-color)] cursor-pointer flex items-center gap-1 font-semibold">
                        <i class="fas fa-dollar-sign text-xl"></i>
                        <span class="text-sm">{{ currency }}</span>
                    </button>
                     <a :href="basePath + '/cart'" @click.prevent="setView('cart')" class="icon text-2xl text-gray-600 hover:text-[var(--primary-color)] cursor-pointer relative" aria-label="Shopping Cart">
                        <i class="fas fa-shopping-bag relative -top-0.5"></i>
                        <span v-show="cartCount > 0" class="notification-badge">{{ cartCount }}</span>
                    </a>
                    <button @click="isSideMenuOpen = !isSideMenuOpen" class="icon text-2xl text-gray-600 hover:text-[var(--primary-color)] cursor-pointer" aria-label="Open menu"><i class="fas fa-bars"></i></button>
                </div>
            </div>

            <div class="hidden md:flex items-center w-full gap-5">
                <a :href="basePath + '/'" @click.prevent="setView('home')" class="logo flex-shrink-0 flex items-center text-gray-800 no-underline">
                     <?php if (!empty($site_logo_path) && file_exists($site_logo_path)): ?>
                        <img src="<?= htmlspecialchars(BASE_PATH . '/' . $site_logo_path) ?>" alt="Submonth Logo" class="h-9">
                    <?php else: ?>
                        <img src="https://i.postimg.cc/gJRL0cdG/1758261543098.png" alt="Submonth Logo" class="h-9">
                    <?php endif; ?>
                </a>
                <form @submit.prevent="performSearch" class="relative flex-1">
                    <input type="text" v-model.lazy="searchQuery" placeholder="Search for premium subscriptions, courses, and more..." class="w-full py-2.5 px-4 pr-12 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-gray-500 focus:border-gray-500 transition-colors text-gray-900 placeholder-gray-400" aria-label="Search">
                    <div class="absolute top-2.5 bottom-2.5 right-10 w-px bg-gray-300"></div>
                    <button type="submit" class="absolute right-3 top-1/2 transform -translate-y-1/2" aria-label="Submit search">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M15.5 14h-.79l-.28-.27A6.471 6.471 0 0 0 16 9.5 6.5 6.5 0 1 0 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
                      </svg>
                    </button>
                </form>
                <div class="flex-shrink-0 flex items-center gap-5">
                    <button @click="toggleCurrency()" class="icon text-xl text-gray-600 hover:text-[var(--primary-color)] cursor-pointer flex items-center gap-2 font-semibold">
                        <i class="fas fa-dollar-sign text-2xl pt-px"></i>
                        <span class="pt-px">{{ currency }}</span>
                    </button>
                    <a :href="basePath + '/products'" @click.prevent="setView('products')" class="icon text-2xl text-gray-600 hover:text-[var(--primary-color)] cursor-pointer" aria-label="All Products"><i class="fas fa-box-open"></i></a>
                    <a :href="basePath + '/cart'" @click.prevent="setView('cart')" class="icon text-2xl text-gray-600 hover:text-[var(--primary-color)] cursor-pointer relative" aria-label="Shopping Cart">
                        <i class="fas fa-shopping-bag relative -top-0.5"></i>
                        <span v-show="cartCount > 0" class="notification-badge">{{ cartCount }}</span>
                    </a>
                    <a :href="basePath + '/order-history'" @click.prevent="setView('orderHistory')" class="icon text-2xl text-gray-600 hover:text-[var(--primary-color)] cursor-pointer relative" aria-label="Order History">
                        <i class="fas fa-receipt relative -top-0.5"></i>
                        <span v-show="newNotificationCount > 0" class="notification-badge">{{ newNotificationCount }}</span>
                    </a>
                    <button @click="isSideMenuOpen = !isSideMenuOpen" class="icon text-2xl text-gray-600 hover:text-[var(--primary-color)] cursor-pointer" aria-label="Open menu"><i class="fas fa-bars"></i></button>
                </div>
            </div>
        </header>

        <main class="flex-grow">
            <div v-if="currentView === 'home'">
                <?php include 'src/views/home.php'; ?>
            </div>

            <div class="pb-16" v-else>
                <?php include 'src/views/products.php'; ?>
                <?php include 'src/views/product-detail.php'; ?>
                <?php include 'src/views/cart.php'; ?>
                <?php include 'src/views/checkout.php'; ?>
                <?php include 'src/views/order-history.php'; ?>
                <?php include 'src/views/about-us.php'; ?>
                <?php include 'src/views/privacy-policy.php'; ?>
                <?php include 'src/views/terms-and-conditions.php'; ?>
                <?php include 'src/views/refund-policy.php'; ?>
            </div>
        </main>

        <div v-show="currentView === 'home'">
            <section class="py-16 sm:py-24">
                <div class="max-w-2xl mx-auto text-center px-6">
                    <h2 class="text-3xl sm:text-4xl font-bold tracking-tight text-slate-900">
                        Your Opinion Matters
                    </h2>
                    <p class="mt-2 text-base text-slate-600">
                        Share your experience on Trustpilot.
                    </p>
                    <div class="mt-8">
                        <div class="trustpilot-widget inline-block" data-locale="en-US" data-template-id="56278e9abfbbba0bdcd568bc" data-businessunit-id="68cd3e85a5e773033d7242cf" data-style-height="52px" data-style-width="100%" data-token="4607939e-09dd-4f65-8fed-06bda9352f4e">
                          <a href="https://www.trustpilot.com/review/submonth.com" target="_blank" rel="noopener">Trustpilot</a>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <div v-show="currentView === 'home'">
            <footer class="bg-slate-900">
                <div class="max-w-4xl mx-auto px-6 sm:px-8 py-12">
                    <div class="space-y-8 text-center">
                        <div class="space-y-4">
                            <div>
                                <a :href="basePath + '/'" @click.prevent="setView('home')" class="inline-block text-2xl font-bold text-slate-100">Submonth</a>
                                <p class="text-sm text-slate-400 max-w-sm mx-auto">
                                    The Digital Product Store
                                </p>
                            </div>
                            <div class="pt-2">
                                <form class="flex gap-2 max-w-md mx-auto">
                                    <input type="email" placeholder="Enter your email" class="flex-1 w-full min-w-0 px-3 py-2 bg-slate-800 border border-slate-600 rounded-md text-sm shadow-sm placeholder-slate-400 text-white focus:outline-none focus:border-[var(--primary-color)] focus:ring-1 focus:ring-[var(--primary-color)]" required>
                                    <button type="submit" class="bg-[var(--primary-color)] hover:bg-[var(--primary-color-darker)] text-white font-semibold px-3 sm:px-4 py-2 rounded-md text-sm transition-colors duration-300 flex-shrink-0">Subscribe</button>
                                </form>
                            </div>
                        </div>

                        <nav>
                            <div class="overflow-x-auto no-scrollbar pb-2">
                                <ul class="inline-flex flex-nowrap items-center whitespace-nowrap gap-x-6 sm:gap-x-8 text-sm text-slate-400">
                                    <li><a :href="basePath + '/'" @click.prevent="setView('home')" class="hover:text-violet-400 hover:underline">Home</a></li>
                                    <li><a :href="basePath + '/about-us'" @click.prevent="setView('aboutUs')" class="hover:text-violet-400 hover:underline">About Us</a></li>
                                    <li><a :href="basePath + '/privacy-policy'" @click.prevent="setView('privacyPolicy')" class="hover:text-violet-400 hover:underline">Privacy Policy</a></li>
                                    <li><a :href="basePath + '/terms-and-conditions'" @click.prevent="setView('termsAndConditions')" class="hover:text-violet-400 hover:underline">Terms & Conditions</a></li>
                                    <li><a :href="basePath + '/refund-policy'" @click.prevent="setView('refundPolicy')" class="hover:text-violet-400 hover:underline">Refund Policy</a></li>
                                </ul>
                            </div>
                        </nav>

                        <div class="pt-2">
                            <p class="text-xs text-slate-500">&copy; <span id="current-year-footer"></span> Submonth, Inc. All rights reserved.</p>
                        </div>
                    </div>
                </div>
            </footer>
        </div>

        <nav class="md:hidden fixed bottom-0 left-0 right-0 z-40 bg-white border-t border-gray-200 flex justify-around items-center h-16 shadow-[0_-2px_5px_rgba(0,0,0,0.05)]">
            <a :href="basePath + '/'" @click.prevent="setView('home')" class="flex flex-col items-center justify-center transition w-full" :class="currentView === 'home' ? 'text-[var(--primary-color)]' : 'text-gray-500'"><i class="fas fa-home text-2xl"></i><span class="text-xs mt-1">Home</span></a>
            <a :href="basePath + '/products'" @click.prevent="setView('products')" class="flex flex-col items-center justify-center transition w-full" :class="currentView === 'products' ? 'text-[var(--primary-color)]' : 'text-gray-500'"><i class="fas fa-box-open text-2xl"></i><span class="text-xs mt-1">Products</span></a>
            <a :href="basePath + '/order-history'" @click.prevent="setView('orderHistory')" class="relative flex flex-col items-center justify-center transition w-full" :class="currentView === 'orderHistory' ? 'text-[var(--primary-color)]' : 'text-gray-500'">
                <div class="relative">
                    <i class="fas fa-receipt text-2xl"></i>
                    <span v-show="newNotificationCount > 0" class="notification-badge" style="top: -2px; right: -8px;">{{ newNotificationCount }}</span>
                </div>
                <span class="text-xs mt-1">Orders</span>
            </a>
        </nav>

        <div class="fixed bottom-20 md:bottom-6 right-4 z-40">
            <div v-show="fabOpen" class="flex flex-col items-center space-y-3 mb-3" style="display: none;">
                <a href="tel:<?= htmlspecialchars($contact_info['phone']) ?>" class="w-12 h-12 bg-white rounded-full flex items-center justify-center shadow-lg text-[var(--primary-color)] border"><i class="fas fa-phone-alt text-xl transform -scale-x-100"></i></a>
                <a href="https://wa.me/<?= htmlspecialchars($contact_info['whatsapp']) ?>" target="_blank" class="w-12 h-12 bg-white rounded-full flex items-center justify-center shadow-lg text-green-500 border"><i class="fab fa-whatsapp text-2xl"></i></a>
                <a href="mailto:<?= htmlspecialchars($contact_info['email']) ?>" class="w-12 h-12 bg-white rounded-full flex items-center justify-center shadow-lg text-red-500 border"><i class="fas fa-envelope text-xl"></i></a>
            </div>
            <button @click="fabOpen = !fabOpen" class="flex flex-col items-center text-gray-700">
                <div class="w-14 h-14 bg-[var(--primary-color)] text-white rounded-full flex items-center justify-center shadow-lg"><i class="fas fa-headset text-2xl fab-icon" :class="{'rotate-45': fabOpen}"></i></div>
                <span class="text-xs font-semibold mt-2">Need Help?</span>
            </button>
        </div>
    </div>

    <script src="assets/js/app.js"></script>

    <script type="text/javascript" src="//widget.trustpilot.com/bootstrap/v5/tp.widget.bootstrap.min.js" async></script>
</body>
</html>