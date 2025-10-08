# Debugging 500 Error on Vercel 🐛

## 🔍 **Step-by-Step Debug Process:**

### Step 1: Check Health Endpoint
After deployment, visit: `https://your-app.vercel.app/health`

This will show:
- ✅ PHP version and basic info
- ✅ Environment variables status
- ✅ File existence check
- ✅ Server configuration

### Step 2: Check Vercel Function Logs
1. Go to Vercel Dashboard
2. Click on your project
3. Go to "Functions" tab
4. Click on any failed function to see detailed logs

### Step 3: Most Common 500 Error Causes:

#### ❌ **Missing Environment Variables**
Make sure these are set in Vercel:
```
APP_ENV=production
APP_KEY=base64:avsiI/KgwZ9hCAUxqzCfU+W6IX/dJDf1QYR9V/NKgJE=
APP_DEBUG=false
APP_URL=https://your-project-name.vercel.app
DATABASE_URL=postgresql://neondb_owner:npg_Hycop8OQCsv4@ep-billowing-moon-ad4vg68z-pooler.c-2.us-east-1.aws.neon.tech/neondb?sslmode=require&options=endpoint%3Dep-billowing-moon-ad4vg68z
LOG_CHANNEL=stderr
CACHE_DRIVER=array
SESSION_DRIVER=cookie
```

#### ❌ **Database Connection Issues**
- Database URL format incorrect
- Database server unreachable
- SSL/TLS configuration problems

#### ❌ **Missing Dependencies**
- Composer packages not installed
- PHP extensions missing
- Laravel framework issues

#### ❌ **File Permissions/Paths**
- Laravel entry point not found
- Vendor directory missing
- Bootstrap files not accessible

### Step 4: Enable Debug Mode Temporarily
Set in Vercel environment variables:
```
APP_DEBUG=true
LOG_LEVEL=debug
```

### Step 5: Check Laravel Requirements
Ensure all these files exist in your repository:
- ✅ `public/index.php`
- ✅ `bootstrap/app.php`
- ✅ `vendor/autoload.php`
- ✅ `composer.json`
- ✅ `.env` (not needed for Vercel, but structure should be correct)

## 🚀 **Quick Fixes:**

### Fix 1: Redeploy with Debug
```bash
git add .
git commit -m "Add debug endpoints and error handling"
git push origin main
```

### Fix 2: Check Vercel Environment Variables
1. Go to Vercel Dashboard → Project → Settings → Environment Variables
2. Ensure all required variables are set
3. Redeploy after adding missing variables

### Fix 3: Check Function Logs
- Look for specific error messages in Vercel Function logs
- Common errors: "Class not found", "Database connection failed", "File not found"

## 📋 **Debug Checklist:**

- [ ] Health endpoint returns 200 OK
- [ ] All environment variables set in Vercel
- [ ] APP_KEY is properly formatted (base64:...)
- [ ] DATABASE_URL is correctly formatted
- [ ] Vercel function logs show specific error
- [ ] Laravel files are properly deployed
- [ ] Composer dependencies are installed

## 🆘 **If Still 500 Error:**

1. **Enable APP_DEBUG=true** temporarily
2. **Check Vercel function logs** for detailed error
3. **Test health endpoint** first: `/health`
4. **Verify database connection** separately
5. **Check if basic PHP works** before Laravel

Most 500 errors are due to missing environment variables or database connection issues! 🎯