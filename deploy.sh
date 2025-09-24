#!/bin/bash

# Production Deployment Script for Apollo Invoice App
# This script prepares the application for production deployment

echo "🚀 Starting Apollo Invoice Production Deployment..."

# Set production environment
export APP_ENV=production
export APP_DEBUG=false

# Install/Update Composer Dependencies
echo "📦 Installing Composer dependencies..."
composer install --no-dev --optimize-autoloader --no-interaction

# Install/Update NPM Dependencies
echo "📦 Installing NPM dependencies..."
npm ci --production

# Build Assets
echo "🔨 Building production assets..."
npm run build

# Clear and Cache Configuration
echo "⚡ Optimizing Laravel caches..."
php artisan config:clear
php artisan config:cache
php artisan route:clear
php artisan route:cache
php artisan view:clear
php artisan view:cache
php artisan cache:clear

# Run Database Migrations
echo "🗄️ Running database migrations..."
php artisan migrate --force

# Clear and Cache Country Codes
echo "🌍 Caching country codes..."
php artisan tinker --execute="App\Services\CountryCodeService::clearCache();"

# Set Proper Permissions
echo "🔐 Setting proper permissions..."
chmod -R 755 storage
chmod -R 755 bootstrap/cache
chmod -R 755 public
chmod -R 755 public/build

# Create Storage Link
echo "🔗 Creating storage link..."
php artisan storage:link

# Clear Logs
echo "🧹 Clearing old logs..."
> storage/logs/laravel.log

# Optimize for Production
echo "⚡ Optimizing for production..."
php artisan optimize

echo "✅ Production deployment completed successfully!"
echo "🌍 Apollo Invoice is ready for production!"
