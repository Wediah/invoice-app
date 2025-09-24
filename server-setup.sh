#!/bin/bash

# Server Setup Script for Apollo Invoice App
# Run this script ONCE on the server to set up the environment
# Run from: /var/www/invoice-app/

echo "🚀 Setting up Apollo Invoice Server Environment..."
echo "📍 Server Path: /var/www/invoice-app/"
echo ""

# Check if we're in the correct directory
if [ ! -f "artisan" ]; then
    echo "❌ Error: artisan file not found. Please run this script from the Laravel root directory."
    echo "Expected location: /var/www/invoice-app/"
    exit 1
fi

echo "✅ Confirmed: Running from correct directory: $(pwd)"
echo ""

# 1. Set proper ownership
echo "🔐 Setting proper ownership..."
sudo chown -R apolloinvoicegh:www-data /var/www/invoice-app/

# 2. Set proper permissions
echo "🔐 Setting proper permissions..."
sudo chmod -R 755 /var/www/invoice-app/
sudo chmod -R 775 storage/
sudo chmod -R 775 bootstrap/cache/

# 3. Make scripts executable
echo "🔧 Making scripts executable..."
chmod +x production-update.sh
chmod +x rollback.sh

# 4. Install Composer dependencies
echo "📦 Installing Composer dependencies..."
composer install --no-dev --optimize-autoloader --no-interaction

# 5. Install NPM dependencies
echo "📦 Installing NPM dependencies..."
npm ci --production

# 6. Build production assets
echo "🔨 Building production assets..."
npm run build

# 7. Generate application key (if not exists)
echo "🔑 Generating application key..."
if [ ! -f ".env" ]; then
    echo "❌ .env file not found. Please create it first."
    exit 1
fi

php artisan key:generate

# 8. Create storage link
echo "🔗 Creating storage link..."
php artisan storage:link

# 9. Set up caches
echo "⚡ Setting up caches..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 10. Optimize for production
echo "⚡ Optimizing for production..."
php artisan optimize

echo ""
echo "✅ Server setup completed successfully!"
echo "🌍 Apollo Invoice server environment is ready!"
echo ""
echo "📋 Next steps:"
echo "   1. Configure your .env file with production settings"
echo "   2. Run database migrations: php artisan migrate --force"
echo "   3. Test the application"
echo "   4. For future updates, use: ./production-update.sh"
echo ""
echo "🎉 Apollo Invoice is ready for production!"
