# Apollo Invoice - Production Deployment Guide

## 🚀 Pre-Deployment Checklist

### 1. Environment Configuration
```bash
# Set production environment variables
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-domain.com

# Database Configuration
DB_CONNECTION=mysql
DB_HOST=your-db-host
DB_PORT=3306
DB_DATABASE=apollo_invoice_prod
DB_USERNAME=your-db-user
DB_PASSWORD=your-secure-password

# Cache Configuration (Redis recommended for production)
CACHE_DRIVER=redis
REDIS_HOST=your-redis-host
REDIS_PASSWORD=your-redis-password
REDIS_PORT=6379

# Session Configuration
SESSION_DRIVER=redis
SESSION_LIFETIME=120

# Queue Configuration (if using queues)
QUEUE_CONNECTION=redis
```

### 2. Security Settings
```bash
# Generate application key
php artisan key:generate

# Set secure session settings
SESSION_SECURE_COOKIE=true
SESSION_HTTP_ONLY=true
SESSION_SAME_SITE=strict

# Set secure cookie settings
COOKIE_SECURE=true
COOKIE_HTTP_ONLY=true
COOKIE_SAME_SITE=strict
```

### 3. File Permissions
```bash
# Set proper permissions
chmod -R 755 storage
chmod -R 755 bootstrap/cache
chmod -R 755 public
chmod -R 755 public/build

# Set ownership (replace www-data with your web server user)
chown -R www-data:www-data storage
chown -R www-data:www-data bootstrap/cache
chown -R www-data:www-data public
```

## 🔧 Deployment Steps

### 1. Run Deployment Script
```bash
# Make script executable
chmod +x deploy.sh

# Run deployment
./deploy.sh
```

### 2. Manual Steps (if needed)
```bash
# Install dependencies
composer install --no-dev --optimize-autoloader
npm ci --production

# Build assets
npm run build

# Optimize Laravel
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize

# Run migrations
php artisan migrate --force

# Create storage link
php artisan storage:link
```

## 🌍 Country Codes Configuration

The application includes a comprehensive country codes system with caching:

- **Cache Duration**: 24 hours (configurable via `COUNTRY_CODES_CACHE_DURATION`)
- **Popular Countries**: Pre-cached for better performance
- **Default Country**: Ghana (+233)

### Cache Management
```bash
# Clear country codes cache
php artisan tinker --execute="App\Services\CountryCodeService::clearCache();"

# Or clear all caches
php artisan cache:clear
```

## 📱 Phone Number Features

### Validation Rules
- **Phone 1**: Required with country code
- **Phone 2 & 3**: Optional with smart validation
- **Country Code Selection**: Flag + code only (e.g., 🇬🇭 +233)

### Default Logo
- **Apollo Invoice Logo**: Used as default when no logo uploaded
- **Storage**: `storage/app/public/company_logo/apollo-invoice-default-logo.png`

## 🔒 Security Features

### CSRF Protection
- Automatic CSRF token handling for AJAX requests
- Token refresh on 419 errors
- User-friendly error messages

### Input Validation
- Phone number format validation
- Country code validation
- File upload validation (images only)

## 📊 Performance Optimizations

### Caching
- **Configuration**: Cached for production
- **Routes**: Cached for production
- **Views**: Cached for production
- **Country Codes**: Cached for 24 hours

### Database
- Optimized queries with proper indexing
- Soft deletes for data integrity
- Proper foreign key constraints

## 🚨 Monitoring & Logging

### Log Files
- **Location**: `storage/logs/laravel.log`
- **Level**: Production logs (errors and info)
- **Rotation**: Automatic log rotation

### Error Handling
- Graceful error handling with user-friendly messages
- Detailed logging for debugging
- No sensitive data in logs

## 🔄 Maintenance

### Regular Tasks
```bash
# Clear caches (weekly)
php artisan cache:clear

# Clear country codes cache (monthly)
php artisan tinker --execute="App\Services\CountryCodeService::clearCache();"

# Check logs
tail -f storage/logs/laravel.log
```

### Backup Strategy
- Database backups (daily)
- File storage backups (weekly)
- Configuration backups (monthly)

## 🌐 Web Server Configuration

### Nginx Example
```nginx
server {
    listen 80;
    server_name your-domain.com;
    root /path/to/apollo-invoice/public;
    
    index index.php;
    
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }
    
    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }
    
    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

### Apache Example
```apache
<VirtualHost *:80>
    ServerName your-domain.com
    DocumentRoot /path/to/apollo-invoice/public
    
    <Directory /path/to/apollo-invoice/public>
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

## ✅ Post-Deployment Verification

1. **Test User Registration**: Verify country code selection works
2. **Test Company Creation**: Verify phone validation and logo handling
3. **Test CSRF Protection**: Verify AJAX requests work properly
4. **Check Logs**: Ensure no errors in `storage/logs/laravel.log`
5. **Performance Test**: Verify page load times are acceptable

## 🆘 Troubleshooting

### Common Issues
1. **419 Errors**: Check CSRF token configuration
2. **Country Codes Not Loading**: Clear cache and check file permissions
3. **Logo Not Displaying**: Verify storage link and file permissions
4. **Phone Validation Errors**: Check validation rules in controller

### Support
- Check logs: `tail -f storage/logs/laravel.log`
- Clear caches: `php artisan cache:clear`
- Verify permissions: `ls -la storage/`

---

**Apollo Invoice** - Ready for Production! 🚀
