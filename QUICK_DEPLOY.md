# Apollo Invoice - Quick Deployment Reference

## 🚀 Your Deployment Workflow

### **Local → GitHub → Server**

---

## 📋 Step-by-Step Deployment

### **1. Local Development (Your Machine)**
```bash
# Navigate to your project
cd /Users/georgeagyemang/Desktop/laravelworkspace/invoice-app/

# Test locally
npm run build
php artisan migrate

# Commit and push
git add .
git commit -m "Add country code features"
git push origin main
```

### **2. Server Deployment**
```bash
# SSH into your server
ssh apolloinvoicegh@apollo-invoice

# Navigate to project directory
cd /var/www/invoice-app/

# Pull latest changes
git pull origin main

# Run production update
./production-update.sh
```

---

## 🛠️ Server Setup (One-time only)

### **First time on server:**
```bash
# SSH into server
ssh apolloinvoicegh@apollo-invoice

# Navigate to project
cd /var/www/invoice-app/

# Run setup script
chmod +x server-setup.sh
./server-setup.sh

# Configure .env file
nano .env

# Run migrations
php artisan migrate --force
```

---

## 🔄 Regular Updates

### **Every time you want to deploy:**

#### **Local:**
```bash
git add .
git commit -m "Your update message"
git push origin main
```

#### **Server:**
```bash
ssh apolloinvoicegh@apollo-invoice
cd /var/www/invoice-app/
git pull origin main
./production-update.sh
```

---

## 🆘 Emergency Rollback

```bash
ssh apolloinvoicegh@apollo-invoice
cd /var/www/invoice-app/
./rollback.sh
```

---

## 📁 Server Directory Structure

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
├── production-update.sh    ← Main deployment script
├── rollback.sh            ← Emergency rollback
├── server-setup.sh        ← One-time setup
└── .env                   ← Environment config
```

---

## 🔧 Scripts Explained

| Script | Purpose | When to Use |
|--------|---------|-------------|
| `server-setup.sh` | Initial server setup | First time only |
| `production-update.sh` | Deploy updates | Every update |
| `rollback.sh` | Emergency rollback | If issues occur |

---

## ⚡ Quick Commands

### **Deploy Update:**
```bash
# Local
git push origin main

# Server
ssh apolloinvoicegh@apollo-invoice
cd /var/www/invoice-app/
git pull origin main
./production-update.sh
```

### **Check Status:**
```bash
# Check if running
php artisan about

# Check logs
tail -f storage/logs/laravel.log

# Check maintenance mode
curl -I https://your-domain.com
```

### **Emergency:**
```bash
# Quick rollback
ssh apolloinvoicegh@apollo-invoice
cd /var/www/invoice-app/
./rollback.sh
```

---

## 🎯 Your Server Details

- **Server**: `apolloinvoicegh@apollo-invoice`
- **Path**: `/var/www/invoice-app/`
- **Main Script**: `./production-update.sh`
- **Rollback Script**: `./rollback.sh`

---

**Ready to deploy! 🚀**
