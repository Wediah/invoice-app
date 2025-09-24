# Apollo Invoice - GitHub to Server Deployment Guide

## 🚀 Deployment Workflow: Local → GitHub → Server

### **Server Details:**
- **Server Path**: `/var/www/invoice-app/`
- **User**: `apolloinvoicegh@apollo-invoice`
- **Environment**: Production

---

## 📋 Complete Deployment Process

### **Step 1: Local Development (Your Current Environment)**
```bash
# You're currently here: /Users/georgeagyemang/Desktop/laravelworkspace/invoice-app/

# 1. Test everything locally first
npm run build
php artisan migrate
php artisan config:cache

# 2. Commit your changes
git add .
git commit -m "Add country code selection and production optimizations"

# 3. Push to GitHub
git push origin main
```

### **Step 2: Server Deployment**
```bash
# SSH into your server
ssh apolloinvoicegh@apollo-invoice

# Navigate to the project directory
cd /var/www/invoice-app/

# Pull latest changes from GitHub
git pull origin main

# Run the production update script
chmod +x production-update.sh
./production-update.sh
```

---

## 🛠️ Server Setup Commands

### **Initial Server Setup (One-time only):**
```bash
# SSH into server
ssh apolloinvoicegh@apollo-invoice

# Navigate to project directory
cd /var/www/invoice-app/

# Make scripts executable
chmod +x production-update.sh
chmod +x rollback.sh

# Set proper ownership (if needed)
sudo chown -R apolloinvoicegh:www-data /var/www/invoice-app/
sudo chmod -R 755 /var/www/invoice-app/

# Set proper permissions for Laravel
sudo chmod -R 775 storage/
sudo chmod -R 775 bootstrap/cache/
```

---

## 🔄 Regular Update Process

### **Every time you want to deploy updates:**

#### **1. Local (Your Machine):**
```bash
# Navigate to your local project
cd /Users/georgeagyemang/Desktop/laravelworkspace/invoice-app/

# Test locally
npm run build
php artisan migrate

# Commit and push
git add .
git commit -m "Your update message"
git push origin main
```

#### **2. Server (Production):**
```bash
# SSH into server
ssh apolloinvoicegh@apollo-invoice

# Navigate to project
cd /var/www/invoice-app/

# Pull latest changes
git pull origin main

# Run production update
./production-update.sh
```

---

## 📁 File Structure on Server

```
/var/www/invoice-app/
├── app/
├── bootstrap/
├── config/
├── database/
├── public/
├── resources/
├── routes/
├── storage/
├── vendor/
├── artisan
├── composer.json
├── package.json
├── production-update.sh
├── rollback.sh
└── .env
```

---

## 🔧 Server Environment Configuration

### **Create/Update `.env` file on server:**
```bash
# SSH into server
ssh apolloinvoicegh@apollo-invoice
cd /var/www/invoice-app/

# Edit environment file
nano .env
```

### **Production `.env` settings:**
```env
APP_NAME="Apollo Invoice"
APP_ENV=production
APP_KEY=base64:your-generated-key
APP_DEBUG=false
APP_URL=https://your-domain.com

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=apollo_invoice_prod
DB_USERNAME=your_db_user
DB_PASSWORD=your_db_password

CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_CONNECTION=sync

MAIL_MAILER=smtp
MAIL_HOST=your-smtp-host
MAIL_PORT=587
MAIL_USERNAME=your-email
MAIL_PASSWORD=your-password
MAIL_ENCRYPTION=tls
```

---

## 🚨 Emergency Procedures

### **If something goes wrong on server:**

#### **Quick Rollback:**
```bash
# SSH into server
ssh apolloinvoicegh@apollo-invoice
cd /var/www/invoice-app/

# Run rollback script
./rollback.sh
```

#### **Manual Rollback:**
```bash
# Put in maintenance mode
php artisan down

# Rollback database migration
php artisan migrate:rollback --step=1

# Clear caches
php artisan cache:clear
php artisan config:clear

# Disable maintenance mode
php artisan up
```

---

## 📊 Monitoring and Verification

### **After each deployment, check:**

#### **1. Application Status:**
```bash
# Check if application is running
php artisan about

# Check logs
tail -f storage/logs/laravel.log

# Check if maintenance mode is off
curl -I https://your-domain.com
```

#### **2. Test Key Features:**
- ✅ User registration with country code selection
- ✅ Company creation with phone validation
- ✅ Existing data displays correctly
- ✅ New country code features work

#### **3. Performance Check:**
```bash
# Check disk space
df -h

# Check memory usage
free -h

# Check if processes are running
ps aux | grep php
```

---

## 🔐 Security Considerations

### **File Permissions:**
```bash
# Set correct permissions
sudo chown -R apolloinvoicegh:www-data /var/www/invoice-app/
sudo chmod -R 755 /var/www/invoice-app/
sudo chmod -R 775 storage/
sudo chmod -R 775 bootstrap/cache/
```

### **Environment Security:**
```bash
# Make sure .env is not accessible via web
echo "Deny from all" > public/.env
```

---

## 📝 Deployment Checklist

### **Before Each Deployment:**
- [ ] Test locally with `npm run build`
- [ ] Test locally with `php artisan migrate`
- [ ] Commit all changes to Git
- [ ] Push to GitHub
- [ ] Backup production database (optional but recommended)

### **During Deployment:**
- [ ] SSH into server
- [ ] Navigate to `/var/www/invoice-app/`
- [ ] Pull from GitHub
- [ ] Run `./production-update.sh`
- [ ] Monitor the output for errors

### **After Deployment:**
- [ ] Test user registration
- [ ] Test company creation
- [ ] Verify existing data
- [ ] Check logs for errors
- [ ] Monitor performance

---

## 🆘 Troubleshooting

### **Common Issues:**

#### **1. Permission Denied:**
```bash
sudo chown -R apolloinvoicegh:www-data /var/www/invoice-app/
sudo chmod -R 755 /var/www/invoice-app/
```

#### **2. Composer Issues:**
```bash
composer install --no-dev --optimize-autoloader
```

#### **3. NPM Issues:**
```bash
npm ci --production
npm run build
```

#### **4. Database Issues:**
```bash
php artisan migrate --force
```

#### **5. Cache Issues:**
```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

---

## 🎯 Quick Commands Reference

### **Local Development:**
```bash
npm run build
php artisan migrate
git add .
git commit -m "Your message"
git push origin main
```

### **Server Deployment:**
```bash
ssh apolloinvoicegh@apollo-invoice
cd /var/www/invoice-app/
git pull origin main
./production-update.sh
```

### **Emergency Rollback:**
```bash
ssh apolloinvoicegh@apollo-invoice
cd /var/www/invoice-app/
./rollback.sh
```

---

**Your Apollo Invoice app is ready for production deployment! 🚀**
