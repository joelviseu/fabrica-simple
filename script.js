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
    
    // Disabled API call for analytics (PHP backend)
    /*
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
    */
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

 // Close navbar collapse on nav link click (mobile)
$(function() {
    // Use event delegation for robustness
    $('.navbar-nav').on('click', 'a', function() {
        var $toggle = $('.navbar-toggle');
        var $collapse = $('#main-navbar');
        // Only close if toggle is visible and menu is open
        if ($toggle.is(':visible') && $collapse.hasClass('in')) {
            setTimeout(function() {
                $collapse.collapse('hide');
            }, 100); // Small delay to allow navigation
        }
    });
});