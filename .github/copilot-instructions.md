# Copilot Instructions - HomeStyle Furniture

## Project Overview
This is a furniture showcase website with enhanced animations and mobile responsiveness. The project demonstrates a furniture company's product collections through an interactive, multi-view interface with separated concerns for better maintainability.

## Architecture & Structure

### File Organization
- **`index.html`**: Main HTML structure and content
- **`styles.css`**: All CSS styling including animations and responsive design
- **`script.js`**: JavaScript functionality, animations, and mobile interactions
- **View Management**: Uses `display: none/block` to toggle between three main views: home, categories, and details
- **No Build Process**: Direct file serving - open `index.html` in browser or serve with any static server

### Key Components
1. **Hero Section**: Full-width banner with call-to-action and gradient overlay
2. **Home View**: Card-based navigation for furniture categories (kitchens, living rooms, bedrooms, storage)
3. **Categories View**: Three furniture collections (Modern, Classic, Luxury) with hover effects
4. **Details View**: Detailed view for each collection with interactive contact CTA

## Development Patterns

### CSS Architecture (`styles.css`)
- **CSS Custom Properties**: Uses `--primary-color` and `--secondary-color` for consistent theming
- **Bootstrap 3.4.1**: External CSS framework for grid and components
- **Font Awesome 5.15.4**: Icon library for UI elements
- **Enhanced Animations**: `slideIn`, `fadeInUp` keyframes with staggered delays
- **Mobile-First Responsive**: Breakpoints at 768px and 480px with optimized layouts
- **Interactive Effects**: Card hover, button shimmer, image zoom transitions

### JavaScript Architecture (`script.js`)
- **Pure Vanilla JS**: No frameworks - efficient DOM manipulation
- **Modular Functions**: Separated concerns for view management, animations, and interactions
- **Enhanced Navigation**: `showView()` function with animation triggers
- **Mobile Features**: Swipe detection for navigation, touch-friendly interactions
- **Analytics Tracking**: Enhanced `trackAction()` with device and viewport data

### External Dependencies
- Bootstrap 3.4.1 (CDN)
- Font Awesome 5.15.4 (CDN) 
- Unsplash images (CDN) - specific image URLs with crop parameters
- HTMX 1.9.12 (loaded but not actively used)

## Development Workflow

### Local Development
```bash
# Serve locally (any method works)
python -m http.server 8000
# OR
npx serve .
# OR simply open index.html in browser
```

### Making Changes
- **HTML Structure**: Edit `index.html` for content and layout changes
- **Styling**: Edit `styles.css` for visual design, animations, and responsive behavior
- **Functionality**: Edit `script.js` for interactions, navigation, and business logic
- **Images**: Replace Unsplash URLs with new ones (maintain crop parameters)

## Project-Specific Conventions

### Color Scheme
- Primary: `#b48a78` (warm brown)
- Secondary: `#2d3a4b` (dark blue-gray)
- Applied via CSS custom properties and Bootstrap overrides

### Animation System
- **View Transitions**: `slideIn` animation for view changes
- **Staggered Loading**: `.animate-on-load` elements with incremental delays
- **Interactive Feedback**: Hover effects, loading states, and success animations
- **Mobile Swipe**: Touch-based navigation with visual feedback

### Image Handling
- All images use Unsplash with specific crop parameters: `?w=400&h=250&fit=crop`
- Hero background uses gradient overlay for text readability
- Interactive zoom functionality on detail images

### Navigation Pattern
- Breadcrumb-style navigation with Home/Back buttons
- Swipe gestures for mobile navigation (left/right)
- Each view change triggers animation and analytics tracking

### Data Management
- Product information stored as literal objects in JavaScript functions
- No external data sources or API calls
- Easy to extend by adding new objects to the `details` object in `showDetails()`

## Adding New Features

### New Product Categories
1. Add new card in `home-view` section (`index.html`)
2. Add corresponding case in `showDetails()` function (`script.js`)
3. Update navigation onclick handlers
4. Add any new styles to `styles.css`

### New Collections
1. Add new card in `categories-view` (`index.html`)
2. Add new object to `details` in `showDetails()` (`script.js`)
3. Include new image URL with proper crop parameters

### Styling Updates
- Modify CSS custom properties in `styles.css` for theme changes
- All cards inherit hover effects automatically
- Bootstrap classes handle responsive behavior
- Animation timing can be adjusted via CSS variables