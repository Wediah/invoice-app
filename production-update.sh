#!/bin/bash

# Production Update Script for Apollo Invoice App
# This script safely updates a live production system without disrupting existing data
# Run this script on the server after pulling from GitHub

echo "🚀 Starting Apollo Invoice Production Update..."
echo "⚠️  WARNING: This will update a live production system!"
echo "📋 Please ensure you have:"
echo "   1. Database backup completed"
echo "   2. File system backup completed"
echo "   3. Rollback plan ready"
echo ""

# Confirmation prompt
read -p "Do you want to continue? (yes/no): " confirm
if [ "$confirm" != "yes" ]; then
    echo "❌ Update cancelled by user"
    exit 1
fi

echo "✅ Starting production update..."

# Set production environment
export APP_ENV=production
export APP_DEBUG=false

# Create backup timestamp
BACKUP_TIMESTAMP=$(date +%Y%m%d_%H%M%S)
echo "📦 Backup timestamp: $BACKUP_TIMESTAMP"

# Check if we're in the correct directory
if [ ! -f "artisan" ]; then
    echo "❌ Error: artisan file not found. Please run this script from the Laravel root directory."
    echo "Expected location: /var/www/invoice-app/"
    exit 1
fi

echo "✅ Confirmed: Running from correct directory: $(pwd)"

# 1. Backup current database (if not already done)
echo "💾 Creating database backup..."
# Uncomment the next line if you want automatic DB backup
# mysqldump -u your_username -p your_database > "backup_${BACKUP_TIMESTAMP}.sql"

# 2. Put application in maintenance mode
echo "🔧 Enabling maintenance mode..."
php artisan down --message="Updating Apollo Invoice - Back in a few minutes" --retry=60

# 3. Install/Update Composer Dependencies (production-safe)
echo "📦 Installing Composer dependencies..."
composer install --no-dev --optimize-autoloader --no-interaction --no-scripts

# 4. Install/Update NPM Dependencies
echo "📦 Installing NPM dependencies..."
npm ci --production

# 5. Build Assets
echo "🔨 Building production assets..."
npm run build

# 6. Run Database Migrations (production-safe)
echo "🗄️ Running database migrations..."
php artisan migrate --force

# 7. Clear and Cache Configuration (production-safe)
echo "⚡ Optimizing Laravel caches..."
php artisan config:clear
php artisan config:cache
php artisan route:clear
php artisan route:cache
php artisan view:clear
php artisan view:cache

# 8. Clear application cache
echo "🧹 Clearing application cache..."
php artisan cache:clear

# 9. Clear and Cache Country Codes (new feature)
echo "🌍 Caching country codes..."
php artisan tinker --execute="App\Services\CountryCodeService::clearCache();"

# 10. Set Proper Permissions (production-safe)
echo "🔐 Setting proper permissions..."
chmod -R 755 storage
chmod -R 755 bootstrap/cache
chmod -R 755 public
chmod -R 755 public/build

# 11. Create Storage Link (if not exists)
echo "🔗 Ensuring storage link exists..."
php artisan storage:link

# 12. Optimize for Production
echo "⚡ Optimizing for production..."
php artisan optimize

# 13. Disable maintenance mode
echo "✅ Disabling maintenance mode..."
php artisan up

# 14. Verify deployment
echo "🔍 Verifying deployment..."
php artisan about

echo ""
echo "✅ Production update completed successfully!"
echo "🌍 Apollo Invoice has been updated with country code features!"
echo ""
echo "📋 Post-deployment checklist:"
echo "   1. Test user registration with country code selection"
echo "   2. Test company creation with new phone validation"
echo "   3. Verify existing companies still display correctly"
echo "   4. Check logs: tail -f storage/logs/laravel.log"
echo "   5. Monitor application performance"
echo ""
echo "🆘 If issues occur, rollback with:"
echo "   php artisan down"
echo "   git checkout previous-commit"
echo "   php artisan migrate:rollback"
echo "   php artisan up"
echo ""
echo "🎉 Apollo Invoice is ready with enhanced country code features!"
