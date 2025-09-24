#!/bin/bash

# Rollback Script for Apollo Invoice App
# Use this script to quickly rollback if issues occur after production update
# Run this script on the server: /var/www/invoice-app/

echo "🔄 Starting Apollo Invoice Rollback..."
echo "⚠️  WARNING: This will rollback recent changes!"
echo ""

# Check if we're in the correct directory
if [ ! -f "artisan" ]; then
    echo "❌ Error: artisan file not found. Please run this script from the Laravel root directory."
    echo "Expected location: /var/www/invoice-app/"
    exit 1
fi

echo "✅ Confirmed: Running from correct directory: $(pwd)"

# Confirmation prompt
read -p "Are you sure you want to rollback? (yes/no): " confirm
if [ "$confirm" != "yes" ]; then
    echo "❌ Rollback cancelled by user"
    exit 1
fi

echo "🔄 Starting rollback process..."

# 1. Put application in maintenance mode
echo "🔧 Enabling maintenance mode..."
php artisan down --message="Rolling back Apollo Invoice - Back in a few minutes" --retry=60

# 2. Rollback database migrations
echo "🗄️ Rolling back database migrations..."
php artisan migrate:rollback --step=1

# 3. Clear caches
echo "🧹 Clearing caches..."
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# 4. Restore previous assets (if you have them)
echo "📦 Restoring previous assets..."
# Uncomment and modify the next line if you have a backup of previous assets
# cp -r backup_assets/* public/

# 5. Disable maintenance mode
echo "✅ Disabling maintenance mode..."
php artisan up

echo ""
echo "✅ Rollback completed!"
echo "🔍 Please verify the application is working correctly."
echo "📋 Check logs: tail -f storage/logs/laravel.log"
echo ""
echo "🆘 If you need further assistance, contact your system administrator."
