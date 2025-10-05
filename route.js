// route.js - SPA hash-based navigation for HomeStyle Furniture

if (!window.routes) {
    window.routes = {
        'home': 'categories/main.html',
        'kitchen_styles': 'categories/kitchen/style-main.html',
        'livingroom_styles': 'categories/living-room/style-main.html',
        'bedroom_styles': 'categories/bed-room/style-main.html',
        'storage_styles': 'categories/storage/style-main.html',
        // Kitchen details
        'kitchen_modern': 'categories/kitchen/style-modern_detail.html',
        'kitchen_classic': 'categories/kitchen/style-classic_detail.html',
        'kitchen_rustic': 'categories/kitchen/style-rustic_detail.html',
        'kitchen_personalized': 'categories/kitchen/style-personalized_detail.html',
        // Living room details
        'livingroom_modern': 'categories/living-room/style-modern_detail.html',
        'livingroom_classic': 'categories/living-room/style-classic_detail.html',
        'livingroom_rustic': 'categories/living-room/style-rustic_detail.html',
        'livingroom_personalized': 'categories/living-room/style-personalized_detail.html',
        // Bedroom details
        'bedroom_modern': 'categories/bed-room/style-modern_detail.html',
        'bedroom_classic': 'categories/bed-room/style-classic_detail.html',
        'bedroom_rustic': 'categories/bed-room/style-rustic_detail.html',
        'bedroom_personalized': 'categories/bed-room/style-personalized_detail.html',
        // Storage details
        'storage_modern': 'categories/storage/style-modern_detail.html',
        'storage_classic': 'categories/storage/style-classic_detail.html',
        'storage_rustic': 'categories/storage/style-rustic_detail.html',
        'storage_personalized': 'categories/storage/style-personalized_detail.html'
    };
}

if (!window.loadRouteFromHash) {
    window.loadRouteFromHash = function() {
        let hash = window.location.hash.replace('#', '');
        if (!hash || hash === '' || hash === 'home') {
            hash = 'home';
        }
        const fragment = window.routes[hash];
        if (fragment) {
            htmx.ajax('GET', fragment, {target: '#main-content', swap: 'innerHTML'});
        } else {
            document.getElementById('main-content').innerHTML =
                '<div class="panel-content"><div class="alert alert-danger text-center my-5">Page not found or route missing.<br><a href="#home" class="btn btn-primary mt-3">Go Home</a></div></div>';
        }
    };
}

if (!window._spa_nav_initialized) {
    window._spa_nav_initialized = true;
    window.addEventListener('DOMContentLoaded', function() {
        window.loadRouteFromHash();
    });
    let lastHash = '';
    window.addEventListener('hashchange', function() {
        window.loadRouteFromHash();
    });
    window.addEventListener('click', function() {
        setTimeout(() => {
            if (window.location.hash === lastHash) {
                window.loadRouteFromHash();
            }
            lastHash = window.location.hash;
        }, 0);
    });
    document.body.addEventListener('click', function(e) {
        const link = e.target.closest('a[href^="#"]');
        if (link) {
            const hash = link.getAttribute('href');
            if (hash && hash.startsWith('#')) {
                window.location.hash = hash;
                e.preventDefault();
            }
        }
    });
}
