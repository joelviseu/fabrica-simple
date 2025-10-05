# HomeStyle Furniture Website

A modern, responsive furniture showcase website featuring smooth animations and mobile-optimized interactions.

## ✨ Features

- **Smooth Right-to-Left Transitions**: Professional view transitions between sections
- **Mobile-First Design**: Optimized for all screen sizes with touch-friendly interactions  
- **Swipe Navigation**: Touch gestures for mobile navigation
- **Interactive Elements**: Hover effects, loading animations, and image zoom functionality
- **Clean Architecture**: Separated CSS, JavaScript, and HTML for maintainability

## 🚀 Quick Start

### Option 1: Direct Browser
Simply open `index.html` in your web browser.

### Option 2: Local Server
```bash
# Using Python
python -m http.server 8000

# Using Node.js
npx serve .

# Using PHP
php -S localhost:8000
```

Then visit `http://localhost:8000`

## 📁 Project Structure

```
fabrica-simple/
├── index.html              # Main HTML structure
├── styles.css              # All CSS styling and animations
├── script.js               # JavaScript functionality and interactions
├── .github/
│   └── copilot-instructions.md  # AI coding assistant guidelines
└── README.md               # This file
```

## 🎨 Design Features

### Color Scheme
- **Primary**: `#b48a78` (Warm Brown)
- **Secondary**: `#2d3a4b` (Dark Blue-Gray)

### Animations
- **View Transitions**: Smooth right-to-left sliding between sections
- **Button Effects**: Shimmer hover animations with lift effects
- **Image Interactions**: Hover scaling and click-to-zoom functionality
- **Loading States**: Interactive feedback for user actions

### Responsive Breakpoints
- **Desktop**: 1200px+
- **Tablet**: 768px - 1199px
- **Mobile**: < 768px
- **Small Mobile**: < 480px

## 🔧 Development

### File Organization
- **HTML**: Pure semantic markup in `index.html`
- **CSS**: Modular styling with custom properties in `styles.css`
- **JavaScript**: Vanilla JS with modern ES6+ features in `script.js`

### External Dependencies
- Bootstrap 3.4.1 (CDN)
- Font Awesome 5.15.4 (CDN)
- Unsplash Images (CDN)

### Browser Support
- Modern browsers (Chrome, Firefox, Safari, Edge)
- Mobile browsers (iOS Safari, Chrome Mobile)
- Responsive design for all screen sizes

## 📱 Mobile Features

- **Touch Navigation**: Swipe left/right to navigate between views
- **Responsive Images**: Optimized sizing for mobile viewports
- **Touch-Friendly**: Appropriate touch targets and spacing
- **Performance Optimized**: Smooth animations on mobile devices

## 🛠️ Customization

### Adding New Collections
1. Add new card in `categories-view` section (`index.html`)
2. Add collection data in `showDetails()` function (`script.js`)
3. Include new image URL with crop parameters

### Styling Updates
- Modify CSS custom properties in `styles.css` for theme changes
- All interactive elements inherit hover effects automatically
- Animation timing can be adjusted via CSS variables

### Content Updates
- Product information stored in JavaScript objects for easy modification
- Image URLs use Unsplash with consistent crop parameters
- All text content easily editable in HTML

## 📄 License

This project is open source and available under the [MIT License](LICENSE).

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Test across different devices and browsers
5. Submit a pull request

---

**Built with ❤️ using vanilla HTML, CSS, and JavaScript**