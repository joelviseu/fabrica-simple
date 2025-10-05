// Alpine.js SPA logic for HomeStyle with sub-page (detail) support
    function spaApp() {
    return {
            swipeInPanel(panel) {
                if (panel) {
                    panel.style.opacity = '0';
                    panel.style.transform = 'translateX(100vw)';
                    void panel.offsetWidth;
                    panel.classList.remove('swipe-in-right', 'swipe-in-left');
                    panel.classList.add('swipe-in-right');
                    setTimeout(() => {
                        panel.classList.remove('swipe-in-right');
                        panel.style.opacity = '';
                        panel.style.transform = '';
                    }, 600);
                }
            },
            view: 'home',
            data: null,
            history: [], // stack for back navigation
            init() {
                window.addEventListener('hashchange', this.route.bind(this));
                this.route();
            },
            route() {
                const hash = window.location.hash.replace('#', '');
                let endpoint = '';
                let isHome = false;
                if (!hash || hash === 'home') {
                    endpoint = 'api/categories/home.php';
                    isHome = true;
                } else {
                    // Support for sub-pages: e.g. kitchen_styles/modern-kitchen
                    const [section, subpage] = hash.split('/');
                    if (section.startsWith('kitchen')) endpoint = 'api/categories/kitchen.php';
                    else if (section.startsWith('livingroom')) endpoint = 'api/categories/livingroom.php';
                    else if (section.startsWith('bedroom')) endpoint = 'api/categories/bedroom.php';
                    else if (section.startsWith('storage')) endpoint = 'api/categories/storage.php';
                    else endpoint = '';
                }
                let fetchPromise = endpoint ? fetch(endpoint).then(r => r.json()) : Promise.resolve(null);
                const main = document.getElementById('main-content');
                const oldPanel = main.querySelector('.panel-content');
                let animationPromise = new Promise(resolve => {
                    if (oldPanel) {
                        oldPanel.classList.remove('swipe-in-right', 'swipe-in-left');
                        oldPanel.classList.add('swipe-out-left');
                        setTimeout(() => {
                            oldPanel.classList.remove('swipe-out-left');
                            resolve();
                        }, 600);
                    } else {
                        resolve();
                    }
                });
                Promise.all([fetchPromise, animationPromise]).then(([json, _]) => {
                    if (isHome) {
                        // Force Alpine to re-render home view for animation
                        const setAndAnimateHome = () => {
                            this.view = 'home';
                            this.data = json;
                            this.$nextTick(() => {
                                const newPanel = this.$refs.panelContent;
                                if (newPanel) {
                                    newPanel.style.opacity = '0';
                                    newPanel.style.transform = 'translateX(100vw)';
                                    void newPanel.offsetWidth;
                                    this.animateIn();
                                }
                            });
                        };
                        if (this.view === 'home') {
                            this.view = '';
                            this.$nextTick(setAndAnimateHome);
                        } else {
                            setAndAnimateHome();
                        }
                    } else {
                        const hash = window.location.hash.replace('#', '');
                        const [section, subpage] = hash.split('/');
                        if (subpage && json && json.items) {
                            // Find the item by slug or name (slugify for safety)
                            const slug = subpage;
                            const item = json.items.find(i => this.slugify(i.name) === slug);
                            if (item) {
                                // Render as detail page, but use same template structure
                                this.view = 'detail';
                                this.data = {
                                    title: item.name,
                                    items: item.details && Array.isArray(item.details) ? item.details : []
                                };
                            } else {
                                this.view = section;
                                this.data = json;
                            }
                        } else {
                            this.view = section;
                            this.data = json;
                        }
                    }
                    this.$nextTick(() => {
                        // Always hide and set transform before animating
                        const newPanel = this.$refs.panelContent;
                        if (newPanel) {
                            newPanel.style.opacity = '0';
                            newPanel.style.transform = 'translateX(100vw)';
                            void newPanel.offsetWidth;
                            this.animateIn();
                        }
                    });
                });
            },
            animateIn() {
                const newPanel = this.$refs.panelContent;
                if (newPanel) {
                    // Remove any previous swipe-in classes
                    newPanel.classList.remove('swipe-in-right', 'swipe-in-left');
                    // Always animate in from right
                    newPanel.classList.add('swipe-in-right');
                    // After animation, reset styles
                    setTimeout(() => {
                        newPanel.classList.remove('swipe-in-right');
                        newPanel.style.opacity = '';
                        newPanel.style.transform = '';
                    }, 600);
                }
            },
            navigate(section) {
                // Push to history for back navigation
                this.history.push(window.location.hash);
                window.location.hash = section + '_styles';
            },
            navigateDetail(detailsSlug) {
                // Push to history for back navigation
                this.history.push(window.location.hash);
                const oldHash = window.location.hash;
                window.location.hash += '/' + detailsSlug;
                // Only call route() if hashchange will not fire (hash unchanged)
                this.$nextTick(() => {
                    if (window.location.hash === oldHash) {
                        this.route();
                    }
                });
            },
            goBack() {
                if (this.history.length > 0) {
                    const prev = this.history.pop();
                    window.location.hash = prev.replace('#', '');
                } else {
                    // If on a detail page, go to parent category
                    const hash = window.location.hash.replace('#', '');
                    if (hash.includes('/')) {
                        const parent = hash.split('/')[0];
                        window.location.hash = parent;
                    }
                    // No further action needed; fallback handled by outer function
                }
            },
            slugify(str) {
                return str.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)/g, '');
            }
        }
    }
    window.spaApp = spaApp;