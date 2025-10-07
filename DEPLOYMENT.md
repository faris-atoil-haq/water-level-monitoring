# Deploying Laravel Water Level Monitoring to Vercel

## Prerequisites

1. **Vercel Account**: Sign up at [vercel.com](https://vercel.com)
2. **Cloud Database**: You'll need a hosted PostgreSQL database (recommended services):
   - [Supabase](https://supabase.com) (Free tier available)
   - [Neon](https://neon.tech) (Free tier available)
   - [Railway](https://railway.app) (Free tier available)
   - [PlanetScale](https://planetscale.com) (MySQL alternative)

## Step-by-Step Deployment

### 1. Prepare Your Database

Since Vercel is serverless, you need a cloud database:
1. Create account at [railway.app](https://railway.app)
2. Create new project → Add PostgreSQL
3. Copy connection details from Variables tab

### 2. Deploy to Vercel

#### Method 1: Using Vercel CLI
```bash
# Install Vercel CLI
npm i -g vercel

# Login to Vercel
vercel login

# Deploy from your project directory
vercel --prod
```

#### Method 2: Using GitHub Integration
1. Push your code to GitHub
2. Go to [vercel.com/dashboard](https://vercel.com/dashboard)
3. Click "New Project"
4. Import your GitHub repository
5. Configure environment variables (see below)

### 3. Configure Environment Variables in Vercel

In your Vercel project dashboard, go to Settings → Environment Variables and add:

**🎯 Recommended for Vercel (DATABASE_URL method):**
```
APP_NAME=Water Level Monitoring
APP_ENV=production
APP_KEY=base64:avsiI/KgwZ9hCAUxqzCfU+W6IX/dJDf1QYR9V/NKgJE=
APP_DEBUG=false
APP_URL=https://your-project-name.vercel.app

DATABASE_URL=postgresql://neondb_owner:npg_Hycop8OQCsv4@ep-billowing-moon-ad4vg68z-pooler.c-2.us-east-1.aws.neon.tech/neondb?sslmode=require&options=endpoint%3Dep-billowing-moon-ad4vg68z

LOG_CHANNEL=stack
LOG_LEVEL=error
CACHE_DRIVER=array
SESSION_DRIVER=array
QUEUE_CONNECTION=sync
```

**🔄 Alternative (Individual parameters method):**
```
APP_NAME=Water Level Monitoring
APP_ENV=production
APP_KEY=base64:avsiI/KgwZ9hCAUxqzCfU+W6IX/dJDf1QYR9V/NKgJE=
APP_DEBUG=false
APP_URL=https://your-project-name.vercel.app

DB_CONNECTION=pgsql
DB_HOST=ep-billowing-moon-ad4vg68z-pooler.c-2.us-east-1.aws.neon.tech
DB_PORT=5433
DB_DATABASE=neondb
DB_USERNAME=neondb_owner
DB_PASSWORD=npg_Hycop8OQCsv4

LOG_CHANNEL=stack
LOG_LEVEL=error
CACHE_DRIVER=array
SESSION_DRIVER=array
QUEUE_CONNECTION=sync
```

### 4. Generate Application Key

Run this locally and copy the key:
```bash
php artisan key:generate --show
```

### 5. Run Database Migrations

After deployment, you'll need to run migrations on your cloud database:

**Option 1: Local connection to cloud DB**
1. Update your local `.env` with cloud database credentials
2. Run: `php artisan migrate --force`
3. Run: `php artisan db:seed --class=WaterLevelSeeder --force`

**Option 2: Use database management tool**
- Use your database provider's web interface
- Or use tools like phpMyAdmin, Adminer, or database clients

### 6. Verify Deployment

1. Visit your Vercel URL
2. Check that all routes work:
   - `/` (home)
   - `/dashboard`
   - `/prediksi`

## Important Notes

### Limitations on Vercel:
- **Execution Time**: Max 10 seconds for hobby plan, 60 seconds for pro
- **File Storage**: Not persistent (use cloud storage for files)
- **Database**: Must use external database service
- **Caching**: Limited caching options

### Recommendations:
- Use `array` driver for cache and sessions (as configured)
- Consider using Redis cloud service for better performance
- Monitor your function execution times
- Use CDN for static assets

### Troubleshooting:
- Check Vercel function logs in dashboard
- Ensure all environment variables are set
- Verify database connection
- Check PHP version compatibility (Vercel supports PHP 8.0+)

## Alternative Deployment Options

If Vercel doesn't meet your needs, consider:
- **Railway**: Better for full-stack apps with database
- **DigitalOcean App Platform**: Laravel-friendly
- **Heroku**: Traditional PaaS (has free tier limitations)
- **AWS Elastic Beanstalk**: More control and scalability

## Files Added for Vercel:
- `vercel.json`: Vercel configuration
- `api/index.php`: Entry point for Vercel functions
- `.env.vercel`: Environment template for production
- Updated `composer.json` with build scripts