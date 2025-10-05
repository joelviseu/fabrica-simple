// Enhanced navigation with right-to-left animations
function showView(viewId) {
    const views = ['home-view', 'categories-view', 'details-view'];
    const currentView = views.find(id => {
        const element = document.getElementById(id);
        return element && element.style.display !== 'none';
    });
    
    // If there's a current view, animate it out first
    if (currentView && currentView !== viewId) {
        const currentElement = document.getElementById(currentView);
        currentElement.classList.add('view-transition-out');
        
        // Prepare the new view (hidden and positioned off-screen)
        const targetView = document.getElementById(viewId);
        if (targetView) {
            targetView.style.display = 'block';
            targetView.style.transform = 'translateX(100%)';
            targetView.style.opacity = '0';
            targetView.classList.remove('view-transition', 'view-transition-out');
        }
        
        // Wait for exit animation to complete before showing new view
        setTimeout(() => {
            // Hide all views
            views.forEach(id => {
                const element = document.getElementById(id);
                if (element && id !== viewId) {
                    element.style.display = 'none';
                    element.classList.remove('view-transition', 'view-transition-out');
                }
            });
            
            // Start the entrance animation
            if (targetView) {
                targetView.classList.add('view-transition');
                // Reset transform to trigger animation
                targetView.style.transform = '';
                targetView.style.opacity = '';
            }
        }, 300); // Match the duration of slideOutToLeft animation
    } else {
        // No current view or same view, show directly
        views.forEach(id => {
            const element = document.getElementById(id);
            if (element) {
                element.style.display = 'none';
                element.classList.remove('view-transition', 'view-transition-out');
            }
        });
        
        const targetView = document.getElementById(viewId);
        if (targetView) {
            targetView.style.display = 'block';
            targetView.style.transform = 'translateX(100%)';
            targetView.style.opacity = '0';
            
            // Start animation immediately
            setTimeout(() => {
                targetView.classList.add('view-transition');
                targetView.style.transform = '';
                targetView.style.opacity = '';
            }, 10);
        }
    }
}

function triggerLoadAnimations(container) {
    // Animation function removed - no longer needed
    // Elements with .animate-on-load class now show immediately
}

function showHome() {
    showView('home-view');
    trackAction('home_view');
}

function showCategories() {
    showView('categories-view');
    trackAction('categories_view');
}

function showDetails(type) {
    const details = {
        modern: {
            title: 'Modern Collection',
            description: 'Discover our contemporary furniture with clean lines, minimalist design, and premium materials. Perfect for modern homes and offices.',
            image: 'https://images.unsplash.com/photo-1586023492125-27b2c045efd7?w=300&h=200&fit=crop'
        },
        classic: {
            title: 'Classic Collection', 
            description: 'Timeless pieces that combine traditional craftsmanship with lasting comfort. Elegant designs that never go out of style.',
            image: 'https://images.unsplash.com/photo-1555041469-a586c61ea9bc?w=300&h=200&fit=crop'
        },
        luxury: {
            title: 'Luxury Collection',
            description: 'Premium furniture crafted from the finest materials. Exceptional quality and sophisticated design for discerning customers.',
            image: 'https://images.unsplash.com/photo-1567538096630-e0c55bd6374c?w=300&h=200&fit=crop'
        }
    };

    const detail = details[type];
    document.getElementById('detail-title').textContent = detail.title;
    document.getElementById('detail-description').textContent = detail.description;
    document.getElementById('detail-image').src = detail.image;

    showView('details-view');
    trackAction('detail_view', type);
}

// Enhanced contact function with loading animation
function contactUs() {
    const button = document.querySelector('#details-view .btn-primary');
    const originalContent = button.innerHTML;
    
    // Show loading animation
    button.innerHTML = '<span class="loading"></span>Connecting...';
    button.disabled = true;
    
    // Simulate contact process
    setTimeout(() => {
        button.innerHTML = '<i class="fa fa-check"></i> Thank you! We\'ll be in touch soon.';
        button.style.backgroundColor = '#28a745';
        button.style.borderColor = '#28a745';
        
        trackAction('contact_submitted');
        
        // Reset button after 3 seconds
        setTimeout(() => {
            button.innerHTML = originalContent;
            button.disabled = false;
            button.style.backgroundColor = '';
            button.style.borderColor = '';
        }, 3000);
    }, 2000);
}

