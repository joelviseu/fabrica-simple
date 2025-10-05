# HomeStyle Furniture API

A PHP REST API built with Slim Framework for tracking visitor analytics on the HomeStyle Furniture website.

## 🚀 Quick Start

### Prerequisites
- PHP 8.0+
- Composer
- MySQL 5.7+

### Installation

1. **Install Dependencies**
```bash
cd api
composer install
```

2. **Environment Setup**
```bash
cp .env.example .env
# Edit .env with your database credentials
```

3. **Database Setup**
```bash
# Create database and tables
mysql -u root -p < database/schema.sql
```

4. **Start Development Server**
```bash
composer start
# or
php -S localhost:8080 -t public
```

API will be available at: `http://localhost:8080`

## 📡 API Endpoints

### Base URL: `http://localhost:8080`

| Method | Endpoint | Description |
|--------|----------|-------------|
| `GET` | `/` | API information |
| `POST` | `/api/visitors` | Record visitor action |
| `GET` | `/api/visitors` | List all visitors |
| `GET` | `/api/visitors/{id}` | Get specific visitor |

### 📊 Record Visitor Action

**POST** `/api/visitors`

```json
{
    "action": "page_load",
    "page": "home",
    "data": {
        "referrer": "https://google.com"
    },
    "viewportWidth": 1920,
    "isMobile": false
}
```

**Response:**
```json
{
    "statusCode": 201,
    "data": {
        "id": 1,
        "ip_address": "127.0.0.1",
        "user_agent": "Mozilla/5.0...",
        "page": "home",
        "action": "page_load",
        "data": "{\"referrer\":\"https://google.com\"}",
        "viewport_width": 1920,
        "is_mobile": false,
        "created_at": "2025-10-05 10:30:00"
    }
}
```

### 📋 List Visitors

**GET** `/api/visitors`

Returns last 100 visitor records ordered by date.

### 👤 Get Specific Visitor

**GET** `/api/visitors/1`

Returns specific visitor record by ID.

## 🏗️ Architecture

### Clean Architecture
- **Domain Layer**: Business logic and entities
- **Application Layer**: Use cases and application services
- **Infrastructure Layer**: Database, external services

### Key Components
- **Visitor Entity**: Core business object
- **VisitorRepository**: Data access interface
- **Actions**: Request handlers (controllers)
- **Middleware**: CORS, error handling

### Database Schema
```sql
CREATE TABLE visitors (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ip_address VARCHAR(45) NOT NULL,
    user_agent TEXT NOT NULL,
    page VARCHAR(255) NOT NULL,
    action VARCHAR(100) NOT NULL,
    data JSON NULL,
    viewport_width INT DEFAULT 0,
    is_mobile BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

## 🔧 Configuration

### Environment Variables (.env)
```env
# Database
DB_HOST=localhost
DB_NAME=homestyle_furniture
DB_USER=root
DB_PASS=

# API
API_DEBUG=true
API_LOG_LEVEL=debug

# CORS
CORS_ORIGIN=http://localhost:3000
```

### CORS Configuration
The API includes CORS middleware to allow cross-origin requests from the frontend.

## 🛠️ Development

### Project Structure
```
api/
├── app/                    # Application configuration
│   ├── dependencies.php   # DI container setup
│   ├── middleware.php     # Middleware configuration
│   ├── routes.php         # Route definitions
│   └── settings.php       # Application settings
├── database/              # Database files
│   └── schema.sql         # Database schema
├── public/                # Web root
│   └── index.php         # Application entry point
├── src/                   # Source code
│   ├── Application/       # Application layer
│   ├── Domain/           # Domain layer
│   └── Infrastructure/   # Infrastructure layer
├── .env.example          # Environment template
└── composer.json         # PHP dependencies
```

### Adding New Features

1. **New Domain Entity**: Add to `src/Domain/`
2. **New Repository**: Implement interface in `src/Infrastructure/Persistence/`
3. **New API Endpoint**: Create action in `src/Application/Actions/`
4. **Register Route**: Add to `app/routes.php`

### Testing
```bash
composer test
```

## 📈 Analytics Queries

### Popular Actions
```sql
SELECT action, COUNT(*) as count 
FROM visitors 
GROUP BY action 
ORDER BY count DESC;
```

### Daily Visitors
```sql
SELECT DATE(created_at) as date, 
       COUNT(DISTINCT ip_address) as unique_visitors
FROM visitors 
GROUP BY DATE(created_at) 
ORDER BY date DESC;
```

### Mobile vs Desktop
```sql
SELECT 
    is_mobile,
    COUNT(*) as total,
    COUNT(DISTINCT ip_address) as unique_visitors
FROM visitors 
GROUP BY is_mobile;
```

## 🔒 Security

- Input validation on all endpoints
- SQL injection prevention using prepared statements
- IP address tracking with proxy header support
- Error handling without sensitive information exposure

## 📝 Logging

Logs are written to `logs/app.log` and include:
- API requests and responses
- Database operations
- Error tracking
- Performance metrics

## 🚀 Production Deployment

1. Set `API_DEBUG=false` in production
2. Configure proper database credentials
3. Set up web server (Apache/Nginx)
4. Enable error logging
5. Configure CORS for production domains