function trackAction(action, data = null) {
    // Enhanced analytics tracking
    const timestamp = new Date().toISOString();
    const userAgent = navigator.userAgent;
    const viewportWidth = window.innerWidth;
    const isMobile = viewportWidth <= 768;
    
    const analyticsData = {
        action,
        page: getCurrentPage(),
        data: data ? { actionData: data, timestamp } : { timestamp },
        viewportWidth,
        isMobile
    };
    
    console.log('📊 Analytics:', analyticsData);
    
    // Send to API
    fetch('http://localhost:8082/api/visitors', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(analyticsData)
    })
    .then(response => response.json())
    .then(result => {
        console.log('✅ Analytics sent:', result);
    })
    .catch(error => {
        console.error('❌ Analytics error:', error);
        // Fallback: still log locally if API fails
    });
}

function getCurrentPage() {
    const currentView = getCurrentView();
    switch(currentView) {
        case 'home-view': return 'home';
        case 'categories-view': return 'categories';
        case 'details-view': return 'details';
        default: return 'unknown';
    }
}

// Enhanced image hover effects
function initializeImageEffects() {
    const cardImages = document.querySelectorAll('.card img');
    cardImages.forEach(img => {
        img.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.05)';
        });
        
        img.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1)';
        });
    });
    
    // Detail image click to zoom
    const detailImage = document.getElementById('detail-image');
    if (detailImage) {
        detailImage.addEventListener('click', function() {
            if (this.style.transform === 'scale(1.5)') {
                this.style.transform = 'scale(1)';
                this.style.cursor = 'zoom-in';
            } else {
                this.style.transform = 'scale(1.5)';
                this.style.cursor = 'zoom-out';
            }
        });
        detailImage.style.cursor = 'zoom-in';
    }
}

// Mobile swipe detection
function initializeSwipeDetection() {
    let startX = 0;
    let startY = 0;
    
    document.addEventListener('touchstart', function(e) {
        startX = e.touches[0].clientX;
        startY = e.touches[0].clientY;
    });
    
    document.addEventListener('touchend', function(e) {
        if (!startX || !startY) return;
        
        const endX = e.changedTouches[0].clientX;
        const endY = e.changedTouches[0].clientY;
        
        const deltaX = startX - endX;
        const deltaY = startY - endY;
        
        // Only trigger if horizontal swipe is more significant than vertical
        if (Math.abs(deltaX) > Math.abs(deltaY) && Math.abs(deltaX) > 50) {
            const currentView = getCurrentView();
            
            if (deltaX > 0) { // Swipe left
                if (currentView === 'home-view') {
                    showCategories();
                } else if (currentView === 'categories-view') {
                    // Could navigate to first collection
                    showDetails('modern');
                }
            } else { // Swipe right
                if (currentView === 'details-view') {
                    showCategories();
                } else if (currentView === 'categories-view') {
                    showHome();
                }
            }
        }
        
        startX = 0;
        startY = 0;
    });
}

function getCurrentView() {
    const views = ['home-view', 'categories-view', 'details-view'];
    return views.find(id => {
        const element = document.getElementById(id);
        return element && element.style.display !== 'none';
    }) || 'home-view';
}

// Responsive viewport handling
function handleViewportChange() {
    const viewportWidth = window.innerWidth;
    const swipeIndicator = document.querySelector('.swipe-indicator');
    
    if (viewportWidth <= 768 && swipeIndicator) {
        swipeIndicator.style.display = 'block';
        // Hide indicator after 5 seconds
        setTimeout(() => {
            if (swipeIndicator) {
                swipeIndicator.style.opacity = '0';
                setTimeout(() => {
                    swipeIndicator.style.display = 'none';
                }, 500);
            }
        }, 5000);
    }
}

// Initialize everything when page loads
document.addEventListener('DOMContentLoaded', function() {
    // Initialize features
    initializeImageEffects();
    initializeSwipeDetection();
    handleViewportChange();
    
    // Track page load
    trackAction('page_load');
});

// Handle window resize
window.addEventListener('resize', handleViewportChange);